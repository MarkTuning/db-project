<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $fillable = ['name', 'price'];

    public function storages(): BelongsToMany
    {
        return $this->belongsToMany(Storage::class);
    }
}
