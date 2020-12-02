<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfoFromDbViewController extends Controller
{
    public function cupon_info(Request $request)
    {
        $cupon = DB::table('cupon')->paginate(15);

        if(request()->ajax())
        {
            if(!empty($request->from_date))
            {
//                $date_from_start = $request->get('date_from');
//                $from_date = date("Y-m-d H:i:s",strtotime($date_from_start));
//
//                $date_to_end = $request->get('date_to');
//                $to_date = date("Y-m-d H:i:s",strtotime($date_to_end));

                $data = DB::table('cupon')
                    ->whereBetween('created_at', array($request->from_date, $request->to_date))
                    ->get();
            }
            else
            {
                $data = DB::table('cupon')
                    ->get();
            }
            return datatables()->of($data)->make(true);
        }
        return view('infoFromDbView',['cupon' => $cupon]);

    }
//        $cupon = DB::table('cupon')->simplePaginate(15);
//        $dropcart = DB::table('dropcart')->simplePaginate(15);
//
//        $date_from = $request->get('date_from');
////        $date_from = date("Y-m-d H:i:s",strtotime($date_from_start));
//
//        $date_to = $request->get('date_to');
////        $date_to = date("Y-m-d H:i:s",strtotime($date_to_end));
//
//
//        $cupon_rage = DB::table('cupon')
//            ->whereBetween('created_at', [date("Y-m-d H:i:s", $date_from),date("Y-m-d H:i:s", $date_to)])
//            ->paginate();
//
//        return view('infoFromDbView', ['cupon' => $cupon, 'dropcart'=>$dropcart,'cupon_rage'=> $cupon_rage, 'date_from' => $date_from]);
//    }

//    public function cupon_filter(Request $request)
//    {
//        $date_from_start = $request->get('date_from');
//        $date_from = date("Y-m-d H:i:s",strtotime($date_from_start));
//
//        $date_to_end = $request->get('date_to');
//        $date_to = date("Y-m-d H:i:s",strtotime($date_to_end));
//
//
//        $cupon_rage = DB::table('cupon')
//            ->whereBetween('created_at', [$date_from, $date_to])
//            ->paginate();
//
//        return view('infoFromDbView', ['cupon_rage'=> $cupon_rage, 'date_from'=>$date_from, 'date_to'=>$date_to, 'date_from_start'=>$date_from_start]);
//
//    }
}
