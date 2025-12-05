# User API Endpoints Test Documentation

## Base URL
- **API Base**: `/api/allizo/v1`
- **Authentication**: Requires `Authorization: Bearer {token}` header for all endpoints

---

## 1. GET /api/allizo/v1/users
**Description**: Retrieve all users with their locations and roles

### Request
```http
GET /api/allizo/v1/users
Authorization: Bearer {token}
```

### Expected Response (200)
```json
{
    "message": "Users retrieved successfully.",
    "status": 200,
    "data": [
        {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "gender": "male",
            "first_name": "John",
            "sure_name": "Doe",
            "work_position": "Developer",
            "location": {
                "id": 1,
                "address": "123 Main St",
                "city": "New York",
                "country": "USA",
                "postal_code": "10001",
                "country_code": "US"
            },
            "roles": [
                {
                    "id": 1,
                    "name": "user"
                }
            ]
        }
    ]
}
```

### Test Cases
- ✅ Returns 200 with array of users
- ✅ Each user includes location (whenLoaded)
- ✅ Each user includes roles (whenLoaded)
- ✅ Returns 401 if no token provided
- ✅ Returns empty array if no users exist

---

## 2. POST /api/allizo/v1/users
**Description**: Create a new user with basic information

### Request
```http
POST /api/allizo/v1/users
Authorization: Bearer {token}
Content-Type: application/json

{
    "name": "Jane Smith",
    "email": "jane@example.com",
    "password": "password123",
    "gender": "female",
    "first_name": "Jane",
    "sure_name": "Smith",
    "work_position": "Designer"
}
```

### Validation Rules
- `name`: required, string, max 20 characters
- `email`: required, email format, unique in users table
- `password`: required, string, min 6, max 16 characters
- `gender`: nullable, string
- `first_name`: nullable, string
- `sure_name`: nullable, string
- `work_position`: nullable, string

### Expected Response (201)
```json
{
    "message": "User registered successfully.",
    "status": 201,
    "data": {
        "id": 2,
        "name": "Jane Smith",
        "email": "jane@example.com",
        "gender": "female",
        "first_name": "Jane",
        "sure_name": "Smith",
        "work_position": "Designer",
        "roles": [
            {
                "id": 1,
                "name": "user"
            }
        ]
    }
}
```

### Test Cases
- ✅ Creates user with all fields
- ✅ Creates user with only required fields (name, email, password)
- ✅ Automatically assigns role_id = 1 (user role)
- ✅ Password is hashed before storage
- ✅ Returns 422 if validation fails
- ✅ Returns 422 if email already exists
- ✅ Returns 422 if name exceeds 20 characters
- ✅ Returns 422 if password less than 6 or more than 16 characters

---

## 3. GET /api/allizo/v1/users/{id}
**Description**: Retrieve a specific user by ID

### Request
```http
GET /api/allizo/v1/users/1
Authorization: Bearer {token}
```

### Expected Response (200)
```json
{
    "message": "User retrieved successfully.",
    "status": 200,
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "gender": "male",
        "first_name": "John",
        "sure_name": "Doe",
        "work_position": "Developer",
        "location": {
            "id": 1,
            "address": "123 Main St",
            "city": "New York",
            "country": "USA",
            "postal_code": "10001",
            "country_code": "US"
        },
        "roles": [
            {
                "id": 1,
                "name": "user"
            }
        ]
    }
}
```

### Test Cases
- ✅ Returns 200 with user data for valid ID
- ✅ Returns 404 if user not found
- ✅ Includes location relationship
- ✅ Includes roles relationship
- ✅ Returns 401 if no token provided

---

## 4. PUT /api/allizo/v1/users/{id}
**Description**: Update an existing user

### Request
```http
PUT /api/allizo/v1/users/1
Authorization: Bearer {token}
Content-Type: application/json

{
    "name": "John Updated",
    "email": "johnupdated@example.com",
    "gender": "male",
    "first_name": "John",
    "sure_name": "Updated",
    "work_position": "Senior Developer",
    "roles": [1, 2]
}
```

### Validation Rules
- `name`: sometimes, string, max 20 characters
- `email`: sometimes, email format, unique except current user
- `password`: sometimes, string, min 6, max 16 characters
- `gender`: sometimes, nullable, string
- `first_name`: sometimes, nullable, string
- `sure_name`: sometimes, nullable, string
- `work_position`: sometimes, nullable, string
- `roles`: sometimes, array
- `roles.*`: integer, must exist in roles table

### Expected Response (200)
```json
{
    "message": "User updated successfully.",
    "status": 200,
    "data": {
        "id": 1,
        "name": "John Updated",
        "email": "johnupdated@example.com",
        "gender": "male",
        "first_name": "John",
        "sure_name": "Updated",
        "work_position": "Senior Developer",
        "roles": [
            {
                "id": 1,
                "name": "user"
            },
            {
                "id": 2,
                "name": "admin"
            }
        ]
    }
}
```

### Test Cases
- ✅ Updates user with partial data (only provided fields)
- ✅ Updates user with all fields
- ✅ Updates password and hashes it
- ✅ Updates user roles via sync()
- ✅ Returns 404 if user not found
- ✅ Returns 422 if validation fails
- ✅ Returns 422 if email already exists for another user
- ✅ Returns 422 if roles contain non-existent role IDs
- ✅ Email uniqueness excludes current user's ID

---

## 5. DELETE /api/allizo/v1/users/{id}
**Description**: Delete a user

### Request
```http
DELETE /api/allizo/v1/users/1
Authorization: Bearer {token}
```

### Expected Response (200)
```json
{
    "message": "User deleted successfully.",
    "status": 200
}
```

