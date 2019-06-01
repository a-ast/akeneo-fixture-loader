# Akeneo Fixture Loader

[![Build Status](https://travis-ci.org/a-ast/akeneo-fixture-loader.svg?branch=master)](https://travis-ci.org/a-ast/akeneo-fixture-loader)

Akeneo Fixture Loader allows you to create fixtures data 
for use while developing or testing your Akeneo project.

* Loads fixture data using Akeneo REST API.
* Uses Alice-like syntax and [Faker](https://github.com/fzaninotto/Faker) for data generation.
* Uses [Akeneo Data Loader](https://github.com/a-ast/akeneo-data-loader)

## Example

Load 10 products with fake skus:

```php

use Aa\AkeneoDataLoader\Api;
use Aa\AkeneoFixtureLoader\FixtureLoaderFactory;

$apiCredentials = Api\Credentials::create('https://your.akeneo.host/', 'clientId', 'secret', 'username', 'password');

$loaderFactory = new FixtureLoaderFactory();
$loader = $factory->createByCredentials($apiCredentials);

$loader->loadData([
                             
    'product_{1..10}' => [
        'identifier' => 'test-<ean8()>',
    ]
    
]);
```
