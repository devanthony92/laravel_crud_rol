<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        // Lista de nombres de productos para generar datos más realistas
        $nombres = [
            'Café molido', 'Pan integral', 'Aceite de oliva', 'Arroz orgánico',
            'Leche deslactosada', 'Queso fresco', 'Yogur natural', 'Galletas de avena',
            'Jugo de naranja', 'Harina de trigo', 'Chocolate amargo', 'Té verde',
            'Mermelada de fresa', 'Cereal multigrano', 'Agua mineral', 'Vinagre balsámico',
            'Sal marina', 'Azúcar morena', 'Frijoles negros', 'Lentejas rojas'
        ];
        
        return [
            'name' => $this->faker->randomElement($nombres),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'stock' => $this->faker->numberBetween(10, 500),
        ];
    }
}