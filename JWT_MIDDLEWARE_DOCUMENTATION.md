# JWT Authentication Middleware - SOLID Implementation

## Tổng quan
Middleware JWT Authentication được thiết kế theo nguyên tắc SOLID và Single Responsibility, đảm bảo tính bảo mật và khả năng mở rộng cao.

## Cấu trúc Components

### 1. TokenValidatorInterface (`app/Contracts/TokenValidatorInterface.php`)
- **Nguyên tắc**: Interface Segregation Principle & Dependency Inversion Principle
- **Chức năng**: Định nghĩa contract cho việc validate token
- **Methods**:
  - `validateToken()`: Validate JWT token và trả về user
  - `extractTokenFromHeader()`: Trích xuất token từ Authorization header
  - `isTokenBlacklisted()`: Kiểm tra token có bị blacklist không
  - `refreshToken()`: Refresh token nếu có thể

### 2. TokenValidatorService (`app/Services/TokenValidatorService.php`)
- **Nguyên tắc**: Single Responsibility Principle
- **Chức năng**: Xử lý logic validation token JWT
- **Features**:
  - Validate token và trả về authenticated user
  - Xử lý các exception JWT (expired, invalid, parsing failed)
  - Extract token từ Bearer header
  - Kiểm tra blacklist token
  - Refresh token functionality

### 3. JwtAuthMiddleware (`app/Http/Middleware/JwtAuthMiddleware.php`)
- **Nguyên tắc**: Single Responsibility Principle
- **Chức năng**: Xử lý HTTP authentication flow
- **Features**:
  - Dependency injection TokenValidatorInterface
  - Extract và validate token từ request
  - Set authenticated user vào request
  - Return consistent error responses
  - Exception handling

## Dependency Injection Setup

### AppServiceProvider (`app/Providers/AppServiceProvider.php`)
```php
$this->app->bind(
    \App\Contracts\TokenValidatorInterface::class,
    \App\Services\TokenValidatorService::class
);
```

### Middleware Registration (`bootstrap/app.php`)
```php
$middleware->alias([
    'jwt.auth' => \App\Http\Middleware\JwtAuthMiddleware::class,
]);
```

## Usage trong Routes

### Protected Routes
```php
Route::middleware('jwt.auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    // ... other protected routes
});
```

### Public Routes
```php
Route::post('/login', [AuthController::class, 'login']);
```

## SOLID Principles Implementation

### 1. Single Responsibility Principle (SRP)
- **TokenValidatorService**: Chỉ xử lý logic validate token
- **JwtAuthMiddleware**: Chỉ xử lý HTTP authentication flow
- Mỗi class có một lý do duy nhất để thay đổi

### 2. Open/Closed Principle (OCP)
- Có thể mở rộng functionality thông qua interface
- Không cần modify existing code để thêm features mới

### 3. Liskov Substitution Principle (LSP)
- TokenValidatorService có thể được thay thế bằng implementation khác
- Interface đảm bảo contract consistency

### 4. Interface Segregation Principle (ISP)
- TokenValidatorInterface chỉ chứa methods cần thiết
- Không force clients implement unnecessary methods

### 5. Dependency Inversion Principle (DIP)
- JwtAuthMiddleware depends on abstraction (interface), không phải concrete class
- High-level modules không depend vào low-level modules

## Security Features

### Token Validation
- Kiểm tra token format (Bearer scheme)
- Validate JWT signature và payload
- Kiểm tra token expiration
- Xử lý token blacklist

### Error Handling
- Consistent error responses
- Không expose sensitive information
- Proper HTTP status codes (401 Unauthorized)

### Exception Management
- TokenExpiredException
- TokenInvalidException
- JWTException
- AuthenticationException

## Testing

### Automated Tests
Có thể tạo unit tests cho từng component:
```php
// TokenValidatorServiceTest
// JwtAuthMiddlewareTest
```

### Manual Testing
Sử dụng file `test_middleware.md` để test các scenarios:
- Login successful
- Access protected route without token
- Access protected route with valid token
- Access protected route with invalid token
- Token expiration handling

## Performance Considerations

### Optimizations
- Token validation chỉ thực hiện một lần per request
- User object được cache trong request lifecycle
- Minimal database queries

### Scalability
- Stateless authentication (JWT)
- Horizontal scaling friendly
- Redis integration có thể thêm cho blacklist

## Maintenance & Extension

### Adding New Features
1. Extend interface nếu cần thêm methods
2. Implement trong service class
3. Update middleware nếu cần xử lý HTTP logic mới

### Configuration
- JWT settings trong `config/jwt.php`
- Middleware settings trong `bootstrap/app.php`
- Service bindings trong `AppServiceProvider`

## Best Practices Implemented

1. **Dependency Injection**: Sử dụng constructor injection
2. **Interface Programming**: Program to interfaces, not implementations
3. **Separation of Concerns**: Tách biệt HTTP logic và business logic
4. **Error Handling**: Comprehensive exception handling
5. **Documentation**: Detailed PHPDoc comments
6. **Type Hinting**: Strong typing throughout
7. **Immutability**: Readonly properties where appropriate
