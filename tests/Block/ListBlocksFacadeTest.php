<?php

namespace Block;

class ListBlocksFacadeTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var PHPUnit_Framework_MockObject_MockObject
	 */
	private $documentManager;

	/**
	 * @var PHPUnit_Framework_MockObject_MockObject
	 */
	private $user;

	/**
	 * @var int
	 */
	private $userId;

	/**
	 * @var ListBlocksFacade
	 */
	private $facade;

	public function setup()
	{
		$this->documentManager = $this->getMock('\Doctrine\ODM\MongoDB\DocumentManager', ['find'], [], '', false, false);
		$this->userId = 8;
		$this->user = $this->getMock('\User\Entity\User', ['getId'], [], '', false, false);
		$this->user
			->expects($this->once())
			->method('getId')
			->will($this->returnValue($this->userId));
		$this->facade = new ListBlocksFacade($this->documentManager);
	}

	public function testNothingInDatabase()
	{
		$userBlocks = null;
		$this->documentManager
			->expects($this->once())
			->method('find')
			->with('\User\Documents\UserBlocks', $this->userId)
			->will($this->returnValue($userBlocks));
		$result = $this->facade->getBlocksByUser($this->user);
		$this->assertEquals([], $result);
	}

	public function testNoBlocks()
	{
		$userBlocks = $this->getMock('\User\Documents\UserBlocks', ['getBlocks'], [$this->userId]);
		$userBlocks
			->expects($this->once())
			->method('getBlocks')
			->will($this->returnValue(null));
		$this->documentManager
			->expects($this->once())
			->method('find')
			->with('\User\Documents\UserBlocks', $this->userId)
			->will($this->returnValue($userBlocks));
		$result = $this->facade->getBlocksByUser($this->user);
		$this->assertEquals([], $result);
	}

	public function testReturnsBlocks()
	{
		$userBlocks = $this->getMock('\User\Documents\UserBlocks', ['getBlocks'], [$this->userId]);
		$blocks = [
			$this->getMock('\User\Documents\UrlBlock', [], [], '', false, false)
		];
		$userBlocks
			->expects($this->once())
			->method('getBlocks')
			->will($this->returnValue($blocks));
		$this->documentManager
			->expects($this->once())
			->method('find')
			->with('\User\Documents\UserBlocks', $this->userId)
			->will($this->returnValue($userBlocks));
		$result = $this->facade->getBlocksByUser($this->user);
		$this->assertEquals($blocks, $result);
	}
}