<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Booking extends Model
{
    use HasFactory;
    public $guarded = [];
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function nights()
    {
        return Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date));
    }
    public function total()
    {
        return $this->price_per_night * $this->nights();
    }
    public function toArray()
    {
        return [
            'id' => $this->id,
            'price_per_night' => $this->price_per_night,
            'client' => $this->user()->get(),
            'room' => $this->room()->get(),
            'no_of_adults' => $this->no_adults,
            'no_of_children' => $this->no_children,
            'start_date' => Carbon::parse($this->start_date)->format('Y-m-d H:i:s'),
            'end_date' => Carbon::parse($this->end_date)->format('Y-m-d H:i:s'),
            'nights' => $this->nights(),
            'total' => $this->total()
        ];
    }
}
