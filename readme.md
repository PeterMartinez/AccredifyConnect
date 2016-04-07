# Accredify Connect PHP Library

## Dependencies
- PHP 5.2+
- Composer [Getting Started](https://getcomposer.org/)
- Guzzle HTTP Client (Installed via Composer)
- adoy/PHP-OAuth2 (Installed via Composer)

## Getting Started

**Step 1, Install Accredify Connect Library**
``` composer require petermartinez/accredify-connect-php```

**Step 2, Set Environment Variables**  Add the following environment variables to your .env file. 
```
ACCREDIFY_APP_ENV=sandbox
ACCREDIFY_APP_ID=
ACCREDIFY_APP_SECRET=
ACCREDIFY_REDIRECT_URI=
```

- Get Keys/Register App
    - [Sandbox Developer Portal](https://developer.sandbox.accredify.com)
    - [Production Developer Portal](https://developer.accredify.com)

- Configure **.env** 
    - Enviroment
        - Testing Sandbox: ```ACCREDIFY_APP_ENV=sandbox```
        - Testing Production ```ACCREDIFY_APP_ENV=production```
    - Public Key ```ACCREDIFY_APP_ID=<YOUR_PUBLIC_KEY>```
    - Private Key ```ACCREDIFY_APP_SECRET=<YOUR_PUBLIC_KEY>```
    - Redirect URI ```ACCREDIFY_REDIRECT_URI=<YOUR_REDIRECT_URI>```

**Example Usage**
```
use Accredify\Connect as AccredifyConnect;
  $AccredifyConnect = new AccredifyConnect;

  //Generate Connect URL /w State, leave empty for no state param
  $connectURL = $AccredifyConnect->getConnectLink('StateVarGoesHereOptional');
  
  //If return code (bounce back)
  if($_GET['code']){
    $Tokens = $AccredifyConnect->getAccessToken($_GET['code']);//Option 1
    $Tokens = $AccredifyConnect->getAccessToken();//Option 2, if no param is sent it will look for $_GET['code']
    /* 
        $Tokens::
        Array ( 
            [access_token] => uVZpA3aSDzxuMFqbYJgjoB9cRKs6xwbfzBxcMt6k 
            [token_type] => Bearer 
            [expires_in] => 7776000 
            [refresh_token] => vZpboiXBXexmWC0jNJ2FGaBWd1bxYvw5PTzZm9LJ
            )
    */
    //Get User
    $AccredifyUser = $AccredifyConnect->getUser($Tokens['access_token]);
    /*
    Array
    (
    [result] => Array
        (
            [data] => Array
                (
                    [person] => Array
                        (
                            [name] => Peter Martinez
                            [email] => Peter@Accredify.com
                            [hash] => ekFIa0NTWU1lRzFIOEMzZmpR
                            [address] => Array
                                (
                                    [city] => Miami
                                    [state] => FL
                                    [zip] => 33133
                                )

                        )

                    [certificates] => Array
                        (
                            [0] => Array
                                (
                                    [status] => Array
                                        (
                                            [code] => 2
                                            [message] => Approved
                                        )

                                    [type] => 3rd party
                                    [certificate] => https://www.sandbox.accredify.com/certificate/6A8pw8qu4iJHShZcGfsLwqb6qHTDl2VrC4Q9chDgzmXsEXFkc75JyhQZZJCk
                                    [reason] => Array
                                        (
                                            [type] => Attorney
                                            [name] => Adrian Alverez
                                            [license] => 123
                                            [address] => Address
                                            [doc] => https://s3.amazonaws.com/accredify-sandbox-secure/1_qA0wMcD9i.png?X-Amz-Content-Sha256=e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJOZ6LDMBE2M377KQ%2F20160305%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20160305T164512Z&X-Amz-SignedHeaders=Host&X-Amz-Expires=5400&X-Amz-Signature=37c480887fd52fa901850a2e1e1b60b24a326fbac3241ae1a1ea7ffa22b4ecf3
                                            [doc_date] => 09 / 23 / 2015
                                        )

                                    [created_on] => 2015-09-24 20:45:51
                                    [expires_on] => 2016-05-07 18:24:16
                                )
                        )

                )

        )

    [code] => 200
    [content_type] => application/json
)
    */
  }
 
```

