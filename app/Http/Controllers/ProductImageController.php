<?php

namespace App\Http\Controllers;

use App\ProductImage;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class ProductImageController extends Controller
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

            return Datatables::of(ProductImage::query())

                ->addIndexColumn()
                ->setRowId('{{$id}}')
                ->editColumn('created_at', function(ProductImage $productImage) {
                    return $productImage->created_at->diffForHumans();
                })

                ->editColumn('updated_at', function(ProductImage $productImage) {
                    return $productImage->updated_at->format('h:m:s');
                    })

                ->addColumn('product_name', function(ProductImage $productImage) {
                    return $productImage->products->product_name;
                })

                ->addColumn('product_image', function($productImage) {
                    $url=asset("/storage/$productImage->product_image"); 
                    return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
                })

                ->rawColumns(['product_image', 'action'])

                ->addColumn('actions', function($row){
                    $editUrl = route('productImage.edit', $row->id);
                    $deleteUrl = route('productImage.destroy', $row->id);

                    return view('website.backend.colmun.column', compact('editUrl', 'deleteUrl'));
                    })

                ->addIndexColumn()->make(true);
            
        }    
        return view('website.backend.productImage.index');
    }



    public function anyData()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('website.backend.productImage.create', compact('products'));
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
            'img_title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp'
        ]);

        $slug = Str::slug($request->product_name, '-');

        $image = $request->file('image');

        if ($request->hasFile('image')) {
                $fileName = $image->getClientOriginalName();                
                $img = $request->image->storeAs('product/images',$fileName,'public');

                $productImage = new ProductImage();

             $productImage->img_title = request('img_title');
             $productImage->product_image = $img;
             $productImage->product_id = $request->get('product_id');
             $productImage->slug = $slug;
             $productImage->save();

             if ($productImage->save()) {
                    $request->session()->flash('success','Product Image has been created');
                }
                else{
                    $request->session()->flash('error','There was an error created the product Image');
                }
             
             return redirect()->route('productImage.index');

            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productImage = ProductImage::findorFail($id);
            $products = Product::all();
            
        return view('website.backend.productImage.edit', compact('productImage','products')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $image = $request->file('image');

        if ($request->hasFile('image'))
         {
            request()->validate([
                'img_title' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp'
            ]);

            $slug = Str::slug($request->product_name, '-');

            $productImage = ProductImage::findorFail($request->id);

                    $fileName = $image->getClientOriginalName();                
                    $img = $request->image->storeAs('product/images',$fileName,'public');

                 $productImage->img_title = request('img_title');
                 $productImage->product_image = $img;
                 $productImage->product_id = $request->get('product_id');
                 $productImage->slug = $slug;

                if ($productImage->save()) {
                $request->session()->flash('success','Product Image has been updated');
                }
                else{
                    $request->session()->flash('error','There was an error updated the product Image');
                }
                 
                 return redirect()->route('productImage.index');

         }

                request()->validate([
                        'img_title' => 'required'
                    ]);

                $slug = Str::slug($request->product_name, '-');

                $productImage = ProductImage::findorFail($request->id);


                 $productImage->img_title = request('img_title');
                 $productImage->product_id = $request->get('product_id');
                 $productImage->slug = $slug;

                if ($productImage->update()) {
                $request->session()->flash('success','Product Image has been updated');
                }
                else{
                    $request->session()->flash('error','There was an error updated the product Image');
                }
                 
                 return redirect()->route('productImage.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $productImage = ProductImage::findorFail($id);

        if ($productImage->delete())
         {
            $request->session()->flash('success','Product Image has been deleted');
         }
        else
         {
            $request->session()->flash('error','There was an error deleted the product Image');
         }

        return redirect()->route('productImage.index');
    }
    
}
