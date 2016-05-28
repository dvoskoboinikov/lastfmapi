<?php

namespace LastFm\Tests\Controller\Artist;

/**
 * Unit test for artist list action.
 */
class ListActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Subject of testing.
     *
     * @var \LastFm\Controller\Artist\ListAction
     */
    protected $subject;

    /**
     * @var \Interop\Container\ContainerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $ci;

    /**
     * @var \Psr\Http\Message\ServerRequestInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $request;

    /**
     * @var \Psr\Http\Message\ResponseInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $response;

    public function setUp()
    {
        $this->ci = $this->getMockBuilder('Interop\Container\ContainerInterface')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->request = $this->getMockBuilder('Psr\Http\Message\ServerRequestInterface')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->subject = new \LastFm\Controller\Artist\ListAction($this->ci);
    }

    public function testInvocation()
    {
        $arguments = [
            'country' => 'Australia'
        ];

        $testGeoData = [
            'topartists' => [
                'artist' => [
                    'name' => 'Coldplay'
                ]
            ]
        ];

        $geoDataProvider = $this->getMockBuilder('LastFm\Model\DataProvider\Geo\Api')
            ->setMethods(['getTopArtists'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $geoDataProvider->expects($this->once())
            ->method('getTopArtists')
            ->with($arguments['country'])
            ->willReturn($testGeoData);

        $this->ci->expects($this->at(0))
            ->method('get')
            ->with('geoDataProvider')
            ->willReturn($geoDataProvider);

        $view = $this->getMockBuilder('Slim\Views\Twig')
            ->setMethods(['render'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $view->expects($this->once())
            ->method('render')
            ->with(
                $this->response,
                'artist/list.html',
                [
                    'data' => $testGeoData
                ]
            )->willReturn($this->response);

        $this->ci->expects($this->at(1))
            ->method('get')
            ->with('view')
            ->willReturn($view);

        // Assertions.
        $this->subject->__invoke($this->request, $this->response, $arguments);
    }
}
