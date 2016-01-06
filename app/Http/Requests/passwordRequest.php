<?php namespace market\Http\Requests;

use market\Http\Requests\Request;

class passwordRequest extends baseRequest {

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
        return $this->userprofileSettingsRules;
    }
}
