<?php namespace market\Http\Controllers\question;

use Chromabits\Purifier\Purifier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use market\helper\text;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Http\Request;
use market\Http\Requests\CreateUpdateQuestionRequest;
use market\models\marketQuestions;

class questionController extends Controller {

	public function question(CreateUpdateQuestionRequest $request, Purifier $purifier)
	{
		//TODO::Add validation, questionRequest
		//TODO:: Sanitize

		$input = $request->all();
		$input = text::purifyQuestionInput($input, $purifier);
//        $input = text::purifyQuestionInput($input);
		$input = text::questionFromBBToHTML($input);

		$question = new MarketQuestions;

		$question->createdByUser = Auth::id();
		$question->market = $input['market'];
		$question->message = $input['message'];

		$question->save();

		return redirect()->back();
	}

}
