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
}
