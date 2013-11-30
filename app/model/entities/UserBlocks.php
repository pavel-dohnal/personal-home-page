<?php

namespace User\Documents;

/** @Document(collection="blocks") */
class UserBlocks
{

	/** @Id(strategy="NONE") */
	private $userId;

	/**
     * @EmbedMany(
     *   discriminatorMap={
     *     "url"="User\Documents\UserBlock"
     *   }
     * )
     */
	private $blocks;
}