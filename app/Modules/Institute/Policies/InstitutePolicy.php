<?php

namespace App\Modules\Institute\Policies;

use App\Models\User;
use App\Modules\Institute\Models\Institute;

class InstitutePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('institute.view');
    }

    public function view(User $user, Institute $institute): bool
    {
        return $user->hasPermissionTo('institute.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('institute.create');
    }

    public function update(User $user, Institute $institute): bool
    {
        return $user->hasPermissionTo('institute.edit');
    }

    public function delete(User $user, Institute $institute): bool
    {
        return $user->hasPermissionTo('institute.delete');
    }

    public function publish(User $user, Institute $institute): bool
    {
        return $user->hasPermissionTo('institute.publish');
    }

    public function archive(User $user, Institute $institute): bool
    {
        return $user->hasPermissionTo('institute.archive');
    }

    public function restore(User $user, Institute $institute): bool
    {
        return $user->hasPermissionTo('institute.edit');
    }
}
