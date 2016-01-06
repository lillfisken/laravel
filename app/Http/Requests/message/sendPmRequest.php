<?php namespace market\Http\Requests\message;

use market\Http\Requests\baseRequest;
use market\Http\Requests\Request;

class sendPmRequest extends baseRequest {

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
		//Sender and reciever not the same
		return [
            'title' => 'required_without:conversationId|min:3',
            'reciever' => 'required_without:conversationId|exists:users,username',
			'conversationId' => 'required_without:reciever|exists:conversations,id',
            'message' => 'required|min:3'
		];
	}
}
