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
                        <a class="btn btn-info" style="margin-top: 5px " href="{{action('TaskController@edit',['task' => $task->id])}}"> Edit Task </a>
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
