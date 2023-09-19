<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;
    public $guarded = [];
    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class);
    }
    public function names()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}