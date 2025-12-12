# rector-bc-library

Reusable Rector rule set package.

Installation
------------

Install as a development dependency in your project:

```bash
composer require --dev art4/rector-bc-library
```

Usage
-----

In your project's `rector.php` configuration file import the set via the provided constant:

```php
<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    // Import this package's set
    $rectorConfig->import(\Art4\RectorBcLibrary\Set::SET);
};
```

Alternative import by path (less future-proof):

```php
$rectorConfig->import(__DIR__ . '/vendor/art4/rector-bc-library/rector.php');
```

Notes
-----

- This package does not require `rector/rector` itself. Install Rector in the projects that consume this package.
- Add your specific Rector rules and sets inside `rector.php` in this package and publish via Composer.

License
-------

This project is licensed under the GNU General Public License v3 or later (`GPL-3.0-or-later`). See the `LICENSE` file for the full text.

When using this package, make sure that your project's licensing is compatible with the GNU GPL v3 or later.
