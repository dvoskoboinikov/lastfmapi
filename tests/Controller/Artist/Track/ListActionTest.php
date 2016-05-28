<?php

namespace LastFm\Tests\Controller\Artist\Track;

/**
 * Unit test for artist tracks list action.
 */
class ListActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Subject of testing.
     *
     * @var \LastFm\Controller\Artist\Track\ListAction
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

        $this->subject = new \LastFm\Controller\Artist\Track\ListAction($this->ci);
    }

    public function testInvocation()
    {
        $arguments = [
            'artist' => 'Cher'
        ];

        $testTracksData = [
            'toptracks' => [
                'track' => [
                    'name' => 'Believe'
                ]
            ]
        ];

        $artistDataProvider = $this->getMockBuilder('LastFm\Model\DataProvider\Artist\Api')
            ->setMethods(['getTopTracks'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $artistDataProvider->expects($this->once())
            ->method('getTopTracks')
            ->with($arguments['artist'])
            ->willReturn($testTracksData);

        $this->ci->expects($this->at(0))
            ->method('get')
            ->with('artistDataProvider')
            ->willReturn($artistDataProvider);

        $view = $this->getMockBuilder('Slim\Views\Twig')
            ->setMethods(['render'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $view->expects($this->once())
            ->method('render')
            ->with(
                $this->response,
                'artist/track/list.html',
                [
                    'data' => $testTracksData
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
