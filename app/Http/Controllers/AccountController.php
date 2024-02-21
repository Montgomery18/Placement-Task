<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function Test(){
        $account = Account::all();
        dd($account);
    }

     public function Register()
    {
        return view('views.Register');
    }

    public function add(Request $request){

        $newAccount= new Account;

        $newAccount->Username= $request->username;

        $newAccount->Password= $request->passw;

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
            echo ("no work");
        }
 
   }
}
