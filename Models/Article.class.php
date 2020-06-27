<?php
/**
 * La classe représentant un article
 */
class Article
{
	public $idArticle,
			$idCategorie,
			$image,
			$details;

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
	public function setIdArticle($id)
	{
		$this->idArticle = (int) $id;
	}

	public function setIdCategorie($id)
	{
		$this->idCategorie = (int) $id;
	}

	public function setImage($image)
	{
		$this->image = $image;
	}

	public function setDetails($details)
	{
		$this->details = $details;
	}

	//getters
	public function idArticle() { return $this->idArticle ; }
	public function idCategorie() { return $this->idCategorie ; }
	public function image() { return $this->image ; }
	public function details() { return $this->details ; }
}