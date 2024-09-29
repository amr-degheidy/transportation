<?php

namespace App\Services\Auth;

interface AuthServiceInterface
{
    public function checkIsCorrectCredentials(array $credentials): bool;

    public function getAuthInformation(array $credentials): array;

    public function logout(): void;
}
