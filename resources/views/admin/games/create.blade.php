@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Add Game</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Game</li>
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
            <h3 class="card-title">Add Game</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
		  <form action="{{ route('games.store')}}" method="POST" enctype="multipart/form-data">		
				@csrf
				<div class="row">
				  <div class="col-md-6" data-select2-id="29">
					<div class="form-group">
					  <label>Sports</label>
					  <select class="form-control" style="width: 100%;" id="sportOpt" name="sport_id" required onchange="getChampionshipBySportID(this)">
						<option value="">Select Sports</option>
							@if(isset($data['sports']) && !empty($data['sports']))
								@foreach($data['sports'] as $dt)
									<option value="{{ $dt->id }}"> {{ $dt->name }}</option>
								@endforeach
							@endif
					  </select>
					</div>
					<div class="form-group">
					  <label>Championships</label>
					  <select class="form-control" style="width: 100%;" name="championship_id" required id="ChampionshipOpt">
						<option value="">Select Championship</option>
							
					  </select>
					</div>

					<div class="form-group clearfix">
					  <div class="icheck-primary d-inline">
						<input type="radio" id="single" name="type" checked="" value="1">
						<label for="single">
						Single
						</label>
					  </div>
					  <div class="icheck-primary d-inline">
						<input type="radio" id="teams" name="type" value="2">
						<label for="teams">
						Team
						</label>
					  </div>
					</div>

					<div class="form-group">
						<label>Team Name</label>
						<input type="text" class="form-control" id="team1" name="team1" placeholder="Enter team name" required >
						<label>Team Logo</label>
						<input type="file" class="form-control" id="team1Logo" name="team1Logo" required accept="image/*" onchange="allowonlyImg(this)">
					</div>
					
					<div class="form-group" id="team2Div" style="display:none">
						<label>Team 2 Name</label>
						<input type="text" class="form-control" id="team2" name="team2" placeholder="Enter team name" >
						<label>Team 2 Logo</label>
						<input type="file" class="form-control" id="team2Logo" name="team2Logo" accept="image/*" onchange="allowonlyImg(this)">
					</div>

					<div class="form-group">
						<label>Game start date time</label>
						<div class="input-group date" id="startdatetime" data-target-input="nearest">
							<input type="text" class="form-control datetimepicker-input" name="startdatetime" -target="#startdatetime" required/>
							<div class="input-group-append" data-target="#startdatetime" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="fa fa-calendar"></i></div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>Game end date time</label>
						<div class="input-group date" id="enddatetime" data-target-input="nearest">
							<input type="text" class="form-control datetimepicker-input" name="enddatetime" data-target="#enddatetime" required />
							<div class="input-group-append" data-target="#enddatetime" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="fa fa-calendar"></i></div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-lg" type="submit" id="save-btn" />Save</button>
					</div>
				  </div>
				</div>
				<!-- /.row -->
			</form>
          </div>
          <!-- /.card-body -->
        </div>
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
            $('#startdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
            $('#enddatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

            $('input[name="type"]').change(function(){
               if(this.checked){
                   if($(this).val() == 2){
                       $('#team2Div').css('display','block');
                       $('#team2').attr('required',true);
                       $('#team2Logo').attr('required',true);
                   } else{
                       $('#team2Div').css('display','none');
					   $('#team2').attr('required',false);
                       $('#team2Logo').attr('required',false);
                   }
               }
           });
          });
		  
		function getChampionshipBySportID(e)
		{
			$("#ChampionshipOpt").html("");
			var sportID = $(e).val();
			if(sportID == '')
			{
				$("#ChampionshipOpt").html('<option value="">Select Championship</option>');
				alert("Please Select Sport");
				return false;
			}
					
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				}
			});
			
			var type = "POST";
			var ajaxurl = '/admin/championships/getChampionshipBySportID';
			$.ajax({
				type: type,
				url: ajaxurl,
				data: {"sportID" : sportID },
				dataType: 'json',
				success: function (data) {
					$("#ChampionshipOpt").html(data.html);
				},
				error: function (data) {
	
				}
			});
		}

        </script>
    @endpush
@endonce