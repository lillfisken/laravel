<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-11-16
 * Time: 00:06
 */

namespace market\core\message;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use market\models\Message;

class newPm
{
    protected $subjectSuffix;

    public function __construct()
    {
        $this->subjectSuffix = ENV('EMAIL_TITLE_SUFFIX');
    }

    public function send($messageId)
    {
        Log::debug('core/mailer/newPm/send, messageId: ' . $messageId);
        Log::debug('Suffix: ' . $this->subjectSuffix);

//        $message = Message::where('id', $messageId)->with('sender conversation.user1 conversation.user2')->first();
        $pm = Message::where('id', $messageId)->with('sender', 'conversation.getUser1', 'conversation.getUser2')->first();
//        $message = Message::where('id', $messageId)->with('sender')->first();

        if($pm)
        {
            $sender = $pm->sender;

            //Get reciever
            if($sender != $pm->conversation->getUser1)
            {
                $receiver = $pm->conversation->getUser1;
            }
            else
            {
                $receiver = $pm->conversation->getUser2;
            }

            //Check if receiver want mail
            if($receiver->mailNewPm)
            {
                //Prepare the data for the email
                $data = [
                    'sender' => $sender,
                    'receiver' => $receiver,
                    'pm' => $pm,
                    'title' => $pm->conversation->title . ' ' . $this->subjectSuffix,
                    'subjectSuffix' => $this->subjectSuffix,
                    'testData' => 'testData'
                ];

                //Send the mail
                Mail::send('emails.newPM', $data , function($message) use ($data) {
                    $message
                        ->from($data['sender']['email'], $data['sender']['username'])
                        ->to($data['receiver']['email'])
                        ->subject('Nytt PM: ' . $data['pm']['conversation']['title']);
                });
            }
        }
    }
}