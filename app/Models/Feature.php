<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    use HasFactory;
    public $guarded = [];
    public const TYPE = 1;
    public const FEATURE = 0;
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class,RoomFeature::class);
    }
    public function toArray()
    {
        return[
            'name' => $this->name,
            'description' => $this->description
        ];
    }

}
