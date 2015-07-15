<?php namespace market\Http\Controllers\Markets;

use Chromabits\Purifier\Purifier;
use Illuminate\Support\Facades\Auth;
use market\Http\Requests;
use market\Http\Controllers\Controller;
use market\helper;

use Illuminate\Http\Request;
use market\Market;

class QuestionController extends MarketBaseController {

    public function question(CreateUpdateQuestionRequest $request)
    {
        //TODO::Add validation, questionRequest
        //TODO:: Sanitize
        debug::logConsole('MarketsController->question post');

        $input = $request->all();
        $input = text::purifyQuestionInput($input, $this->purifier);
//        $input = text::purifyQuestionInput($input);
        $input = text::questionFromBBToHTML($input);

        $question = new MarketQuestions;

        $question->createdByUser = Auth::id();
        $question->market = $input['market'];
        $question->message = $input['message'];

        $question->save();

        return Redirect::back();
    }
}