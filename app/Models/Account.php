<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = 'Account';
    protected $primaryKey = 'AccountID';
    protected $fillable = ['AccountID', 'email', 'password', 'Access_Level'];
    public $timestamps = false;
}
