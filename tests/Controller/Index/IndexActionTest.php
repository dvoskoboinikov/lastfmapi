<?php

namespace LastFm\Tests\Controller\Index;

/**
 * Unit test for index action.
 */
class IndexActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Subject of testing.
     *
     * @var \LastFm\Controller\Index\IndexAction
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

        $this->subject = new \LastFm\Controller\Index\IndexAction($this->ci);
    }

    public function testInvocation()
    {
        $view = $this->getMockBuilder('Slim\Views\Twig')
            ->setMethods(['render'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $view->expects($this->once())
            ->method('render')
            ->with($this->response, 'index/index.html')
            ->willReturn($this->response);

        $this->ci->expects($this->once())
            ->method('get')
            ->with('view')
            ->willReturn($view);

        // Assertions.
        $this->subject->__invoke($this->request, $this->response, []);
    }
}
