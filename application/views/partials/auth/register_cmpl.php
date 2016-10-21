<?php
    if('success' === $state)
    {
?>
        You have successfully registered. 
        To activate your account, 
        please click on the link sent to 
        your email.
<?php
    }
    else if('failed' === $state)
    {
?>
        Registration has failed. Please try again.
<?php
    }