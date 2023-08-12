<?php

namespace Tests\Feature;

use AcmeSecureCode\Contracts\SecureCodeInterface;
use Tests\TestCase;

class SecureCodeTest extends TestCase
{
    public function testCodeGeneration()
    {
        $secureCodeGenerator = app(SecureCodeInterface::class);
        $code = $secureCodeGenerator->generateCode();

        $this->assertMatchesRegularExpression('/^\d{6}$/', $code);
    }
}
