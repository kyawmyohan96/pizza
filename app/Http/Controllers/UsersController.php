<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    // direct home page
    public function index(){
        $pizza =Pizza::where('publish_status',1)->paginate(9);
        $status = count($pizza) == 0 ? 0 : 1;

        $category = Category::get();
        return view('user.index')->with(['pizza'=>$pizza,'category'=>$category,'status'=>$status]);
    }

    public function pizzaDetails($id){
        $data =Pizza::where('pizza_id',$id)->first();


        return view('user.details')->with(['pizza'=>$data]);
    }

    public function categorySearch($id){
        $data = Pizza::where('category_id',$id)->paginate(9);
        $status = count($data) == 0 ? 0 : 1;
        $category = Category::get();

        return view('user.index')->with(['pizza'=>$data,'category'=>$category,'status'=>$status]);
    }

    public function searchItem(Request $request){

        // dd($request->searchData);

        $data = Pizza::where('pizza_name','like','%'.$request->searchData.'%')->paginate(9);
        $data->appends($request->all());

        $status = count($data) == 0 ? 0 : 1;

        $category = Category::get();
        return view('user.index')->with(['pizza'=>$data,'category'=>$category,'status'=>$status]);


    }
}
