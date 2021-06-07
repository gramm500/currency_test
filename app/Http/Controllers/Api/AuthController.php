<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Symfony\Component\Finder\Exception\AccessDeniedException;


class AuthController extends Controller
{
    public function register(RegisterRequest $request): string
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        /** @var User $user */
        $user = User::create($data);

        return json_encode($user->createToken('default')->plainTextToken);
    }

    public function login(LoginRequest $request): string
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->firstOrFail();

        if (!Hash::check($data['password'], $user->password)) {
            throw new AccessDeniedException('your credentials are incorrect');
        }

        return json_encode($user->createToken('default')->plainTextToken);
    }
}
