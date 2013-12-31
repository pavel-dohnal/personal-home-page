<?php

namespace Block;

class BlockCreateFacadeTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var PHPUnit_Framework_MockObject_MockObject
	 */
	private $documentManager;

	/**
	 * @var BlockCreateFacade
	 */
	private $facade;
	
	public function setup()
	{
		$this->documentManager = $this->getMock('\Doctrine\ODM\MongoDB\DocumentManager', ['persist', 'flush', 'find'], [], '', false, false);		
		$this->facade = new BlockCreateFacade($this->documentManager);
	}

	public function testWorksWithExistingDocument()
	{
		$userId = 5;
		$user = $this->getMock('\User\Entity\User', [], [], '', false, false);
		$user
			->expects($this->once())
			->method('getId')
			->will($this->returnValue($userId));
		$block = $this->getMock('\User\Documents\UrlBlock', [], [], '', false, false);
		$this->facade->setBlock($block);
		$userBlocks = $this->getMock('\User\Documents\UserBlocks', [], [], '', false, false);
		$this->documentManager
			->expects($this->once())
			->method('find')
			->with('\User\Documents\UserBlocks', $userId)
			->will($this->returnValue($userBlocks));
		$this->documentManager
			->expects($this->never())
			->method('persist');
		$userBlocks
			->expects($this->once())
			->method('addBlock')
			->with($block);
		$this->documentManager
			->expects($this->once())
			->method('flush');
		$this->facade->saveBlock($user);
	}

	public function testWorksWithNewDocument()
	{
		$userId = 5;
		$user = $this->getMock('\User\Entity\User', [], [], '', false, false);
		$user
			->expects($this->any())
			->method('getId')
			->will($this->returnValue($userId));
		$block = $this->getMock('\User\Documents\UrlBlock', [], [], '', false, false);
		$this->facade->setBlock($block);		
		$this->documentManager
			->expects($this->once())
			->method('find')
			->with('\User\Documents\UserBlocks', $userId)
			->will($this->returnValue(null));
		$this->documentManager
			->expects($this->once())
			->method('persist');
		$this->documentManager
			->expects($this->once())
			->method('flush');
		$this->facade->saveBlock($user);
	}
}