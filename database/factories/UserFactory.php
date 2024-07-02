<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends
 * \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),

            /*
             The $verified variable determines if a user is verified or not.
             If the user is verified, no verification token is generated (verification_token is null);
             otherwise, a verification token is generated.
             Verified users can be either regular users or admins, while unverified users are always regular users.
             This logic ensures that only verified users can potentially be admins and that unverified users are always regular users.
             */
            'verified' => $verified = fake()->randomElement([User::VERIFIED_USER,User::UNVERIFIED_USER]),
            'verification_token' => $verified === USER::VERIFIED_USER ? null : User::generateVerificationToken(),
            'admin' => $verified === USER::VERIFIED_USER ? fake()->randomElement([User::ADMIN_USER,User::REGULAR_USER]) : USER::REGULAR_USER

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
