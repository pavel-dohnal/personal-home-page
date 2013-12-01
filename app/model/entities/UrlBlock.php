<?php

namespace User\Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\EmbeddedDocument */
class UrlBlock extends Block
{
	const TYPE = 'url';

	/** @ODM\Field */
	private $url;

	/**
	 * //TODO validation
	 * @param string $url
	 */
	public function __construct($url)
	{
		parent::__construct();
		$this->url = $url;
	}

	public function getType()
	{
		return static::TYPE;
	}

}