<?php namespace market\Http\Requests;

use market\Http\Requests\Request;

class userSettingsBaseRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return false;
	}

    	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        ////Externa kopplingar
        //Elektronikforumet
        //Google
        //Facebook
        //Twitter

		return [
            //'presentation',
            'phone1' => 'required',
            'phoneAllowed' => 'boolean',
            'email' => 'required|email|unique:users,email',
            'emailAllowed' => 'boolean',
            'name' => 'required',
            'street' => 'required',
            'zip' => 'required|digits:5',
            'city' => 'required',
            'cityAllowed' => 'boolean',
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
        //TODO:Add translations
        return [
            //'presentation',
            'phone1' => 'Telefonnr',
            'phoneAllowed' => 'Kontaktsätt telefon',
            'email' => 'E-post',
            'emailAllowed' => 'Kontaktsätt e-post',
            'name' => 'Namn',
            'street' => 'Gata',
            'zip' => 'Postnr',
            'city' => 'Stad',
            'cityAllowed' => 'Kontaktsätt stad',
            'pswdOld' => 'Gammalt lösenord',
            'password' => 'Nytt lösenord'
        ];
    }

}
