<?php

namespace App\Models;

use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{

    protected $guarded = ['id', 'view_count'];

    public function getImageAttribute($image) {

        return asset('storage/images/'.$image);

    }
    public function scopeSearch($query, $request)
    {
        if($request->category) {
            $query->whereCategory_id($request->category);
        }
        if($request->address){
            $query->where('address', 'LIKE', '%'.$request->address.'%');
        }

        return $query;
    }

public function user()
{
    return $this->belongsTo(User::class);
}

public function reviews(){
    return $this->hasMany(Review::class);
}
public function setNameAttribute($value){
    $this->attributes['name'] = $value;
    $slug = Str::slug($value);
    $count = DB::table('places')->where('slug', $slug)->count();
    if ($count > 0) {
        $slug = $slug . '-' . ($count + 1);
    }
    $this->attributes['slug'] = $slug;
}

public function bookmarks()
{
    return $this->belongsToMany('App\Models\Place', 'book_marks');
}

}