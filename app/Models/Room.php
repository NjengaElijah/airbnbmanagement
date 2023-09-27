<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Room extends Model
{
    use HasFactory;
    public $guarded = [];
    public static function all($columns = [])
    {
        return Room::where('deleted',0)->get();
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function images(): HasMany
    {
        return Photo::where(['photoable_type' => Room::class,'photoable_id' => $this->id]);
    }
    public function features(): BelongsToMany
    {
        // return Feature::whereHas('rooms')->where('deleted', 0)->get();
        return $this->belongsToMany(Feature::class ,  'room_features');
    }
    public function unassignedFeatures()
    {
        return Feature::whereDoesntHave('rooms',function ($query){
            $query->where('room_id',$this->id);
        })->where('deleted', 0)->get();

    }
    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable')->get()->toArray();
        
    }
    public function mainPhoto() 
    {
        return ($this->photos()) ? $this->morphMany(Photo::class, 'photoable')->first() : null;
    }
    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function rating()
    {
        $r = $this->reviews()->avg('rating')??5;
        return round($r,2);
    }
    public function toArray()
    {
        // dd($this->features()->get());
        return [
            'id' => $this->id,
            'name'  => $this->name,
            'description'  => $this->description,
            'price' => $this->price_per_night,
            'discounted_price' => $this->discounted_price,
            'no_of_guests' => $this->no_guests,
            'type' => $this->features()->where('type', Feature::TYPE)->get(),
            'features' => $this->features()->where('type', Feature::FEATURE)->get(),
            'photos' => $this->photos(),
            'rating' => $this->rating(),
            'reviews' => $this->reviews()->get()
        ];
    }
}