<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //direct userList Page
    public function userList(){
        $userData = User::where('role','user')->paginate(4);

        return view('admin.user.userList')->with(['user'=>$userData]);
    }
    //direct adminList Page

    public function adminList(){
        $userData = User::where('role','admin')->paginate(4);

        return view('admin.user.adminList')->with(['admin'=>$userData]);
    }

    // user account search
    public function userSearch(Request $request){



        $response=$this->searchData('user',$request);


        return view('admin.user.userList')->with(['user'=>$response]);


    }

    //   admin account search
      public function adminSearch(Request $request){
        $response=$this->searchData('admin',$request);


        return view('admin.user.adminList')->with(['admin'=>$response]);


    }
    private function searchData($role,$request){


        $search = User::where('role',$role)
                ->where(function($query) use($request){
                $query->orWhere('name','like','%'.$request->search.'%')
                ->orWhere('email','like','%'.$request->search.'%')
                ->orWhere('phone','like','%'.$request->search.'%')
                ->orWhere('address','like','%'.$request->search.'%');
        })
        ->paginate(4);
        $search->appends($request->all());
        return $search;
    }

// user delete
    public function userDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete Success...']);
    }

    // admin delete
    public function adminDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete Success...']);
    }
}
