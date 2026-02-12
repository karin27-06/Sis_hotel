<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    use HasFactory;

    protected $table = 'room_types'; // nombre de la tabla

    protected $fillable = [
        'name',
        'description',
        'state',
    ];

    protected $casts = [
        'state' => 'boolean',
    ];
    /*public function tieneRelaciones(): bool
    {
    return $this->Schedules()->exists() || $this->Movements()->exists();
    }*/
    //PONER LAS RELACIONES QUE EXISTEN CON OTROS MODELOS
}
