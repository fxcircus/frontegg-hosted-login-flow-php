# Frontegg Hosted Login Flow

This project demonstrates how to implement Frontegg's Hosted Login Flow using PHP. It provides a simple example of how to integrate Frontegg's authentication system into your PHP application.

## Prerequisites

- PHP 7.4 or higher
- PHP cURL extension enabled
- A Frontegg account and application

## Configuration

1. Clone this repository
2. Update the `config.php` file with your Frontegg credentials:
   ```php
   define('CLIENT_ID', 'YOUR_CLIENT_ID');
   define('API_KEY', 'YOUR_API_KEY');
   define('GATEWAY', 'YOUR_GATEWAY');
   ```

3. **Important**: In your Frontegg dashboard, add the following redirect URI:
   ```
   http://localhost:3000/callback.php
   ```

## Running the Application

1. Start the PHP development server:
   ```bash
   php -S localhost:3000
   ```

2. Open your web browser and navigate to:
   ```
   http://localhost:3000
   ```

3. Click the "Login with Frontegg" button to start the authentication flow

## How It Works

1. When a user clicks the login button, they are redirected to Frontegg's hosted login page
2. After successful authentication, Frontegg redirects back to your application with an authorization code
3. The application exchanges this code for access and ID tokens
4. The tokens are displayed on the success page

## Security Features

- Implements PKCE (Proof Key for Code Exchange) flow
- Uses secure session handling
- Implements proper error handling
- Includes XSS protection through output escaping

## Files

- `index.php` - Entry point with login button
- `login.php` - Handles the initial login redirect
- `callback.php` - Processes the OAuth callback and token exchange
- `config.php` - Configuration settings
- `utils.php` - Helper functions for code verifier and challenge generation

## Notes

- This is a basic implementation for demonstration purposes
- In a production environment, you should:
  - Use HTTPS
  - Implement proper token storage
  - Add additional security headers
  - Handle token refresh
  - Implement proper error pages
  - Use environment variables for sensitive data
