<?php

namespace App\Http\Controllers;

use App\User;

class ProfilesController extends Controller
{
    public function show ( User $profileUser )
    {
        $threads = $profileUser->threads()->paginate(1);
        return view( 'profiles.show', [
            'profileUser' => $profileUser,
            'threads'     => $threads
        ] );
    }
}
