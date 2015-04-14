<?php namespace market\Http\Requests;

use market\Http\Requests\Request;

class registerRequest extends userSettingsBaseRequest {

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
        $rulesParent = parent::rules();
        $rulesThis = [
            'username' => 'required|min:3|unique:users,username',
            'password' => 'required|min:6|confirmed'
        ];
        $rules = array_merge($rulesParent, $rulesThis);
//        dd($rules);

		return $rules;
	}

    public function attributes(){

        $attributes = parent::attributes();
        $attributes['password'] = 'Lösenord';
        $attributes['username'] = 'Användarnamn';
        return $attributes;
    }

}
