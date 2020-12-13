<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\projects_business\Business_ru_api_lib;
use App\Images;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;


class PicController extends Controller
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
        $this->business = new Business_ru_api_lib($this->app_id, "", $this->address);
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
    }

    //получаем все группы товаров
    public function get_groupsofgoods()
    {
        Log::info('WORKING1');
    }
    public function get_good()
    {
        $time=set_time_limit(900);
        return $time;
    }

    public function change_images()
    {


        $k=0;
        for ($m = 1; $m <= 1000; $m++) {
            //  получаю список товаров постранично
            $customerorders = $this->business->request('get','goods',["type" => 1  ,"order_by" =>  ["id" =>"DESC"],'page'=>$m ,'limit' => 250]);
            //     получаем все товары и проверяем есть ли они на следующей полученной странице

//            if($customerorders['status']!='ok')
//            {
//                return dd('1');
//            }

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
//                                        return dd('тут работает');
                                    } catch (\Exception $e) {
                                        $err_flag=1;
                                        unlink($value["images"][$i]['name']);
//                                        return dd($value);
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
                                //new code
                                if(preg_match( '#.jpeg#' , $value["images"][$i]['name']))
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
//                                        return dd($value);
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
                                //end new code


                                //проверяю png
                                if(preg_match( '#.png#' , $value["images"][$i]['name']))
                                {
//                                    return dd('9');
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
//                                        return dd($value);
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
//                        return dd($customerorders);
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
//                            return dd($customerorders);
                        }

//                        if($img_counter!=(count($res_arr)))
//                        {
//                            return dd($value['part']);
//                        }

                    }


                }

            }
            return dd('1 круг пройден');

        }
        return dd('done');
    }



}
