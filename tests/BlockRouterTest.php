<?php

class BlockRouterTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var PHPUnit_Framework_MockObject_MockObject
	 */
	private $httpRequest;

	/**
	 * @var PHPUnit_Framework_MockObject_MockObject
	 */
	private $url;

	/**
	 * @var BlockRouter
	 */
	private $blockRouter;
	
	public function setup()
	{
		$this->blockRouter = new BlockRouter;
		$this->httpRequest = $this->getMock('Nette\Http\Request', ['getUrl', 'getMethod'], [], '', false, false);
		$this->url = $this->getMock('Nette\Http\UrlScript', ['getPath'], [], '', false, false);
		$this->httpRequest
			->expects($this->once())
			->method('getUrl')
			->will($this->returnValue($this->url));
	}

	public function testReturnsNullOnUnknownUrl()
	{
		$path = 'url/long/asdf';
		$this->url
			->expects($this->once())
			->method('getPath')
			->will($this->returnValue($path));
		$match = $this->blockRouter->match($this->httpRequest);
		$this->assertNull($match);
	}

	public function testReturnsNullOnEmptyUrl()
	{
		$path = '';
		$this->url
			->expects($this->once())
			->method('getPath')
			->will($this->returnValue($path));
		$match = $this->blockRouter->match($this->httpRequest);
		$this->assertNull($match);
	}

	public function testReturnsBlocksList()
	{
		$path = '/blocks/';
		$this->url
			->expects($this->once())
			->method('getPath')
			->will($this->returnValue($path));
		$match = $this->blockRouter->match($this->httpRequest);
		$this->assertInstanceOf('\Nette\Application\Request', $match);
		$this->assertEquals('Front:Block:List', $match->getPresenterName());
	}

	public function testReturnsCreate()
	{
		$path = '/block/';
		$this->url
			->expects($this->once())
			->method('getPath')
			->will($this->returnValue($path));
		$this->httpRequest
			->expects($this->once())
			->method('getMethod')
			->will($this->returnValue('POST'));
		$match = $this->blockRouter->match($this->httpRequest);
		$this->assertInstanceOf('\Nette\Application\Request', $match);
		$this->assertEquals('Front:Block:Create', $match->getPresenterName());	
	}

	public function testReturnsDelete()
	{
		$path = '/block/4/';
		$this->url
			->expects($this->once())
			->method('getPath')
			->will($this->returnValue($path));
		$this->httpRequest
			->expects($this->once())
			->method('getMethod')
			->will($this->returnValue('DELETE'));
		$match = $this->blockRouter->match($this->httpRequest);
		$this->assertInstanceOf('\Nette\Application\Request', $match);
		$this->assertEquals('Front:Block:Delete', $match->getPresenterName());	
	}

	public function testReturnsUpdate()
	{
		$path = '/block/4/';
		$this->url
			->expects($this->once())
			->method('getPath')
			->will($this->returnValue($path));
		$this->httpRequest
			->expects($this->any())
			->method('getMethod')
			->will($this->returnValue('PUT'));
		$match = $this->blockRouter->match($this->httpRequest);
		$this->assertInstanceOf('\Nette\Application\Request', $match);
		$this->assertEquals('Front:Block:Update', $match->getPresenterName());	
	}

	public function testWrongMethod()
	{
		$path = '/block/4/';
		$this->url
			->expects($this->once())
			->method('getPath')
			->will($this->returnValue($path));
		$this->httpRequest
			->expects($this->any())
			->method('getMethod')
			->will($this->returnValue('GET'));
		$match = $this->blockRouter->match($this->httpRequest);
		$this->assertNull($match);
	}
}
