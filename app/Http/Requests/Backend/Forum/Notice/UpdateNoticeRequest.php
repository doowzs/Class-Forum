<?php

namespace App\Http\Requests\Backend\Forum\Notice;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateNoticeRequest.
 */
class UpdateNoticeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isExecutive();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        clean($_POST['content']);
        return [
            'notice' => 'max:10000',
        ];
    }
}
