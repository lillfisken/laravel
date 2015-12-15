<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-12-13
 * Time: 22:39
 */

namespace market\core\mail;

use Illuminate\Support\Facades\Mail;

class base
{
    protected function sendMail($viewName, $data)
    {
        Mail::send($viewName, $data, function($message) use ($data) {
            $message
                ->from($data['sender']['email'], $data['sender']['username'])
                ->to($data['receiver']['email'])
                ->subject($data['title']);
        });
    }
}