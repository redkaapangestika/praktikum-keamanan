# Google OAuth Project

This project implements Google OAuth 2.0 authentication for a web application. It allows users to log in using their Google accounts, handle the authentication callback, and log out.

## Files Overview

- **login.php**: Initiates the OAuth flow and redirects users to the Google authentication page.
- **callback.php**: Processes the callback from Google after user authentication and exchanges the authorization code for an access token.
- **logout.php**: Clears the session and redirects users to the login page or a confirmation page.
- **config.php**: Contains configuration settings such as Google OAuth client ID, client secret, and redirect URI.

## Setup Instructions

1. Clone the repository to your local machine.
2. Install the required dependencies (if any).
3. Update the `config.php` file with your Google OAuth credentials:
   - Client ID
   - Client Secret
   - Redirect URI
4. Ensure your web server is configured to serve the project files.
5. Access `login.php` to start the authentication process.

## Usage

- Navigate to `login.php` to log in with your Google account.
- After authentication, you will be redirected back to the application via `callback.php`.
- Use `logout.php` to log out of the application.

## Additional Information

For more details on Google OAuth 2.0, refer to the [Google Identity documentation](https://developers.google.com/identity/protocols/oauth2).