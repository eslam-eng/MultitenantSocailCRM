<?php

namespace App\Exceptions\VerificationCode;

class CodeExpiredException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Verification code has expired. Please request a new one.');
    }
}
