<?php

namespace Block\ResponseGenerator;

class BlockResponseGeneratorFactoryCachingDecorator implements IResponseGeneratorFactory
{

	/** @var BlockResponseGeneratorFactory */
	private $factory;

	private $createdGenerators = [];

	public function __construct(BlockResponseGeneratorFactory $factory)
	{
		$this->factory = $factory;
	}

	public function createResponseGenerator($blockType)
	{
		//TODO
	}

}