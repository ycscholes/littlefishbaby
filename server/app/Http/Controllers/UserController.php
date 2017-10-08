<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getUsers($id, Request $request) {
        return $request->user();

        $results = DB::select('SELECT * FROM users');

        return $results;
    }
}
