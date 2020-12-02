<?php

namespace App\Http\Controllers;

use App\Cupon;
use App\EmailsDb;
use App\Jobs\SendCupon;
use App\Mail\CuponMail;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SendCuponController extends Controller
{
    public function send_cupon(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_email' => [ 'string', 'email', 'max:50']
        ]);
        if ($validator->fails()) {
            $failed = $validator->messages();
            return response()->json([
                'messages' => $failed,
                'status' => 'fail'
            ], 200);
        }

        $user_email = $request->input('userEmail');


        if (!Cupon::where('user_email', '=', $user_email)->exists())
        //Проверка не был ли отправлен купон ранее на email
        {
            if(!EmailsDb::where('user_email', '=', $user_email)->exists())
            //Проверка есть ли мэйл в нашей бд мэйлов
            {
                $email_token = bin2hex(random_bytes(30));
                EmailsDb::create([
                    'user_email' => $user_email,
                    'token' => $email_token
                ]);

                Cupon::create([
                    'user_email' => $user_email,
                    'token' => $email_token
                ]);
            }
            else
                //Если мэйл есть в нашей бд
                {
                    $email_token = DB::table('emailsdb')
                        ->where('user_email', '=', $user_email)
                        ->value('token');

                    Cupon::create([
                        'user_email' => $user_email,
                        'token' => $email_token
                    ]);
                }

            $unsubed_value = EmailsDb::where('user_email', '=', $user_email)->value('unsubed');

            if($unsubed_value != 1)
                //Проверка не отписался ли пользователь от рассылки
            {
                Mail::to($user_email)
                    ->send(new CuponMail($email_token, $user_email));

                Cupon::where('user_email', $user_email)
                    ->update(['send' => 1]);
            }
        }

        return response()->json([
            'status' => 'Cupon send successfully',
        ], 200);
    }

}
