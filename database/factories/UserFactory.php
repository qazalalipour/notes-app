<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'mobile' => $this->generateIranianMobile(),
        ];
    }
    private function generateIranianMobile(): string
    {
        $prefixes = ['0910', '0911', '0912', '0913', '0914', '0915', '0916', '0917', '0918', '0919', '0901', '0902', '0903', '0930', '0933', '0935', '0936', '0937', '0938', '0939', '0920', '0921', '0922', '0923'];

        $prefix = $this->faker->randomElement($prefixes);
        $number = $this->faker->numerify('#######');

        return $prefix . $number;
    }
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified()
    {
        // 
    }
}
