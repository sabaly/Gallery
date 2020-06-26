<?php
/**
 * 
 */

class categorieManager_PDO extends categorieManager
{
	protected $db;
	
	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	/**
	* @see Manager\categorieManager::addCategorie()
	*/
	public function addCategorie(Categorie $categorie)
	{
		$request = $this->db->prepare('INSERT INTO categorie(nameCategorie, describeCategorie)
			VALUES (:name, :describe); ');
		$request->bindValue(':name', $categorie->nameCategorie());
		$request->bindValue(':describe', $categorie->describeCategorie());

		$request->execute();
	}

	/**
	* @see Manager\categorieManager::updateCategorie()
	*/
	public function updateCategorie(Categorie $categorie)
	{
		$request = $this->db->prepare('UPDATE categorie SET nameCategorie = :name, describeCategorie = :describe WHERE idCategorie = :id');
		$request->bindValue(':name', $categorie->nameCategorie());
		$request->bindValue(':describe', $categorie->describeCategorie());
		$request->bindValue(':id', $categorie->idCategorie());

		$request->execute();
	}

	/**
	* @see Manager\categorieManager::deleteCategorie()
	*/
	public function deleteCategorie($id)
	{
		$this->db->exec('DELETE FROM categorie WHERE idCategorie = '.(int) $id);
	}

	/**
	* @see Manager\categorieManager::listCategories()
	*/
	public function listCategories($begin = -1, $end = -1)
	{
		$sql = 'SELECT idCategorie, nameCategorie, describeCategorie FROM categorie';

		// On vérifie l'intégrité des paramètres fournis.
		if ($begin != -1 || $end != -1)
		{
			$sql .= ' LIMIT '.(int) $end.' OFFSET '.(int) $begin;
		}

		$request = $this->db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Categorie');
		$listCategorie = $request->fetchAll();

		/*
		foreach ($listeDeDiscussions as $discuss)
		{
			$discuss->setDatedajout_discuss(new DateTime($discuss->datedajout_discuss()));
			$discuss->setDatemodif_discuss(new DateTime($discuss->datemodif_discuss()));
		}
		*/

		$request->closeCursor();

		return $listCategorie;
	}
}