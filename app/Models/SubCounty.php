<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCounty extends Model
{
    use HasFactory;
    protected $table = "subcounties";
    public function county():BelongsTo
     {
         return $this->belongsTo(County::class);
    }
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
