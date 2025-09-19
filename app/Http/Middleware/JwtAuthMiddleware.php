<?php

namespace App\Http\Middleware;

use App\Contracts\TokenValidatorInterface;
use App\Helpers\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;

/**
 * JwtAuthMiddleware - Responsible for JWT authentication middleware logic
 * Follows Single Responsibility Principle by handling only HTTP authentication flow
 */
class JwtAuthMiddleware
{
    public function __construct(
        private readonly TokenValidatorInterface $tokenValidator
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Extract token from Authorization header
            $authHeader = $request->header('Authorization');
            $token      = $this->tokenValidator->extractTokenFromHeader($authHeader);

            if (!$token) {
                return $this->unauthorizedResponse('Authorization token not provided');
            }

            // Validate token and get user
            $user = $this->tokenValidator->validateToken($token);

            // Set authenticated user in request
            $request->setUserResolver(function () use ($user) {
                return $user;
            });

            // Add user to request attributes for easy access
            $request->merge(['authenticated_user' => $user]);

            return $next($request);

        } catch (AuthenticationException $e) {
            return $this->unauthorizedResponse($e->getMessage());
        } catch (\Exception $e) {
            return $this->unauthorizedResponse('Authentication failed');
        }
    }

    /**
     * Return unauthorized response
     *
     * @param string $message
     * @return Response
     */
    private function unauthorizedResponse(string $message): Response
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => []
        ], 401);
    }
}