### Test Cases
- ✅ Deletes user successfully
- ✅ Returns 404 if user not found
- ✅ Returns 401 if no token provided
- ⚠️ Consider: Should check if user can delete themselves?
- ⚠️ Consider: Should prevent deleting admin users?

---

## 6. POST /api/allizo/v1/users/full-info
**Description**: Create a user with complete information including roles and location

### Request
```http
POST /api/allizo/v1/users/full-info
Authorization: Bearer {token}
Content-Type: application/json

{
    "name": "Alice Johnson",
    "email": "alice@example.com",
    "password": "password123",
    "gender": "female",
    "first_name": "Alice",
    "sure_name": "Johnson",
    "work_position": "Manager",
    "roles": [1, 2],
    "location": [
        {
            "address": "456 Oak Ave",
            "city": "Los Angeles",
            "country": "USA",
            "postal_code": "90001",
            "country_code": "US"
        }
    ]
}
```

### Validation Rules
- `name`: required, string, max 20 characters
- `email`: required, email format, unique
- `password`: required, string, min 6, max 16 characters
- `gender`: required, nullable, string ⚠️ (contradictory validation)
- `first_name`: required, nullable, string ⚠️ (contradictory validation)
- `sure_name`: required, nullable, string ⚠️ (contradictory validation)
- `work_position`: required, nullable, string ⚠️ (contradictory validation)
- `roles`: required, array
- `roles.*`: integer, must exist in roles table
- `location`: required, array
- `location.*.address`: string
- `location.*.city`: string
- `location.*.country`: string
- `location.*.postal_code`: string
- `location.*.country_code`: string

### Expected Response (201)
```json
{
    "message": "User created successfully.",
    "status": 201,
    "data": {
        "id": 3,
        "name": "Alice Johnson",
        "email": "alice@example.com",
        "gender": "female",
        "first_name": "Alice",
        "sure_name": "Johnson",
        "work_position": "Manager",
        "roles": [
            {
                "id": 1,
                "name": "user"
            },
            {
                "id": 2,
                "name": "admin"
            }
        ],
        "location": [
            {
                "id": 2,
                "address": "456 Oak Ave",
                "city": "Los Angeles",
                "country": "USA",
                "postal_code": "90001",
                "country_code": "US"
            }
        ]
    }
}
```

### Test Cases
- ✅ Creates user with roles and location
- ✅ Syncs multiple roles
- ✅ Creates multiple locations if provided
- ✅ Returns 422 if validation fails
- ✅ Returns 422 if roles don't exist
- ⚠️ Validation issue: "required|nullable" is contradictory - should be just "nullable"

---

## Issues Found

### 🔴 Critical Issues
1. **CreateUsersFullinfo Validation Contradiction**
   - Fields have `required|nullable` which is contradictory
   - Should be either `required` OR `nullable`, not both
   - Affects: gender, first_name, sure_name, work_position

### 🟡 Recommendations
1. **Consider Access Control**
   - All User endpoints require authentication but no role check
   - Should `/users` endpoints be admin-only?
   - Consider adding `IsAdmin` middleware to User routes

2. **Soft Deletes**
   - Consider implementing soft deletes for users
   - Prevents accidental data loss
   - Allows user restoration

3. **Password Update Security**
   - Consider requiring current password when updating password
   - Add password confirmation field

4. **Self-Delete Prevention**
   - Prevent users from deleting their own account via update/delete
   - Or require additional confirmation

---

## Testing Commands (Using Laravel's HTTP client or Postman)

### Prerequisites
1. Start Laravel development server: `php artisan serve`
2. Get authentication token from `/api/auth/login`
3. Use token in Authorization header

### Manual Testing Steps
1. **Login to get token**
   ```bash
   POST http://localhost:8000/api/auth/login
   Body: {"email": "admin@example.com", "password": "password"}
   ```

2. **Test GET all users**
   ```bash
   GET http://localhost:8000/api/allizo/v1/users
   Headers: Authorization: Bearer {token}
   ```

3. **Test POST create user**
   ```bash
   POST http://localhost:8000/api/allizo/v1/users
   Headers: Authorization: Bearer {token}
   Body: {JSON from example above}
   ```

4. **Test GET single user**
   ```bash
   GET http://localhost:8000/api/allizo/v1/users/1
   Headers: Authorization: Bearer {token}
   ```

5. **Test PUT update user**
   ```bash
   PUT http://localhost:8000/api/allizo/v1/users/1
   Headers: Authorization: Bearer {token}
   Body: {JSON from example above}
   ```

6. **Test DELETE user**
   ```bash
   DELETE http://localhost:8000/api/allizo/v1/users/1
   Headers: Authorization: Bearer {token}
   ```

7. **Test POST full info**
   ```bash
   POST http://localhost:8000/api/allizo/v1/users/full-info
   Headers: Authorization: Bearer {token}
   Body: {JSON from example above}
   ```

---

## Summary

### Available Endpoints
- ✅ GET `/api/allizo/v1/users` - List all users
- ✅ POST `/api/allizo/v1/users` - Create basic user
- ✅ GET `/api/allizo/v1/users/{id}` - Get user by ID
- ✅ PUT `/api/allizo/v1/users/{id}` - Update user
- ✅ DELETE `/api/allizo/v1/users/{id}` - Delete user
- ✅ POST `/api/allizo/v1/users/full-info` - Create user with full info

### Required Fixes
1. Fix `CreateUsersFullinfo` validation - remove "required" from nullable fields
2. Consider adding admin middleware to user management endpoints
3. Consider implementing soft deletes for User model
