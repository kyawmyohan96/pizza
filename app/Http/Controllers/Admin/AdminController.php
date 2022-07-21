<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // direct admin profile
    public function profile(){
        $id = auth()->user()->id;
        $userData = User::where('id',$id)->first();
        return view('admin.profile.index')->with(['user'=>$userData]);
    }

    // update profile
    public function updateProfile($id,Request $request){

        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',

        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }



        $updateData = $this-> updateProfileData($request);
        User::where('id',$id)->update($updateData);
        return back()->with(['updateProfileSuccess'=>'User Information Updated...']);


    }


    // change password
    public function changePassword($id,Request $request){


        $validator = Validator::make($request->all(),[
            'oldPassword' =>'required',
            'newPassword'=>'required',
            'comfirmPassword'=>'required',

        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $data = User::where('id',$id)->first();

        $oldPassword = $request->oldPassword;
        $newPassword =$request->newPassword;
        $comfirmPassword=$request->comfirmPassword;
        $hashedPassword = $data['password'];


        if(Hash::check($oldPassword,$hashedPassword)){ //db and (userinput ) smae password
            if($newPassword != $comfirmPassword){ //newpassword != comfirmpassword
            return back()->with(['notSameError'=>'New Password No Same with Comfirm Password..']);

            }else{
                if(strlen($newPassword) <= 6 || strlen($comfirmPassword) <=6){ //<6
            return back()->with(['lengthError'=>'Length Must Be At Least 6..']);

                }else{ //change
                    $hash = Hash::make($newPassword);
                    User::where('id',$id)->update([
                        'password'=>$hash
                    ]);
                    return back()->with(['success'=>'Password Changed...']);

                }
            }
        }else{
            return back()->with(['notMatchError'=>'Password Do Not Match!! Try Again...']);
        }





    }

    // change password page
    public function changePasswordPage(){
        return view('admin.profile.changePasswordPage');
    }

    // request profile data
    private function updateProfileData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=> $request->address,

        ];

    }




}
