<?php

namespace AcmeSecureCode;

use Illuminate\Support\Facades\Config;
use AcmeSecureCode\Contracts\SecureCodeInterface;

class SecureCodeService implements SecureCodeInterface
{
    public function generateCode()
    {
        $maxRetries = Config::get('code-config.max_retries', 100);
        $codeLength = Config::get('code-config.code_length', 6);
        $characters = '0123456789';

        $attempts = 0;

        do {
            $code = '';

            for ($i = 0; $i < $codeLength; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }

            $attempts++;
        } while (
            $this->isPalindrome($code) ||
            $this->hasRepeatedCharacters($code) ||
            $this->hasSequentialCharacters($code) ||
            $this->hasInsufficientUniqueCharacters($code)
        );

        if ($attempts >= $maxRetries) {
            throw new \Exception("Failed to generate a secure code after {$maxRetries} attempts.");
        }

        return $code;
    }

    private function isPalindrome($code)
    {
        return $code === strrev($code);
    }

    private function hasRepeatedCharacters($code)
    {
        return preg_match('/(\d)\1{3,}/', $code);
    }

    private function hasSequentialCharacters($code)
    {
        return preg_match('/012|123|234|345|456|567|678|789|987|876|765|654|543|432|321|210/', $code);
    }

    private function hasInsufficientUniqueCharacters($code)
    {
        return count(array_unique(str_split($code))) < 3;
    }
}
