@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Edit Transactions</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Transactions</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>


 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Edit Transactions</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
				<form action="{{ route('withdraws.update',$withdraw->id) }}" method="POST" enctype="multipart/form-data">
					
					@csrf
					@method('PUT')
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="name">User Name</label>
								<input class="form-control" type="text" placeholder="User Name" value="{{ $withdraw->user_name }}" readonly />
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="name">Email</label>
								<input class="form-control" type="text" placeholder="Email" value="{{ $withdraw->email }}" readonly />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="name">Payment Method</label>
								<input class="form-control" type="text" placeholder="Payment Method" value="{{ $withdraw->method_name }}" readonly />
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="name">Amount</label>
								<input class="form-control" type="text" placeholder="Amount" value="{{ $withdraw->amount }}" readonly />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" style="width: 100%;" id="is_status" name="is_status" required >
									<option value="">Select Status</option>
									<option value="0" {{ $withdraw->is_status == 0 ? 'selected' : '' }} >Pending</option>
									<option value="1" {{ $withdraw->is_status == 1 ? 'selected' : '' }} >Complete</option>
								  </select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<button class="btn btn-primary btn-lg" type="submit" id="save-btn" />Save</button>
						</div>
					</div>
				</form>
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