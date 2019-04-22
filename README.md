# Composer Yaml

[![Packagist](https://img.shields.io/packagist/v/sandfoxme/composer-yaml.svg?maxAge=2592000)](https://packagist.org/packages/sandfoxme/composer-yaml)
[![Packagist](https://img.shields.io/github/license/sandfoxme/composer-yaml.svg?maxAge=2592000)](https://opensource.org/licenses/MIT)
[![Code Climate](https://img.shields.io/codeclimate/maintainability/sandfoxme/composer-yaml.svg?maxAge=2592000)](https://codeclimate.com/github/sandfoxme/composer-yaml)

(Almost) real support for yaml in Composer for your local project!
As easy as ``composer yaml update``!

## Installation

Global installation is required

    composer global require sandfoxme/composer-yaml

## Usage

The plugin adds a proxy command ``yaml`` that allows Composer to read config from ``composer.yml`` file

### What works

* ``composer yaml install``
* ``composer yaml update``

### What doesn't work

* ``composer yaml require``: add your dependencies manually
* Reading ``composer.y[a]ml`` from other repositories: it's only for your local project

### What might be broken

* Other plugins (probably. composer-viz was tested successfully however)
* Other proxy commands (do not combine it with ``global``, obviously)

### Documentation

Read full documentation here: <https://sandfox.dev/composer-yaml.html>

## License

The library is available as open source under the terms of the [MIT License].
See LICENSE.md

[MIT License]:  https://opensource.org/licenses/MIT
