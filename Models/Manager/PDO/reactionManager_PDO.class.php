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
	
}