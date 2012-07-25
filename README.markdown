# CSRF Protection

A simple class for CSRF protection in PHP. Uses PHP sessions for storage of tokens. The code is simple and fully commented.

## Functions

These are the public functions available to you:

    1. __construct($namespace = '_csrf')
    The constructor takes an optional parameter that sets the "namespace." The namespace is used as the name for the session variables and form fild names.
    
    2. getToken()
    Returns the unique string token. Once generated for a user, it remains the same for that browser session.
    
    3. isTokenValid($userToken)
    You can use this function to test the token submitted by the user against the one that was generated. The function takes the user's version of the token as a parameter.
    
    4. echoInputField()
    This echoes the input form field with name same as the namespace, and value equal to the token. Saves you the common trouble.
    
    5. verifyRequest()
    This functions is to be used in conjunction with the 'echoInputField()' function. It automatically verifies the appropriate POST variable and dies if an invalid token is encountered.
    
## Usage (For normal forms)

In the PHP file that renders the form, you could have a hidden input as follows:

    require 'CSRF_Protect.php';
    $csrf = new CSRF_Protect();
    ...
    
    <form ...>
    ...
    
    
    $csrf->echoInputField();
    </form>
    
And in the PHP file that processes the data:

    $csrf = new CSRF_Protect();
    $csrf->verifyRequest();
    
    // all good
    
    
## Usage (Doing it manually)

You may have reasons to do the verification manually as shown:

    require 'CSRF_Protect.php';
    $csrf = new CSRF_Protect();
    ...
    
    <form ...>
    ...
    
    echo '<input type="hidden" name="csrf" value=". $csrf->getToken() ." />';
    
And in the file that processes the data:

    $csrf = new CSRF_Protect();
    if (!$csrf->isTokenValid($_POST['csrf']))
    {
        // do stuff when token not valid
    }
    else
    {
        // all good
    }