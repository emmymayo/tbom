<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        /* Disable User Status*/

        $user->status = User::STATUS_DISABLED;
        $user->save();
        // $user->deleteProfilePhoto();
        // $user->tokens->each->delete();
        // $user->isMentor() ? $user->mentor()->delete() : $user->mentee()->delete();
        // $user->delete();
    }
}
