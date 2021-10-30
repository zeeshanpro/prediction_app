@extends('layouts.app')

@section('content')
<style>
.password{
	display:none;
}
</style>
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Edit User</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit User</li>
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
            <h3 class="card-title">Edit User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
				<form id="userForm" action="{{ route('userUpdate',$user->id) }}" method="POST" enctype="multipart/form-data">
					
					@csrf
					
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="name">Name</label>
								<input class="form-control" type="text" name="name" id="name" placeholder="Name" value="{{ $user->name }}" required />
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="name">Email</label>
								<input class="form-control" type="text" id="email" placeholder="Name" value="{{ $user->email }}" required readonly />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="name">Credit</label>
								<input class="form-control decimal_only" type="text" id="credit" name="credit" placeholder="Credit" value="{{ $user->credits }}" />
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" style="width: 100%;" id="is_status" name="is_status" required >
									<option value="">Select Status</option>
									<option value="1" {{ $user->is_status == 1 ? 'selected' : '' }} >Active</option>
									<option value="0" {{ $user->is_status == 0 ? 'selected' : '' }} >Block</option>
								  </select>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<label for="change_password" style="margin-top: 25px">Change Password <input type="checkbox" id="change_password" name="change_password" value=""></label>
							</div>
						</div>
						<div class="col-4 password">
							<div class="form-group">
								<label for="password">Password</label>
								<input class="form-control" type="password" id="password" name="password" placeholder="Password" />
							</div>
						</div>
						<div class="col-4 password">
							<div class="form-group">
								<label for="con_pass">Confirm Password</label>
								<input class="form-control" type="password" id="con_pass" placeholder="Confirm Password" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-12">
							<input class="form-control" type="submit" id="submitbtn" hidden />
						</div>
					</div>
					
				</form>
					<div class="row">
						<div class="col-12">
							<button class="btn btn-primary btn-lg" type="submit" onclick="submitForm()" id="save-btn" />Save</button>
						</div>
					</div>
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
				$('input[name="change_password"]').change(function(){
				   if(this.checked){
						$(".password").show();
						//$("#password").attr("required",true);
						//$("#con_pass").attr("required",true);
				   }
				   else{
						$(".password").hide();
						//$("#password").attr("required",false);
						//$("#con_pass").attr("required",false);
				   }
			   });
			});

			function submitForm()
			{
				if($('#change_password').is(":checked"))
				{
					var password = $("#password").val();
					var confirmPassword = $("#con_pass").val();
					
					if( password == "" )
					{
						alert("Please Enter Password");
						return false;
					}
					if( confirmPassword == "" )
					{
						alert("Please Enter Confirm Password");
						return false;
					}
					
					if (password != confirmPassword)
					{
						alert("Passwords do not match!");
						return false;
					}
				}
					
				$("#submitbtn").click();
			}
		</script>
    @endpush
@endonce