function isConnected() {
	$.ajax({
		url: '../Controllers/connexionController.php',
		success: function(msg) {
			if(msg == 'CONNECTE'){
				$('.status').html('CONNECTE');
				$('#status-btn').removeClass('icofont-ban').addClass('icofont-close-circled');
				$('#status-btn').css('color', '#f00');
				$('#status-btn').attr('title', 'Se déconnecter');
				$('.status').css('color', '#0f0');
				if($('.status').hasClass('d-none'))
					$('.status').removeClass('d-none');

				//disable the login form adding a message with
				$('.connexion').removeClass('d-none');
				$('.connexion').css({
					color: '#0f0'
				});
				$('.connexion').html('Vous êtes connecté');
				$('#login-form input').attr('disabled', 'disabled');
			}
			else
			{
				$('.status').html('DECONNECTE');
				$('#status-btn').css('color', '#f00');
				$('#status-btn').removeClass('icofont-close-circled').addClass('icofont-check-ban');
				$('#status-btn').attr('title', 'déconnecté');
				if(!$('.status').hasClass('d-none'))
					$('.status').addClass('d-none');
			}
		}
	});
}
//Color the Logo 
function colorLogo() {
	setTimeout(function() {
		colors = ['#f00', '#0f0', '#00f','#ff0', '#f0f', '#0ff', '#ff007a']
		
		for (var i = 0; i < colors.length; i++) {
			$('#header .logo h2').animate({
				color : colors[i]
			}, 1500, 'linear');
		}

		colorLogo();
	}, 1000);

}

//Load a categorie's articles when it is selected
function reloadCategorie($categorie) {
	$.ajax({
		type : 'POST',
		url : '../Controllers/loadArticlesController.php',
		data : 'id='+$($categorie).children('option:selected').val(),
		success: function(msg) {
			//alert(msg);
			$('#products > div').remove();

			var $articles = JSON.parse(msg);
			if($articles.length == 0)
				location.reload();

			for (let i = 0; i < $articles.length;  i++) {

				var div = $('<div/>', {
					'class' : 'product',
					'data-aos' : 'flip-up',
					'data-aos-duration' : '2000',
				}).appendTo('#products');

				var img = $('<img/>', {
					'src' : '../assets/img/'+$articles[i].image,
					'class' : 'd-block',
				}).appendTo(div);

				addReactionBar($articles[i], div);

			}

		},
		error: function(erreur) {
			alert(erreur);
		}
	});
}
//Get reactions to an article
function getReactions(article, like, heart) {
	$.ajax({
		type: 'POST',
		url: '../Controllers/reactionController.php',
		data: 'article='+article.idArticle,
		success: function(msg) {
			if(msg == 'NOT_CONNECTED') {
				//non connnecter
			}else {
				let reactions = JSON.parse(msg);
				if(reactions.length == 2) {
					$(like).addClass('react');
					$(heart).addClass('react');
				}else if(reactions.length == 1) {
					$(eval(reactions[0].type)).addClass('react');
				}
			}
		}
	});
}

//Check if an object is empty
function isEmpty(obj) {
	for( key in obj) {
		if(obj.hasOwnProperty(key))
			return false;
	}
	return true;
}

//
function addReactionBar(article, place) {
	var divChild = $('<div/>', {
		'class' : 'article-text'
	}).appendTo(place);

	var linkLike = $('<a/>', {
		href: 'javascript:void(0)',
		type: 'like',
		onclick: 'react(this)',
		article: article.idArticle,
		categorie: article.idCategorie
	}).appendTo(divChild);

	var like = $('<i/>', {
		'class' : 'icofont-like'
	}).appendTo(linkLike);

	var linkHeart = $('<a/>', {
		href: 'javascript:void(0)',
		type: 'heart',
		onclick: 'react(this)',
		article: article.idArticle,
		categorie: article.idCategorie
	}).appendTo(divChild);

	var heart = $('<i/>', {
		'class' : 'icofont-heart'
	}).appendTo(linkHeart);

	if(!$('#gallerie').length) {
		
	
		var linkEye = $('<a/>', {
			href: '#view',
			class: 'scrollto',
			alt: article.idArticle
		}).appendTo(divChild);

		var eye = $('<i/>', {
			class: 'icofont-eye',
			onclick: 'showArticle(this)'
		}).appendTo(linkEye);
	}

	getReactions(article, like, heart);
}

