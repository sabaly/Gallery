<?php
/**
*
 */
abstract class categorieManager
{
	/*
		On définit ici les différentes actions en rapport avec les catégories
	*/
	abstract protected function addCategorie(Categorie $categorie);
	abstract protected function updateCategorie(Categorie $categorie);
	abstract protected function deleteCategorie($id);
	abstract protected function listCategories($begin = -1 , $end = -1);
	abstract protected function getUnique($id);
}