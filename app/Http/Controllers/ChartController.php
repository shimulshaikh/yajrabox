<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use DB;

class ChartController extends Controller
{
    public function customerChart()
    {
    	$customers = Customer::select(DB::raw("COUNT(*) as count"))
    				->whereYear('created_at', date('Y'))
    				->groupBy(DB::raw("Month(created_at)"))
    				->pluck('count'); 

    	$months = Customer::select(DB::raw("Month(created_at) as month"))
    				->whereYear('created_at', date('Y'))
    				->groupBy(DB::raw("Month(created_at)"))
    				->pluck('month'); 			

    	$data = array(0,0,0,0,0,0,0,0,0,0,0,0);
    	
    	foreach ($months as $index => $month)
    	{
    		$data[$month] = $customers[$index];						
    	}			

    	view()
    }

}
