<?php
  
namespace App\Http\Controllers;
   
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
  
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $products = Product::latest()->paginate(5);
    
        $data = array(
            'products' => $products
        );
   
        return view('products.index')->with($data);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // using ajax show validation messsages       

    try {
    
        $products   =   Product::updateOrCreate(
                    [
                        'id' => $request->id
                    ],
                    [
                        'name' => $request->name, 
                        'detail' => $request->detail,
                        'file' => $request->file,
                                                
                    ]);
        } catch (Exception $e) {
            return response()->json(['success' => false]);
    
        }
    
        return response()->json(['success' => true]);



                
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $products  = Product::where($where)->first();
 
        return response()->json($products);
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function edit(Product $product)
    // {        
    //     return view('products.edit',compact('product'));
    // }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
   public function destroy(Request $request)
    {
        $products = Product::where('id',$request->id)->delete();
   
        return response()->json(['success' => true]);
    }

    public function getData()
    {
        return Product::all();
    }

    public function addData(Request $request)
    {
        $product= new Product;
        $product->name=$request->name;
         $product->detail=$request->detail;
          $product->file=$request->file;
          $result=$product->save();

          if($result)
          {
        return ["result"=>"done"];
    }
    else{
        return ["result"=>"fail"];
    }
    }
    
}