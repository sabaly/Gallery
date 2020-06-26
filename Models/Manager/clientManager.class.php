<?php
/**
 * 
 */
abstract class clientManager
{
	
	/*
		On définit ici les différentes actions en rapport avec les clients
	*/
	abstract protected function subscribe(Client $client);
	//abstract protected function updateClient(Client $client);
	//abstract protected function deleteArticle($id);
	//abstract protected function listArticles($begin = -1 , $end = -1);
	abstract public function getUnique($pseudo);
}