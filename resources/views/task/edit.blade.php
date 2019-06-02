@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form action="{{ action('TaskController@update', ['task' => $task->id]) }}" method="POST"
                      class="form-horizontal">
                {{ csrf_field() }}
                <!-- Task Name -->
                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">Task</label>
                        <div class="col-sm-6">
                            <input type="text" name="title" value="{{$task->title}}" id="task-name" class="form-control">
                            <input type="text" value="{{$task->description}}" name="description" id="task-name" class="form-control">
                            <input class="form-control" value="{{$task->deadline->toDateString()}}" name="deadline" type="date">
                        </div>
                    </div>

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-plus"></i> Update Task
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
