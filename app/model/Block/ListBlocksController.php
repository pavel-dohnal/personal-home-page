<?php

namespace Block;

class ListBlocksController
{

	private $responseGenerator;

	private $facade;

	public function __construct(
		\Block\ResponseGenerator\IListResponseGenerator $responseGenerator, 
		\Block\ListBlocksFacade $facade
	)
	{
		$this->responseGenerator = $responseGenerator;
		$this->facade = $facade;
	}

	/**
	 * @param \User\Entity\User $user
	 * @return \stdClass[]
	 */
	public function run(\User\Entity\User $user)
	{
		//TODO
		return [];
	}
}