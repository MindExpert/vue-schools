<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserDataRandomlyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-data-randomly-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        User::query()->get()->each(function (User $user) {
            $user->update([
                'firstname' => fake()->firstName(),
                'lastname' => fake()->lastName(),
                'timezone' => fake()->randomElement(['cet', 'cst', 'gmt+1']),
            ]);
        });

        return self::SUCCESS;
    }
}
