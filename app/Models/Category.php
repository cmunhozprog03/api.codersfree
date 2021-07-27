<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $allowIncluded = ['posts', 'posts.user'];

    // One->Many
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeIncluded(Builder $query){

        if (empty($this->allowIncluded)||empty(request('included'))){
            return;
        }
        $relations = explode(',', request('included'));

        $allowIncluded = collect($this->allowIncluded);

        foreach($relations as $key => $realtionship){
            if(!$allowIncluded->contains($realtionship)){
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }
}
