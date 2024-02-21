<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $primaryKey = 'AccountID';
    protected $fillable = ['AccountID', 'email', 'password', 'Access_Level'];
    use HasFactory;
    protected $table = 'Account';
    public $timestamps = false;
}
