<?php

namespace App\Utility;

class PasswordEncoder
{
    /**
     * Encode password
     *
     * @param $plainPassword
     * @return bool|string
     */
    public static function encodePassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_BCRYPT);
    }

    /**
     * Verify password
     *
     * @param $plainPassword
     * @param $hash
     * @return bool
     */
    public static function verifyPassword($plainPassword, $hash): bool
    {
        return password_verify($plainPassword, $hash);
    }
}
