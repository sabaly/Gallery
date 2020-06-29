<?php
/**
 * La classe représentant une reaction
 */
class Reaction
{

	public $idReaction,
			$idArticle,
			$idClient,
			$type;
	
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
	public function setIdReaction($id)
	{
		$this->idReaction = (int) $id;
	}

	public function setIdArticle($art)
	{
		$this->idArticle = (int) $art;
	}

	public function setIdClient($cli)
	{
		$this->idClient = (int) $cli;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	//getters
	public function idReaction() { return $this->idReaction ; }
	public function idArticle() { return $this->idArticle ; }
	public function idClient() { return $this->idClient ; }
	public function type() { return $this->type ; }
}