<?php
/**
 * 
 */

class articleManager_PDO extends articleManager
{
	protected $db;
	
	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	/**
	* @see articleManager::addArticle()
	*/
	public function addArticle(Article $article)
	{
		$request = $this->db->prepare('INSERT INTO article(idCategorie, image, details)
			VALUES (:id, :image, :details);');
		$request->bindValue(':id', $article->idCategorie());
		$request->bindValue(':image', $article->image());
		$request->bindValue(':details', $article->details());

		$request->execute();
	}

	/**
	* @see articleManager::updateArticle()
	*/
	public function updateArticle(Article $article)
	{
		$request = $this->db->prepare('UPDATE article SET idCategorie = :idCat, image = :image, details = :details WHERE idArticle = :id');
		$request->bindValue(':idCat', $article->idCategorie());
		$request->bindValue(':image', $article->image());
		$request->bindValue(':details', $article->details());
		$request->bindValue(':id', $article->idArticle());

		$request->execute();
	}

	/**
	* @see articleManager::deleteArticle()
	*/
	public function deleteArticle($id)
	{
		$this->db->exec('DELETE FROM article WHERE idArticle = '.(int) $id);
	}

	/**
	* @see articleManager::listArticles()
	*/
	public function listArticles($begin = -1, $end = -1)
	{
		$sql = 'SELECT idArticle, idCategorie, image, details FROM article';

		// On vérifie l'intégrité des paramètres fournis.
		if ($begin != -1 || $end != -1)
		{
			$sql .= ' LIMIT '.(int) $end.' OFFSET '.(int) $begin;
		}

		$request = $this->db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');
		$listArticle = $request->fetchAll();

		/*
		foreach ($listeDeDiscussions as $discuss)
		{
			$discuss->setDatedajout_discuss(new DateTime($discuss->datedajout_discuss()));
			$discuss->setDatemodif_discuss(new DateTime($discuss->datemodif_discuss()));
		}
		*/

		$request->closeCursor();

		return $listArticle;
	}
}