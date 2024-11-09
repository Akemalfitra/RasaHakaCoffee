<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
 /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->word,
            'jenis' => $this->faker->randomElement(['Makanan Utama', 'Makanan Ringan', 'Minuman']),
            'stok' => $this->faker->numberBetween(10, 100),
            'harga' => $this->faker->numberBetween(5000, 50000),
            'gambar' => $this->faker->imageUrl(640, 480, 'food', true, 'product'),
        ];
    }
}
