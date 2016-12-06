Changelog
=========

All notable changes to `mjaschen/astrotools` will be documented in this file.
Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.
This project adheres to [Semantic Versioning](http://semver.org/).

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
