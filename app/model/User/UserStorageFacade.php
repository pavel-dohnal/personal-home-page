<?php

namespace User;

class StorageFacade 
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

	/**
	 * @param \User $user
	 */
	public function save(\User\Entity\User $user)
	{
		$this->entityManager->persist($user);
		$this->entityManager->flush();
	}

}