<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // 用户更新策略
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    // 用户关注策略
    public function follow(User $currentUser, User $user)
    {
        // 不能关注自己
        return $currentUser->id !== $user->id;
    }

}
