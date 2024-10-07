<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->warn('Start seeding the DB....');

         Model::unguard();
         Schema::disableForeignKeyConstraints();

        $this->call([
            UserSeeder::class,
        ]);

         Schema::enableForeignKeyConstraints();
         Model::reguard();

        $this->command->warn('All Database tables have been seeded.');
    }
}
