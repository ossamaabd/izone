<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusDoneRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'work_report' => 'required',
            "client's_notes" => 'required',
            "total_cost" => 'required|numeric',
            "client's_evaluation" => 'required',
        ];
    }
}
