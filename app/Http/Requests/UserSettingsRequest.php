<?php namespace market\Http\Requests;

use market\Http\Requests\Request;

class UserSettingsRequest extends userSettingsBaseRequest {

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
}