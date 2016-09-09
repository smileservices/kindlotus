<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

class MessageController extends Controller
{
    public function guestMessage(Request $request)
    {
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'message' => $request['message'],
        ];
        Mail::send('emails.message', ['data' => $data], function($message) {
            $message->to(env('MAIL_MESSAGES_RECIPIENT'))->subject('New Message');
        });
        return redirect()->back()->with('message', 'Message sent! Thank you !');
    }

}