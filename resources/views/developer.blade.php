@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Developer Tasks</div>
                    <ul>
                        @foreach($assignments  as $assignment)
                            <li>Task name: {{$assignment->task()->title}}</li>
                            <li>Task Manager: {{$assignment->manager()->name}}</li>
                            <li>Task Status: {{$assignment->task_status}}</li>
                            <li>
                                <label>
                                    change task status
                                    <select data-assignment="{{$assignment->id}}" class="changeStatus"
                                            name="changeStatus">
                                        <option value="">select option</option>
                                        <option
                                                {!! $assignment->task_status === \App\Models\Task::IN_PROGRESS ? 'selected="selected"' : '' !!}
                                                value="{{\App\Models\Task::IN_PROGRESS}}">{{\App\Models\Task::IN_PROGRESS}}</option>
                                        <option
                                                {!! $assignment->task_status === \App\Models\Task::DONE ? 'selected="selected"' : '' !!}
                                                value="{{\App\Models\Task::DONE}}">{{\App\Models\Task::DONE}}</option>
                                    </select>
                                </label>
                            </li>
                            <hr/>
                        @endforeach
                    </ul>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
      $(document).ready(function () {
        $('.changeStatus').on('change', function () {
          if ($(this).val() && $(this).data('assignment')) {
            $.post({
              url : '{!! action('DevController@changeStatus') !!}',
              data: {
                task_status  : $(this).val(),
                _token       : "{{ csrf_token() }}",
                assignment_id: $(this).data('assignment'),
              },
            });
          }
        })
      })

      $('.dropdown-toggle').on('click',function () {

          $('.dropdown-menu').show();
      });
    </script>
@endsection
