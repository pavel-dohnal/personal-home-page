<?php

namespace User\Documents;

/** @EmbeddedDocument */
class UrlBlock extends Block
{
	const TYPE = 'url';

	public function getType()
	{
		return static::TYPE;
	}

}