<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function generateToken($id)
    {
        $targetUser = User::find($id);
        $token = Carbon::now()->toDateTimeString() . Str::random(80);
        $targetUser->update([
            'api_token' => hash('sha256', $token),
        ]);
        return true;
    }
}
