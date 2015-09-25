<?php namespace market\Http\Requests;

use market\Http\Requests\Request;

class CreateUpdateQuestionRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        //Todo:: some better check...
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
			'market' => 'required',
            'message' => 'required|min:5',
		];
	}

    public function messages(){
        return [
            'required' => ':attribute är obligatoriskt.',
            'numeric' => ':attribute får bara innehålla ett tal (decimal med &#39.&#39)',
            'min' => ':attribute måste innehålla minst :min bokstäver'
        ];
    }

    public function attributes(){
        return [
            'message' => 'Meddelande'
        ];
    }

}
