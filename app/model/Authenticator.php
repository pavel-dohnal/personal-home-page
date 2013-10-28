<?php

use Nette\Security,
	Nette\Utils\Strings;

/*
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` char(60) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

/**
 * Users authenticator.
 */
class Authenticator extends Nette\Object implements Security\IAuthenticator
{

	private $entityManager;

	public function __construct(\Doctrine\ORM\EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;

	
		// if (!$row) {
		// 	throw new Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);
		// }

		// if ($row->password !== $this->calculateHash($password, $row->password)) {
		// 	throw new Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
		// }

		// $arr = $row->toArray();
		// unset($arr['password']);
		// return new Nette\Security\Identity($row->id, $row->role, $arr);
	}

}