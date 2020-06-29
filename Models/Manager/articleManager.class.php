<?php
/**
 * 
 */
abstract class articleManager
{
	/*
		On définit ici les différentes actions en rapport avec les articles
	*/
	abstract protected function addArticle(Article $article);
	abstract protected function updateArticle(Article $article);
	abstract protected function deleteArticle($id);
	abstract protected function listArticles($begin = -1 , $end = -1);
	abstract protected function listArticlesOfCategorie($idCategorie);
	abstract protected function getUnique($id);
}