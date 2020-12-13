<?php

namespace App\Http\Controllers;


use App\DropCart;
use App\EmailsDb;
use App\Jobs\SendEmail;
use App\Library\projects_business\Business_ru_api_lib;
use App\Images;
use App\Mail\WelcomeMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use mysql_xdevapi\Table;
use phpDocumentor\Reflection\Types\Array_;
use PhpParser\Node\Expr\Cast\Object_;
use SebastianBergmann\Timer\Timer;
use stdClass;
use Symfony\Component\Console\Input\Input;
use function Sodium\compare;

class IndexController extends Controller
{

    protected $secret  = "6AzrWWpdJhzrfjkkLaSPPIo0MxJObLhf"; // секретный ключ
    protected $app_id  = "478717"; // Id интеграции
    protected $address = 'https://action_645999.class365.ru'; // адрес
    protected $action  = 'get'; // операция
    protected $model   = 'offers'; // модель
    protected $business;

    public function __construct ( $secret= "6AzrWWpdJhzrfjkkLaSPPIo0MxJObLhf",$app_id= "478717",$address= 'https://action_645999.class365.ru',
                                  $action= 'get',$model= 'offers')
    {
        $this->business = new Business_ru_api_lib($this->app_id,"",$this->address);
        $this->business->setSecret("6AzrWWpdJhzrfjkkLaSPPIo0MxJObLhf");
         $response = $this->business->repair();
//         return dd($response);
//        if ($response['status'] == 'error'){
//            $params[ 'app_id'  ] = $this->app_id;
//            ksort( $params );
//            $params_string = http_build_query($params);
//            $app_psw = md5($this->secret.$params_string);
//            $repairUrl = "https://action_645999.business.ru/api/rest/repair.json?app_id={$this->app_id}&app_psw={$app_psw}";
//            $resRequest = file_get_contents($repairUrl);
//            $resRequest = json_decode($resRequest);
//            //$this->token = $resRequest->token;
//            if(isset($resRequest->token)){
//                $this->business = new Business_ru_api_lib($app_id,$resRequest->token,$address,false);
//            }
//
//        }
    }

    public function index()
    {
        return view('spa');
//        return view('unsubView');
    }

    //получаем все группы товаров
    public function get_groupsofgoods()
    {
        Log::info('WORKING1');
    }
    public function get_good()
    {
//     $time=set_time_limit(900);
//     return $time;

    }

