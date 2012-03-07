$(document).ready(function(){
	var scrollAnimations = [];

	// sliders

	$('.ipad .bullets a').click(function(event){
		event.preventDefault();
		showSlide($(this).index(),{
			'display': $(this).parent().parent().find('.ipad-screen img'),
			'nav': $(this).parent().find('a')
		});
	});

	$('.cinema .bullets a').click(function(event){
		event.preventDefault();
		showSlide($(this).index(),{
			'display': $(this).parent().parent().find('.cinema-screen img'),
			'nav': $(this).parent().find('a')
		});
	});

	var autoSlideTimer = null;

	var nextSlide = function(options){
		var display = options.display;
		if (options.transition && options.transition === 'fade') {
			index = options.display.has(':visible').index()+1;
			if (index+1 > options.display.length) index = 0;
		} else {
			var elemSize = display.parent().width();
			var length = Math.round(display.width()/elemSize);

			cIndex = (-display.position().left)/elemSize;
			if (cIndex >= length-1) {
				index = 0;
			} else {
				index = cIndex+1;
			}
		}
		
		showSlide(index, options);
	};

	var showSlide = function(index,options){
		if (options.transition && options.transition === 'fade') {
			// ugly solution, redo sometime
			for (i=0;i<options.display.length;i++) {
				if (i==index) continue;
				$(options.display[i]).stop(true,true).fadeOut();
				$(awardsTexts[i]).stop(true,true).fadeOut();
			}
			$(options.display[index]).stop(true,true).fadeIn((options.isAuto) ? 1000 : 300);
			$(awardsTexts[index]).stop(true,true).fadeIn((options.isAuto) ? 1000 : 300);
		} else {
			var elemSize = options.display.parent().width();
			options.display.stop().animate({
				'left': -(elemSize*(index))+'px'
			},{
				'duration': (options.isAuto) ? 1000 : 300,
				'complete': options.callback,
				'nav': options.nav
			});
		}
		if (options.nav) {
			$(options.nav).removeClass('active');
			$(options.nav[index]).addClass('active');
		}
		
		clearTimeout(autoSlideTimer);
		options.isAuto = true;
		
		autoSlideTimer = setTimeout(function(){
			nextSlide(options);
		},(options.transition && options.transition === 'fade') ? 4000 : 2500);
	};

	var cScrolltop;
	var cSubpage;
	var lastDirection;
	function displaySubpage(page, direction) {
		if (cSubpage) return false;
		cScrolltop = $(window).scrollTop();
		lastDirection = direction;
		cSubpage = page;
		$('.top:first').stop().animate({
			'left': (direction === 0) ? '-100%' : '100%'
		},400);
		page.stop().animate({
			'left': '0%'
		}, 400);
	}
	function hideSubpage() {
		if (!cSubpage) return false;
		$('.top:first').stop().animate({
			'left': '0%'
		}, 400);
		cSubpage.stop().animate({
			left: (lastDirection === 0) ? '100%' : '-100%'
		}, 400);
		cSubpage = null;
	}


	$('.back-button').click(function(){
		hideSubpage();
		return false;
	});

	// home
	var homePage = $('#home');
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (scrollTop < 1500) {
				homePage.css('background-position', '100% ' + -scrollTop*0.4+'px');
			}
		}
	});

	// reference / SELECTED

	//  BG
	var selectedPage = $('#ref-selected');
	var selectedPageInit = true;
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (selectedPageInit === false && scrollTop < 500) {
				selectedPage.css('background-position', '50% 0');
				selectedPageInit = true;
			} else if (scrollTop < 3300) {
				selectedPage.css('background-position', '50% ' + -(scrollTop-500)*0.25+'px');
				selectedPageInit = false;
			}
		}
	});
	// content
	var fixedSelected = $('#fixed-selected');
	var fixedSelectedState = 0;
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (scrollTop < 850 && fixedSelectedState !== 0) {
				fixedSelected.css({
					'margin-top': '200px',
					'top': '100%'
				});
				fixedSelectedState = 0;
			} else if (scrollTop >= 850 && scrollTop < 1560) {
				fixedSelected.css({
					'margin-top': 200+(-(scrollTop-850)*(200/200))+'px',
					'top': '50%'
				});
				fixedSelectedState = 1;
			} else if (scrollTop >= 1560 && fixedSelectedState !== 2) {
				fixedSelected.css({
					'margin-top': '-510px'
				});
				fixedSelectedState = 2;
			}
		}
	});
	// sub content
	var selectedIpad = $(this).find('#ref-selected .ipad-screen img');
	var selectedIpadBullets = $(this).find('#ref-selected .ipad .bullets a');
	$('#ref-selected .next-button').click(function(){
		displaySubpage($('#ref-selected .subpage'),0);
		showSlide(0, {
			'display': selectedIpad,
			'nav': selectedIpadBullets
		});
		return false;
	});

	// reference / Le Management

	// reference / Le Management / BG
	var lemanagementPage = $('#ref-lemanagement');
	scrollAnimations.push({
		'start': 2400,
		'end': null,
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			lemanagementPage.css('background-position', '100% ' + -(scrollTop-2400)*0.4+'px');
		}
	});

	// reference / Le Management / sub content
	var lemanagementIpad = lemanagementPage.find('.cinema-screen img');
	var lemanagementIpadBullets = lemanagementPage.find('.cinema .bullets a');
	lemanagementPage.find('.next-button').click(function(){
		displaySubpage(lemanagementPage.find('.subpage'),0);
		showSlide(0, {
			'display': lemanagementIpad,
			'nav': lemanagementIpadBullets
		});
		return false;
	});

	// reference / Outfitters
	var outfittersPage = $('#ref-outfitters');
	var outfittersIphones = $('#iphones-outfitters');
	scrollAnimations.push({
		'start': 4500,
		'end': null,
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			outfittersPage.css('background-position', '50% ' + -(scrollTop-4500)*0.3+'px');
		}
	});
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (scrollTop <= 5000){
				outfittersIphones.css('margin-top',0);
			} else if (scrollTop > 5000){
				outfittersIphones.css('margin-top',0 + -(scrollTop-5000)*0.6 + 'px');
			}
		}
	});

	// reference / Outfitters / sub content
	var outfittersIpad = outfittersPage.find('.cinema-screen img');
	var outfittersIpadBullets = outfittersPage.find('.cinema .bullets a');
	outfittersPage.find('.next-button').click(function(){
		displaySubpage(outfittersPage.find('.subpage'),0);
		showSlide(0, {
			'display': outfittersIpad,
			'nav': outfittersIpadBullets
		});
		return false;
	});

	// reference / Just Female
	var just = $('#just');
	var second = $('#second');
	scrollAnimations.push({
		'start': 6400,
		'end': null,
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			just.css('background-position', '0% ' + -(scrollTop-6400)*0.4+'px');
		}
	});
	scrollAnimations.push({
		'start': 6400,
		'end': null,
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			second.css('background-position', '100% ' + -(scrollTop-6400)*0.4+'px');
		}
	});
	var iphoneJust = $('.iphone-hand-just');
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (scrollTop < 7000) {
				iphoneJust.css({
					'margin-bottom': '-579px'
				});
			} else if (scrollTop >= 7000 && scrollTop < 7700) {
				iphoneJust.css({
					'margin-bottom': -579+(-(scrollTop-7000)*(-579/700))+'px'
				});
			} else if (scrollTop > 7700) {
				iphoneJust.css({
					'margin-bottom': '0px'
				});
			}
			if (scrollTop < 7000) {
				iphoneJust.css({
					'margin-left': '-651px'
				});
			} else if (scrollTop >= 7000) {
				iphoneJust.css({
					'margin-left': -621+((scrollTop-7000)*(-621/2000))+'px'
				});
			}
		}
	});
	var justCinema = just.find('#just-cinema div.cinema-screen img:first');
	var justCinemaBullets = just.find('#just-cinema div.bullets a');
	just.find('.next-button').click(function(){
		displaySubpage(just.find('.subpage'),1);
		showSlide(0, {
			'display': justCinema,
			'nav': justCinemaBullets
		});
		return false;
	});
	var iphoneSecond = $('.iphone-hand-second');
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (scrollTop < 7000) {
				iphoneSecond.css({
					'margin-bottom': '-579px'
				});
			} else if (scrollTop >= 7000 && scrollTop < 7700) {
				iphoneSecond.css({
					'margin-bottom': -579+(-(scrollTop-7000)*(-579/700))+'px'
				});
			} else if (scrollTop > 7700) {
				iphoneSecond.css({
					'margin-bottom': '0px'
				});
			}
			if (scrollTop < 7000) {
				iphoneSecond.css({
					'margin-right': '-651px'
				});
			} else if (scrollTop >= 7000) {
				iphoneSecond.css({
					'margin-right': -621+((scrollTop-7000)*(-621/2000))+'px'
				});
			}
		}
	});
	var secondCinema = second.find('#second-cinema div.cinema-screen img:first');
	var secondCinemaBullets = second.find('#second-cinema div.bullets a');
	second.find('.next-button').click(function(){
		displaySubpage(second.find('.subpage'),0);
		showSlide(0, {
			'display': secondCinema,
			'nav': secondCinemaBullets
		});
		return false;
	});

	// reference / Lykke SKO
	var lykkesko = $('#ref-lykkesko');
	var lykkeskoShoes = lykkesko.find('.shoes-lykkesko');
	var lykkeskoIphone = $('.iphone-lykkesko');
	var fixedLykkesko = $('#fixed-lykkesko');
	var fixedLykkeskoState = 0;
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (scrollTop < 8500 && fixedLykkeskoState !== 0) {
				fixedLykkesko.css({
					'margin-top': '200px',
					'top': '100%'
				});
				fixedLykkeskoState = 0;
			} else if (scrollTop >= 8500 && scrollTop < 9110) {
				fixedLykkesko.css({
					'margin-top': 200+(-(scrollTop-8500)*(200/200))+'px',
					'top': '50%'
				});
				fixedLykkeskoState = 1;
			} else if (scrollTop >= 9110 && fixedLykkeskoState !== 2) {
				fixedLykkesko.css({
					'margin-top': '-410px'
				});
				fixedLykkeskoState = 2;
			}
		}
	});
	scrollAnimations.push({
		'start': 8000,
		'end': null,
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			lykkesko.css('background-position', '0% ' + -(scrollTop-8000)*0.3+'px');
		}
	});
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (scrollTop <= 8500){
				lykkeskoShoes.css('margin-top',0);
			} else if (scrollTop > 8500){
				lykkeskoShoes.css('margin-top',0 + -(scrollTop-8500)*0.35 + 'px');
			}
		}
	});
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (scrollTop <= 8200){
				lykkeskoIphone.css('margin-top',0);
			} else if (scrollTop > 8200){
				lykkeskoIphone.css('margin-top',0 + -(scrollTop-8200)*0.6 + 'px');
			}
		}
	});
	var lykkeskoCinema = lykkesko.find('#lykkesko-cinema div.cinema-screen img:first');
	var lykkeskoCinameBullets = lykkesko.find('#lykkesko-cinema div.bullets a');
	lykkesko.find('.next-button').click(function(){
		displaySubpage(lykkesko.find('.subpage'),0);
		showSlide(0, {
			'display': lykkeskoCinema,
			'nav': lykkeskoCinameBullets
		});
		return false;
	});

	// FACTS 
	var factsPage = $('#facts-page');
	scrollAnimations.push({
		'start': 11200,
		'end': null,
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			factsPage.css('background-position', '0% ' + -(scrollTop-11200)*0.20+'px');
		}
	});

	var s = document.body.style;
	if (s.transform !== undefined ||
        s.WebkitTransform !== undefined ||
        s.MozTransform !== undefined ||
        s.OTransform !== undefined) {

		var circle = $('div.circle');
		var chart = $('#pie');
		var cDegrees = 180;
		var isShown = false;
		function pie(degrees) {
			if (cDegrees === degrees) return;
			jQuery({'deg': cDegrees}).stop().animate({'deg': degrees},{
				'duration': 100,
				'step': function(now, fx){
					chart.css({
						'-webkit-transform': 'rotate('+now+'deg)',
						'-moz-transform': 'rotate('+now+'deg)',
						'-o-transform': 'rotate('+now+'deg)',
						'transform': 'rotate('+now+'deg)'
					});
					cDegrees = now;
				}
			});
		}
	}
	
	var degrees = 180;
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			var offset = 400-(scrollBottom-scrollTop)/2;

			if (scrollTop < 12200+offset && isShown) {
				circle.fadeOut(200);
				isShown = false;
			} else if (scrollTop >= 12200+offset && scrollTop < 14800+offset && !isShown) {
				circle.fadeIn(200);
				isShown = true;
			} else if (scrollTop >= 14800 && isShown) {
				circle.fadeOut(200);
				isShown = false;
			}

			if (scrollTop < 12350+offset) {
				pie(180);
			} else if (scrollTop >= 12350+offset && scrollTop < 12750+offset) {
				pie(104);
			} else if (scrollTop >= 12750+offset && scrollTop < 13150+offset) {
				pie(0);
			} else if (scrollTop >= 13150+offset && scrollTop < 13550+offset) {
				pie(112);
			} else if (scrollTop >= 13550+offset && scrollTop < 13950+offset) {
				pie(47);
			} else if (scrollTop >= 13950+offset && scrollTop < 14350+offset) {
				pie(162);
			} else if (scrollTop >= 14350+offset && scrollTop < 14750+offset) {
				pie(25);
			} else {
				pie(180);
			}
		}
	});


	// OM INZEIT 
	var about = $('#about');

	var awardsPhones = about.find('.awards-iphone a');
	var awardsTexts = about.find('.container .award');
	var awardsBullets = about.find('.awards-content .bullets a');
	about.find('.next-button').click(function(){
		displaySubpage(about.find('.subpage'),0);
		showSlide(0, {
			'display': awardsPhones,
			'nav': awardsBullets,
			'transition': 'fade'
		});
		return false;
	});

	$('.awards-content .bullets').click(function(event){
		event.preventDefault();
		showSlide($(event.target).closest('a').index(),{
			'display': awardsPhones,
			'nav': awardsBullets,
			'transition': 'fade'
		});
	});

	// contact
	/*var contact = $('#contact');
	scrollAnimations.push({
		'start': 14000,
		'end': null,
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			contact.css('background-position', '50% ' + -(scrollTop-14000)*0.25+'px');
		}
	});*/
	var moon = $('#moon');
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (scrollTop <= 15700){
				moon.css('margin-top',0);
			} else if (scrollTop > 15700){
				moon.css('margin-top',0 + -(scrollTop-15700)*0.5 + 'px');
			}
		}
	});


