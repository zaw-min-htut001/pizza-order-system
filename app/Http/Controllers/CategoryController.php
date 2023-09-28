<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //admin list page
    public function list(){
        $categories =Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->orderBy('id','desc')->paginate(5);
        return view('admin.list',compact('categories'));
    }
    // direct category create
    public function createPage(){
        return view('admin.create');
    }
    // cate delete
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSucess' => 'Category Deleted ... ']);
    }

    // category create data

    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->categoryCreateData($request);
        Category::create($data);
        return redirect()->route('category#list');
    }

    // edit cate

    public function edit($id){
        $edit = Category::where('id',$id)->first();
        return view('admin.edit',compact('edit'));
    }
    // update cate
    public function update(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->categoryCreateData($request);
        $id =$request->updateId;
        Category::where('id',$id)->update($data);
        return redirect()->route('category#list');
    }

    // // cate Validation

    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
             'category_name' => 'required|unique:categories,name,'.$request->updateId,
         ])->validate();

    }
    // // cate create data

    private function categoryCreateData($request){
        return [
            'name' => $request->category_name,
        ];
    }
}
