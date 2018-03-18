<?php

namespace Kapersoft\NpmSearch\Test;

use GuzzleHttp\Client;
use GuzzleHttp\MiddleWare;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Kapersoft\NpmSearch\NpmSearch;
use GuzzleHttp\Handler\MockHandler;

/**
 * Class NpmSearchTest.
 *
 * @author   Jan Willem Kaper <kapersoft@gmail.com>
 * @license  MIT (see LICENSE.txt)
 *
 * @link     http://github.com/kapersoft/npmsearch-api
 */

class NpmSearchTest extends TestCase
{
    /**
     * MockClient history container.
     *
     * @var array
     */
    protected $container;

    /**
     * Test for itCanBeInstantiated.
     *
     * @test
     *
     * @return void
     */
    public function itCanBeInstantiated()
    {
        $npmSearch = new NpmSearch();

        $this->assertInstanceOf(NpmSearch::class, $npmSearch);
    }

    /**
     * Test for itCanBeInstantiatedWithAGuzzleClient.
     *
     * @test
     *
     * @return void
     */
    public function itCanBeInstantiatedWithGuzzleClient()
    {
        $guzzleClient = new \GuzzleHttp\Client;
        $npmSearch = new NpmSearch('', $guzzleClient);

        $this->assertInstanceOf(NpmSearch::class, $npmSearch);
        $this->assertSame($npmSearch->guzzleClient, $guzzleClient);
    }

    /**
     * Test for itCanBeInstantiatedWithBaseUrl.
     *
     * @test
     *
     * @return void
     */
    public function itCanBeInstantiatedWithBaseUrl()
    {
        $npmSearch = new NpmSearch('https://my_url.test/query');

        $this->assertInstanceOf(NpmSearch::class, $npmSearch);
        $this->assertSame('https://my_url.test/query', $npmSearch->baseUrl);
    }

    /**
     * Test for itUsesBaseUrlInRequest.
     *
     * @test
     *
     * @return void
     */
    public function itUsesBaseUrlInRequest()
    {
        $npmSearch = $this->getMockNpmSearch();

        $response = $npmSearch->search('jquery');

        $this->assertStringStartsWith($npmSearch->baseUrl, (string)$this->getLastRequest()->getUri());
    }

    /**
     * Test for itCanSearch.
     *
     * @test
     *
     * @return void
     */
    public function itCanSearch()
    {
        $response = $this->getMockNpmSearch()->search('jquery');

        $this->assertSame(['result' => 'ok'], $response);
        $this->assertArraySubset(['q' => 'jquery'], $this->getQueryFromLastRequest());
    }

    /**
     * Test for itCanSearchWithStartAndRows.
     *
     * @test
     *
     * @return void
     */
    public function itCanSearchWithStartAndRows()
    {
        $response = $this->getMockNpmSearch()->search('jquery', 100, 5);

        $this->assertSame(['result' => 'ok'], $response);
        $this->assertArraySubset(['q' => 'jquery'], $this->getQueryFromLastRequest());
        $this->assertArraySubset(['start' => 100, 'rows' => 5], $this->getQueryFromLastRequest());
    }

    /**
     * Test for itHasStandardSetOfFields.
     *
     * @test
     *
     * @return void
     */
    public function itHasStandardSetOfFields()
    {
        $npmSearch = $this->getMockNpmSearch();
        
        $this->assertNotEmpty($npmSearch->fields);
    }

    /**
     * Test for itUsesStandardSetOfFieldsInRequest.
     *
     * @test
     *
     * @return void
     */
    public function itUsesStandardSetOfFieldsInRequest()
    {
        $npmSearch = $this->getMockNpmSearch();
        
        $response = $npmSearch->search('jquery');

        $this->assertArraySubset(['fields' => implode('', $npmSearch->fields)], $this->getQueryFromLastRequest());
    }

    /**
     * Test for itCanUseAppliedSetOfFieldsInRequest.
     *
     * @test
     *
     * @return void
     */
    public function itCanUseAppliedSetOfFieldsInRequest()
    {
        $npmSearch = $this->getMockNpmSearch();
        $npmSearch->fields = ['name'];
        
        $response = $npmSearch->search('jquery');

        $this->assertArraySubset(['fields' => 'name'], $this->getQueryFromLastRequest());
    }

    /**
     * Test for itCanSearchUsingAParameter.
     *
     * @test
     *
     * @param string $searchParameter Search parameter used for testing
     *
     * @dataProvider searchParameterProvider
     */
    public function itCanSearchUsingAParameter(string $searchParameter)
    {
        $response = $this->getMockNpmSearch()->{'searchUsing'.$searchParameter}('jquery');

        $this->assertSame(['result' => 'ok'], $response);
        $this->assertArraySubset(['q' => $searchParameter.':jquery'], $this->getQueryFromLastRequest());
    }

    /**
     * Test for itCanSearchUsingAParameterWithStartAndRows.
     *
     * @test
     *
     * @param string $searchParameter Search parameter used for testing
     *
     * @dataProvider searchParameterProvider
     */
    public function itCanSearchUsingParameterWithStartAndRows(string $searchParameter)
    {
        $response = $this->getMockNpmSearch()->{'searchUsing'.$searchParameter}('jquery', 100, 5);

        $this->assertSame(['result' => 'ok'], $response);
        $this->assertArraySubset(['q' => $searchParameter.':jquery'], $this->getQueryFromLastRequest());
        $this->assertArraySubset(['start' => 100, 'rows' => 5], $this->getQueryFromLastRequest());
    }

    /**
     * Create a mock NpmSearch object.
     *
     * @return NpmSearch
     */
    private function getMockNpmSearch(): NpmSearch
    {
        // Create mockResponse
        $mockResponse = [
            new Response(200, [], '{"result": "ok" }'),
        ];

        // Create mockHandler with history container
        $this->container = [];
        $history = Middleware::history($this->container);
        $mockHandler = HandlerStack::create(new MockHandler($mockResponse));
        $mockHandler->push($history);

        // Create Guzzle Client with mockHandler
        $mockGuzzleClient = new Client([
            'handler' => $mockHandler,
        ]);

        // Return NpmSearch with mocked Guzzle Client
        return new NpmSearch('', $mockGuzzleClient);
    }

    /**
     * Get Last request from mock Guzzle client.
     *
     * @return Request
     */
    private function getLastRequest(): Request
    {
        return end($this->container)['request'];
    }

    /**
     * Get query parameters from last request from mock Guzzle client.
     *
     * @return array
     */
    private function getQueryFromLastRequest():array
    {
        $returnValue = [];
        parse_str($this->getLastRequest()->getUri()->getQuery(), $returnValue);
        return $returnValue;
    }

    /**
     * Provider for search parameters.
     *
     * @return array
     */
    public function searchParameterProvider()
    {
        return [
            ['author'],
            ['created'],
            ['dependencies'],
            ['description'],
            ['devDependencies'],
            ['homepage'],
            ['keywords'],
            ['maintainers'],
            ['modified'],
            ['name'],
            ['rating'],
            ['readme'],
            ['repository'],
            ['scripts'],
            ['times'],
            ['version'],
        ];
    }
}
