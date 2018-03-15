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

class NpmSearchTest extends TestCase
{
    /**
     * MockClient history container.
     *
     * @var array
     */
    protected $container;

    /**
     * URL for mock tests.
     *
     * @var string
     */
    protected $testUrl = 'https://my_url.test/query';

    /**
     * Test for itCanBeInstantiatedWithoutParameters.
     *
     * @test
     *
     * @return void
     */
    public function itCanBeInstantiatedWithoutParameters()
    {
        $npmSearch = new NpmSearch();

        dd($npmSearch->search('kapersoft'));
        $this->assertInstanceOf(NpmSearch::class, $npmSearch);
    }

    /**
     * Test for itCanBeInstantiatedWithAGuzzleClient.
     *
     * @test
     *
     * @return void
     */
    public function itCanBeInstantiatedWithAGuzzleClient()
    {
        $guzzleClient = new \GuzzleHttp\Client;
        $npmSearch = new NpmSearch('', $guzzleClient);

        $this->assertInstanceOf(NpmSearch::class, $npmSearch);
        $this->assertSame($npmSearch->guzzleClient, $guzzleClient);
    }

    /**
     * Test for itCanBeInstantiatedWithABaseUrl.
     *
     * @test
     *
     * @return void
     */
    public function itCanBeInstantiatedWithABaseUrl()
    {
        $npmSearch = new NpmSearch($this->testUrl);

        $this->assertInstanceOf(NpmSearch::class, $npmSearch);
        $this->assertSame($this->testUrl, $npmSearch->baseUrl);
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
        $this->assertSame(
            $this->testUrl.'?q=jquery&start=0&rows=10',
            (string) $this->getLastRequest()->getUri()
        );
    }

    /**
     * Test for itCanSearch.
     *
     * @test
     *
     * @return void
     */
    public function itCanSearchWithStartAndRows()
    {
        $response = $this->getMockNpmSearch()->search('jquery', 100, 5);

        $this->assertSame(['result' => 'ok'], $response);
        $this->assertSame(
            $this->testUrl.'?q=jquery&start=100&rows=5',
            (string) $this->getLastRequest()->getUri()
        );
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
        $method = 'searchUsing'.$searchParameter;

        $response = $this->getMockNpmSearch()->{$method}('jquery');

        $this->assertSame(['result' => 'ok'], $response);
        $this->assertSame(
            $this->testUrl.'?q='.$searchParameter.'%3Ajquery&start=0&rows=10',
            (string) $this->getLastRequest()->getUri()
        );
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
    public function itCanSearchUsingAParameterWithStartAndRows(string $searchParameter)
    {
        $method = 'searchUsing'.$searchParameter;

        $response = $this->getMockNpmSearch()->{$method}('jquery', 100, 5);

        $this->assertSame(['result' => 'ok'], $response);
        $this->assertSame(
            $this->testUrl.'?q='.$searchParameter.'%3Ajquery&start=100&rows=5',
            (string) $this->getLastRequest()->getUri()
        );
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
        $mockHandler = new MockHandler($mockResponse);

        // Create mockHandler with history container
        $this->container = [];
        $history = Middleware::history($this->container);
        $mockHandler = HandlerStack::create(new MockHandler($mockResponse));
        $mockHandler->push($history);

        // Create Guzzle Client with mockHandler
        $mockGuzzleClient = new Client([
            'handler' => $mockHandler,
        ]);

        // Return NpmSearch with mockGuzzleClient
        return new NpmSearch($this->testUrl, $mockGuzzleClient);
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
            ['readme'],
            ['repository'],
            ['scripts'],
            ['times'],
            ['version'],
            ['rating'],
        ];
    }
}
