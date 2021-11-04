@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Packages</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Packages</li>
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
            <h3 class="card-title">Packages</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th>Sr#</th>
						<th>Name</th>
						<th>Flag</th>
						<th>Durations (Months) </th>
						<th>Price (TRY)</th>
						<th>Status</th>
					</tr>
                </thead>
                <tbody>
				@php $i= 0; @endphp
                @foreach($packages as $dt)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $dt->name }}</td>
                    <td>{{ $dt->flag }}</td>
                    <td>{{ $dt->duration }}</td>
                    <td>{{ $dt->price }}</td>
                    <td>{{ ( $dt->is_status == 1 ) ? "Active" : "Deactive" }}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
					<tr>
						<th>Sr#</th>
						<th>Name</th>
						<th>Flag</th>
						<th>Durations (Months) </th>
						<th>Price (TRY)</th>
						<th>Status</th>
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