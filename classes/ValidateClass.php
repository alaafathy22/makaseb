<?php

class ValidateClass
{
    function validateInputs($email, $password)
    {
        if ($email == 'Alaa@yahoo.com') {
            return [
                'state' => 'true',
                'email' => $email,
            ];
        }else{
            return [
                'state' => 'false',
                'email' => $email,
            ];
        }
    }
}

?>
