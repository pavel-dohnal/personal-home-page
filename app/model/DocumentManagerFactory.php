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
		$config->setDefaultDB($mongoConfig['dbname']);
		$config->setMetadataDriverImpl(\Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::create(array(__DIR__."/model/entities")));

		$mongoClient = new \MongoClient(rtrim($mongoConfig['connectionuri'], '/') . '/' . $mongoConfig['dbname'], ["connect" => true]);
		$mongoClient->selectDB($mongoConfig['dbname']);
		$mongoClient->connect();
		$connection = new \Doctrine\MongoDB\Connection($mongoClient);
		return \Doctrine\ODM\MongoDB\DocumentManager::create($connection, $config);
	}

}