<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class ProductCategoryController extends Controller
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
        if ($request->ajax()) {

            return Datatables::of(ProductCategory::query())
                // ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-warning" }}')
                ->setRowId('{{$id}}')
                //->addColumn('intro', 'Hi {{$brand_name}}!')
                ->editColumn('created_at', function(ProductCategory $productCategory) {
                    return $productCategory->created_at->diffForHumans();
                })
                ->editColumn('updated_at', function(ProductCategory $productCategory) {
                    return $productCategory->updated_at->format('h:m:s');
                })
                // ->editColumn('updated_at', 'website.backend.productCategory.column')
                // ->rawColumns(['updated_at'])
                // ->addColumn('action', 'website.backend.productCategory.column')
                ->addColumn('actions', function($row){
                    $editUrl = route('productCategory.edit', $row->id);
                    $deleteUrl = route('productCategory.destroy', $row->id);

                    return view('website.backend.colmun.column', compact('editUrl', 'deleteUrl'));
                    })
                //->removeColumn('intro')
                ->addIndexColumn()->make(true);

        }    
        return view('website.backend.productCategory.index');
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website.backend.productCategory.create');
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
            'brand_name' => 'required'
        ]);

            $slug = Str::slug($request->brand_name, '-');
            $productCategory = new ProductCategory();

            $productCategory->brand_name = request('brand_name');
            $productCategory->slug = $slug;

            if ($productCategory->save()) {
                $request->session()->flash('success','Product Category has been created');
            }
            else{
                $request->session()->flash('error','There was an error created the product category');
            }

            return redirect()->route('productCategory.index');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productCategory = ProductCategory::findorFail($id);
        return view('website.backend.productCategory.edit', compact('productCategory'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        request()->validate([
            'brand_name' => 'required'
        ]);

            $slug = Str::slug($request->brand_name, '-');
            $productCategory = ProductCategory::findorFail($request->id);

            $productCategory->brand_name = request('brand_name');
            $productCategory->slug = $slug;

            if ($productCategory->update()) {
                $request->session()->flash('success','Product Category has been updated');
            }
            else{
                $request->session()->flash('error','There was an error updated the product category');
            }

            return redirect()->route('productCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $productCategory = ProductCategory::findorFail($id);

       
        if ($productCategory->delete()) {
                $request->session()->flash('success','Product Category has been deleted');
            }
        else{
                $request->session()->flash('error','There was an error deleted the product category');
            }

        return redirect()->route('productCategory.index');
    }
    
}
