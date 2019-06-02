<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateTask
 *
 * @property-read \App\Models\Task $task
 *
 * @package App\Http\Requests
 */
class UpdateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('edit', $this->task);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required',
            'deadline'    => 'required',
            'description' => 'required',
        ];
    }
}
