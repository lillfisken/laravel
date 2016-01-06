<?php namespace market\Http\Requests\block;

use market\Http\Requests\Request;

class blockSellerRequest extends Request {

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
			'hidden' => 'required|numeric'
		];
	}

}
