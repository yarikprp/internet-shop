<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Support\Testing\FakerImageProvider;
use Faker\Generator as FakerGenerator;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = app(FakerGenerator::class);
        $faker->addProvider(new FakerImageProvider($faker));

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Brand::factory(20)->create();

        Category::factory(10)
            ->has(Product::factory(rand(5, 15)))
            ->create();
    }
}
