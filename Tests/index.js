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
