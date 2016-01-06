<?php namespace market\Http\Requests\settings;

use market\Http\Requests\baseRequest;
use market\Http\Requests\Request;

class userprofileRequest extends baseRequest {

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
		//TODO: Add support for only one of this email check
		return $this->userprofileSettingsRules;
	}
}
