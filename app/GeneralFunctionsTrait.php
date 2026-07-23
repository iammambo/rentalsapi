<?php

namespace App;

trait GeneralFunctionsTrait
{
    /**
     * Characters used to build a short slug.
     */
    public function generateCode(int $length = 6): string
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $code;
    }
}
