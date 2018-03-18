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
// Initiate NpmSearch
$npmSearch = new Kapersoft\NpmSearch\NpmSearch();
```

If you like to use your own [NpmSearch imeplementation](https://github.com/nodesource/npmsearch). You can override the URL of the API in the constructor of `Kapersoft\NpmSearch\NpmSearch`. You can also pass your your own [Guzzle HTTP client](https://github.com/guzzle/guzzle) to the constructor.

``` php
// Create Guzzle HTTP Client
$guzzleClient = new \GuzzleHttp\Client();

// Initiate NpmSearch with custom URL and Guzzle HTTP Client
$npmSearch = new Kapersoft\NpmSearch\NpmSearch('https://my-own-npmsearch-api/query', $guzzleClient);
```

### Search packages

You can search packages using the `search`-method:

``` php
// Search for kapersoft
$npmSearch->search('kapersoft');
```

The result is converted to an array that looks like this:

``` php
array:4 [
  "results" => array:1 [
    0 => array:8 [
      "maintainers" => array:1 [
        0 => "kapersoft"
      ]
      "score" => array:1 [
        0 => 0
      ]
      "author" => array:1 [
        0 => "kapersoft"
      ]
      "name" => array:1 [
        0 => "npo"
      ]
      "description" => array:1 [
        0 => "CLI utility to watch NPO streams in QuickTime Player"
      ]
      "version" => array:1 [
        0 => "1.2.0"
      ]
      "rating" => array:1 [
        0 => 0
      ]
      "modified" => array:1 [
        0 => "2018-02-11T22:22:18.543Z"
      ]
    ]
  ]
  "total" => 1
  "size" => 10
  "from" => "0"
]
```

### Specify fields

By default the result will include all fields except `readme`. You can specify the fields in the `$fields` property of the `NpmSearch`-object.

For example:

``` php
// Search for jquery with field 'name' returned in the result
$npmsSearch->fields = ['name'];
$npmSearch->search('jquery');
```

Will return this result:

``` php
array:4 [
  "results" => array:10 [
    0 => array:1 [
      "name" => array:1 [
        0 => "makeup-jquery"
      ]
    ]
    1 => array:1 [
      "name" => array:1 [
        0 => "egis-jquery-qrcode"
      ]
    ]
    2 => array:1 [
      "name" => array:1 [
        0 => "eslint-plugin-jquery"
      ]
    ]
    3 => array:1 [
      "name" => array:1 [
        0 => "kd-shim-jquery-mousewheel"
      ]
    ]
    4 => array:1 [
      "name" => array:1 [
        0 => "jquery-joint-colorbox"
      ]
    ]
    5 => array:1 [
      "name" => array:1 [
        0 => "apta-jquery"
      ]
    ]
    6 => array:1 [
      "name" => array:1 [
        0 => "jquery-shim"
      ]
    ]
    7 => array:1 [
      "name" => array:1 [
        0 => "eslint-plugin-various"
      ]
    ]
    8 => array:1 [
      "name" => array:1 [
        0 => "makeup-ebay"
      ]
    ]
    9 => array:1 [
      "name" => array:1 [
        0 => "jquery-cycle-2"
      ]
    ]
  ]
  "total" => 33208
  "size" => 10
  "from" => "0"
]
```

### Paging

By default the first 10 results will be returned. If you want to query more packages, you can specify the `$start` and `$rows` parameters:

``` php
// Search for jquery packages 100 to 105
$npmSearch->search('jquery', 100, 5);
```

### Extended search methods

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

### Advanced search options

In the backend [npmsearch.com](https://npmsearch.com) is a proxy to an ElasticSearch server. So you can use [ElasticSearch query string syntax](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-query-string-query.html#query-string-syntax) in the `search`method:

``` php
// Search for packages using a regular expression
$npmSearch->search('name:/joh?n(ath[oa]n)/');
```

### Available search methods

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
- `searchByRating($rating, $start = 0, $rows = 10)` - computed rating as per [bin/ratings.js](https://github.com/nodesource/npmsearch/blob/master/bin/rating.js)
- `searchByReadme($readme, $start = 0, $rows = 10)`
- `searchByRepository($repository, $start = 0, $rows = 10)`
- `searchByScripts($scripts, $start = 0, $rows = 10)`
- `searchByTimes($times, $start = 0, $rows = 10)`
- `searchByVersion($version, $start = 0, $rows = 10)`

## Testing

In the `/tests`-folder is one test defined:

- `NpmSearchTest.php` tests the `Kapersoft\NpmSearch\NpmSearch-class` using mock Guzzle objects;

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
