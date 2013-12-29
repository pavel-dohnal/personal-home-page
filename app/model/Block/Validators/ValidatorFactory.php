<?php

namespace Block\Validator;

class EValidation extends \Exception{};

class ValidatorFactory
{

	public function createValidator(\stdClass $input = null)
	{
		if (!$input) {
			throw new EValidation('Missing input data.');
		}
		if (!isset($input->type)) {
			throw new EValidation('Type parameter is mandatory.');
		}
		if ($input->type == 'url') {
			return new UrlValidator();
		}
	}

}