//load all categories for home page
function loadCategories() {
	$.ajax({
		type : 'GET',
		url : '../Controllers/loadCategoriesController.php',
		success: function(msg) {
			let categories = JSON.parse(msg);

			for (var c = 0; c < categories.length; c++) {
				let j=c+1;
				let categorie = $('<h5/>', {
					class: 'categorie'
				}).text(categories[c].nameCategorie);

				let link = $('<a/>', {
					'href': 'categories.html',
				}).appendTo(categorie);


				let text = $('<span/>').text('Voir tous les produits').appendTo(link);
				let articleCategorie;


				$.ajax({
					type: 'POST',
					url : '../Controllers/loadArticlesController.php',
					data: 'id='+categories[c].idCategorie,
					success : function(message) {
						//get all the articles of our categorie
						let articles = JSON.parse(message);

						//check if there is articles in it
						if(articles.length != 0){
							categorie.appendTo('#gallerie');

							articleCategorie = $('<div/>', {
								class: 'articles-categorie bg-white',
								'data-aos': 'fade-in',
								'data-aos-duration': '1500'
							}).appendTo('#gallerie');

						}

						if(articles.length <= 4) {
							for (var i = 0; i < articles.length; i++) {
								let article = $('<div/>', {
									class: 'article w-40 h-40 d-none d-lg-block'
								}).appendTo(articleCategorie);

								let articleImage = $('<img/>', {
									src: '../assets/img/'+articles[i].image,
									class: 'd-block'
								}).appendTo(article);

								addReactionBar(articles[i], article);
							}
						}else {
							moreThanFourArticles(articles, articleCategorie, j);
						}

						//On mobile
						if(articles.length > 1) {
							let carousel = $('<div/>', {
								id: 'categorie-'+ j + '-item-mobile',
								class: 'carousel slide d-lg-none bg-white',
								'data-ride': 'carousel'
							}).appendTo(articleCategorie);

							let carouselInner = $('<div/>', {
								class: 'carousel-inner'
							}).appendTo(carousel);

							for (var i = 0; i < articles.length; i++) {
								if (i==0) { active = 'active'; }else{active = ''; }
								let carouselItem = $('<div/>', {
									class: 'carousel-item '+ active
								}).appendTo(carouselInner);

								let article = $('<div/>', {
									class: 'article w-40 h-40'
								}).appendTo(carouselItem);

								let articleImage = $('<img/>', {
									src: '../assets/img/'+articles[i].image,
									class: 'd-block'
								}).appendTo(article);

								addReactionBar(articles[i], article);
							}

							let prev = $('<a/>', {
								class: 'carousel-control-prev',
								href: '#categorie-'+ j + '-item-mobile',
								role: 'button',
								'data-slide': 'prev'
							}).appendTo(carousel);

							$('<span/>', {
								class: 'carousel-control-prev-icon preview rounded rounded-circle',
								'aria-hidden': 'true'
							}).appendTo(prev);

							$('<span/>', {
								class: 'sr-only'
							}).appendTo(prev);

							let next = $('<a/>', {
								class: 'carousel-control-next',
								href: '#categorie-'+ j + '-item-mobile',
								role: 'button',
								'data-slide': 'next'
							}).appendTo(carousel);

							$('<span/>', {
								class: 'carousel-control-next-icon preview rounded rounded-circle',
								'aria-hidden': 'true'
							}).appendTo(next);

							$('<span/>', {
								class: 'sr-only'
							}).appendTo(next);
						}else if(articles.length == 1) {
							let article = $('<div/>', {
								class: 'article w-40 h-40 d-lg-none'
							}).appendTo(articleCategorie);

							let articleImage = $('<img/>', {
								src: '../assets/img/'+articles[0].image,
								class: 'd-block'
							}).appendTo(article);

							addReactionBar(articles[0], article);
						}
					}
				});
			}
		}
	})
}

