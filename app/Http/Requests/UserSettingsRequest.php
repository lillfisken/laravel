<?php namespace market\Http\Requests;

use market\Http\Requests\Request;

class UserSettingsRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        //If pswdOld is present -> AuthorizeOnly if password is correct for user
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        //'presentation',
        //'phone1',
        //'phoneAllowed',
        //'email',
        //'emailAllowed',
        //'name',
        //'street',
        //'zip',
        //'city',
        //'cityAllowed',
        //'password',
        //'pswdOld',
        //'pswd',
        //'pswd2',

        ////Externa kopplingar
        //Elektronikforumet
        //Google
        //Facebook
        //Twitter

		return [
            //'presentation',
            'phone1' => 'required',
            'phoneAllowed' => 'boolean',
            'email' => 'required',
            'emailAllowed' => 'boolean',
            'name' => 'required',
            'street' => 'required',
            'zip' => 'required|digits:5',
            'city' => 'required',
            'cityAllowed' => 'boolean',
            'pswdOld' => 'required_with:password',
            'password' => 'min:6|confirmed|required_with:pswdOld'
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