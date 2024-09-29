<?php

namespace App\Services\Auth;

use App\Enums\AdminEnum;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthService implements AuthServiceInterface
{

    public function checkIsCorrectCredentials(array $credentials): bool
    {
        $admin = Admin::where('email',$credentials['email'])->first();
        return $admin && Hash::check($credentials['password'], $admin->password);
    }

    public function getAuthInformation(array $credentials): array
    {
        $admin = Admin::where('email',$credentials['email'])->first();

        return [
            'admin' => $admin,
            'token' => $admin->createToken('Api Token for adminId: '.$admin->id . ' and email' . $admin->email)->plainTextToken
        ];
    }

    public function logout(): void
    {
        auth(AdminEnum::GUARD->value)->user()->currentAccessToken()->delete();
    }
}
