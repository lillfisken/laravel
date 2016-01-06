<?php namespace market\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use market\models\Conversation;
use market\Http\Requests;

use Illuminate\Contracts\Auth\Authenticator;
use Input;
use market\models\Market;
use market\models\Message;
use Redirect;
use market\models\User;
use Illuminate\Http\Request;
use Session;

//use Illuminate\Contracts\Auth\Guard;
//use Illuminate\Contracts\Auth\Registrar;


class MessageController extends Controller
{
    /* Show user profile
             *
             * get 'profile/inbox/{user}'
             * route 'accounts.inbox'
             * middleware 'auth'
             *
             * @var user
             * @return
            */
    public function inbox()
    {
        Log::debug('------------- Inbox ----------------');

        $conversations = Conversation::
            where('user1', Auth::id())
            ->orWhere('user2', Auth::id())
            ->with('messages.sender', 'getUser1', 'getUser2')
            ->paginate(config('market.paginationNr'));
        $conversations->setPath(route('message.inbox'));

        foreach($conversations as $conversation)
        {
            $unread = 0;
            foreach($conversation->messages as $message)
            {
                if(!$message->isRead() && $message->senderId != Auth::id())
                {
                    $unread++;
                    Log::debug('Unread message');
                }
            }

            $conversation['unread'] = $unread;
            $conversation['username1'] = $conversation->getUser1->username;
            $conversation['username2'] = $conversation->getUser2->username;
            $conversation['latestMessage'] = $conversation->messages->last()->created_at->timestamp;
            $conversation['sender'] = $conversation->messages->last()->sender->username;
        }

        $conversations->sortByDesc('latestMessage');

        return view('account.message.inbox', ['conversations' => $conversations]);
    }

    public function show($conversationId)
    {
        $messages = Message::where('conversationId', '=', $conversationId)
            ->orderBy('created_at', 'desc')
            ->with(['sender', 'Conversation'])
            ->paginate(config('market.paginationNr'));
        $messages->setPath(route('message.show', [$conversationId]));

        Message::where('conversationId', '=', $conversationId)
            ->where('senderId', '!=', Auth::id())
            ->where('read', '=', 0)
            ->update(['read' => 1]);

        return view('account.message.show', ['messages' => $messages]);
    }

    /* Show user profile
             *
             * get 'profile/draft/{user}'
             * route 'accounts.draft'
             * middleware 'auth'
             *
             * @var user
             * @return
            */
    public function draft()
    {
//        dd('AccountController@draft');
        return view('account.message.draft');
    }

    /* Show user profile
             *
             * get 'profile/sent/{user}'
             * route 'accounts.sent'
             * middleware 'auth'
             *
             * @var user
             * @return
            */
    public function sent()
    {
//        dd('AccountController@sent')
        return view('account.message.sent');
    }

    /* Show user profile
             *
             * get 'profile/trash/{user}'
             * route 'accounts.trash'
             * middleware 'auth'
             *
             * @var user
             * @return
            */
    public function trash()
    {
//        dd('AccountController@trash');
        return view('account.message.trash');

    }

    public function newMessage()
    {
        return view('account.message.new');
    }

    //Post,
    public  function sendMessage(Requests\message\sendPmRequest $request)
    {
//        dd('Sending message', $request);
        //TODO:: Sanitize
        if(Auth::check())
        {
            //TODO: Sen email notification if asked for, In messageModel

            $message = new Message();

            //New conversation
            $cId = $request->get('conversationId');
            if(!isset($cId))
            {
                $c = new Conversation();
                $c->title = $request->input('title');
                $c->user1 = Auth::id();

                $user2 = User::select('id')->where('username', '=', $request->input('reciever'))->first();
                if(isset($user2))
                {
                    $c->user2 = $user2['id'];
                }
                else
                {
                    return Redirect::back()->withInput()->with(['message' => 'Hittar inte användaren ' . $request->input('reciever')]);
                }
//                $c->user2 = get user id from reciever, if not found, redirect back with message
                if($c->user1 == $c->user2)
                {
                    return Redirect::back()->withInput()->with(['message' => 'Du kan inte skicka meddelande till dig själv ' . $request->input('reciever')]);
                }

//                dd($c);
                $c->save();

                $message->conversationId = $c->id;
                $cId= $c->id;

                //get id, add to message
            }
            else
            {
                $message->conversationId = $request->input('conversationId');

            }

            //Create new message from input and save it in db
            $message->senderId = Auth::id();
            $message->message = $request->input('message');
            $message->save();

            //Kolla ID på postaren
            //Plocka ut mottagare, en eller flera
            //Kolla om det finns ett konversations ID
            //      Om inte, skapa ett nytt från sista registrerade (extra db fråga)
            //Skapa nytt meddelande med ovanstående parametrar
            //Spara i db
            //      Om lyckats -> redirect, ladda nya meddelanden
            //      Om inte lyckats, redirekt back med felorsak

            return Redirect::route('message.show', $cId)->with('message', 'Meddelande skickat');
        }
        else{
            return redirect(['route'=>'accounts.login']);
        }
    }

    public function deleteMessage()
    {

    }

    public function mail(Request $request)
    {
        //TODO: Add if previous and current is not equal
        Session::put('uri', Session::get('_previous'));
//        dd(Session::get('_previous'));

        $reciever = $request->query('reciever');
        $title = 'Ang: ' . $request->query('title');

        return view('account.message.mail', ['toUser' => $reciever, 'title' => $title]);
    }

    public function mailPost(Requests\message\sendEmailRequest $request)
    {
        //TODO: Sanitize title and message
        //TODO: Queue
        //TODO: Emailview
        //TODO: Validate user allaows email and has an email

        $from = User::find(Auth::Id())->email;
        $to = User::where('userName', '=$', $request->get('toUser'))->first()->email;
        $subject = $request->get('title');
        $body = $request->get('message');

        Mail::raw($body, function($message) use ($from, $to, $subject){
            $message->from($from); //Add username
            $message->to($to);
            $message->subject($subject);
        });

        //TODO: replace
        $uri = Session::get('uri');
        if(isset($uri))
        {
            if(isset($uri['url']))
            {
                return redirect($uri['url'])->with('message', 'Mail skickat');
            }
            return redirect()->route('markets.index')->with('message', 'Mail skickat');
        }
        else
        {
            return redirect()->route('markets.index')->with('message', 'Mail skickat');
        }
    }

    //endregion
}