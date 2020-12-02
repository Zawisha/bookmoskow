<?php

namespace App\Http\Controllers;

use App\EmailsDb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewRedirectController extends Controller
{
    public function unsubView(Request $request)
    {
        $user_email = request() -> user_email;
        $email_token = request() -> email_token;

        if (EmailsDb::where('user_email', '=', $user_email)  && EmailsDb::where('token', '=', $email_token)->exists())
        {
            EmailsDb::where('user_email', $user_email)
                ->update(['unsubed' => 1]);
        }

        return view('unsubView', ['email_token' =>  request() -> email_token, 'user_email' =>  request() -> user_email ] );
    }
}