    public function set_time()
    {

//        $timer = $request->get('timer')*60*60;
//
//        $timerset = DB::table('DropCart')
//            ->where('id',1)
//            ->update(['timer' => $timer] );
//
//        $timered = DB::table('DropCart')
//            ->where('id', '1')
//            ->value('timer');
//----------------------------------------------------------------

        $todayTime = time();


        $sortedDB = DropCart::where('send','=', '0')
            ->orderBy('created_at', 'desc')
            ->get();



        $secondSortedDB = $sortedDB;
        $sortedInfoArr = [];



        $arrToDelete = [];

         for ($i = 0;$i <count($secondSortedDB); $i++)
         {
             if(( $todayTime - strtotime($secondSortedDB[$i]['created_at'])) < 30*60)
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

            $uniqueArr = [];

            foreach ($secondSortedDB as $good)
            {
                if($user == $good['user_email'])
                {
                    array_push($goodArrForSendObject, $good);
//                    $goodArrForSendObject =array_map('unserialize',array_unique(array_map('serialize', $goodArrForSendObject)));

                }
            }
//            dd($goodArrForSendObject);
//
//            foreach ($goodArrForSendObject as $kurw)
//            {
//                if(in_array($kurw['good_id'], $goodArrForSendObject))
//                {
//                    unset($kurw);
//                }
//                else
//                {
//                    break;
//                }
//            }



//            $tmp = [];
//
//            foreach ($goodArrForSendObject as $row)
//            {
//                if ($goodArrForSendObject['good_id'] !== $row['good_id'])
//                {
//                    $tmp[] = $row;
//                }
//
//            }
//            dd($tmp);
//
//            $goodArrForSendObject = $tmp;
//            $goodArrForSendObject = array_unique($goodArrForSendObject, 'good_id');
//             $goodArrForSendObject =array_map('unserialize',array_unique(array_map('serialize', $goodArrForSendObject)));
//             dd($goodArrForSendObject);





//            $tmp = [];
//
//            foreach ($secondSortedDB as $row)
//            {
//                if(!in_array($row['good_id'], $goodArrForSendObject))
//                {
//                    $tmp[] = $row;
//                }
//            }
//
//            $goodArrForSendObject = $tmp;
//



            //Проверка на дубли
//            $tmp = [];
//            foreach ($goodArrForSendObject as $row)
//            {
//                if (!in_array($row,$tmp)) array_push($tmp,$row);
//            }
//            $goodArrForSendObject = $tmp;

//             $uniqArr = [];
//             foreach ($goodArrForSendObject as $row)
//             {
//                 if( !in_array($row['good_id'], $goodArrForSendObject))
//                 {
//                    array_push($uniqArr, $row);
//                 }
//             }
//
//
//             $goodArrForSendObject = $uniqArr;
//
//             dd($goodArrForSendObject);
             $sendArrNew = [];
             $tmp_key = [];
             $tmp_arr = [];
             $counter = 0;

            if($goodArrForSendObject != null)
            {
                foreach ($goodArrForSendObject as $bingo)
                {
                    if(!in_array($bingo['good_id'], $tmp_key))
                    {
                        $tmp_key[$counter] = $bingo['good_id'];
                        $tmp_arr[$counter] = $bingo;
                    }
                    $counter++;
                }

//                $sendObject -> sendArr = $goodArrForSendObject;
                $sendObject -> sendArr = $tmp_arr;
//                dd($sendArr);




//                array_push($sendArr,$tmp_arr);


//                $sendArr[] = $tmp_arr;
//                array_push($sendArrNew, $tmp_arr);
            }


//            dd($sendObject);
//             array_push($sendObject,$sendArr);
//             $sendArr[] = $sendArrNew;

            array_push($sendArr, $sendObject);
//            dd($sendObject);

        }

         foreach ($sendArr as $newSendArr)
         {
             $collection = new Collection();
             $collection->push((object)$newSendArr);
//             $queueVar = $newSendArr -> user_email;

             $queueVar =  $collection[0] -> sendArr[0] -> user_email;
//             $queueVar =  $collection[0] -> sendArr[0] -> good_id;

//             $check_email_unsub = $newSendArr -> user_email;
             $check_email_unsub = $newSendArr -> user_email;

//             dropcart::where('user_email', $queueVar)
//                 ->update(['send' => 1]);

             DB::table('dropcart')
                 ->where('user_email', $queueVar)
//                 ->where('good_id', $queueVar)
                 ->update(['send' => 1]);


//             $result = DB::table('dropcart')
//                 ->where('user_email',$queueVar )
//                 ->update(['send' => 1]);

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
                 SendEmail::dispatch($collection,$email_token,$queueVar);
             }
         }
}


    public function test_api()
    {

//        DropCart::create([
//            'user_id' => '2',
//            'user_email' => 'atgwdfwdyawd@tut.by',
//            'user_name' => '2',
//            'good_id' =>'2',
//            'good_name' => '2',
//            'good_image' => '2'
//        ]);
//
//        return true;

        $k=0;
        for ($m = 1; $m <= 105; $m++) {
        //  получаю список товаров постранично
        $customerorders = $this->business->request('get','goods',["type" => 1  ,"order_by" =>  ["id" =>"DESC"],'page'=>$m ,'limit' => 250]);
            //     получаем все товары и проверяем есть ли они на следующей полученной странице
            if($customerorders['status']!='ok')
            {
                return dd( $customerorders);
            }
        if(count($customerorders['result'])!==0)
        {

            foreach ($customerorders['result'] as $value) {
                //получаю id и проверяю по базе данных
                // var_dump($value['id']);
                //получаю изображения
                $res_arr=[];
                $images_arr=[];
                $img_counter=0;
                for ($i = 0; $i < count($value["images"]) ; $i++) {
                    //return dd($value);
                    if (!in_array($value["images"][$i]['name'], $images_arr)) {
                        $images_arr[]=$value["images"][$i]['name'];
                    $images_list = Images::where('post_id', '=',$value['id'] )->where('img_name', '=', $value["images"][$i]['name'])->get();
                    if(count($images_list)==0)
                    {
                        $flag_png=0;
                        //СДЕЛАТЬ ПРОВЕРКУ НА ОШИБКУ JPG но в PNG
                        //проверяю jpg или png
                        if(preg_match( '#.jpg#' , $value["images"][$i]['name']))
                        {
                        //получаю изображение товара и сохраняю его на хостинге
                        $res=  file_put_contents($value["images"][$i]['name'], file_get_contents($value["images"][$i]['url']));
                        //конструктор для работы с imagejpeg
                            $err_flag=0;
                            try {
                                $image = imagecreatefromjpeg($value["images"][$i]['name']);
                            } catch (\Exception $e) {
                                $err_flag=1;
                                unlink($value["images"][$i]['name']);
                                return dd($value);
                            }
                            if($err_flag==0){
                        //требует "ext-gd": "*" в composer.json
                            $red = imagecolorallocate($image,255,0,0);
                            $x_axis=imagesx($image)*0.2;
                            $y_axis=imagesy($image)*0.2;
                            $dot = imagefilledellipse($image,imagesx($image)-$x_axis,imagesy($image)-(imagesy($image)-$y_axis),$x_axis,$x_axis,$red);
                        imagejpeg($image, $value["images"][$i]['name'], 20);
                                $img_counter++;
                        $res_arr[]=[
                            'name' => $value["images"][$i]['name'],
                            'url'=> 'https://okmos.ru/'.$value["images"][$i]['name']
                        ];
                            }

                        }
                        //проверяю png
                        if(preg_match( '#.png#' , $value["images"][$i]['name']))
                        {

                            $flag_png=1;
                            //получаю изображение товара и сохраняю его на хостинге
                            $res=  file_put_contents($value["images"][$i]['name'], file_get_contents($value["images"][$i]['url']));
                            //конструктор для работы с imagejpeg
                            $err_flag=0;
                            try {
                                $image = imagecreatefrompng ($value["images"][$i]['name']);
                            } catch (\Exception $e) {
                                $err_flag=1;
                                unlink($value["images"][$i]['name']);
                                return dd($value);
                            }
                            if($err_flag==0){
                            //требует "ext-gd": "*" в composer.json
                            $red = imagecolorallocate($image,255,0,0);
                            $x_axis=imagesx($image)*0.2;
                            $y_axis=imagesy($image)*0.2;
                            $dot = imagefilledellipse($image,imagesx($image)-$x_axis,imagesy($image)-(imagesy($image)-$y_axis),$x_axis,$x_axis,$red);

                            preg_match_all( '#(.*).png#' , $value["images"][$i]['name'],$image_name);
                            $image_name=$image_name['1']['0'];
                            imagejpeg($image, $image_name.'.jpg', 20);

                            //imagepng ($image, $value["images"][$i]['name'], 9);
                                $img_counter++;
                            $res_arr[]=[
                                'name' => $image_name.'.jpg',
                                'url'=> 'https://okmos.ru/'.$image_name.'.jpg'
                            ];
                            }
                        }
                    }
                    }

                }
                if(count($res_arr)!=0 )
                {

                          $params = [
                       'id'=>$value['id'],
                       'images' =>$res_arr
                                    ];
                    $customerorders = $this->business->request('put','goods',$params);

                if($customerorders['status']=='ok')
                {
                    foreach ($res_arr as $img_name_link) {
                        $post_cr =  Images::create([
                            'post_id' => $value['id'],
                            'img_name' => $img_name_link['name'],
                            'part'=>$value['part']
                        ]);
                        if($flag_png==1)
                        {
                            preg_match_all( '#(.*).jpg#' , $img_name_link['name'],$image_name);
                            $image_name=$image_name['1']['0'];
                            try {
                                unlink($image_name.'.png');
                            } catch (\Exception $e) {
                               // return dd($image_name.'.png');
                              //  unlink($image_name.'.png'.'.jpg');
                            }


                        }
                        else{
                            try {
                                unlink($img_name_link['name']);
                            } catch (\Exception $e) {
                              //  return dd($img_name_link['name']);
                                //  unlink($img_name_link['name'].'.jpg');
                            }
                        }



                    }
                    $k++;
//                    if($k==50)
//                    {
//                        return dd($value);
//                    }

                }
                else
                {
                    foreach ($res_arr as $img_name_link) {
                        //add png delete
                        unlink($img_name_link['name']);
                    }
                    return dd($customerorders);
                }

                    if($img_counter!=(count($res_arr)))
                    {
                        return dd($value['part']);
                    }

                }


            }

        }


    }
        return dd('done');
    }
}
//$params = [
//
//    'id'=>$value['id'],
//    'images' =>
//        [
//            [
//                'name' => $value["images"][$i]['name'],
//                'url'=> 'https://okmos.ru/'.$value["images"][$i]['name']
//
//            ]
//        ]
//];
//   $customerorders = $this->business->request('put','goods',$params);
// return dd($customerorders);
//end send image
//удаляем изображение
// unlink('test_img.jpg');
