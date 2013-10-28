<?php

class EEmailValidation extends \Exception{}

class Email
{

	/**
	 * @var string
	 */
	private $emailAddress;

	/**
	 * @param string $emailAddress
	 */
	public function __construct($emailAddress)
	{
		if $this->isValid($emailAddress) {
			$this->emailAddress = $emailAddress;
		} else {
			throw new EEmailValidation('Email address ' . $emailAddress . ' is not valid.');
		}
	}

	/**
	 * good enough validation
	 * @param string $emailAddress
	 * @return string
	 */
	private function isValid($emailAddress)
	{
		return preg_match('/\S+@\S+/', $emailAddress);
	}

	public function __toString()
	{
		return $this->emailAddress;
	}

}