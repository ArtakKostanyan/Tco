@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="{{ action('TaskController@store') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <!-- Task Name -->
                <div class="col-sm-6">
                    <div class="form-group">
                       
             <label for="task-name"> Title</label>
    
                       <input type="text" name="title" id="task-name" class="form-control">

               <label for="task-name"> Description</label>
                         <input type="text" name="description" id="task-name" class="form-control">
                         <label for="task-name"> Deadline</label>
                        <input class="form-control"  value="2018-07-22" name="deadline" type="date">
                    </div>
                </div>
 


                <!-- Add Task Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> Add Task
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  jQuery(document).ready(function () {
    jQuery('.date').datepicker();
});


</script>
