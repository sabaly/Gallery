<?php
/**
 * 
 */

class clientManager_PDO extends clientManager
{
	protected $db;
	
	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	/**
	* @see clientManager::subscribe()
	*/
	public function subscribe(Client $client)
	{
		$request = $this->db->prepare('INSERT INTO client(nameClient, psswdClient)
			VALUES (:name, :psswd);');
		$request->bindValue(':name', $client->nameClient());
		$request->bindValue(':psswd', $client->psswdClient());

		$request->execute();
	}

	/**
	* @see clientManager::getUnique()
	*/
	public function getUnique($pseudo)
	{
		$request = $this->db->prepare('SELECT idClient, nameClient, psswdClient FROM client WHERE idClient = :pseudo or nameClient = :pseudo');

		$request->bindValue(':pseudo', $pseudo);
		$request->execute();

		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Client');
		$client = $request->fetch();

		return $client;		
	}

	
}