<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $user->loadMissing([
            'projects' => function ($query) {
                $query->active();
            }
        ]);
        return view('home', compact('user'));
    }
}
