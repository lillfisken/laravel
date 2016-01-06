<?php namespace market\Http\Requests\auth;

use market\Http\Requests\baseRequest;

class loginRequest extends baseRequest {

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
			'email' => 'required|email',
			'password' => 'required|string'
		];
	}

}
