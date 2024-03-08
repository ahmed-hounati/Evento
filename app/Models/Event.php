<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'place',
        'date',
        'category_id',
        'availablePlaces',
        'auto_confirmation',
        'organizer_id'
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }
}
