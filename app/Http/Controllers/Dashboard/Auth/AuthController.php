<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use App\Services\Auth\AuthServiceInterface;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function __construct(
        private readonly AuthServiceInterface $authServiceInterface
    ){
    }

    public function login(AdminLoginRequest $request)
    {
        $request->validated($request->all());
        $credentials = $request->only(['email', 'password']);

        if(!$this->authServiceInterface->checkIsCorrectCredentials($credentials)) {
            return  $this->error('','Error Occuored ', 401);
        }

        return $this->success($this->authServiceInterface->getAuthInformation($credentials), 'Login Successful');
    }

    public function logout()
    {
        $this->authServiceInterface->logout();
        return $this->success([], 'Logout Successful');
    }
}
