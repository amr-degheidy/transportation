<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;
    public function login(AdminLoginRequest $request)
    {
        $request->validated($request->all());
        $admin = Admin::where('email',$request->email)->first();

        if(!$admin || !Hash::check($request->password, $admin->password)) {
            return    $this->error('','Error Occuored ', 401);
        }
        return $this->success([
            'admin' => $admin,
            'token' => $admin->createToken('Api Token for adminId: '.$admin->id . ' and email' . $admin->email)->plainTextToken
        ]);
    }

    public function logout()
    {
        auth('admin')->user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'Logged out successfully',
        ]);
    }
}
