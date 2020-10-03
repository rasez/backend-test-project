<?php

namespace App\Observers;

use App\Jobs\NewUserActivationEmailJob;
use App\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        dispatch(new NewUserActivationEmailJob($user));
    }

}
