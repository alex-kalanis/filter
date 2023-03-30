Filter Interfaces
================

[![Build Status](https://app.travis-ci.com/alex-kalanis/filter.svg?branch=master)](https://app.travis-ci.com/github/alex-kalanis/filter)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alex-kalanis/filter/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alex-kalanis/filter/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/alex-kalanis/filter/v/stable.svg?v=1)](https://packagist.org/packages/alex-kalanis/filter)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.3-8892BF.svg)](https://php.net/)
[![Downloads](https://img.shields.io/packagist/dt/alex-kalanis/filter.svg?v1)](https://packagist.org/packages/alex-kalanis/filter)
[![License](https://poser.pugx.org/alex-kalanis/filter/license.svg?v=1)](https://packagist.org/packages/alex-kalanis/filter)
[![Code Coverage](https://scrutinizer-ci.com/g/alex-kalanis/filter/badges/coverage.png?b=master&v=1)](https://scrutinizer-ci.com/g/alex-kalanis/filter/?branch=master)

Contains simple interfaces for creating filtering compatible across the libraries.
It has been cut from running project and simplified for usage available for another
libraries.

This is the mixed package - contains sever-side implementation in Python and PHP.

# PHP Installation

```
{
    "require": {
        "alex-kalanis/filter": "1.1"
    }
}
```

(Refer to [Composer Documentation](https://github.com/composer/composer/blob/master/doc/00-intro.md#introduction) if you are not
familiar with composer)


# PHP Usage

1.) Use your autoloader (if not already done via Composer autoloader)

2.) Connect the "kalanis\kw_filter" into your app. When it came necessary
you can extends every library to comply your use-case; mainly your storage and
processing.

# Python Installation

into your "setup.py":

```
    install_requires=[
        'kw_filter',
    ]
```

# Python Usage

1.) Connect the "kw_filter\filter" into your app. When it came necessary
you can extends every library to comply your use-case; mainly your storage and
processing.
