# OXID Academy: Training extensions

This package contains an example extension for training purposes at OXID Academy. 

## Installation instructions

### Require the package

In the local development environment, cd into the root directory of your compilation
and run Composer as follows:
 
```
composer config repositories.oxid-academy/feefreepayments vcs https://github.com/oxid-academy/feefreepayments.git
```

This should result in the following change to `composer.json`:
```
...
  "repositories": {
    ...,
    "oxid-academy/feefreepayments": {
      "type": "vcs",
      "url": "https://github.com/oxid-academy/feefreepayments.git"
    }
  },
  ...
```

And then, ...
```
composer require oxid-academy/feefreepayments
```

... which makes it:
```
  "require": {
    ...,
    "oxid-academy/feefreepayments": "^1.0"
  },
```

Now, 

## Running tests
`./vendor/bin/runtests /var/www/html/source/modules/oxac/oxac_feefreepayments/Tests/`
