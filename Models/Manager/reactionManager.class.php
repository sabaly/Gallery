<?php
/**
 * 
 */
abstract class reactionManager
{
	
	/*
		On définit ici les différentes actions en rapport avec les clients
	*/
	abstract protected function react(Reaction $reaction);
	abstract protected function unReact(Reaction $reaction);
	abstract protected function getUnique($client, $article, $type);
	abstract protected function getArticleReacts($client, $article);
}