@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Payment Methods</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Payment Methods</li>
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
            <h3 class="card-title">Payment Methods</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Exchange Rate</th>
						<th>Status</th>
						<th>Logo</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
                </thead>
                <tbody>
                @foreach($payment_methods as $dt)
                <tr>
                    <td>{{ $dt->id }}</td>
                    <td>{{ $dt->name }}</td>
                    <td>{{ $dt->exchange_rate }}</td>
                    <td><a href="{{ asset('/uploads/payment_methods/'.$dt->logo) }}" target="_blank">View</a></td>
                    <td>{{ ($dt->is_status == 1 ) ? 'Show' : 'Hide' }}</td>
                    <td>{{ $dt->created_at }}</td>
                    <td><a href="{{ route('payment_method.edit',$dt->id) }}">Edit</a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Status</th>
						<th>Logo</th>
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