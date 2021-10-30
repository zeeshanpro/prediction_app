@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Edit Notification</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Notification</li>
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
            <h3 class="card-title">Edit Notification</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
				<form action="{{ route('notifications.update',$notification->id) }}" method="POST" enctype="multipart/form-data">
					
					@csrf
					@method('PUT')
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="name">Title</label>
								<input class="form-control" type="text" name="title" id="title" placeholder="Title" value="{{ $notification->title }}" required />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="name">Message</label>
								<textarea class="form-control" rows="5" name="message" id="message" placeholder="Message" required >{{ $notification->message }}</textarea>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label>Publish time</label>
								<div class="input-group date" id="publish_time" data-target-input="nearest">
									<input type="text" class="form-control datetimepicker-input" name="publish_time" data-target="#publish_time" value="<?php echo date("m/d/Y H:i:s",strtotime($notification->publish_time));?>" required/>
									<div class="input-group-append" data-target="#publish_time" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" style="width: 100%;" id="is_status" name="is_status" required >
									<option value="">Select Status</option>
									<option value="1" {{ $notification->is_status == 1 ? 'selected' : '' }} >Show</option>
									<option value="0" {{ $notification->is_status == 0 ? 'selected' : '' }} >Hide</option>
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

@once
    @push('scripts')
        <script>
			$('document').ready(function() {
				//Date and time picker
				$('#publish_time').datetimepicker({ icons: { time: 'far fa-clock' } });
			});
		</script>
    @endpush
@endonce