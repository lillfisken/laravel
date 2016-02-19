<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-18
 * Time: 21:49
 */

namespace market\Http\Requests\market\create;


use market\Http\Requests\baseRequest;

class auction extends baseRequest
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
            'title' => 'required|min:3',
            'price' => 'required|numeric|min:0',
            'end_at' => 'required|date', //TODO: After today
            'description' => 'required|min:5',
            'contactPm' => 'boolean',
            'contactPhone' => 'boolean',
            'contactMail' => 'boolean',
            'contactQuestions' => 'boolean',
        ];
    }
}