@extends('layouts.app')

@section('content')

 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>User Detail</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Detail</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>


 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
    <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">User Detail</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="name">Name</label>
						<input class="form-control" type="text" value="{{ $user->name }}" disabled />
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="name">Email</label>
						<input class="form-control" type="text" value="{{ $user->email }}" disabled />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="name">User Status</label>
						<input class="form-control" type="text" value="{{ $user->is_status == 1 ? 'Active' : 'Block' }}" disabled />
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="name">User Type</label>
						<input class="form-control" type="text" value="{{ $user->is_premium == 1 ? 'Premium' : 'Non Premium' }}" disabled />
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="name">Membership Expiry Date</label>
						<input class="form-control" type="text" value="{{ !empty($user->expiry_date) ? date('Y-m-d h:i:s A',strtotime($user->expiry_date)) : '-' }}" disabled />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="name">Total Played Games</label>
						<input class="form-control" type="text" value="{{ $playedGames }}" disabled />
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="name">Complete Games</label>
						<input class="form-control" type="text" value="{{ $completeGames }}" disabled />
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="name">Pending Games</label>
						<input class="form-control" type="text" value="{{ $pendingGames }}" disabled />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="name">Total Prediction</label>
						<input class="form-control" type="text" value="{{ $totalPrediction }}" disabled />
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="name">Complete Prediction</label>
						<input class="form-control" type="text" value="{{ $completePrediction }}" disabled />
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="name">Pending Prediction</label>
						<input class="form-control" type="text" value="{{ $pendingPrediction }}" disabled />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="name">Win Prediction</label>
						<input class="form-control" type="text" value="{{ $winPrediction }}" disabled />
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="name">Lose Prediction</label>
						<input class="form-control" type="text" value="{{ $losePrediction }}" disabled />
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="name">Win Rate</label>
						<input class="form-control" type="text" value="{{ $winRate }}" disabled />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="name">Total Transactions </label>
						<input class="form-control" type="text" value="{{ $totalTransactions }}" disabled />
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="name">Open Transactions</label>
						<input class="form-control" type="text" value="{{ $openTransactions }}" disabled />
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="name">Complete Transactions</label>
						<input class="form-control" type="text" value="{{ $completeTransactions }}" disabled />
					</div>
				</div>
			</div>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection