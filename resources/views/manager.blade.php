@extends('layouts.app')

@section('content')
    <style>
        .display{

            display: block;
        }
    </style>

    <div class="container">
        <div class="row">
            <ul>
                @foreach($tasks  as $task)
                    <li>{{$task->id}} {{$task->title}}</li>
                    <li>
                        Assign to
                        <select name="assignTo" style="width: 10%;height: 30px" class="assignTo form-control form-control-sm" data-task="{{$task->id}}">
                            <option value="">select</option>
                            @foreach($developers  as $developer)
                                <option value="{{$developer->id}}">{{$developer->id}} {{$developer->name}}</option>
                            @endforeach
                        </select>
                    </li>
                    <hr>
                @endforeach
            </ul>
            <p>Assigned Tasks List</p>
            <ul>
                @foreach($assignedTasks  as $assignedTask)
                    <li>{{$assignedTask->task()->title}} {{$assignedTask->task_status}} {{$assignedTask->developer()->name}}</li>
                @endforeach
            </ul>
            <br/>

            <a class="btn btn-primary" href="{{action('TaskController@create')}}"> Create New Task </a>
{{--            <div class="col-md-8 col-md-offset-2">--}}
{{--                <form action="{{ url('task') }}" method="POST" class="form-horizontal">--}}
{{--                {{ csrf_field() }}--}}
{{--                <!-- Task Name -->--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="task-name" class="col-sm-3 control-label">Title</label>--}}

{{--                        <div class="col-sm-6">--}}
{{--                            <input type="text" name="title" id="task-name" class="form-control">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="task-name" class="col-sm-3 control-label">Description</label>--}}

{{--                        <div class="col-sm-6">--}}
{{--                            <input type="text" name="description" id="task-description" class="form-control">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                --}}{{--<select class="form-control" name="developer">--}}
{{--                --}}{{--@foreach($developers as $developer)--}}
{{--                --}}{{--<option value="{{$developer->id}}">{{$developer->name}}</option>--}}
{{--                --}}{{--@endforeach--}}
{{--                --}}{{--</select>--}}

{{--                <!-- Add Task Button -->--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="col-sm-offset-3 col-sm-6">--}}
{{--                            <button type="submit" class="btn btn-default">--}}
{{--                                <i class="fa fa-plus"></i> Add Task--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
        </div>
    </div>

@endsection
@section('scripts')
    <script>
      $(document).ready(function () {
        $('.assignTo').on('change', function () {
          var _this = $(this);
          if ($(this).val() && $(this).data('task')) {
            $.post({
              url    : '{!! action('TaskController@assignTo') !!}',
              data   : {
                developer_id: $(this).val(),
                task_id     : $(this).data('task'),
                _token      : "{{ csrf_token() }}",
              },
              success: function () {
                  location.reload();
                  _this.val("");

              }
            });
          }
        })

        $('.dropdown-toggle').on('click',function () {

            $('.dropdown-menu').show();
        });
      })
    </script>
@endsection
