<?php
require_once('request/RuleProfile.php');

class ValidationProfile extends RuleProfile
{
    public $msg;

    public function __construct()
    {
        $this->msg = $this->message();
    }
}
