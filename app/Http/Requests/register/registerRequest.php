<?php namespace market\Http\Requests\register;

use market\Http\Requests\baseRequest;

class registerRequest extends baseRequest {

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
        $rules = $this->userprofileSettingsRules;
        $rules['email'] = $rules['email'] . '|unique:users,email';
        return $rules;
	}

    public function attributes(){

        $attributes = $this->attribute;
        $attributes['password'] = 'Lösenord';
        $attributes['username'] = 'Användarnamn';
        return $attributes;
    }
}
