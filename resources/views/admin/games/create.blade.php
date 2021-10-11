@extends('layouts.app')

@section('content')
<style>
.topMargin{
	margin-top:10px !important;
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
						<input type="file" class="form-control" id="team1Logo" name="team1Logo" accept="image/*" onchange="allowonlyImg(this)" required>
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
					
					<hr />
					
					<div class="form-group">
						<label>Questions</label>
						<div id="questionsDiv">
							<div class="form-group" id="QuestionDiv_1">
								<div id="Question_1">
									<label>Question 1 <a href="javascript:void(0)" data-id="1" onclick="removeQuestion(this)">Remove Question</a></label> 
									<input type="text" class="form-control"  name="questions[0]" placeholder="Enter Question 1" required >
									<div class="input-group topMargin" id="answer_1_1">
									 <input type="text" class="form-control" name="answers[0][]" placeholder="Enter Answer 1" required >
									  <div class="input-group-append">
										<span class="input-group-text"><a href="javascript:void(0)" data-id="1_1" onclick="removeAnswer(this)">Remove Answer</a></span>
									  </div>
									</div>
								</div>
								<a href="javascript:void(0)" data-Question_no="1" data-Answer_no="2" onclick="addAnswer(this)">Add Answer</a>
							</div>
						</div>
						<a href="javascript:void(0)" data-Question_no="2" id="add_question_btn" onclick="addQuestion(this)">Add Question</a>
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

		function addQuestion(e)
		{
			var Question_no = $(e).attr('data-Question_no');
			var Next_Question_no = parseInt(Question_no) + 1;
			var Perv_Question_no = parseInt(Question_no) - 1;
			
			var QuestionHtml = 
						'<div class="form-group" id="QuestionDiv_'+Question_no+'">'+
							'<div id="Question_'+Question_no+'">'+
								'<label>Question '+Question_no+' <a href="javascript:void(0)" data-id="'+Question_no+'" onclick="removeQuestion(this)">Remove Question</a></label>'+
								'<input type="text" class="form-control"  name="questions['+Perv_Question_no+']" placeholder="Enter Question '+Question_no+'" required >'+
								'<div class="input-group topMargin" id="answer_'+Question_no+'_1">'+
									'<input type="text" class="form-control"  name="answers['+Perv_Question_no+'][]" placeholder="Enter Answer 1" required >'+
									'<div class="input-group-append">'+
										'<span class="input-group-text"><a href="javascript:void(0)" data-id="'+Question_no+'_1" onclick="removeAnswer(this)">Remove Answer</a></span>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<a href="javascript:void(0)" data-Question_no="'+Question_no+'" data-Answer_no="2" onclick="addAnswer(this)">Add Answer</a>'+
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
								'<input type="text" class="form-control" name="answers['+Perv_Question_no+'][]" placeholder="Enter Answer '+Answer_no+'" required>'+
								'<div class="input-group-append">'+
										'<span class="input-group-text"><a href="javascript:void(0)" data-id="'+Question_no+'_'+Answer_no+'" onclick="removeAnswer(this)">Remove Answer</a></span>'+
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