<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $users;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getUsers(Request $request) {

    }

    static function getUserByUsername($username)
    {
        return User::where('username', $username)->first();
    }
}
