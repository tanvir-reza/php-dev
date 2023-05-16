<?php

require_once('./validation/fuctions.php');

$userPass = sanitizeInput('d rrthr rr rtg r rtrtg');
echo $userPass;
if(isStrongPassword($userPass) == true){
                echo " ok You are good to go";
             }
                else{
                    echo "Password is not strong enough";
                }

?>