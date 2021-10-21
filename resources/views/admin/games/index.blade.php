@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Games</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Games</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>


 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
    <div class="row">
	
		@if($message = Session::get('success'))
			<div class="alert alert-success">
				<p> {{ $message }} </p>
			</div>
		@endif
		
		@if($message = Session::get('error'))
			<div class="alert alert-danger">
				<p> {{ $message }} </p>
			</div>
		@endif
		
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Games</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th>ID</th>
						<th>Sports</th>
						<th>Championships</th>
						<th>Type</th>
						<th>Status</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
                </thead>
                <tbody>
				@if(isset($games) && !empty($games))
					<?php $statusArray = array("Hide","Publish","Completed"); ?>
					@foreach($games as $dt)
					<tr>
						<td>{{ $dt->id }}</td>
						<td>{{ $dt->sport->name }}</td>
						<td>{{ $dt->championships->name }}</td>
						<td>{{ (isset($statusArray[$dt->is_status])) ? $statusArray[$dt->is_status] : '-' }}</td>
						<td>{{ ($dt->type == 1 ) ? 'Single' : 'Team' }}</td>
						<td>{{ $dt->created_at }}</td>
						<td>
							<a href="{{ route('games.edit',$dt->id) }}">Edit</a>
							<?php 
								if($dt->end_time <= date("Y-m-d H:i:s")){
									if($dt->is_allocate == 0){
							?>
										| <a href="javascript:void(0)" onclick="allocateReward(this)" data-id="{{ $dt->id }}">Finalize</a>
							<?php	
									}
								}
							?>
						</td>
					</tr>
					@endforeach
                @endif
                </tbody>
                <tfoot>
					<tr>
						<th>ID</th>
						<th>Sports</th>
						<th>Championships</th>
						<th>Type</th>
						<th>Status</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
                </tfoot>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>		
	function allocateReward(e)
		{
			var gameID = $(e).attr('data-id');
			if(gameID !="")
			{
				if (confirm('Do you want to process this request?')) {
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': "{{ csrf_token() }}"
						}
					});
					
					var type = "POST";
					var ajaxurl = '/admin/games/allocateRewardByGameID';
					$.ajax({
						type: type,
						url: ajaxurl,
						data: {"gameID" : gameID },
						dataType: 'json',
						success: function (data) {
							if(data.status)
							{
								alert(data.message);
								location.reload();
							}
							else
							{
								alert("Something went wrong.");
							}
						},
						error: function (data) {
			
						}
					});
				}
			}
			else
			{
				var answerID = $(e).attr('data-id');
				$("#answer_"+answerID).remove();
			}
		}
</script>

@endsection