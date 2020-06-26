<?php
/**
 * La classe représentant un client
 */
class Client
{
	private $idClient,
			$nameClient,
			$psswdClient;
	
	function __construct($data = [])
	{
		if(!empty($data))
		{
			$this->hydrate($data);
		}
	}

	//fonction pour hydrater un objet
	public function hydrate($data)
	{
		foreach ($data as $attribut => $value)
		{
			$methode = 'set'.ucfirst($attribut);
			if (is_callable([$this, $methode]))
			{
				$this->$methode($value);
			}
		}
	}

	//setters
	public function setIdClient($id)
	{
		$this->idClient = (int) $id;
	}

	public function setNameclient($name)
	{
		$this->nameClient = $name ; 
	}

	public function setPsswdClient($psswd)
	{
		$this->psswdClient = $psswd ; 
	}

	//getters
	public function idClient() { return $this->idClient ; }
	public function nameClient() { return $this->nameClient ; }
	public function psswdClient() { return $this->psswdClient ; }
}