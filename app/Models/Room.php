<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'floor_id',
        'room_type_id',
        'price',
        'characteristics',
        'state',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relación con piso
    public function floor(): BelongsTo
    {
        return $this->belongsTo(Floor::class, 'floor_id', 'id');
    }

    // Relación con tipo de habitación
    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'room_type_id', 'id');
    }
    /*public function tieneRelaciones(): bool
    {
       return $this->floor()->exists() || $this->roomType()->exists();
    }*/
}
