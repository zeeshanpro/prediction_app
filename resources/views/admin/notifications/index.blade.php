@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Notifications</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Notifications</li>
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
            <h3 class="card-title">Notifications</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Message</th>
						<th>Status</th>
						<th>Publish Date</th>
						<th>Action</th>
					</tr>
                </thead>
                <tbody>
				<?php
					$i = 0;
					foreach($notifications as $dt):
						$i++;
				?>
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $dt->title }}</td>
                    <td>{{ $dt->message }}</td>
                    <td>{{ ($dt->is_status == 1 ) ? 'Show' : 'Hide' }}</td>
                    <td><?php echo date("m/d/Y h:i:s A",strtotime($dt->publish_time)); ?></td>
                    <td><a href="{{ route('notifications.edit',$dt->id) }}">Edit</a></td>
                </tr>
                <?php
					endforeach;
				?>
                </tbody>
                <tfoot>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Message</th>
						<th>Status</th>
						<th>Publish Date</th>
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