<?php

namespace Kapersoft\NpmSearch;

use GuzzleHttp\Client;

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
     * Search package using a query
     *
     * @param string  $query Search query
     * @param integer $start Start from
     * @param integer $rows  Number of rows
     * @return array
     */
    public function search(string $query, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => $query,
            'start' => $start,
            'rows'  => $rows
        
        ]);
    }

    /**
     * Search package using author
     *
     * @param string  $author Author
     * @param integer $start  Start form
     * @param integer $rows   Number of rows
     * @return array
     */
    public function searchUsingAuthor(string $author, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'author:' . $author,
            'start' => $start,
            'rows'  => $rows
        
        ]);
    }
    
    /**
     * Search package using create data
     *
     * @param string  $created Created date
     * @param integer $start   Start form
     * @param integer $rows    Number of rows
     * @return array
     */
    public function searchUsingCreated(string $created, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'created:' . $created,
            'start' => $start,
            'rows'  => $rows
        
        ]);
    }
    
    /**
     * Search package using dependencies
     *
     * @param string  $dependencies  Dependencies
     * @param integer $start         Start form
     * @param integer $rows          Number of rows
     * @return array
     */
    public function searchUsingDependencies(string $dependencies, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'dependencies:' . $dependencies,
            'start' => $start,
            'rows'  => $rows
        ]);
    }

    /**
     * Search package using description
     *
     * @param string  $description Description
     * @param integer $start       Start form
     * @param integer $rows        Number of rows
     * @return array
     */
    public function searchUsingDescription(string $description, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'description:' . $description,
            'start' => $start,
            'rows'  => $rows
        ]);
    }

    /**
     * Search package using devDependencies
     *
     * @param string  $devDependencies DevDependencies
     * @param integer $start           Start form
     * @param integer $rows            Number of rows
     * @return array
     */
    public function searchUsingDevDependencies(string $devDependencies, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'devDependencies:' . $devDependencies,
            'start' => $start,
            'rows'  => $rows
        ]);
    }

    /**
     * Search package using homepage
     *
     * @param string  $homepage Homepage
     * @param integer $start    Start form
     * @param integer $rows     Number of rows
     * @return array
     */
    public function searchUsingHomepage(string $homepage, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'homepage:' . $homepage,
            'start' => $start,
            'rows'  => $rows
        ]);
    }

    /**
     * Search package using keywords
     *
     * @param string  $keywords Keywords
     * @param integer $start    Start form
     * @param integer $rows     Number of rows
     * @return array
     */
    public function searchUsingKeywords(string $keywords, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'keywords:' . $keywords,
            'start' => $start,
            'rows'  => $rows
        ]);
    }

    /**
     * Search package using maintainers
     *
     * @param string  $maintainers Maintainers
     * @param integer $start       Start form
     * @param integer $rows        Number of rows
     * @return array
     */
    public function searchUsingMaintainers(string $maintainers, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'maintainers:' . $maintainers,
            'start' => $start,
            'rows'  => $rows
        ]);
    }

    /**
     * Search package using modified date
     *
     * @param string  $modified Modified date
     * @param integer $start    Start form
     * @param integer $rows     Number of rows
     * @return array
     */
    public function searchUsingModified(string $modified, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'modified:' . $modified,
            'start' => $start,
            'rows'  => $rows
        ]);
    }

    /**
     * Search package using name
     *
     * @param string  $name  Name
     * @param integer $start Start form
     * @param integer $rows  Number of rows
     * @return array
     */
    public function searchUsingName(string $name, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'name:' . $name,
            'start' => $start,
            'rows'  => $rows
        ]);
    }

    /**
     * Search package using readme
     *
     * @param string  $readme Readme
     * @param integer $start  Start form
     * @param integer $rows   Number of rows
     * @return array
     */
    public function searchUsingReadme(string $readme, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'readme:' . $readme,
            'start' => $start,
            'rows'  => $rows
        ]);
    }
    
    /**
     * Search package using repository
     *
     * @param string  $repository Repository
     * @param integer $start      Start form
     * @param integer $rows       Number of rows
     * @return array
     */
    public function searchUsingRepository(string $repository, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'repository:' . $repository,
            'start' => $start,
            'rows'  => $rows
        ]);
    }

    /**
     * Search package using scripts
     *
     * @param string  $scripts Scripts
     * @param integer $start   Start form
     * @param integer $rows    Number of rows
     * @return array
     */
    public function searchUsingScripts(string $scripts, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'scripts:' . $scripts,
            'start' => $start,
            'rows'  => $rows
        ]);
    }

    /**
     * Search package using times
     *
     * @param string  $times Times
     * @param integer $start Start form
     * @param integer $rows  Number of rows
     * @return array
     */
    public function searchUsingTimes(string $times, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'times:' . $times,
            'start' => $start,
            'rows'  => $rows
        ]);
    }

    /**
     * Search package using version
     *
     * @param string  $version Version
     * @param integer $start   Start form
     * @param integer $rows    Number of rows
     * @return array
     */
    public function searchUsingVersion(string $version, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'version:' . $version,
            'start' => $start,
            'rows'  => $rows
        ]);
    }

    /**
     * Search package using rating
     *
     * @param string  $rating Rating
     * @param integer $start  Start form
     * @param integer $rows   Number of rows
     * @return array
     */
    public function searchUsingRating(string $rating, int $start = 0, int $rows = 10):array
    {
        return $this->makeRequest([
            'q'     => 'rating:' . $rating,
            'start' => $start,
            'rows'  => $rows
        ]);
    }
  
    /**
     * @param array $query
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
