<?php

namespace Kapersoft\NpmSearch;

use GuzzleHttp\Client;

/**
 * Class NpmSearch.
 *
 * @author   Jan Willem Kaper <kapersoft@gmail.com>
 * @license  MIT (see LICENSE.txt)
 *
 * @link     http://github.com/kapersoft/npmsearch-api
 */

class NpmSearch
{
    /** @var Client */
    public $guzzleClient;

    /** @var string */
    public $baseUrl;

    /**
     * @param Client $client
     * @param string $baseUrl
     */
    public function __construct($baseUrl = 'https://npmsearch.com/query', Client $guzzleClient = null)
    {
        if ($guzzleClient === null) {
            $guzzleClient = new Client();
        }
        $this->guzzleClient = $guzzleClient;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Search package using a query.
     *
     * @param string $query Search query
     * @param int    $start Start from
     * @param int    $rows  Number of rows
     * @return array
     */
    public function search(string $query, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'      => $query,
            'start'  => $start,
            'rows'   => $rows,
        ]);
    }

    /**
     * Search package using author.
     *
     * @param string $author Author
     * @param int    $start  Start form
     * @param int    $rows   Number of rows
     * @return array
     */
    public function searchUsingAuthor(string $author, int $start = 0, int $rows = 10):array
    {
        return $this->search('author:' . $author, $start, $rows);
    }

    /**
     * Search package using create data.
     *
     * @param string $created Created date
     * @param int    $start   Start form
     * @param int    $rows    Number of rows
     * @return array
     */
    public function searchUsingCreated(string $created, int $start = 0, int $rows = 10):array
    {
        return $this->search('created:' . $created, $start, $rows);
    }

    /**
     * Search package using dependencies.
     *
     * @param string $dependencies  Dependencies
     * @param int    $start         Start form
     * @param int    $rows          Number of rows
     * @return array
     */
    public function searchUsingDependencies(string $dependencies, int $start = 0, int $rows = 10):array
    {
        return $this->search('dependencies:' . $dependencies, $start, $rows);
    }

    /**
     * Search package using description.
     *
     * @param string $description Description
     * @param int    $start       Start form
     * @param int    $rows        Number of rows
     * @return array
     */
    public function searchUsingDescription(string $description, int $start = 0, int $rows = 10):array
    {
        return $this->search('description:' . $description, $start, $rows);
    }

    /**
     * Search package using devDependencies.
     *
     * @param string $devDependencies DevDependencies
     * @param int    $start           Start form
     * @param int    $rows            Number of rows
     * @return array
     */
    public function searchUsingDevDependencies(string $devDependencies, int $start = 0, int $rows = 10):array
    {
        return $this->search('devDependencies:' . $devDependencies, $start, $rows);
    }

    /**
     * Search package using homepage.
     *
     * @param string $homepage Homepage
     * @param int    $start    Start form
     * @param int    $rows     Number of rows
     * @return array
     */
    public function searchUsingHomepage(string $homepage, int $start = 0, int $rows = 10):array
    {
        return $this->search('homepage:' . $homepage, $start, $rows);
    }

    /**
     * Search package using keywords.
     *
     * @param string $keywords Keywords
     * @param int    $start    Start form
     * @param int    $rows     Number of rows
     * @return array
     */
    public function searchUsingKeywords(string $keywords, int $start = 0, int $rows = 10):array
    {
        return $this->search('keywords:' . $keywords, $start, $rows);
    }

    /**
     * Search package using maintainers.
     *
     * @param string  $maintainers Maintainers
     * @param int     $start       Start form
     * @param int     $rows        Number of rows
     * @return array
     */
    public function searchUsingMaintainers(string $maintainers, int $start = 0, int $rows = 10):array
    {
        return $this->search('maintainers:' . $maintainers, $start, $rows);
    }

    /**
     * Search package using modified date.
     *
     * @param string $modified Modified date
     * @param int    $start    Start form
     * @param int    $rows     Number of rows
     * @return array
     */
    public function searchUsingModified(string $modified, int $start = 0, int $rows = 10):array
    {
        return $this->search('modified:' . $modified, $start, $rows);
    }

    /**
     * Search package using name.
     *
     * @param string $name  Name
     * @param int    $start Start form
     * @param int    $rows  Number of rows
     * @return array
     */
    public function searchUsingName(string $name, int $start = 0, int $rows = 10):array
    {
        return $this->search('name:' . $name, $start, $rows);
    }

    /**
     * Search package using readme.
     *
     * @param string $readme Readme
     * @param int    $start  Start form
     * @param int    $rows   Number of rows
     * @return array
     */
    public function searchUsingReadme(string $readme, int $start = 0, int $rows = 10):array
    {
        return $this->search('readme:' . $readme, $start, $rows);
    }

    /**
     * Search package using repository.
     *
     * @param string $repository Repository
     * @param int    $start      Start form
     * @param int    $rows       Number of rows
     * @return array
     */
    public function searchUsingRepository(string $repository, int $start = 0, int $rows = 10):array
    {
        return $this->search('repository:' . $repository, $start, $rows);
    }

    /**
     * Search package using scripts.
     *
     * @param string $scripts Scripts
     * @param int    $start   Start form
     * @param int    $rows    Number of rows
     * @return array
     */
    public function searchUsingScripts(string $scripts, int $start = 0, int $rows = 10):array
    {
        return $this->search('scripts:' . $scripts, $start, $rows);
    }

    /**
     * Search package using times.
     *
     * @param string $times Times
     * @param int    $start Start form
     * @param int    $rows  Number of rows
     * @return array
     */
    public function searchUsingTimes(string $times, int $start = 0, int $rows = 10):array
    {
        return $this->search('times:' . $times, $start, $rows);
    }

    /**
     * Search package using version.
     *
     * @param string $version Version
     * @param int    $start   Start form
     * @param int    $rows    Number of rows
     * @return array
     */
    public function searchUsingVersion(string $version, int $start = 0, int $rows = 10):array
    {
        return $this->search('version:' . $version, $start, $rows);
    }

    /**
     * Search package using rating.
     *
     * @param string $rating Rating
     * @param int    $start  Start form
     * @param int    $rows   Number of rows
     * @return array
     */
    public function searchUsingRating(string $rating, int $start = 0, int $rows = 10):array
    {
        return $this->search('rating:' . $rating, $start, $rows);
    }

    /**
     * @param array $query Query
     *
     * @return array
     */
    private function makeRequest($query = []):array
    {
        $packages = $this->guzzleClient
            ->get("{$this->baseUrl}", compact('query'))
            ->getBody()
            ->getContents();
            
        return json_decode($packages, true);
    }
}
