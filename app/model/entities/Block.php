<?php

namespace User\Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\EmbeddedDocument */
abstract class Block
{
	/** @ODM\Id(strategy="AUTO") */
	protected $id;

	/** @ODM\Field */
	protected $type;

	public function __construct()
	{
		$this->type = $this->getType();
	}

	/**
	 * @return string
	 */
	public abstract function getType();

	/** @return int */
	public function getId()
	{
		return $this->id;
	}
}