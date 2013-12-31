<?php

namespace Block;

class CreateBlockFacade
{

	/** @var \User\Documents\Block */
	private $block;

	/** @var \Doctrine\ODM\MongoDB\DocumentManager */
	private $documentManager;

	public function __construct(\Doctrine\ODM\MongoDB\DocumentManager $documentManager)
	{		
		$this->documentManager = $documentManager;
	}

	public function setBlock(\User\Documents\Block $block)
	{
		$this->block = $block;
	}

	public function saveBlock(\User\Entity\User $user)
	{
		$userBlocks = $this->documentManager->find('\User\Documents\UserBlocks', $user->getId());
		if (!$userBlocks) {
			$userBlocks = new \User\Documents\UserBlocks($user->getId());
			$this->documentManager->persist($userBlocks);
		}
		if (isset($this->block)) {
			$userBlocks->addBlock($this->block);
		}
		$this->documentManager->flush($userBlocks);
	}
}