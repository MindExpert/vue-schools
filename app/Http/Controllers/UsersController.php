<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UpdateService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected UpdateService $batchService;

    public function __construct(UpdateService $batchService)
    {
        $this->batchService = $batchService;
    }

    public function updateUserAttributes()
    {
        $users = User::query()
            ->get()
            ->map(function (User $user) {
                return [
                    'email' => $user->email,
                    'name' => $user->firstname,
                    'timezone' => $user->timezone,
                ];
            })
            ->values()
            ->toArray();

        foreach ($users as $user) {
            $this->batchService->addSubscriberToBatch($user);
        }

        // Other logic...
    }
}
