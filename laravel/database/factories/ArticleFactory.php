<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageDir = storage_path('/app/public/images');
        if (!file_exists($imageDir)) {
            mkdir($imageDir, 0777, true);
        }
        $imagePath = $this->faker->image($imageDir, 640, 480, null, false);
        $createdByUser = User::query()->exists() ? User::query()->inRandomOrder()->first()->id : User::factory()->create()->id;

        return [
            'title' => fake()->text(50),
            'image_path' => 'images/' . basename($imagePath),
            'content' => fake()->paragraphs(3, true),
            'created_user_id' => $createdByUser,
        ];
    }
}
