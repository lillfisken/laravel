<?php namespace market\Http\Requests;

use market\Http\Requests\Request;

class passwordRequest extends Request {

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
            'pswdOld' => 'required|required_with:password',
            'password' => 'required|min:6|confirmed|required_with:pswdOld'
		];
	}

    public function messages(){
        return [
            'boolean' => ':attribute måste vara 1 eller 0',
            'required' => ':attribute är obligatoriskt.',
            'pswdOld.required_with' => 'Ogiltligt lösenord',
            'numeric' => ':attribute får bara innehålla ett tal (decimal med &#39.&#39)',
            'min' => ':attribute måste innehålla minst :min bokstäver',
            'digits' => ':attribute måste vara :value siffror',
            'confirmed' => ':attribute matchar inte'
        ];
    }

    public function attributes(){
        return [
            'pswdOld' => 'Gammalt lösenord',
            'password' => 'Nytt lösenord'
        ];
    }


}
