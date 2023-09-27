<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    
    public $guarded = [];
    public function uPath()
    {
        return "images/".$this->path;    }
    public function toArray():array
    {
        return[
                'id' => $this->id,
            'path' => "images/".$this->path,

        ];
    }
}
