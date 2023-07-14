<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Checkout;
use Auth;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title','price'];

    //cek apakah user sudah terdaftar di camp yang sama
    public function getIsRegisteredAttribute(){
        if(!Auth::check()){
            return false;
        }
    
        //cek apakah user sudah terdaftar di camp yang sama
        return Checkout::whereCampId($this->id)->whereUserId(Auth::id())->exists();
    }
}
