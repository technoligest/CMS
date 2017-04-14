<?php
    echo password_verify("tech","$2y$10$4WqVmzTKQ44QXFFgYNsvsuzO4esDi8OVG5cTym9dboT/QaYfVOZZq");
echo password_hash(test_form_input($_POST['user_password']),PASSWORD_BCRYPT);
?>