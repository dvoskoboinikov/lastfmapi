<?php

namespace LastFm\Tests\Model\DataProvider\Geo;

/**
 * Unit test for API provider of Geo data.
 */
class ApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Subject of testing.
     *
     * @var \LastFm\Model\DataProvider\Artist\Api
     */
    protected $subject;

    /**
     * @var \Interop\Container\ContainerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $ci;

    /**
     * @var \LastFm\Framework\Model\ApiClientInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $apiClient;

    /**
     * @var \Psr\Http\Message\ResponseInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $response;

    /**
     * @var array
     */
    protected $testSettings = [
        'api' => [
            'url' => 'http://api.testhost.com/2.0/',
            'key' => 'szVESkGY7YDhWwEzYRPFmvX6fckhzUVF',
            'format' => 'json',
            'limit' => 5
        ]
    ];

    public function setUp()
    {
        $this->ci = $this->getMockBuilder('Interop\Container\ContainerInterface')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->apiClient = $this->getMockBuilder('LastFm\Framework\Model\ApiClientInterface')
            ->setMethods(['get'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->ci->expects($this->at(0))
            ->method('get')
            ->with('apiClient')
            ->willReturn($this->apiClient);

        $this->ci->expects($this->at(1))
            ->method('get')
            ->with('settings')
            ->willReturn($this->testSettings);

        $this->response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->subject = new \LastFm\Model\DataProvider\Geo\Api($this->ci);
    }

    public function testGetTopArtists()
    {
        $testCountry = 'Australia';
        $testPage = 48;

        $testQueryData = [
            'method' => 'geo.gettopartists',
            'country' => $testCountry,
            'page' => $testPage,
            'api_key' => $this->testSettings['api']['key'],
            'format' => $this->testSettings['api']['format'],
            'limit' => $this->testSettings['api']['limit']
        ];

        $testResponceBody = '{"topartists":{"artist":[{"name":"David Bowie"}]}}';

        $this->apiClient->expects($this->once())
            ->method('get')
            ->with($this->testSettings['api']['url'], ['query' => $testQueryData])
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($testResponceBody);

        // Assertions.
        $response = $this->subject->getTopArtists($testCountry, $testPage);

        $this->assertEquals(json_decode($testResponceBody, true), $response);
    }
}
