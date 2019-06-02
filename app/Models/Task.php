<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @property int $id
 *
 * @package App\Models
 */
class Task extends Model
{
    const ASSIGNED = 'assigned';
    const IN_PROGRESS = 'in_progress';
    const DONE = 'done';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'deadline',
        'description',
    ];

    protected $dates = [
        'deadline',
    ];
}




