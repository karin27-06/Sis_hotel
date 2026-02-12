<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        RoomType::create([
            'name' => 'Habitación Individual (Single)',
            'description' => 'Habitación diseñada para una sola persona con una cama individual.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Habitación Doble (Double)',
            'description' => 'Habitación para dos personas con una cama matrimonial.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Habitación Twin',
            'description' => 'Habitación para dos personas con dos camas individuales separadas.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Habitación Triple',
            'description' => 'Habitación diseñada para tres personas con múltiples configuraciones de camas.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Habitación Cuádruple',
            'description' => 'Habitación amplia para cuatro personas, ideal para familias o grupos.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Habitación Familiar',
            'description' => 'Habitación espaciosa diseñada para alojar familias con varias camas o ambientes.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Habitación Estándar',
            'description' => 'Habitación básica con servicios esenciales para una estancia cómoda.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Habitación Superior',
            'description' => 'Habitación con mayor espacio, mejores vistas o comodidades adicionales.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Habitación Deluxe',
            'description' => 'Habitación de categoría superior con mayor confort y servicios premium.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Junior Suite',
            'description' => 'Habitación amplia con área de descanso integrada y mayor comodidad.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Suite',
            'description' => 'Habitación de lujo con espacios separados como dormitorio y sala de estar.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Suite Presidencial',
            'description' => 'La habitación más lujosa del hotel con amplios espacios y servicios exclusivos.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Habitación Comunicada',
            'description' => 'Habitaciones conectadas internamente, ideales para familias o grupos.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Habitación Adaptada',
            'description' => 'Habitación diseñada para personas con movilidad reducida o discapacidad.',
            'state' => true,
        ]);
        RoomType::create([
            'name' => 'Bungalow o Villa',
            'description' => 'Unidad de alojamiento independiente del edificio principal con mayor privacidad.',
            'state' => true,
        ]);
        // RoomType::factory(10000)->create();
    }
}
