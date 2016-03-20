<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-03-20
 * Time: 20:27
 */

namespace market\Http\Requests\market\delete;


use market\Http\Requests\baseRequest;

class baseDeleteRequest extends baseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hidden' => 'required|numeric|min:0',
            'reason' => 'required|numeric|min:0',
            'yes'=> 'required_without:no',
//
//            'price' => 'required|numeric|min:0',
//            'description' => 'required|min:5',
//            'contactPm' => 'boolean',
//            'contactPhone' => 'boolean',
//            'contactMail' => 'boolean',
//            'contactQuestions' => 'boolean',
        ];
    }
}