@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Game</h1>
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

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6" data-select2-id="29">
                <div class="form-group">
                  <label>Sports</label>
                  <select class="form-control" style="width: 100%;">
                    <option value="">Select Sports</option>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label>Championships</label>
                  <select class="form-control" style="width: 100%;">
                    <option value="">Select Championship</option>
                    
                  </select>
                </div>

                <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="single" name="team" checked="" value="1">
                        <label for="single">
                        Single
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="teams" name="team" value="2">
                        <label for="teams">
                        Team
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="team1" placeholder="Enter team name">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="team2" placeholder="Enter team name"  style="display:none">
                    </div>

                    <div class="form-group">
                        <label>Game start date time</label>
                        <div class="input-group date" id="startdatetime" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#startdatetime"/>
                        <div class="input-group-append" data-target="#startdatetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                        <label>Game end date time</label>
                        <div class="input-group date" id="enddatetime" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#enddatetime"/>
                        <div class="input-group-append" data-target="#enddatetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    </div>
              </div>
            </div>
            <!-- /.row -->
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div>
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

            $('input[name="team"]').change(function(){
               if(this.checked){
                   if($(this).val() == 2){
                       $('#team2').css('display','block');
                   } else{
                       $('#team2').css('display','none');
                   }
               }
           });
          });
        </script>
    @endpush
@endonce