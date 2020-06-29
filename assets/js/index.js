!(function($) {
	"use strict";


	$(document).on('click', '.nav-menu a, .scrollto', function(e) {
	      	e.preventDefault();

		    var target = $(this.hash);

		    if (target.length) {

		        var scrollto = target.offset().top;
		        var scrolled = 20;

		      	if ($('#header').length) {
		          scrollto -= $('#header').outerHeight()

		          if (!$('#header').hasClass('header-scrolled')) {
		            scrollto += scrolled;
		          }
		        }

		        if ($(this).attr("href") == '#header') {
		          scrollto = 0;
		        }

		        $('html, body').animate({
		          scrollTop: scrollto
		        }, 1500, 'easeInOutExpo');

		        return false;
		    } else {
		    	if($(this).attr('href') != undefined)
		    		location.assign($(this).attr('href'));
		    }
	  });

	//Load categories and articles
	loadCategories();

	// Toggle .header-scrolled class to #header when page is scrolled
	$(window).scroll(function() {
	    if ($(this).scrollTop() > 100) {
	      $('#header').addClass('header-scrolled');
	    } else {
	      $('#header').removeClass('header-scrolled');
	    }
	});

	//Animating the header logo
	colorLogo();

	//Navigation
	if($('.menu').length) {
		var $nav = $('.menu').clone().prop({
			class: 'nav-menu rounded rounded-circle'
		});

		$('body main').append($nav);
		$('body main').append('<div class="nav-overly"></div>');

	    $(document).on('click', '.menu-toggle', function(e) {
	        $('body main').toggleClass('nav-active');
	        $('.nav-active .nav-menu').fadeIn(1500);
	        $('.menu-toggle i').toggleClass('icofont-navigation-menu icofont-close');
	        $('.menu-toggle i').css('color', 'red');
	        $('.nav-overly').toggle();
	    });

	    $(document).click(function(e) {
	        var container = $(".menu-toggle, .nav-menu");
	        if (!container.is(e.target) && container.has(e.target).length === 0) {
		        if ($('body main').hasClass('nav-active')) {
			        $('body main').removeClass('nav-active');
			        $('.menu-toggle i').toggleClass('icofont-navigation-menu icofont-close');
			        $('.menu-toggle i').css('color', '#ff007a');
	        		$('.nav-overly').fadeOut(1000);
		        }
	      	}
	    });

	}else if ($(".menu, .menu-toggle").length) {
	    $(".menu, .menu-toggle").hide();
	}

	// Back to top button
	$(window).scroll(function() {
		if ($(this).scrollTop() > 100) {
	      $('.back-to-top').fadeIn('slow');
	    } else {
	      $('.back-to-top').fadeOut('slow');
	    }
	});

	$('.back-to-top').click(function() {
	    $('html, body').animate({
	      scrollTop: 0
	    }, 1500, 'easeInOutExpo');
	    return false;
	});

	//research input
	$(document).on('click', '#search-btn', function(e) {
		$('#header .search-input input').attr('type', 'text').hide();
		$('#header .search-input input').fadeIn(2000);

		$(document).on('click', function(e){
			var container = $("#search-btn, #header .search-input input");
	        if (!container.is(e.target) && container.has(e.target).length === 0) {
		        if ($('#header .search-input input').attr('type') == 'text') {
			        $('#header .search-input input').attr('type', 'hidden');
			        $('#header .search-input input').fadeToggle(2000);
		        }
	      	}
	      });
	});

	/*
		page categorie
	*/
	if($(".categorie-menu select").length)
		reloadCategorie($(".categorie-menu select"));

})(jQuery);

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

function reloadCategorie($categorie) {
	$.ajax({
		type : 'POST',
		url : '../Controllers/loadArticlesController.php',
		data : 'id='+$($categorie).children('option:selected').val(),
		success: function(msg) {
			//alert(msg);
			$('#products > div').remove();

			var $articles = JSON.parse(msg);
			if(isEmpty($articles))
				location.reload();

			for (key in $articles) {
				let $article = JSON.parse($articles[key]);
				var div = $('<div/>', {
					'class' : 'product',
					'data-aos' : 'flip-up',
					'data-aos-duration' : '2000',
				}).appendTo('#products');

				var img = $('<img/>', {
					'src' : '../assets/img/'+$article.image,
					'class' : 'd-block',
				}).appendTo(div);

				var divChild = $('<div/>', {
					'class' : 'article-text'
				}).appendTo(div);

				var like = $('<i/>', {
					'class' : 'icofont-like'
				}).appendTo(divChild);

				var heart = $('<i/>', {
					'class' : 'icofont-heart'
				}).appendTo(divChild);

				var eye = $('<i/>', {
					'class' : 'icofont-eye'
				}).appendTo(divChild);
			}

		},
		error: function(erreur) {
			alert(erreur);
		}
	});
}



function isEmpty(obj) {
	for( key in obj) {
		if(obj.hasOwnProperty(key))
			return false;
	}
	return true;
}

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
					'href': 'categorie.php',
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
							}

							
						}else {
							//moreThanFourArticles(articles, articleCategorie, j);
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
						}
					}
				});
			}
		}
	})
}

function moreThanFourArticles(articles, articleCategorie, index) {
	let carousel = $('<div/>', {
		class: 'carousel slide d-lg-block d-none',
		'data-ride': 'slide',
		id: 'categorie'+index+'-item'
	}).appendTo(articleCategorie);

	let carouselInner = $('<div/>', {
		class: 'carousel-inner'
	}).appendTo(carousel);

	for (var i = 0; i < Math.trunc(articles.length/4)+1; i++) {
		let carouselItem = $('<div/>', {
			class: 'carousel-item',
		}).appendTo(carouselInner);

		let flexItems = $('<div/>', {
			class: 'flex-items w-100'
		}).appendTo(carouselItem);

		let k;
		
		for (var j = i*4; j < (i+1)*4; j++) {
			if(j >= articles.length)
				k = j % articles.length;

			let article = $('<div/>', {
				class: 'article w-40 h-40'
			}).appendTo(flexItems);

			let articleImage = $('<img/>', {
				src: '../assets/img/'+articles[k].image,
				class: 'd-block'
			}).appendTo(article);
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
