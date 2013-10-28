<?php

class UserFacade 
{

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $entityManager;

	public function __construct(\Doctrine\ORM\EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * @param string $emailAddress
	 * @return \User
	 */
	public function loadByEmailAddress($emailAddress)
	{
		return $this->entityManager->getRepository('User')->findOneByEmail($emailAddress);
	}

}