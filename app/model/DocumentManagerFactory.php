<?php

class DocumentManagerFactory
{

	public static function create($mongoConfig, $tempDir)
	{
		\Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::registerAnnotationClasses();

		$config = new \Doctrine\ODM\MongoDB\Configuration();
		$config->setProxyDir($tempDir . '/proxies');
		$config->setProxyNamespace('Proxies');
		$config->setHydratorDir($tempDir . '/hydrators');
		$config->setHydratorNamespace('Hydrators');
		$config->setMetadataDriverImpl(\Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::create(array(__DIR__."/model/entities")));

		$connection = new \Doctrine\MongoDB\Connection($mongoConfig['connectionuri']);
		return \Doctrine\ODM\MongoDB\DocumentManager::create($connection, $config);
	}

}