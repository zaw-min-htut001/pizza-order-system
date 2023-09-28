<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // product list
    public function list(){
        $pizza = Product::select('products.*','categories.name as category_name')
            ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request("key").'%');
        })
            ->leftJoin('categories','products.category_id','categories.id')
            ->orderBy('products.created_at','desc')
            ->paginate(3);
        return view('admin.product.list',compact('pizza'));
    }

    public function create(){
        $Category = Category::select('id','name')->get();

        return view('admin.product.create',compact('Category'));
    }
    //pizza delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSucess' => 'Pizza Deleted...']);
    }
    // view pizza
    public function view($id){
        $data = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.view',compact('data'));
    }
    // pizza create
    public function pizzaCreate(Request $request){
       $this->pizzaValidaation($request,'create');
       $data = $this->pizzaData($request);
       $fileName = uniqid().$request->file('image')->getClientOriginalName();
       $request->file('image')->storeAs('public', $fileName);
       $data['image'] = $fileName;
       Product::create($data);
       return redirect()->route('product#list');

    }
    //pizza updatePage
    public function updatePage($id){
        $pizzaUpdate = Product::where('id',$id)->first();
        $categories = Category::get();
        return view('admin.product.update',compact('pizzaUpdate','categories'));
    }
    // pizza update
    public function update(Request $request){
        $this->pizzaValidaation($request,'update');
        $data =$this->pizzaData($request);
        if($request->hasFile('image')){
            $oldImage=Product::where('id',$request->pizzaId)->first();
            $oldImage =$oldImage->image;

            if($oldImage != null){
                Storage::delete('public',$oldImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
            Product::where('id',$request->pizzaId)->update($data);
            return redirect()->route('product#list');


        }
    }
    //pizza data
    private function pizzaData($request){
        return [
            'name' => $request->name,
            'category_id' => $request->pizzaCategory,
            'description' => $request->pizzaDescription,
            'price' => $request->price,
            'waiting_time' => $request->waitingTime,
        ];
    }
    // pizza validation
    private function pizzaValidaation($request,$action){
        $validationRule =[
            'name' => 'required|unique:products,name,'.$request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required',
            'waitingTime' => 'required',
            'price' => 'required',
        ];
        $validationRule ['image'] =$action == 'create' ? 'required|mimes:png,jpg,jpeg.webp|file':'mimes:png,jpg,jpeg.webp|file';
       Validator::make($request->all(),$validationRule )->validate();
    }

}
