<?php

namespace User\Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="blocks") */
class UserBlocks
{

	/** @ODM\Id(strategy="NONE") */
	private $userId;

	/**
     * @ODM\EmbedMany(
     *   discriminatorMap={
     *     "url"="User\Documents\UrlBlock"
     *   }
     * )
     */
	private $blocks;

	public function __construct($userId)
	{
		$this->userId = $userId;
		$this->blocks = [];
	}

	public function addBlock(Block $block)
	{
		$this->blocks[] = $block;
	}

	public function getBlocks()
	{
		return $this->blocks;
	}
}