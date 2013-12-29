<?php

namespace Block\Validator;

class UrlValidator implements IBlockValidator
{
	const TYPE = 'url';

	public function validateCreate(\stdClass $input)
	{
		if (!isset($input->type)) {
			throw new Evalidation('Type parameter is mandatory.');
		}
		if ($input->type != self::TYPE) {
			throw new Evalidation('Wrong input type.');
		}
		if (!isset($input->url)) {
			throw new Evalidation('Url is mandatory.');
		}
		if (!filter_var($input->url, FILTER_VALIDATE_URL)) {
			throw new EValidation('Malformed Url.');
		}
		return true;
	}

	public function validateUpdate(\stdClass $input)
	{
		//TODO
	}

}