<?php

namespace Block\ResponseGenerator;

class BlockResponseGeneratorFactoryCachingDecorator implements IResponseGeneratorFactory
{

	/** @var IResponseGeneratorFactory */
	private $factory;

	private $createdGenerators = [];

	public function __construct(IResponseGeneratorFactory $factory)
	{
		$this->factory = $factory;
	}

	public function createResponseGenerator($blockType)
	{
		if (!isset($this->createdGenerators[$blockType])) {
			$this->createdGenerators[$blockType] = $this->factory->createResponseGenerator($blockType);
		}
		return $this->createdGenerators[$blockType];
	}

}