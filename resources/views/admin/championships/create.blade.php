@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Add Championship</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Championship</li>
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
            <h3 class="card-title">Add Championship</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
				<form action="{{ route('championships.store')}}" method="POST">
					
					@csrf
					
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="name">Name</label>
								<input class="form-control" type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}" required />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="name">Sports</label>
								<select class="form-control" name="sports_id" required >
									<option value=""> Select Sport </option>
										@if(isset($sports) && !empty($sports))
											@foreach($sports as $dt)
												<option value="{{ $dt->id }}"> {{ $dt->name }}</option>
											@endforeach
										@endif
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