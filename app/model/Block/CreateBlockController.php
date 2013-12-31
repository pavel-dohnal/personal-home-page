<?php

namespace Block;

class CreateBlockController
{

	/** @var InputDataToBlockMapper */
	private $mapper;

	/** @var BlockCreateFacade */
	private $facade;

	public function __construct(InputDataToBlockMapper $mapper, BlockCreateFacade $facade)
	{
		$this->mapper = $mapper;
		$this->facade = $facade;
	}

	/**
	 * @param \User\Entity\User $user
	 * @param \stdClass $inputData
	 * @throws \InvalidArgumentException
	 * @throws \Nette\InvalidArgumentException
	 */
	public function run(\User\Entity\User $user, \stdClass $input = null)
	{		
		$block = $this->mapper->map($input);
		$this->facade->setBlock($block);
		$this->facade->saveBlock($user);
		$response = new \stdClass;
		$response->created = $block->getId();
		return $response;
	}
}