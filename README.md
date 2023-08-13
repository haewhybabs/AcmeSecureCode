# AcmeSecureCode

## Installation

To include this library in your Laravel project, follow these steps:

1. Add the following to your `composer.json` to install the code-generating library implementation:

    ```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/haewhybabs/acmesecurecode"
        }
    ],
    ```

2. Run the following command to install the package:

    ```sh
    composer require intellicore/acme-secure-code:1.0.2
    ```

## Usage

1. Import the necessary class in your code:

    ```php
    use AcmeSecureCode\Contracts\SecureCodeInterface;
    ```

2. You can inject the `SecureCodeInterface` into your controller or any other part of your code where you need to call the `generateCode()` method.

    For example:

    ```php
    use AcmeSecureCode\Contracts\SecureCodeInterface;

    class CodeRepository implements CodeRepositoryInterface
    {
        protected $secureCodeGenerator;

        public function __construct(SecureCodeInterface $secureCodeGenerator)
        {
            $this->secureCodeGenerator = $secureCodeGenerator;
        }

        public function generateCode()
        {
            return $this->secureCodeGenerator->generateCode();
        }
    }
    ```

**Author: Ayobami Babalola**
