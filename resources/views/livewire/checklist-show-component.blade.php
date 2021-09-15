<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{ $checklist->name }}
            </div>
            <div class="card-body">
                <table class="table">
                    @foreach($checklist->tasks->where('user_id',null) as $task)
                        <tr>
                            <td>
                                <input type="radio" wire:click="complete_task({{ $task->id }})"
                                    @if(in_array($task->id,$completed_tasks)) checked="checked" @endif>
                            </td>
                            <td wire:click="toggle_task({{$task->id}})" class="task-description-toggle" data-id="{{ $task->id }}">{{ $task->title }}</td>
                            <td wire:click="toggle_task({{$task->id}})">
                                @if(in_array($task->id, $opened_tasks))
                                    <i class="cil-caret-top"></i>
                                @else
                                    <i class="cil-caret-bottom"></i>
                                @endif
                            </td>
                        </tr>
                        @if(in_array($task->id, $opened_tasks))
                            <tr>
                                <td></td>
                                <td colspan="2">{!! $task->description !!}</td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
