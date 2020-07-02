<?php
/**
 * 
 */

class reactionManager_PDO extends reactionManager
{
	protected $db;
	
	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	/**
	* @see reactionManager::react()
	*/
	public function react(Reaction $react)
	{
		$request = $this->db->prepare('INSERT INTO reaction(idArticle, idClient, type)
			VALUES (:art, :cli, :type);');
		$request->bindValue(':art', $react->idArticle());
		$request->bindValue(':cli', $react->idClient());
		$request->bindValue(':type', $react->type());

		$request->execute();
	}

	/**
	* @see reactionManager::unReact()
	*/
	public function unReact($id)
	{
		$this->db->exec('DELETE FROM reaction WHERE idReaction = '.(int) $id);
	}
	/**
	* @see reactionManager::getUnique()
	*/
	public function getUnique($article, $client, $type)
	{
		$request = $this->db->prepare('SELECT idReaction, idArticle, idClient, type FROM reaction WHERE idArticle = :article and idClient = :client and type = :type');

		$request->bindValue(':article', (int) $article);
		$request->bindValue(':client', (int) $client);
		$request->bindValue(':type', $type);
		$request->execute();

		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Reaction');
		$react = $request->fetch();


		return $react;		
	}

	/**
	* @see reactionManager::getArticleReacts($client, $article)
	*/
	public function getArticleReacts($article, $client)
	{
		$request = $this->db->prepare('SELECT idReaction, idArticle, idClient, type FROM reaction WHERE idArticle = :article and idClient = :client');

		$request->bindValue(':article', (int) $article);
		$request->bindValue(':client', (int) $client);
		$request->execute();

		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Reaction');
		$reacts = $request->fetchAll();


		return $reacts;		
	}

	
}