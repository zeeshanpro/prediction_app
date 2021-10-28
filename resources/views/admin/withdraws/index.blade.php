@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>{{ $flag }} Transactions</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">{{ $flag }} Transactions</li>
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
            <h3 class="card-title">{{ $flag }} Transactions</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th>ID</th>
						<th>User Name</th>
						<th>Email</th>
						<th>Method Name</th>
						<th>Amount</th>
						<th>Status</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
                </thead>
                <tbody>
				@php $i = 0; @endphp
                @foreach($withdraws as $dt)
					@php $i++; @endphp
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $dt->user_name }}</td>
                    <td>{{ $dt->email }}</td>
                    <td>{{ $dt->method_name }}</td>
                    <td>{{ $dt->amount }}</td>
                    <td>{{ ($dt->is_status == 1 ) ? 'Completed' : 'Pending' }}</td>
                    <td>{{ $dt->created_at }}</td>
                    <td>
						<?php if($dt->is_status == 0){ ?>
							<a href="{{ route('withdraws.edit',$dt->id) }}">Edit</a>
						<?php }else{ echo "-"; }?>
					</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
					<tr>
						<th>ID</th>
						<th>User Name</th>
						<th>Email</th>
						<th>Method Name</th>
						<th>Amount</th>
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