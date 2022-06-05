<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userClass extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $primarykey = 'id';
    protected $table = 'user_classes';  

    public function user(){
        return $this->hasMany(User::class);
    }
}
