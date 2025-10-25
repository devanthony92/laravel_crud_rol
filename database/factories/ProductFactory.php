<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
{
    $nombres = [
        'Café molido premium', 'Pan artesanal integral', 'Aceite de oliva virgen extra', 'Arroz orgánico basmati',
        'Leche deslactosada light', 'Queso fresco campesino', 'Yogur natural sin azúcar', 'Galletas de avena y miel',
        'Jugo de naranja natural', 'Harina de trigo fortificada', 'Chocolate amargo 70%', 'Té verde matcha',
        'Mermelada de fresa casera', 'Cereal multigrano con miel', 'Agua mineral con gas', 'Vinagre balsámico italiano',
        'Sal marina gruesa', 'Azúcar morena orgánica', 'Frijoles negros premium', 'Lentejas rojas seleccionadas',
        'Aceitunas verdes rellenas', 'Mantequilla de maní natural', 'Salsa de tomate artesanal', 'Garbanzos cocidos listos',
        'Avena integral instantánea', 'Miel pura de abejas', 'Pasta integral penne', 'Atún en aceite de oliva',
        'Leche de almendras sin azúcar', 'Cacao en polvo orgánico', 'Mostaza Dijon tradicional', 'Mayonesa casera ligera',
        'Cereal de avena con frutas', 'Pan de centeno rústico', 'Queso mozzarella fresco', 'Agua de coco natural',
        'Salsa picante jalapeño', 'Puré de papa instantáneo', 'Chips de plátano horneadas', 'Vinagre de manzana natural',
        'Yogur griego con miel', 'Mermelada de mora andina', 'Té negro con canela', 'Pan blanco artesanal', 
        'Harina de maíz precocida', 'Galletas saladas gourmet', 'Aceite de coco prensado en frío', 
        'Queso cheddar madurado', 'Cereal de arroz inflado', 'Manteca vegetal premium', 'Bebida de avena natural'
    ];

    return [
        'name' => $this->faker->unique()->randomElement($nombres),
        'description' => $this->faker->sentence(12, true),
        'price' => $this->faker->randomFloat(2, 2.5, 120),
        'stock' => $this->faker->numberBetween(5, 500),
    ];
}

}