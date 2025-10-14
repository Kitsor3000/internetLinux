<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Location;

class LocationPolicy
{
    public function viewAny(User $user)
    {
        return true; // Перегляд списку дозволений всім
    }

    public function update(User $user, Location $location)
    {
        // Редагувати може тільки адмін
        return $user->is_admin;
    }

    public function delete(User $user, Location $location)
    {
        // Видаляти може тільки адмін
        return $user->is_admin;
    }

    // Для create, якщо потрібно
    public function create(User $user)
    {
        return $user->is_admin;
    }
}
