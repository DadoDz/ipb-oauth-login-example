# IPB OAuth Login Example

A simple PHP example demonstrating how to authenticate users using OAuth 2.0 system and retrieve their profile information through the API.

## Requirements

* PHP 7.4 or newer

## Configuration

Edit the following values in both files:

```php
$client_id = "YOUR_CLIENT_ID";
$client_secret = "YOUR_CLIENT_SECRET";
$redirect_uri = "YOUR_REDIRECT_URI";
```

## OAuth Flow

1. User clicks "Login with Forum".
2. User is redirected to the forum authorization page.
3. User authorizes the application.
4. The forum redirects back with an authorization code.
5. The application exchanges the code for an access token.
6. User information is retrieved from the API.
