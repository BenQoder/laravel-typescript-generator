# Convert Laravel JSON Renponses to Typescript interfaces usin GPT-3.5

[![Latest Version on Packagist](https://img.shields.io/packagist/v/BenQoder/laravel-typescript-gen.svg?style=flat-square)](https://packagist.org/packages/BenQoder/laravel-typescript-gen)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/BenQoder/laravel-typescript-gen/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/BenQoder/laravel-typescript-gen/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/BenQoder/laravel-typescript-gen/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/BenQoder/laravel-typescript-gen/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/BenQoder/laravel-typescript-gen.svg?style=flat-square)](https://packagist.org/packages/BenQoder/laravel-typescript-gen)

This package for laravel converts your json responses to typescript types and interfaces using GPT-3.5 then stores them in the specified directory.

## Installation

You can install the package via composer:

```bash
composer require BenQoder/laravel-typescript-gen
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-typescript-gen-config"
```

This is the contents of the published config file:

```php
return [
    'enabled' => env('TYPESCRIPT_GENERATOR_ENABLED', false),
    'openai_api_key' => env('OPENAI_API_KEY', ''),
    'output_path' => env('TYPESCRIPT_GENERATOR_OUTPUT_PATH', '.typescript-generator'),
];
```
## Usage

Register Typescript generator middleware as the last middleware in app/Http/Kernel.php

```php
    protected $middleware = [
        ...
        \BenQoder\TypescriptGenerator\Middleware\TypescriptGenerator::class,
    ];
```

When you send request and the response header specifies content-type as "application/json" the Typesceipt interfaces will be generated and placed in "/.typescript-generator" directory or the custom direcory you specify in the config file.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Adinnu Benedict](https://github.com/BenQoder)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
