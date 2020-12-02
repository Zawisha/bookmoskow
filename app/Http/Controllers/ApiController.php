<?php

namespace App\Http\Controllers;

use App\DropCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function add_good(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_email' => [ 'string', 'email', 'max:50'],
            'good_id' => ['integer'],
            'good_name' => ['string'],
            'good_image' => ['string']
        ]);
//        $validator = Validator::make($input, [
//            'user_id' => [ 'integer'],
//            'user_email' => [ 'string', 'email', 'max:50'],
//            'user_name' => ['string'],
//            'good_id' => ['integer'],
//            'good_name' => ['string'],
//            'good_image' => ['string']
//        ]);

        if ($validator->fails()) {
            $failed = $validator->messages();
            return response()->json([
                'messages' => $failed,
                'status' => 'fail'
            ], 200);
        }
        $user_id = $request->input('userId');
        $user_email = $request->input('userEmail');
        $user_name = $request->input('userName');
        $good_id = $request->input('goodId');
        $good_name = $request->input('goodName');
        $good_image = $request->input('goodImage');

//        $user_id = $request->input('userId');
//        $user_email = $request->input('userEmail');
//        $user_name = $request->input('userName');
//        $good_id = $request->input('goodId');
//        $good_name = $request->input('goodName');
//        $good_image = $request->input('goodImage');

                 DropCart::create([
             'user_id' => $user_id,
             'user_email' => $user_email,
             'user_name' => $user_name,
             'good_id' => $good_id,
             'good_name' => $good_name,
             'good_image' => $good_image
        ]);
//        DropCart::create([
//            'user_id' => $user_id,
//            'user_email' => $user_email,
//            'user_name' => $user_name,
//            'good_id' => $good_id,
//            'good_name' => $good_name,
//            'good_image' => $good_image
//        ]);





        return response()->json([
            'status' => 'Good added successfully',
        ], 200);
    }

    public function delete_good(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
//            'user_id' => ['integer'],
            'user_email' => [ 'string', 'email', 'max:50'],
            'good_id' => ['integer']
        ]);
        if ($validator->fails()) {
            $failed = $validator->messages();
            return response()->json([
                'messages' => $failed,
                'status' => 'fail'
            ], 200);
        }
//        $user_id = $request->input('userId');
        $user_email = $request->input('userEmail');
        $good_id = $request->input('goodId');
//        DropCart::where('user_id', '=', $user_id)
        DropCart::where('user_email', '=', $user_email)
            ->where('good_id', '=', $good_id)
            ->delete();
        return response()->json([
            'status' => 'Good deleted',
        ], 200);
    }
    public function delete_order(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
//            'userId' => ['integer'],
            'userEmail' => [ 'string', 'email', 'max:50'],
            'goods'=> ['array']
        ]);
        if ($validator->fails()) {
            $failed = $validator->messages();
            return response()->json([
                'messages' => $failed,
                'status' => 'fail'
            ], 200);
        }
//        $user_id = $request->input('userId');
        $user_email = $request->input('userEmail');
        $goods = $request->input('goods');
//        DropCart::where('user_id', '=', $user_id)
        DropCart::where('user_email', '=', $user_email)
            ->whereIn('good_id', $goods)
            ->delete();
        return response()->json([
            'status' => 'Order deleted',
        ], 200);
    }

}
