<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
  

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('admin.category.category',compact('categories'));
    }

    public function store(Request $request)
    {
        Category::addCategory($request->category_name);

        return redirect()->route('AllCat')->with('success', 'Category added successfully');
    }

    public function edit($id){
        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function update(Request $request, $id){
        $update = Category::find($id)->update([
            'category_name'=>$request->category_name,
            'user_id'=>Auth::user()->id,
        ]);

        return Redirect()->route('AllCat')->with ('success', 'Updated Successfully');
    }

    public function Delete($id){
        $category = Category::find($id);
        $category->delete();

        return Redirect()->back();
    }

}