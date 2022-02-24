<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Book;
class AjaxBOOKCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id','desc')->paginate(10);
        $data = array(
            'books' => $books
        );
   //dd($books);
        return view('ajax-book-crud')->with($data);
    }
    
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book   =   Book::updateOrCreate(
                    [
                        'id' => $request->id
                    ],
                    [
                        'title' => $request->title, 
                        'code' => $request->code,
                        'author' => $request->author,
                        'edition' => $request->edition,
                        'status' => $request->status,
                        'publish' => $request->publish,

                    ]);
    
        return response()->json(['success' => true]);
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $book  = Book::where($where)->first();
 
        return response()->json($book);
    }
 
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $book = Book::where('id',$request->id)->delete();
   
        return response()->json(['success' => true]);
    }

   Public function getData(Request $request)
    {
// return ["name"=>"Demo","email"=>"demo@demo.com","phone"=>"0987654321"];
        return Book::all();
    }

    public function relation()
    {

        return Book::find(1)->BookData;
    }

    public function updateStatus( Request $request ){
        $book = Book::where('id',$request->id)->update(['status'=>$request->status]);

        return response()->json(['success' => true]);

    }
}