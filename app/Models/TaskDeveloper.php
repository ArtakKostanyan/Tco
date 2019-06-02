<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskDeveloper extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manager_id',
        'task_id',
        'task_status',
        'developer_id',
    ];

    public function task()
    {
        return Task::find($this->task_id);
    }

    public function manager()
    {
        return User::find($this->manager_id);
    }

    public function developer()
    {
        return User::find($this->developer_id);
    }
}
