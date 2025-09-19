<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;

/**
 * TokenValidatorInterface - Contract for token validation
 * Follows Interface Segregation Principle and Dependency Inversion Principle
 */
interface TokenValidatorInterface
{
    /**
     * Validate JWT token and return authenticated user
     *
     * @param string|null $token
     * @return User
     * @throws AuthenticationException
     */
    public function validateToken(?string $token = null): User;

    /**
     * Extract token from Authorization header
     *
     * @param string|null $authHeader
     * @return string|null
     */
    public function extractTokenFromHeader(?string $authHeader): ?string;

    /**
     * Check if token is blacklisted
     *
     * @param string $token
     * @return bool
     */
    public function isTokenBlacklisted(string $token): bool;

    /**
     * Refresh token if possible
     *
     * @param string $token
     * @return string
     * @throws AuthenticationException
     */
    public function refreshToken(string $token): string;
}
