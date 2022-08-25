<?php

class Permission
{
    public function role()
    {
        if (isset($_SESSION['i']) == false) {
            header('location: index.php?controller=login');
        } else {
            return $_SESSION['i'];
        }
    }
}
