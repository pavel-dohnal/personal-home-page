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
	 * @param string $url
	 */
	public function __construct(\Nette\Http\Url $url)
	{
		parent::__construct();
		$this->url = $url->getAbsoluteUrl();
	}

	public function getType()
	{
		return static::TYPE;
	}

}