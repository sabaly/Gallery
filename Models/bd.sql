/*
	Suppression de la base de données en cas d'éxistance
*/
DROP DATABASE IF EXISTS salmy_db;

/*
	(re) création de la base de données
*/
CREATE DATABASE salmy_db;

/*
	Utilisation de la base de données
*/
USE salmy_db;

/*
	La table catégorie  
*/
CREATE TABLE categorie
(
	idCategorie 				integer 			not null auto_increment,
	nameCategorie 				char(150) 			not null,
	describeCategorie 			long varchar 			null,
	constraint pk_categorie primary key (idCategorie)
);

/*
	La table article
*/
CREATE TABLE article
(
	idArticle 					integer 			not null auto_increment,
	idCategorie 				integer				not null,
	image						char(255)			not null,
	details 					long varchar 			null,
	constraint pk_article primary key(idArticle)
);

/*
	La table client
*/
CREATE TABLE client
(
	idClient 					integer 			not null auto_increment,
	nameClient 					char(150) 			not null,
	psswdClient 				char(100) 			not null,
	constraint pk_client primary key (idClient)
);

/*
	Admins table
*/
CREATE TABLE admin
(
	idAdmin 					integer 			not null auto_increment,
	pseudo 					char(150) 			not null,
	password 				char(100) 			not null,
	constraint pk_admin primary key (idAdmin)
);

/*
	La table reaction
*/
CREATE TABLE reaction
(
	idReaction 					integer 			not null auto_increment,
	idArticle 					integer 			not null,
	idClient 					integer 			not null,
	type 						char(100) 			not null,
	constraint pk_reaction primary key (idReaction)
);
/*
	Ajout des clefs étrangeres
*/

ALTER TABLE article
	ADD CONSTRAINT fk_article_belong_categorie FOREIGN KEY (idCategorie)
		REFERENCES categorie (idCategorie)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT;


ALTER TABLE reaction
	ADD CONSTRAINT fk_reaction_belong_article FOREIGN KEY (idArticle)
		REFERENCES article (idArticle)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT;


ALTER TABLE reaction
	ADD CONSTRAINT fk_reaction_belong_client FOREIGN KEY (idClient)
		REFERENCES client (idClient)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT;

