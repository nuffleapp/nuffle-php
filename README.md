[![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE) [![Build Status](https://travis-ci.org/nuffleapp/nuffle-php.svg?branch=master)](https://travis-ci.org/nuffleapp/nuffle-php) [![codecov](https://codecov.io/gh/nuffleapp/nuffle-php/branch/master/graph/badge.svg)](https://codecov.io/gh/nuffleapp/nuffle-php) [![Gitter](https://badges.gitter.im/nuffleapp/nuffle-php.svg)](https://gitter.im/nuffleapp/nuffle-php?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=body_badge) [![Packagist](https://img.shields.io/packagist/v/nuffleapp/nuffle.svg?maxAge=2592000)](https://packagist.org/packages/nuffleapp/nuffle)


# Nuffle, The PHP Library

Nuffle, The PHP Library, is a simple library that provides the functionality to roll one die with any number of sides.


## Installation

### Via Composer

Require the library and update via [Composer](https://getcomposer.org/):

```
composer require nuffleapp/nuffle
composer update
```

### Manually

Download the [latest release](https://github.com/nuffleapp/nuffle-php/archive/master.zip), extract into a directory called `nuffle`, and include the library at the beginning of your script:

```
include_once('./nuffle/src/Nuffle.php');
use \Nuffle\Nuffle;
```

## Usage

Nuffle is a simple dice roller, allowing you to roll a die of any number of sides. To do so, simply call the `roll()` method with the number sided die you want to roll:

```
Nuffle::roll(20)
```

That method will return a number between 1 and 20 (inclusive).


## Contributing

Please read through our [contributing guidelines](CONTRIBUTING.md). Included are directions for opening issues, coding standards, and notes on development.


## Versioning

For transparency into our release cycle and in striving to maintain backward compatibility, Nuffle is maintained under [the Semantic Versioning guidelines](http://semver.org/). Sometimes we screw up, but we'll adhere to those rules whenever possible.

See [the Releases section of our GitHub project](https://github.com/nuffleapp/nuffle-php/releases) for changelogs for each release version of Nuffle.


## Support

The [issue tracker](https://github.com/nuffleapp/nuffle-php/issues) is
the preferred channel for [bug reports](#bug-reports), [features requests](#feature-requests)
and [submitting pull requests](#pull-requests).

For personal support requests, please use [Gitter](https://gitter.im/nuffleapp/nuffle-php) to get help.


## Copyright and License

Code and documentation copyright 2016 nuffleapp. Code released under [the MIT license](LICENSE).
