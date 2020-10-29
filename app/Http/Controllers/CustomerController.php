<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Redirect,Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$customers = Customer::all();
        //return response()->json($customers);

        if ($request->ajax()) {

            //Start for date range search
            $customerQuery = Customer::query();

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
                    $button = '<a href="" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-delete"></i> Delete </button>';
                    return $button;
                })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
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
        $id = $request->id;
        Customer::create($request->all());
        $customer = Customer::updateOrCreate(['id' => $id ],
                [
                    'customer_name' => $request->customer_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);

        return response()->json($customer);
        
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
        $where = array('id' => $id);   
        $customer = Customer::where($where)->first();

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
        if ($request->has('id')) {
            Customer::find()->input('id')->update($request->all());
            return ['success'=>true, 'message'=>'Updated Successfully'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Customer::find()->input('id')->delete();
            return ['success'=>true, 'message'=>'Deleted Successfully'];
        }
    }
}
