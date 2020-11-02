<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Redirect,Response;

class CustomerController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$customers = Customer::all();
        //return response()->json($request);

        if ($request->ajax()) {

            //Start for date range search
            $customerQuery = Customer::query()->latest();

            $startDate = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
            $endDate = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');

            if ($startDate && $endDate) {
                $startDate = date('y-m-d', strtotime($startDate));
                $endDate = date('y-m-d', strtotime($endDate)); 

                $customerQuery->whereRaw("date(customers.created_at) >= '" . $startDate . "' AND date(customers.created_at) <= '" . $endDate  . "'");
            }
            //End for date range search

            $customers = $customerQuery->select('*');
            

                return Datatables::of($customers)
                    ->addColumn('action', function($data){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm editCustomer"><i class="far fa-edit"></i> Edit </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm deleteCustomer">Delete</a>';

                    return $button;
                })
                    ->rawColumns(['action'])
                    ->addIndexColumn()->make(true);
        }

       

        return view('website.backend.customers.index');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Customer::updateOrCreate(['id' => $request->customer_id],
                [
                    'customer_name' => $request->customer_name,
                    'email' => $request->email,
                    'phone' => $request->phone
                ]);        
        
        return response()->json(['success'=>'Customer saved successfully.']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $customer = Customer::findorFail($id);
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::findorFail($id)->delete();
     
        return response()->json(['success'=>'Customer deleted successfully.']);
    }
}
