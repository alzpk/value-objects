# Value Objects

A set of value objects.

## Requirements

```json
{
  "php": "^7.4"
}
```

## Installation

```bash
composer require alzpk/value-objects
```

## Usage example


```php
$name = new Alzpk\ValueObjets\Name('John', 'Doe');

$name->getFirstname(); // Returns "John"
$name->getLastname(); // Returns "Doe"
$name->getFullName(); // Return "John Doe"
```

## Testing
The package comes with individual tests for each value object.