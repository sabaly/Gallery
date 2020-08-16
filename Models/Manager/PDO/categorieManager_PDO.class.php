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
		$request = $this->db->prepare('INSERT INTO categorie(nameCategorie, describeCategorie, dateAjout, dateModif)
			VALUES (:name, :describe, NOW(), NOW()); ');
		$request->bindValue(':name', $categorie->nameCategorie());
		$request->bindValue(':describe', $categorie->describeCategorie());

		$request->execute();
	}

	/**
	* @see Manager\categorieManager::updateCategorie()
	*/
	public function updateCategorie(Categorie $categorie)
	{
		$request = $this->db->prepare('UPDATE categorie SET nameCategorie = :name, describeCategorie = :describe, dateModif = NOW() WHERE idCategorie = :id');
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
		$sql = 'SELECT idCategorie, nameCategorie, describeCategorie, dateAjout, dateModif FROM categorie';

		// On vérifie l'intégrité des paramètres fournis.
		if ($begin != -1 || $end != -1)
		{
			$sql .= ' LIMIT '.(int) $end.' OFFSET '.(int) $begin;
		}

		$request = $this->db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Categorie');
		$listCategorie = $request->fetchAll();

		
		foreach ($listCategorie as $categorie)
		{
			$categorie->setDateAjout(new DateTime($categorie->dateAjout()));
			$categorie->setDateModif(new DateTime($categorie->dateModif()));
		}
		

		$request->closeCursor();

		return $listCategorie;
	}

	/**
	* @see Manager\categorieManager::getUnique()
	*/

	public function getUnique($id)
	{
		$sql = 'SELECT idCategorie, nameCategorie, describeCategorie, dateAjout, dateModif FROM categorie WHERE idCategorie = :id';
		$request = $this->db->prepare($sql);
		$request->bindValue(':id', (int) $id);
		$request->execute();

		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Categorie');
		$categorie = $request->fetch();

		
		$categorie->setDateAjout(new DateTime($categorie->dateAjout()));
		$categorie->setdateModif(new DateTime($categorie->dateModif()));
		
		if(is_bool($categorie))
			return false;

		$request->closeCursor();

		return $categorie;
	}
}