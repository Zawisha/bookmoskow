<?php

namespace App\Http\Controllers;

use App\DropCart;
use App\EmailsDb;
use App\Jobs\SendThirdEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class ThirdCartRemindController extends Controller
{
    public function third_remind()
    {
        $todayTime = time();

        $sortedDB =  DropCart::where('send','=', '2')
            ->orderBy('created_at', 'desc')
            ->get();

        $secondSortedDB = $sortedDB;
        $sortedInfoArr = [];

//        for ($i = 0;$i<count($secondSortedDB); $i++)
//        {
//            if(($todayTime - strtotime($secondSortedDB[$i]['created_at'])) <  72*60*60)
////            72*60*60
//            {
//                unset($secondSortedDB[$i]);
//            }
//            else break;
//        }

        $arrToDelete = [];

        for ($i = 0;$i <count($secondSortedDB); $i++)
        {
            if(( $todayTime - strtotime($secondSortedDB[$i]['created_at'])) < 72*60*60)
//             4*60*60
            {
                array_push($arrToDelete, $secondSortedDB[$i]['user_email']);

//                 unset($secondSortedDB[$i]);
            }
            else
            {
                break;
            }
        }

        $finalSortedArr = [];


        foreach ($secondSortedDB as $el)
        {
//                     dd($el['user_email']);
            if( !in_array($el['user_email'], $arrToDelete))
            {
                $finalSortedArr[]=$el;
            }
        }

//             dd($finalSortedArr);

        $secondSortedDB = $finalSortedArr;


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

//            $queueVar =  $collection[0] -> sendArr[0] -> user_email;
            $queueVar =  $collection[0] -> sendArr[0] -> good_id;
            $check_email_unsub = $newSendArr -> user_email;

//            DB::table('dropcart')
//                ->where('user_email', $queueVar)
//                ->update(['send' => 3]);

            DB::table('dropcart')
//                 ->where('user_email', $queueVar)
                ->where('good_id', $queueVar)
                ->update(['send' => 3]);




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
                SendThirdEmail::dispatch($collection,$email_token);
            }
        }
    }
}
