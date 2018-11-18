<?php

namespace App\Http\Requests\Frontend\Forum\Personal;

use App\Models\Forum\Assignment;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageAssignmentRequest.
 */
class ManageAssignmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $assignment = Assignment::find($this->route('assignment'));
        return $assignment &&
            ($this->user()->isExecutive() || $this->user()->id == $assignment->issuer);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
