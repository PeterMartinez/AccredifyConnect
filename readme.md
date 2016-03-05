# Accredify Connect PHP Library

## Dependencies
- PHP 5.2+
- Composer [Getting Started](https://getcomposer.org/)
- Guzzle HTTP Client (Installed via Composer)
- adoy/PHP-OAuth2 (Installed via Composer)

## Getting Started

**Step 1, Install Accredify Connect Library**
``` composer require petermartinez/accredify-php```

**Step 2, Set Environment Variables**  Add the following environment variables to your .env file. 
```ACCREDIFY_APP_ENV=sandbox
ACCREDIFY_APP_ID=
ACCREDIFY_APP_SECRET=
ACCREDIFY_REDIRECT_URI=```. 

- Get Keys/Register App
    - [Sandbox Developer Portal](https://developer.sandbox.accredify.com)
    - [Production Developer Portal](https://developer.accredify.com)

- Configure **.env** 
    - Enviroment
        - Testing Sandbox: ```APP_ENV=sandbox```
        - Testing Production ```APP_ENV=production```
    - Public Key ```ACCREDIFY_APP_ID=<YOUR_PUBLIC_KEY>```
    - Private Key ```ACCREDIFY_APP_SECRET=<YOUR_PUBLIC_KEY>```
    - Redirect URI ```ACCREDIFY_REDIRECT_URI=<YOUR_REDIRECT_URI>```
