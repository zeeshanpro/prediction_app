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
					@foreach($games as $dt)
					<tr>
						<td>{{ $dt->id }}</td>
						<td>{{ $dt->sport->name }}</td>
						<td>{{ $dt->championships->name }}</td>
						<td>{{ ($dt->is_status == 1 ) ? 'Publish' : 'Hide' }}</td>
						<td>{{ ($dt->is_status == 1 ) ? 'Single' : 'Team' }}</td>
						<td>{{ $dt->created_at }}</td>
						<td><a href="{{ route('games.edit',$dt->id) }}">Edit</a></td>
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

@endsection