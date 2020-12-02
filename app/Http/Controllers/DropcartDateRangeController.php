<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DropcartDateRangeController extends Controller
{
    function index()
    {
        return view('dropCartInfoRange');
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            if($request->from_date != '' && $request->to_date != '')
            {
                $data = DB::table('dropcart')
                    ->whereBetween('created_at', array($request->from_date, $request->to_date))
                    ->get();
            }
            else
            {
                $data = DB::table('dropcart')->orderBy('created_at', 'desc')->get();
            }
            echo json_encode($data);
        }
    }
}