//Create a slide when number of article for a categorie is more than 4
function moreThanFourArticles(articles, articleCategorie, index) {
	let carousel = $('<div/>', {
		class: 'carousel slide d-lg-block d-none',
		'data-ride': 'carousel',
		id: 'categorie'+index+'-item'
	}).appendTo(articleCategorie);

	let carouselInner = $('<div/>', {
		class: 'carousel-inner'
	}).appendTo(carousel);

	for (var i = 0; i < Math.trunc(articles.length/4)+1; i++) {
		if (i==0) { active = 'active'; }else{active = ''; }
		let carouselItem = $('<div/>', {
			class: 'carousel-item '+ active
		}).appendTo(carouselInner);

		let flexItems = $('<div/>', {
			class: 'flex-items w-100'
		}).appendTo(carouselItem);

		
		for (var j = i*4; j < (i+1)*4; j++) {

			let article = $('<div/>', {
				class: 'article w-40 h-40'
			}).appendTo(flexItems);

			let articleImage = $('<img/>', {
				src: '../assets/img/'+articles[j % articles.length].image,
				class: 'd-block'
			}).appendTo(article);

			addReactionBar(articles[j % articles.length], article);
		}
	}

	let prev = $('<a/>', {
		class: 'carousel-control-prev',
		href: '#categorie'+index+'-item',
		role: 'button',
		'data-slide': 'prev'
	}).appendTo(carousel);

	$('<span/>', {
		class: 'carousel-control-prev-icon preview rounded rounded-circle',
		'aria-hidden': 'true'
	}).appendTo(prev);

	$('<span/>', {
		class: 'sr-only'
	}).appendTo(prev);

	let next = $('<a/>', {
		class: 'carousel-control-next',
		href: '#categorie'+index+'-item',
		role: 'button',
		'data-slide': 'next'
	}).appendTo(carousel);

	$('<span/>', {
		class: 'carousel-control-next-icon preview rounded rounded-circle',
		'aria-hidden': 'true'
	}).appendTo(next);

	$('<span/>', {
		class: 'sr-only'
	}).appendTo(next);
}

//Check if an input is valide
function checkValidity(element) {
	if(element.val().length < 4) {
		element.css({
			border: '1px groove #f00',
		});
		element.next().removeClass('d-none').hide();
		element.next().html('Il faut au moins 4 caractères')
		.css({color: '#f00', float: 'left'}).slideDown(1000);
		return false;
	}else {
		element.css({
			border: '1px groove #0f0',
		});
		element.next().addClass('d-none');
	}

	return true;
}

function react(element) {
	type = $(element).attr('type');
	article = $(element).attr('article');

	$.ajax({
		type: 'GET',
		url: '../Controllers/reactionController.php',
		data: 'type='+type+'&article='+article,
		success: function(msg) {
			if(msg == 'OK') {
				$(element).children().toggleClass('react');
				if(type == 'like') {
					$('#likeAudio')[0].play();
				}else {
					$('#heartAudio')[0].play();
				}
			}else if(msg == 'NOT_CONNECTED') {
				let scrollto = $('.sign').offset().top;

				$('html, body').animate({
					scrollTop: scrollto
				}, 1500, 'easeInOutExpo');
			}
		}
	});
}




function showArticle(eye) {
	let nameCategorie = $('.categorie-menu select').children('option:selected').html();
	let idArticle = $(eye).parent('a').attr('alt');


	$.ajax({
		type: 'POST',
		url : '../Controllers/loadArticlesController.php',
		data : 'showArt=' + idArticle,
		success : function(msg) {
			let article = JSON.parse(msg);
			console.log(article);
			$('#view .Categorie').html(nameCategorie);
			$('#view .details').html(article.details);
			$('#view img').attr('src', '../assets/img/'+article.image);
			$('#view .dateAjout').html(formatDate(article.dateAjout.date));
			$('#view .dateModif').html(formatDate(article.dateModif.date));
		}
	});
}

function formatDate(theDate) {
	theDate = new Date(theDate);

	let days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
	let months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre',
	'Octobre', 'Novembre', 'Decembre'];

	let stringDate = days[theDate.getDay()-1] + ' ' + theDate.getDate();
	stringDate += ' ' + months[theDate.getMonth()];
	stringDate += ' à ' + theDate.getHours() + 'h ' + theDate.getMinutes() + 'min';

	return stringDate;
}
