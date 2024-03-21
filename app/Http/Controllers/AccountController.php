<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

class AccountController extends Controller
{
   
    
    public function Test(){
        $account = Account::all();
        dd($account);
    }

     public function Register()
    {
        return view('/index');
    }

    public function add(Request $request){

        $newAccount= new Account;
        foreach (Account::all() as $existing){
            if ($request->username == $existing[0]){
                return view("/Register", ["error" => "username or password exists"]);
            }
            else if ($request->password == $existing[1]){
                return view("/Register", ["error" => "username or password exists"]);
            }
        }

        $newAccount->Username= $request->username;

        $newAccount->Password= Hash::make($request->passw);

        $newAccount->save();

        return view('/index');
    }

   public function delete(Request $request)
   {
       $userId=$request -> username;
      
       $user = Account::where('Username', $userId)->first();
 
       if ($user) {
           $user->delete($user);
           return view ('/index');
        } else {
            return view('/AdminDeleteUser');
        }
 
   }

   public function login()
    {
        return view('/index');
    }

    public function loginPost(Request $request) 
    {

    $username = $request->input('username');
    $password = $request->input('password');

    $hashPass = Account::where('Username', $username)->value("Password");
    
    if (Hash::check($password, $hashPass)){
        session(["AccountID" => Account::where('Password', $hashPass)->value("AccountID")]);
        return view("/index");
    }
    else{
        return view("/Login");
    }
    }
    public function ResetPassRequest()
    {
        return view('/index');
    }

   public function ResetPassPost(Request $request)
    {
        $session_id=session()->get("AccountID");

        $row= Account::find($session_id);

       if ($row) {
        $row->Password = Hash::make($request->passw);
        $row->save();
         return view('/index');
    } else {
        echo ("no work");
       
    }
       
    }

}

