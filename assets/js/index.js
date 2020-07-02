!(function($) {
	"use strict";

	isConnected();

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

	


	/*
		submit forms for inscription or connexion
	*/
	//signin form
	$('#signin-form').submit(function(e) {
		e.preventDefault();
		$('.identifiant').addClass('error');
		/* 		Regles de validité */
		if (!checkValidity($('.identifiant')) || !checkValidity($('.psswd')))
			return false;
		if($('.psswd-conf').val() != $('.psswd').val()) {
			$('.psswd-conf').css({
				border: '1px groove #f00'
			});
			return false;
		}else {
			$('.psswd-conf').css({
				border: '1px groove #0f0'
			});
		}

		$.ajax({
			type: 'GET',
			url: '../Controllers/subscribeFormController.php',
			data: $(this).serialize(),
			success: function(msg) {
				
				if(msg == 'SUBSCRIBED') {
					$('.pseudo').val($('.identifiant').val());
					$('#signin-form')[0].reset();
					$('#signin-form input').css({
						border: '1px solid rgba(255, 0, 122, 0.3)'
					});
				}
			}
		});
	});

	//login form
	$('#login-form, #catlogin-form').submit(function(e) {
		e.preventDefault();

		$.ajax({
			type: 'GET',
			url: '../Controllers/loginFormController.php',
			data: $(this).serialize(),
			success: function(msg) {
				if(msg == 'OK') {
					$('html, body').animate({
						scrollTop: 0 
					}, 1500, 'easeInOutExpo', function() {
						location.reload();
					});

				}else if(msg == 'NOT_EXISTS') {
					$('.connexion').removeClass('d-none').hide();
					$('.connexion').html('Créer un compte').slideDown(1000);
					$('.identifiant').css({
						border: '1px groove #f00'
					});
				}else if(msg == 'ERROR_PSSWD') {
					$('.connexion').removeClass('d-none').hide();
					$('.connexion').html('Mot de passe incorrecte').slideDown(1000);
				}
			}
		});
	});
	/*
		Disconnect button
	*/
	$('#status-btn').click(function(e) {
		$.ajax({
			type: 'GET',
			url: '../Controllers/connexionController.php',
			data: 'end=1',
			success: function(msg) {
				isConnected();
				location.reload();
			}
		});
	});

	/*
		Fill option on categories select
	*/
	$.ajax({
		type: 'GET',
		url: '../Controllers/loadCategoriesController.php',
		success: function(msg) {
			let categories = JSON.parse(msg);

			if(categories.length != 0) {
				for(var i=0; i < categories.length; i++) {
					$('<option/>', {
						value: categories[i].idCategorie
					}).html(categories[i].nameCategorie).appendTo('.categorie-menu select');
				}
			}
		},
		complete: function() {
			if($(".categorie-menu select").length)
				reloadCategorie($(".categorie-menu select"));
		}
	});

	//Load categories and articles
	loadCategories();

})(jQuery);
