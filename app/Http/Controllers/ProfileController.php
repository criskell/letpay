<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class ProfileController
{
    public function show(Request $request)
    {
        return $request->user();
    }
}
