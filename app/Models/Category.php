<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function fortunes(): HasMany
    {
        return $this->hasMany(Fortune::class);
    }
}
