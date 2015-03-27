<?php namespace market\Http\Requests;

use market\Http\Requests\Request;

class MarketCreateUpdateRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        //TODO: Add check
        //If created by is set && if Create by == Auth:id
        //  Return True
        //Else if Auth:check
        //  return True
        //Else
        //  return false
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
            'title' => 'required|min:5',
            'price' => 'required|numeric|min:0',
            'contactPm' => 'boolean',
            'contactPhone' => 'boolean',
            'contactMail' => 'boolean',
            'contactQuestions' => 'boolean',

        ];
	}

    public function messages(){
        return [
            'price.min' => 'Priset måste vara över 0',
            'required' => ':attribute är obligatoriskt.',
            'numeric' => ':attribute får bara innehålla ett tal (decimal med &#39.&#39)',
            'min' => ':attribute måste innehålla minst :min bokstäver'
        ];
    }

    public function attributes(){
        return [
            'title' => 'Rubrik',
            'price' => 'Pris',
        ];
    }
}
