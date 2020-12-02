<?php

namespace App\Http\Controllers;



use App\DropCart;
use App\EmailsDb;
use App\Jobs\SendSecondEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class SecondCartRemindController extends Controller
{
    public function second_remind()
    {
        $todayTime = time();

        $sortedDB =  DropCart::where('send','=', '1')
            ->orderBy('created_at', 'desc')
            ->get();

        $secondSortedDB = $sortedDB;
        $sortedInfoArr = [];

        for ($i = 0;$i<count($secondSortedDB); $i++)
        {
            if(($todayTime - strtotime($secondSortedDB[$i]['created_at'])) <  24*60*60)
//            24*60*60
            {
                unset($secondSortedDB[$i]);
            }
            else break;
        }



        $set = [] ;

        foreach ($secondSortedDB as $element)
        {
            if(!in_array($element['user_email'], $set))
            {
                array_push($set, $element['user_email']);
            }
        }


        $sendObject = new stdClass();
        $goodArrForSendObject = [];
        $sendArr = [];


        foreach ($set as $user)
        {

            $sendObject = new stdClass();
            $sendObject -> user_email = $user;
            $goodArrForSendObject = [];


            foreach ($secondSortedDB as $good)
            {
                if($user == $good['user_email'])
                {
                    array_push($goodArrForSendObject, $good);
                }
            }

            if($goodArrForSendObject != null)
            {
                $sendObject -> sendArr = $goodArrForSendObject;
            }

            array_push($sendArr, $sendObject);

        }

        foreach ($sendArr as $newSendArr)
        {
            $collection = new Collection();
            $collection->push((object)$newSendArr);

            $queueVar =  $collection[0] -> sendArr[0] -> user_email;
            $check_email_unsub = $newSendArr -> user_email;

            DB::table('dropcart')
                ->where('user_email', $queueVar)
                ->update(['send' => 2]);


//            $result = DB::table('dropcart')
//                ->where('user_email',$queueVar )
//                ->update(['send' => 2]);

            if(!EmailsDb::where('user_email', '=', $check_email_unsub)->exists())
                //Проверка есть ли мэйл в нашей бд мэйлов
            {
                $email_token = bin2hex(random_bytes(30));
                EmailsDb::create([
                    'user_email' => $check_email_unsub,
                    'token' => $email_token
                ]);

            }
            else
                //Если мэйл есть в нашей бд
            {
                $email_token = DB::table('emailsdb')
                    ->where('user_email', '=', $check_email_unsub)
                    ->value('token');
            }

            //Проверка не отписался ли пользователь от рассылки
            $unsubed_value = EmailsDb::where('user_email', '=', $check_email_unsub)->value('unsubed');

            if($unsubed_value != 1)
            {
                SendSecondEmail::dispatch($collection,$email_token);
            }
        }
    }
}
