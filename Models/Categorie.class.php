<?php
/**
 * La classe representant une catégorie
 * @author : S@dmin;
 */
class Categorie
{
	public $idCategorie,
			$nameCategorie,
			$describeCategorie;
	
	function __construct($data = [])
	{
		if(!empty($data))
		{
			$this->hydrate($data);
		}
	}

	//function to hydrate object
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

	//Check if it's new
	function isNew()
	{
		return empty($this->idCategorie);
	}

	//setters
	public function setIdCategorie($id)
	{
		$this->idCategorie = $id;
	}

	public function setNameCategorie($name)
	{
		$this->nameCategorie = $name;
	}

	public function setDescribeCategorie($describe)
	{
		$this->describeCategorie = $describe;
	}

	//getters
	public function idCategorie() { return $this->idCategorie; }
	public function nameCategorie() { return $this->nameCategorie; }
	public function describeCategorie() { return $this->describeCategorie; }
}