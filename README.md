# Search for NPM packages using npmsearch.com API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kapersoft/npmsearch-api.svg?style=flat-square)](https://packagist.org/packages/kapersoft/npmsearch-api)
[![Build Status](https://img.shields.io/travis/kapersoft/npmsearch-api/master.svg?style=flat-square)](https://travis-ci.org/kapersoft/npmsearch-api)
[![StyleCI](https://styleci.io/repos/125428771/shield?branch=master)](https://styleci.io/repos/125428771)
[![Quality Score](https://img.shields.io/scrutinizer/g/kapersoft/npmsearch-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/kapersoft/npmsearch-api)
[![Total Downloads](https://img.shields.io/packagist/dt/kapersoft/npmsearch-api.svg?style=flat-square)](https://packagist.org/packages/kapersoft/npmsearch-api)

This is an implementation of the [npmsearch.com](https://npmsearch.com) API for the PHP programming environment. More information about [npmsearch.com](https://npmsearch.com) and the API can be found at their [GitHub repository](https://github.com/nodesource/npmsearch).
## Installation

You can install the package via composer:

```bash
composer require kapersoft/npmsearch-api
```

## Usage

First you initiate the NpmSearch object.

``` php
$npmSearch = new kapersoft\NpmSearch\NpmSearch();
```

If you like can override the URL of the the [npmsearch.com](https://npmsearch.com) API. You can also pass your your own Guzzle client to the constructor of `kapersoft\NpmSearch\NpmSearch`.

``` php
$guzzleClient = new \GuzzleHttp\Client();
$npmSearch = new kapersoft\NpmSearch\NpmSearch('https://npmsearch.com/query', $guzzleClient);
```

You can search packages using the `search`-method:

``` php
// Search for jquery
$npmSearch->search('jquery');
```

The result will be array that looks like this:

``` php
array:4 [
  "results" => array:1 [
    0 => array:3 [
      "name" => array:1 [
        0 => "npo"
      ]
      "version" => array:1 [
        0 => "1.2.0"
      ]
      "description" => array:1 [
        0 => "CLI utility to watch NPO streams in QuickTime Player"
      ]
    ]
  ]
  "total" => 1
  "size" => 10
  "from" => "0"
]
```

By default the first 10 results will be returned. If you want to query more packages, you have to specify the `$start` and `$rows` parameters:

``` php
// Search for jquery packages 100 to 105
$npmSearch->search('jquery', 100, 5);
```

There are also extended search methods next the default `search`-method mentioned above. You can search for example for packages by author:

``` php
// Search for packages by author 'npm'
$npmSearch->searchByAuthor('npm');
```

Of course the `$start` and `$rows` parameters are also available for these methods:

``` php
// Search for packages by author 'npm' from 15 to 25
$npmSearch->searchByAuthor('npm', 15, 10);
```

Below the complete list of all search methods:

- `search($q, $start = 0, $rows = 10)`
- `searchByAuthor($author, $start = 0, $rows = 10)`
- `searchByCreated($created, $start = 0, $rows = 10)`
- `searchByDependencies($dependencies, $start = 0, $rows = 10)`
- `searchByDescription($Description, $start = 0, $rows = 10)`
- `searchByDevDependencies($devDependencies, $start = 0, $rows = 10)`
- `searchByHomepage($homepage, $start = 0, $rows = 10)`
- `searchByKeywords($keywords, $start = 0, $rows = 10)`
- `searchByMaintainers($maintainers, $start = 0, $rows = 10)`
- `searchByModified($modified, $start = 0, $rows = 10)`
- `searchByName($name, $start = 0, $rows = 10)`
- `searchByReadme($readme, $start = 0, $rows = 10)`
- `searchByRepository($repository, $start = 0, $rows = 10)`
- `searchByScripts($scripts, $start = 0, $rows = 10)`
- `searchByTimes($times, $start = 0, $rows = 10)`
- `searchByVersion($version, $start = 0, $rows = 10)`
- `searchByRating($rating, $start = 0, $rows = 10)` - computed rating as per [bin/ratings.js](https://github.com/nodesource/npmsearch/blob/master/bin/rating.js)

### Testing
In the `/tests`-folder is one test defined:

- `TestClient.php` tests the Kapersoft\NpmSearch\NpmSearch-class using mock Guzzle objects;

You can run the tests in your terminal:

``` bash
composer test
```

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security
If you discover any security related issues, please email kapersoft@gmail.com instead of using the issue tracker.

## Credits
- [Jan Willem Kaper](https://github.com/kapersoft)

## License
The MIT License (MIT). Please see [License File](LICENSE.txt) for more information.
