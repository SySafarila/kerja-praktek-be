<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminIndex extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();
        $blogs = Blog::all();

        $userResult = $this->usersCount($users);

        return view('admin.index', compact('users', 'roles', 'permissions', 'blogs', 'userResult'));
    }

    private function usersCount($users)
    {
        $yearNow = now()->year;

        $usersJan = [];
        $usersFeb = [];
        $usersMar = [];
        $usersApr = [];
        $usersMay = [];
        $usersJun = [];
        $usersJul = [];
        $usersAug = [];
        $usersSep = [];
        $usersOct = [];
        $usersNov = [];
        $usersDes = [];

        foreach ($users as $user) {
            if (Carbon::parse($user->created_at)->year == $yearNow && Carbon::parse($user->created_at)->month == 1) {
                array_push($usersJan, $user);
            }
            if (Carbon::parse($user->created_at)->year == $yearNow && Carbon::parse($user->created_at)->month == 2) {
                array_push($usersFeb, $user);
            }
            if (Carbon::parse($user->created_at)->year == $yearNow && Carbon::parse($user->created_at)->month == 3) {
                array_push($usersMar, $user);
            }
            if (Carbon::parse($user->created_at)->year == $yearNow && Carbon::parse($user->created_at)->month == 4) {
                array_push($usersApr, $user);
            }
            if (Carbon::parse($user->created_at)->year == $yearNow && Carbon::parse($user->created_at)->month == 5) {
                array_push($usersMay, $user);
            }
            if (Carbon::parse($user->created_at)->year == $yearNow && Carbon::parse($user->created_at)->month == 6) {
                array_push($usersJun, $user);
            }
            if (Carbon::parse($user->created_at)->year == $yearNow && Carbon::parse($user->created_at)->month == 7) {
                array_push($usersJul, $user);
            }
            if (Carbon::parse($user->created_at)->year == $yearNow && Carbon::parse($user->created_at)->month == 8) {
                array_push($usersAug, $user);
            }
            if (Carbon::parse($user->created_at)->year == $yearNow && Carbon::parse($user->created_at)->month == 9) {
                array_push($usersSep, $user);
            }
            if (Carbon::parse($user->created_at)->year == $yearNow && Carbon::parse($user->created_at)->month == 10) {
                array_push($usersOct, $user);
            }
            if (Carbon::parse($user->created_at)->year == $yearNow && Carbon::parse($user->created_at)->month == 11) {
                array_push($usersNov, $user);
            }
            if (Carbon::parse($user->created_at)->year == $yearNow && Carbon::parse($user->created_at)->month == 12) {
                array_push($usersDes, $user);
            }
        }

        $userResults = [count($usersJan), count($usersFeb), count($usersMar), count($usersApr), count($usersMay), count($usersJun), count($usersJul), count($usersAug), count($usersSep), count($usersOct), count($usersNov), count($usersDes)];

        return $userResults;
    }
}
