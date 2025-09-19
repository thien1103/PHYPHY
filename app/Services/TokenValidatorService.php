<?php

namespace App\Services;

use App\Contracts\TokenValidatorInterface;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Auth\AuthenticationException;

/**
 * TokenValidatorService - Responsible for token validation operations
 * Follows Single Responsibility Principle by handling only token validation logic
 */
class TokenValidatorService implements TokenValidatorInterface
{
    /**
     * Validate JWT token and return authenticated user
     *
     * @param string|null $token
     * @return User
     * @throws AuthenticationException
     */
    public function validateToken(?string $token = null): User
    {
        if (!$token) {
            throw new AuthenticationException('Token not provided');
        }

        try {
            // Set the token for JWTAuth
            JWTAuth::setToken($token);

            // Parse and validate the token
            $payload = JWTAuth::parseToken()->getPayload();

            // Get the authenticated user
            $user = JWTAuth::authenticate();

            if (!$user) {
                throw new AuthenticationException('User not found');
            }

            return $user;

        } catch (TokenExpiredException $e) {
            throw new AuthenticationException('Token has expired');
        } catch (TokenInvalidException $e) {
            throw new AuthenticationException('Token is invalid');
        } catch (JWTException $e) {
            throw new AuthenticationException('Token parsing failed');
        }
    }

    /**
     * Extract token from Authorization header
     *
     * @param string|null $authHeader
     * @return string|null
     */
    public function extractTokenFromHeader(?string $authHeader): ?string
    {
        if (!$authHeader) {
            return null;
        }

        // Check if header starts with Bearer
        if (!str_starts_with($authHeader, 'Bearer ')) {
            return null;
        }

        // Extract token after 'Bearer '
        return substr($authHeader, 7);
    }

    /**
     * Check if token is blacklisted
     *
     * @param string $token
     * @return bool
     */
    public function isTokenBlacklisted(string $token): bool
    {
        try {
            JWTAuth::setToken($token);
            return JWTAuth::checkOrFail();
        } catch (JWTException $e) {
            return true;
        }
    }

    /**
     * Refresh token if possible
     *
     * @param string $token
     * @return string
     * @throws AuthenticationException
     */
    public function refreshToken(string $token): string
    {
        try {
            JWTAuth::setToken($token);
            return JWTAuth::refresh();
        } catch (JWTException $e) {
            throw new AuthenticationException('Cannot refresh token');
        }
    }
}
