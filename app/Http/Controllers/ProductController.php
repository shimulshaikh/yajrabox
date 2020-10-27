<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\ProductCategory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;   

class ProductController extends Controller
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
    public function index()
    {
        return view('website.backend.product.index');
    }


    public function anyData()
    {

        return Datatables::of(Product::query())
                ->setRowId('{{$id}}')
                ->editColumn('created_at', function(Product $product) {
                    return $product->created_at->diffForHumans();
                })

                ->editColumn('updated_at', function(Product $product) {
                    return $product->updated_at->format('h:m:s');
                })

                ->addColumn('brand_name', function(Product $product) {
                    return $product->productCatagory->brand_name;
                })

                ->addColumn('actions', function($row){
                    $editUrl = route('product.edit', $row->id);
                    $deleteUrl = route('product.destroy', $row->id);

                    return view('website.backend.product.column', compact('editUrl', 'deleteUrl'));
                    })
                
                ->make(true);    
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategorys = ProductCategory::all();
        return view('website.backend.product.create', compact('productCategorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
                'category_id' => 'required',
                'product_name' => 'required',
                'price' => 'required|integer|min:1',
                'product_desc' => 'required'
            ]);
             
             

                $slug = Str::slug($request->product_name, '-');
                $product = new Product();

                $product->product_name = request('product_name');
                $product->product_desc = request('product_desc');
                $product->price = request('price');
                $product->category_id = $request->get('category_id');
                $product->slug = $slug;


                if ($product->save()) {
                $request->session()->flash('success','Product has been created');
                }
                else{
                    $request->session()->flash('error','There was an error created the product');
                }

                return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findorFail($id);
        $productCategorys = ProductCategory::all();
            
        return view('website.backend.product.edit', compact('product','productCategorys')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        request()->validate([
                'category_id' => 'required',
                'product_name' => 'required',
                'price' => 'required|integer|min:1',
                'product_desc' => 'required'
            ]);
             

                $slug = Str::slug($request->product_name, '-');
                
                $product = Product::findorFail($request->id);

                $product->product_name = request('product_name');
                $product->product_desc = request('product_desc');
                $product->price = request('price');
                $product->category_id = $request->get('category_id');
                $product->slug = $slug;

                if ($product->update()) {
                $request->session()->flash('success','Product has been updated');
                }
                else{
                    $request->session()->flash('error','There was an error updated the product');
                }

                return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $product = Product::findorFail($id);

        if ($product->delete())
         {
            $request->session()->flash('success','Product has been deleted');
         }
        else
         {
            $request->session()->flash('error','There was an error deleted the product');
         }

        return redirect()->route('product.index');
    }
}