////// Overlay
	var demos = [
		['http://m.selected.com', 'SELECTED mobile website', 'Try the solution for yourself by visting www.selected.com from your smartphone, or try it from the device on the left.'],
		['http://m.lemanagement.dk', 'Le Management mobile website', 'Try the solution for yourself by visting www.lemanagement.dk from your smartphone, or try it from the device on the left.']
	];
	$('.demo').click(function(){
		demoId = $(this).data('demo-index');
		console.log(demos[demoId][0]);
		$('#demo-iframe').attr('src',demos[demoId][0]);
		$('#demo-title').text(demos[demoId][1]);
		$('#demo-text').text(demos[demoId][2]);
		$('#overlay').fadeIn();
		return false;
	});
	$('.close').click(function(){
		$('#overlay').fadeOut();
		return false;
	});


////// Devices
	
	// iPhone Selected
	var iphoneSelected = $('.iphone.selected');
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (scrollTop < 800) {
				iphoneSelected.css({
					'top': '100%',
					'margin-top': '0'
				});
			} else if (scrollTop >= 800 && scrollTop < 1187) {
				iphoneSelected.css({
					'top': 100-((scrollTop-800)*(40/387))+'%',
					'margin-top': -((scrollTop-800)*(294/387))+'px'
				});
			} else if (scrollTop >= 1187 && scrollTop < 2540){
				iphoneSelected.css({
					'top': 60-((scrollTop-1187)*(15/1453))+'%',
					'margin-top': '-294px'
				});
			} else if (scrollTop >= 2540 && scrollTop < 3500){
				iphoneSelected.css({
					'top': 45-((scrollTop-2540)*(45/360))+'%'
				});
			}
		}
	});
	// images Selected
	var iphoneSelectedImages = $('.iphone.selected .images');
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (scrollTop < 1600) {
				iphoneSelectedImages.css({
					'background-position': '0 0'
				});
			} else if (scrollTop >= 1600 && scrollTop < 1800) {
				iphoneSelectedImages.css({
					'background-position': (scrollTop-1600)*(-256/200)+'px 0'
				});
			} else if (scrollTop >= 1800 && scrollTop < 2000) {
				iphoneSelectedImages.css({
					'background-position': (-256)+'px 0'
				});
			} else if (scrollTop >= 2000 && scrollTop < 2200) {
				iphoneSelectedImages.css({
					'background-position': (scrollTop-2000)*(-256/200)-256+'px 0'
				});
			} else if (scrollTop >= 2200 && scrollTop < 2400) {
				iphoneSelectedImages.css({
					'background-position': (-2*256)+'px 0'
				});
			} else if (scrollTop >= 2400 && scrollTop < 2600) {
				iphoneSelectedImages.css({
					'background-position': (scrollTop-2400)*(-256/200)-(2*256)+'px 0'
				});
			} else if (scrollTop >= 2600 && scrollTop < 2800) {
				iphoneSelectedImages.css({
					'background-position': (-3*256)+'px 0'
				});
			}
		}
	});

	$(document).keydown(function (e) {
		arrow = {left: 37, up: 38, right: 39, down: 40};
      	switch (e.keyCode) {
			case arrow.left:
				if (cSubpage) hideSubpage();
				else {
					var midScreen = $(window).scrollTop()+($(window).height()/2);
					if (midScreen > 7200 && midScreen < 9000) {
						just.find('.next-button').click();
					}
				}
				break;
			case arrow.right:
				if (cSubpage) hideSubpage();
				else {
					var midScreen = $(window).scrollTop()+($(window).height()/2);
					if (midScreen > 1400 && midScreen < 3300) {
						selectedPage.find('.next-button').click();
					} else if (midScreen > 3300 && midScreen < 5300) {
						lemanagementPage.find('.next-button').click();
					} else if (midScreen > 5300 && midScreen < 7200) {
						outfittersPage.find('.next-button').click();
					} else if (midScreen > 7200 && midScreen < 9000) {
						second.find('.next-button').click();
					} else if (midScreen > 9000 && midScreen < 10700) {
						lykkesko.find('.next-button').click();
					} else if (midScreen > 15600 && midScreen < 16400) {
						about.find('.next-button').click();
					}
				}
				break;
			case arrow.up:
				e.preventDefault();
				if (cSubpage) return;
				$('html,body').stop().animate({
					'scrollTop': '-='+$(window).height()
				},1000);
				break;
			case arrow.down:
				e.preventDefault();
				if (cSubpage) return;
				$('html,body').stop().animate({
					'scrollTop': '+='+$(window).height()
				},1000);
				break;
		}
	});

