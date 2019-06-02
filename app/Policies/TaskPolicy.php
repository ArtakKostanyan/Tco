<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the task.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Task $task
     *
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        return $user->tasks->contains($task->id);
    }

    /**
     * Determine whether the user can view the task.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Task $task
     *
     * @return mixed
     */
    public function edit(User $user, Task $task)
    {
        return $user->tasks->contains($task->id);
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Task $task
     *
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        return $user->tasks->contains($task->id);
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Task $task
     *
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        return $user->tasks->contains($task->id);
    }
}
