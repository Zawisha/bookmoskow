<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuponDateRangeController extends Controller
{
    function index()
    {
        return view('cuponInfoRange');
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            if($request->from_date != '' && $request->to_date != '')
            {
                $data = DB::table('cupon')
                    ->whereBetween('created_at', array($request->from_date, $request->to_date))
                    ->get();
            }
            else
            {
                $data = DB::table('cupon')->orderBy('created_at', 'desc')->get();
            }
//            return json_encode($data);
//            return json_encode($data);
//            echo view ('cuponInfoRange', ['data'=> json_encode($data)]);
            echo json_encode($data);
        }
    }
}

?>
