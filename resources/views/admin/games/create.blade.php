@extends('layouts.app')

@section('content')
<style>
.topMargin{
	margin-top:10px !important;
}
.trueAnschk{
	display:none;
	//margin: 10px !important;
}
</style>
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
						<option value="">Select Sport</option>
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
						<select class="form-control" style="width: 100%;" id="team1" name="team1id" required onchange="getTeamOptions()" >
							<option value="">Select Team</option>
							@if(isset($data['teams']) && !empty($data['teams']))
								@foreach($data['teams'] as $dt)
									<option value="{{ $dt->id }}"> {{ $dt->name }}</option>
								@endforeach
							@endif
						</select>
					</div>
					
					<div class="form-group" id="team2Div" style="display:none">
						<label>Team 2 Name</label>
						<select class="form-control" style="width: 100%;" id="team2" name="team2id" onchange="getTeamOptions()">
						<option value="">Select Team</option>
							@if(isset($data['teams']) && !empty($data['teams']))
								@foreach($data['teams'] as $dt)
									<option value="{{ $dt->id }}"> {{ $dt->name }}</option>
								@endforeach
							@endif
					  </select>
					</div>

					<div class="form-group">
						<label>Game start date time</label>
						<div class="input-group date" id="startdatetime" data-target-input="nearest">
							<input type="text" class="form-control datetimepicker-input" name="startdatetime" data-target="#startdatetime" required/>
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
					
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" style="width: 100%;" id="is_status" name="is_status" required >
									<option value="">Select Status</option>
									<option value="1">Publish</option>
									<option value="0">Hide</option>
								  </select>
							</div>
						</div>
					</div>
				</div>
			</div>
					
					<hr />
			<div class="row">
				  <div class="col-md-12">		
					<div class="form-group">
						<label>Predictions</label>
						<div id="questionsDiv">
							<div class="form-group" id="QuestionDiv_1">
								<div id="Question_1">
									<label>Prediction 1 <a href="javascript:void(0)" data-id="1" onclick="removeQuestion(this)">Remove Prediction</a></label> 
									<input type="text" class="form-control"  name="questions[0]" placeholder="Enter Predictions 1" required >
									<div class="input-group topMargin" id="answer_1_1">
										<input type="text" class="form-control" name="answers[0][]" placeholder="Enter Odd 1" required >
										<div class="input-group-append">
											<input type="text" class="form-control decimal_only" name="points[0][]" placeholder="Point" required >
											<select class="form-control teamsOpt" name="teams[0][]" required >
												<option value="">Select Team</option>	
											</select>
											<input class="trueAnschk" type="checkbox" name="trueAns[0][1]" value="1">
											<span class="input-group-text"><a href="javascript:void(0)" data-id="1_1" onclick="removeAnswer(this)">Remove Odd</a></span>
										</div>
									</div>
								</div>
								<a href="javascript:void(0)" data-Question_no="1" data-Answer_no="2" onclick="addAnswer(this)">Add Odd</a>
							</div>
						</div>
						<a href="javascript:void(0)" data-Question_no="2" id="add_question_btn" onclick="addQuestion(this)">Add Prediction</a>
					</div>
					
					<hr />
					
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
		
		  var TeamHtml = "";
		  function getTeamOptions()
		  {
			var team1Opt = '';
			var team2Opt = '';
			var selected = '';
			
			var TypeID = $('input[name="type"]:checked').val();
			if(TypeID == 1)
					selected = 'selected';
			
			if($("#team1").val() != '')
			{
				var team1Text = $("#team1").children("option:selected").html();
				var team1Value = $("#team1").children("option:selected").val();
				
				if(team1Value != '')
					team1Opt = '<option value="'+team1Value+'" '+selected+'>'+team1Text+'</option>';
			}

			if(TypeID == 2)
			{
				if($("#team2").val() != '')
				{
					var team2Text = $("#team2").children("option:selected").html();
					var team2Value = $("#team2").children("option:selected").val();
					if(team2Value != '')
						team2Opt = '<option value="'+team2Value+'">'+team2Text+'</option>';
				}
			}
			
			TeamHtml = '<option value="">Select Team</option>'+
							team1Opt+
							team2Opt;
							
			$(".teamsOpt").html('');
			$(".teamsOpt").html(TeamHtml);			
		  }
		  
          $('document').ready(function() {

            //Date and time picker
            $('#startdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
            $('#enddatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

            $('input[name="type"]').change(function(){
               if(this.checked){
				   getTeamOptions();
                   if($(this).val() == 2){
                       $('#team2Div').css('display','block');
                       $('#team2').attr('required',true);
                   } else{
                       $('#team2Div').css('display','none');
					   $('#team2').attr('required',false);
					   //$('#team2').val('');
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

		function addQuestion(e)
		{
			var Question_no = $(e).attr('data-Question_no');
			var Next_Question_no = parseInt(Question_no) + 1;
			var Perv_Question_no = parseInt(Question_no) - 1;
			
			var QuestionHtml = 
						'<div class="form-group" id="QuestionDiv_'+Question_no+'">'+
							'<div id="Question_'+Question_no+'">'+
								'<label>Prediction '+Question_no+' <a href="javascript:void(0)" data-id="'+Question_no+'" onclick="removeQuestion(this)">Remove Prediction</a></label>'+
								'<input type="text" class="form-control"  name="questions['+Perv_Question_no+']" placeholder="Enter Prediction '+Question_no+'" required >'+
								'<div class="input-group topMargin" id="answer_'+Question_no+'_1">'+
									'<input type="text" class="form-control"  name="answers['+Perv_Question_no+'][]" placeholder="Enter Odd 1" required >'+
									'<div class="input-group-append">'+
										'<input type="text" class="form-control decimal_only" name="points['+Perv_Question_no+'][]" placeholder="Point" required >'+
										'<select class="form-control teamsOpt" name="teams['+Perv_Question_no+'][]" required >'+
											TeamHtml+	
										'</select>'+
										'<input class="trueAnschk" type="checkbox" name="trueAns['+Perv_Question_no+'][1]" value="1">'+
										'<span class="input-group-text"><a href="javascript:void(0)" data-id="'+Question_no+'_1" onclick="removeAnswer(this)">Remove Odd</a></span>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<a href="javascript:void(0)" data-Question_no="'+Question_no+'" data-Answer_no="2" onclick="addAnswer(this)">Add Odd</a>'+
						'</div>';
			$("#questionsDiv").append(QuestionHtml);
			$(e).attr('data-Question_no',Next_Question_no);
		}
		
		function addAnswer(e)
		{
			var Question_no = $(e).attr('data-Question_no');
			var Answer_no = $(e).attr('data-Answer_no');
			var Next_Answer_no = parseInt(Answer_no) + 1;
			var Perv_Question_no = parseInt(Question_no) - 1;
			
			var AnswerHtml = 
							'<div class="input-group topMargin" id="answer_'+Question_no+'_'+Answer_no+'">'+
								'<input type="text" class="form-control" name="answers['+Perv_Question_no+'][]" placeholder="Enter Odd '+Answer_no+'" required>'+
								'<div class="input-group-append">'+
									'<input type="text" class="form-control decimal_only" name="points['+Perv_Question_no+'][]" placeholder="Point" required >'+
									'<select class="form-control teamsOpt" name="teams['+Perv_Question_no+'][]" required >'+
										TeamHtml+	
									'</select>'+
									'<input class="trueAnschk" type="checkbox" name="trueAns['+Perv_Question_no+']['+Answer_no+']" value="1">'+
									'<span class="input-group-text"><a href="javascript:void(0)" data-id="'+Question_no+'_'+Answer_no+'" onclick="removeAnswer(this)">Remove Odd</a></span>'+
								'</div>'+
							'</div>';
						
			$("#Question_"+Question_no).append(AnswerHtml);
			$(e).attr('data-Answer_no',Next_Answer_no);
		}
		
		function removeAnswer(e)
		{
			var answerID = $(e).attr('data-id');
			$("#answer_"+answerID).remove();
		}
		
		function removeQuestion(e)
		{
			var questionID = $(e).attr('data-id');
			$("#QuestionDiv_"+questionID).remove();
		}
		
        </script>
    @endpush
@endonce