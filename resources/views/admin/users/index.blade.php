@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Users</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
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
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th>Sr #</th>
						<th>Name</th>
						<th>Email</th>
						<th>Current Credit</th>
						<th>Status</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
                </thead>
                <tbody>
				<?php
					$i = 0;
					foreach($users as $user):
						$i++;
				?>
					<tr>
						<td>{{ $i }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ (!empty($user->credits)) ? $user->credits : 0 }}</td>
						<td>{{ ($user->is_status == 1 ) ? 'Active' : 'Block' }}</td>
						<td>{{ $user->created_at }}</td>
						<td>
							<a href="{{ route('userDetail',$user->id) }}">Details</a> |
							<a href="{{ route('userEdit',$user->id) }}">Edit</a> |
							<a href="javascript:void(0)" onclick="deleteUser({{$user->id}})">Delete</a>
						</td>
					</tr>
				<?php
					endforeach;
				?>
                </tbody>
                <tfoot>
					<tr>
						<th>Sr #</th>
						<th>Name</th>
						<th>Email</th>
						<th>Current Credit</th>
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

@endsection

@once
    @push('scripts')
        <script>
			function deleteUser(uid)
			{
				if(uid !="")
				{
					if (confirm('Do you want to this User?')) {
						$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': "{{ csrf_token() }}"
							}
						});
						
						var type = "POST";
						var ajaxurl = '/admin/users/userDelete/'+uid;
						$.ajax({
							type: type,
							url: ajaxurl,
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
			
			}
		</script>
    @endpush
@endonce