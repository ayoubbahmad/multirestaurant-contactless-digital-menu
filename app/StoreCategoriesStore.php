<?php

namespace App;

use App\Models\Store;
use Illuminate\Database\Eloquent\Model;

class StoreCategoriesStore extends Model
{
    public function stores(){

            return $this->belongsTo(Store::class,'store_id','id');

    }
}
