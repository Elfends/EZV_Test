<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Task;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:tasks,id',
            'title' => 'required|max:255|string',
            'description' => 'nullable|max:255|string',
            'user_id' => 'required|numeric|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'id.exists' => 'Task is not exist.',
            'user_id.exists' => 'User is not exist.',
        ];
    }
}
