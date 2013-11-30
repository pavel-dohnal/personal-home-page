<?php

namespace User\Documents;

/** @EmbeddedDocument */
abstract class Block
{
	/** @Id(strategy="AUTO") */
	protected $id;

	/** @Field */
	protected $type;

	public function __construct()
	{
		$this->type = $this->getType();
	}

	/**
	 * @return string
	 */
	public abstract function getType();

}