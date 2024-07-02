<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        //if we are in production we wont truncate the table
        if (App::environment() === 'production') exit();

        //below code is only for development mode
        //we truncate the table in development mode
        //because Resetting and repopulating the database is a best practice in software development, testing, and deployment processes.
        // It helps in maintaining a clean, consistent, and predictable environment,
        // which is essential for developing robust applications, ensuring reliable testing, and deploying updates with confidence.

        $tables = DB::select('SHOW TABLES');
        $key = "Tables_in_" . env('DB_DATABASE');

        /*
         This disables foreign key checks in the database. It's necessary because truncating tables that have foreign key constraints would result in errors if the constraints are violated. Disabling these checks allows for truncating tables without worrying about foreign key relationships temporarily.
         */
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        foreach ($tables as $table) {
            if ($table->$key !== 'migrations') {
                DB::table($table->$key)->truncate();
            }
        }
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            TransactionSeeder::class
        ]);

        //Finally, this re-enables foreign key checks. This ensures that any future operations on the database will enforce foreign key constraints.
        DB::statement("SET FOREIGN_KEY_CHECKS = 1");
    }
}
