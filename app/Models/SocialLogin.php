<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model
{
    use HasFactory;

    protected $fillable=['provider','nick_email','social_id','user_id'];
    //1:1
    public function user(){
        return $this->belongsTo(User::class);
    }
}
