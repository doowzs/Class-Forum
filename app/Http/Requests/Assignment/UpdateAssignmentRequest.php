<?php

namespace App\Http\Requests\Assignment;

use App\Rules\Sanitize;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAssignmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // TODO: PERMISSIONS!!
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'assignment_id' => ['required', 'int', 'exists:assignments,id'],
            'name'          => ['sometimes', new Sanitize(), 'max:100'],
            'content'       => ['sometimes', new Sanitize(), 'max:2000'],
            'due_time'      => ['sometimes', 'date_format:Y-m-d H:i:s'],
        ];
    }
}