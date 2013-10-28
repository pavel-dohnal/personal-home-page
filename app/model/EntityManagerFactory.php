<?php

class EntityManagerFactory
{

	public static function create($database, $debugMode)
	{
		$isDevMode = $debugMode;
		$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(array(__DIR__."/model/entities"), $isDevMode);
		$entityManager = \Doctrine\ORM\EntityManager::create($database, $config);
		return $entityManager;
	}

}