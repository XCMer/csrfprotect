# CSRF Protection

A simple class for CSRF protection in PHP. Uses PHP sessions for storage of tokens. The code is simple and fully commented.

## Usage

In the PHP file that renders the form, you could have a hidden input as follows:

    require 'CSRF_Protect.php';
    $csrf = new CSRF_Protect();
    $token = $csrf->getToken();
    ...
    
    echo '<input type="hidden" name="csrf" value=". $token ." />';
    
And in the PHP file that processes the data:

    $csrf = new CSRF_Protect();
    if (!$csrf->verifyToken($_POST['csrf']))
    {
        die("Something bad happened.");
    }
    
    // all good
    
    
## Further improvements

I'm planning on adding helper functions that'll automatically echo the form input field and verify the POST data. This will save you from manually creating the input field, remember its name, and manually pass in the $_POST data.