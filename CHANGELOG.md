Changelog
=========

All notable changes to `mjaschen/astrotools` will be documented in this file.
Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.
This project adheres to [Semantic Versioning](http://semver.org/).

## [1.0.0] - 2021-03-10

### Added

- support for PHP 8
- Github: test runner

### Removed

- support for PHP 7.0
- support for PHP 7.1
- support for PHP 7.2

### Changed

- Github: renamed main branch from `master` to `main`
- upgraded dev requirements (PHPUnit, Psalm, ...)
- `JulianDay`:
    - expects a `float` value as constructor argument, passing `DateTime` or `null` is not longer allowed 
    - the static factory method `JulianDay::fromDateTime()` can be used to get the `JulianDay` instance for a given `DateTime` object
    - `JulianDay::setDateTime()` was removed (use `JulianDay::fromDateTime()` as replacement)
    - `JulianDay::setValue()` was removed (use constructor as replacement)
- `Time` helper:
    - `Time::setHourAngle()` was removed (use `Time::fromHourAngle()` as replacement)

## [0.1.0] - 2016-12-06

### Added

* increased minimum required PHP version to 7.0
* added scalar type hints to all methods and updated tests

### Changed

* `Time::getSecond()` was splitted into two methods--one for getting the integer value (`Time::getSecond()`) and one for float values (`Time::getDecimalSeconds()`)

## [0.0.2] - 2016-02-08

### Fixed

* changed algorithm for Julian Day to calendar date conversion

## [0.0.1] - 2015-03-06

### Added

* add classes for Julian Day, Sidereal Time, and Date of Easter calculations
