<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class County extends Model
{
    use HasFactory;
    public function subcounties():HasMany
    {
        return $this->hasMany(SubCounty::class,"county_id");
    }
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'suncounties' => $this->subcounties()->get(),
        ];
    }
}
