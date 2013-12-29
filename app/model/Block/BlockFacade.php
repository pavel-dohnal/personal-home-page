<?php

namespace Block;

class BlockFacade
{

	/**
	 * @var \Doctrine\ODM\MongoDB\DocumentManager
	 */
	private $documentManager;

	public function __construct(\Doctrine\ODM\MongoDB\DocumentManager $documentManager)
	{
		$this->documentManager = $documentManager;
	}

	public function create()
	{

	}

}