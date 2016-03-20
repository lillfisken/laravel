<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-08
 * Time: 22:30
 */

namespace market\Http\Requests\market\create;


use market\Http\Requests\baseRequest;

class sell extends baseRequest
{
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
            'description' => 'required|min:5',
            'contactPm' => 'boolean',
            'contactPhone' => 'boolean',
            'contactMail' => 'boolean',
            'contactQuestions' => 'boolean',
        ];
    }
}