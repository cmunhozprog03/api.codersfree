<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // One->Many
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeInclude(Builder $query){
        $relations = request('included');
    }
}