////// Topmenu
	var top = $('.top');
	scrollAnimations.push({
		'callback': function(scrollTop,scrollBottom,scrollDirection){
			if (scrollTop < 800){
				top.css('top','-50px');
			} else if (scrollTop >= 800 && scrollTop < 1400){
				top.css('top',(-1400+scrollTop)/12+'px');
			} else {
				top.css('top','0px');
			}
		}
	});

	$('#menu').on('click','a.internal',function(event){
		event.preventDefault();
		$('body,html').stop().animate({
			'scrollTop': $(this).data('scroll')
		},1500);
	});

	$('#logo').click(function(event){
		event.preventDefault();
		$('body,html').stop().animate({
			'scrollTop': 0
		},1500);
	});

////// Settings
	var scrollDirection = 0;
	$(window).scroll(function(event) {
		if (cSubpage) {
			event.preventDefault();
			$('body,html').scrollTop(cScrolltop);
			return;
		}
		var scrollTop = $(this).scrollTop();
		var scrollBottom = $(this).height()+scrollTop;
		for (i=0;i<scrollAnimations.length;i++) {
			var c = scrollAnimations[i];
			if (c.start && scrollTop < c.start) continue;
			if (c.end && scrollTop > c.end) continue;
			if (c.condition && !c.condition(scrollTop, scrollBottom, scrollDirection)) continue;
			//$('#test').html(scrollTop);
			c.callback(scrollTop,scrollBottom,scrollDirection);
		}
	});
});