# OXID Academy: Exercise extensions

This package contains an example module intended for training purposes at OXID Academy.

# Installation instructions

## Register and require the package

In the local development environment, cd into the root directory of your compilation (where composer.json and composer.lock
are located) and run Composer as shown below:

```
composer config repositories.oxid-academy/feefreepayments vcs https://github.com/oxid-academy/feefreepayments.git
```

This should result in the following change to `composer.json`:
```
   ...
  "repositories": {
    "oxid-academy/feefreepayments": {
      "type": "vcs",
      "url": "https://github.com/oxid-academy/feefreepayments.git"
    },
    ...
  },
  ...
```

And then, ...
```
composer require oxid-academy/feefreepayments:dev-b-7.0.x_resolved
```

... which results in something like:
```
  "require": {
    ...,
    "oxid-academy/feefreepayments": "dev-b-7.0.x_resolved"
  },
```

# Enabling the module

* When Composer is done processing your new request, you may enable the module:
```
vendor/bin/oe-console o:m:activate oxacfeefreepayments
```

# Running tests
 cd into the root dir of your compilation and run the following command whereupon `/var/www` represents the absolute
path to your compilation

Run unit tests
```
cd /var/www/
./vendor/bin/phpunit  -c /var/www/vendor/oxid-academy/feefreepayments/tests/phpunit.xml --testsuite=Unit 
```

Run integraton tests
```
cd /var/www/
./vendor/bin/phpunit --bootstrap=/var/www/source/bootstrap.php -c /var/www/vendor/oxid-academy/feefreepayments/tests/phpunit.xml --testsuite=Integration 
```

Run Codeception tests
```
cd /var/www/
export THEME_ID=flow && export MODULE_IDS=oxacfeefreepayments && vendor/bin/codecept run acceptance --bootstrap=/var/www/source/bootstrap.php -c /var/www/vendor/oxid-academy/feefreepayments/tests/codeception.yml -g example -vvv
```