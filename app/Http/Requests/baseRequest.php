<?php namespace market\Http\Requests;

use market\Http\Requests\Request;

class baseRequest extends Request
{

	protected $messages = [
		'required' => ':attribute är obligatoriskt.',
		'required_without' => ':attribute är obligatoriskt.',
		'numeric' => ':attribute får bara innehålla ett tal (decimal med &#39.&#39)',
		'min' => ':attribute måste innehålla minst :min tecken',
		'email' => ':attribute är inte en korrekt epostadress',
		'boolean' => ':attribute måste vara 1 eller 0',
		'pswdOld.required_with' => 'Ogiltligt lösenord',
		'digits' => ':attribute måste vara :value siffror',
		'confirmed' => ':attribute matchar inte',
        'exists' => ':attribute finns inte',
	];

    protected $attribute = [
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
        'password' => 'Nytt lösenord',
		'message' => 'Meddelande',
		'reciever' => 'Mottagare',
		'title' => 'Titel',
        'toUser' => 'Användaren',
		'description' => 'Beskrivning',
		'price' => 'Pris',
    ];

    protected $userprofileSettingsRules = [
        'phone1' => 'required',
        'phoneAllowed' => 'boolean',
        'emailAllowed' => 'boolean',
        'name' => 'required',
        'street' => 'required',
        'zip' => 'required|numeric',
        'city' => 'required',
        'cityAllowed' => 'boolean',
        'email' => 'required|email'
    ];

    protected $newUserprofileSettingsRules = [
        'phone1' => 'required',
        'phoneAllowed' => 'boolean',
        'emailAllowed' => 'boolean',
        'name' => 'required',
        'street' => 'required',
        'zip' => 'required|numeric',
        'city' => 'required',
        'cityAllowed' => 'boolean',
        'username' => 'required|min:3|unique:users,username',
        'password' => 'required|min:6|confirmed',
        'email' => 'required|email'
    ];

	public function messages()
	{
		return $this->messages;
	}

    public function attributes()
    {
        return $this->attribute;
    }

}
