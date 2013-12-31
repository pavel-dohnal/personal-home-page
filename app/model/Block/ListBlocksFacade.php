<?php

namespace Block;

class ListBlocksFacade
{

	/** @var \Doctrine\ODM\MongoDB\DocumentManager */
	private $documentManager;

	public function __construct(\Doctrine\ODM\MongoDB\DocumentManager $documentManager)
	{		
		$this->documentManager = $documentManager;
	}

	/**
	 * @param \User\Entity\User $user
	 * @return \User\Documents\Block[]
	 */
	public function getBlocksByUser(\User\Entity\User $user)
	{//TODO
		return [];
	}
}