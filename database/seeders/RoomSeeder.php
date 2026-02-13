<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $roomNumber = 101;

        // Crear 30 habitaciones de ejemplo
        for ($i = 1; $i <= 30; $i++) {

            Room::create([
                'number' => (string) $roomNumber++,

                // Solo existen 3 pisos
                'floor_id' => rand(1, 3),

                // Existen 15 tipos de habitación
                'room_type_id' => rand(1, 15),

                // Precio entre 80 y 350
                'price' => rand(80, 350),

                // Algunas con características, otras no
                'characteristics' => rand(0, 1)
                    ? 'TV, WiFi, Aire acondicionado, Baño privado'
                    : null,

                // Estado inicial
                'state' => 'libre',
            ]);
        }
    }
}
