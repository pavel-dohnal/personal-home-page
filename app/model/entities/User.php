<?php
/**
* @Entity @Table(name="users")
*/
class User implements \Nette\Security\IIdentity
{

	/**
	 * @Id @Column(type="integer") @GeneratedValue
	 * @var int
	 */
	private $id;

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $name;

	/**
	 * @Column(type="string", unique=true)
	 * @var string
	 */
	private $email;

	/**
	 * @Column(type="string", length=60)
	 * @var string
	 */
	private $password;

	/**
	 * @Column(type="datetime")
	 * @GeneratedValue
	 * @var DateTime
	 */
	private $created;

	/**
	 * @Column(type="datetime")
	 * @GeneratedValue
	 * @var DateTime
	 */
	private $updated;

	/**
	 * @param \Email email
	 * @param string password
	 */
	public function __construct(\Email $email, $password)
	{
		$this->email = (string)$email;
		$this->password = $password;
	}

	/**
	 * @param string name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @return DateTime
	 */
	public function getCreated()
	{
		return $this->created;
	}

	/**
	 * @return Updated
	 */
	public function getUpdated()
	{
		return $this->updated;
	}

	/**
	 * Returns a list of roles that the user is a member of.
	 * @return array
	 */
	public function getRoles()
	{
		return []; //we don't use roles in this project
	}
}