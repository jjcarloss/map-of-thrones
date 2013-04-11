$(document).ready(function() {
	
	
	var windowWidth = $(document).width();
	var windowHeight = $(document).height();
	
	
	$('#work').click(function(){
		$('#locationsTable').toggle();
		/*show = (new TimelineLite())
		.append([
			TweenMax.to($('#'+target), 0.5, {css:{opacity:1}}),
		]);*/
	})
	
	
	$('.locationHolder').click(function(){
		$('html, body').animate(
			{
				scrollTop:parseInt($(this).attr('newTop')) - windowHeight/2, 
				scrollLeft:parseInt($(this).attr('newLeft')) - windowWidth/2
			},800);
		$('.locationImg').hide();
		$('#'+$(this).attr('target')).show();
		// $('body').animate({scrollLeft:$(this).attr('left')},800);
	});
	// ------------------------------------------------------ GENERAL
	
	var show;
	var opaqueMain = .2;
	
	// ------------------------------------------------------ CREDITOS
	
	$('.credits-off').mouseenter(function(){
		$('.credits-off').stop().animate({"opacity": "0"}, 300);
	}).mouseleave(function(){
		$('.credits-off').stop().animate({"opacity": "1"}, 300);
	});
	
	$('.credits-off').click(function(){
		window.open("http://www.raverstudio.com", '_blank');
	});
	
	// ------------------------------------------------------ PROCARIBE
	
	$(".proCar").mouseenter(function() {
		$('.proCar').stop().animate({"opacity": "0"}, 300);
		show = (new TimelineLite())
		.append([
			TweenMax.fromTo( $('.proCarTxt'), 0.5, {css:{left:50, opacity:0.5}}, {css:{left:330, opacity:1}}),
		]);
	}).mouseleave(function() {
		$('.proCar').stop().animate({"opacity": "1"}, 300);
		show.stop();
		(new TimelineLite())
		.append([
			TweenMax.to( $('.proCarTxt'), 0.3, {css:{opacity:0, left:50}, delay:0}),
		]);
	});	
	
	$('.proCar').click(function(){
		window.open("pro-caribe/", '_self');
	});

	// ------------------------------------------------------ SINGLE
	
	var photoMatrixHeight = $('#photoMatrix').attr('frameHeight');
	
	$('.selectPhoto').click(function(){
		
		
		
		target = $(this).attr('target');
		loaded = $('#'+target).attr('loaded');
		targetImg = $(this).attr('targetImg');
		targetTitle = $(this).attr('targetTitle');

		/*
		console.log($(this));
		console.log(loaded);
		console.log($('#'+target));
		console.log($('#'+targetImg));
		*/
		
		if(loaded == "loadedImg" && !$('#'+targetImg).hasClass('active')){
		
			//alert('loadedimg y no active');
		
			$('.selectColorFilter').css('opacity',0);
			var newTop = $('#'+targetImg).outerHeight(true);
			var newHeight = newTop + $('.postContent').outerHeight(true);
			
			$('.imgFondo').css('height',newTop); 

			show = (new TimelineLite())
			
			.append([
				TweenMax.fromTo( $('#'+targetImg), 1, {css:{opacity:0}}, {css:{opacity:1 }, delay:0}),
				TweenMax.fromTo( $('#'+targetTitle), 1, {css:{opacity:0}}, {css:{opacity:1 }, delay:0}),
				TweenMax.to( $('.active'), 1, {css:{opacity:0}, delay:0}),
				TweenMax.to( $('.activePhotoTitle'), 1, {css:{opacity:0}, delay:0}),
				TweenMax.to( $('.postContent'), 0.5, {css:{top:newTop}, delay:0}),
				TweenMax.to( $('.postArea'), 0.5, {css:{height:Math.max(newHeight,photoMatrixHeight)}, delay:0}),
				TweenMax.to( $(this).find('.selectColorFilter'), 0.5, {css:{opacity:1}, delay:0}),
			]);
			
			$('.active').removeClass('active');
			console.log("asd00");
			$('.activePhotoTitle').removeClass('activePhotoTitle');
			$('#'+targetImg).addClass('active');
			$('#'+targetTitle).addClass('activePhotoTitle');
			
		}else{
		
			if(loaded != "loadedImg"){
				
				//alert('loadedimg no es loadedimg');
			
				$('#'+target).attr('loaded','loadedImg');
				imageSrc = $('#'+target).attr('src');
				imageId = $('#'+target).attr('imgID');
				
				$('.mainImages').append('<img id="'+ imageId +'" class="postMainImage" src="'+ imageSrc +'">');
				
				targetImg = $(this).attr('targetImg');
				var newTop = $('#'+target).attr('newHeight');
				var newHeight = parseInt(newTop) + $('.postContent').outerHeight(true);
				
				$('.selectColorFilter').css('opacity',0);
				$('.imgFondo').css('height',newTop-1); 
				
				show = (new TimelineLite())
				.append([
					TweenMax.fromTo( $('#'+targetImg), 1, {css:{opacity:0}}, {css:{opacity:1 }, delay:0}),
					TweenMax.fromTo( $('#'+targetTitle), 1, {css:{opacity:0}}, {css:{opacity:1 }, delay:0}),
					TweenMax.to( $('.active'), 1, {css:{opacity:0}, delay:0}),
					TweenMax.to( $('.activePhotoTitle'), 1, {css:{opacity:0}, delay:0}),
					TweenMax.to( $('.postContent'), 0.5, {css:{top:newTop}, delay:0}),
					TweenMax.to( $('.postArea'), 0.5, {css:{height:Math.max(newHeight,photoMatrixHeight)}, delay:0}),
					TweenMax.to( $(this).find('.selectColorFilter'), 0.5, {css:{opacity:1}, delay:0}),
				]);
				
				$('.active').removeClass('active');
				$('.activePhotoTitle').removeClass('activePhotoTitle');
				$('#'+targetImg).addClass('active');
				$('#'+targetTitle).addClass('activePhotoTitle');
				
			}else{
				//alert('en el limbo');
			}
			
		}
		
		$('#photoDescription').html($('#'+targetTitle).html());
		
	});

	// ------------------------------------------------------ PROJECTS
	
	$('.postFrame').mouseenter(function(){
		show = (new TimelineLite())
		.append([
			TweenMax.to( $(this).find('.colorLayer'), 0.5, {css:{opacity:1}, delay:0}),
			TweenMax.to( $(this).find('.postInfo'), 0.5, {css:{opacity:1}, delay:0}),
		]);
	}).mouseleave(function(){
		show.stop();
		(new TimelineLite())
		.append([
			TweenMax.to( $('.colorLayer'), 0.2, {css:{opacity:0}, delay:0}),
			TweenMax.to( $('.postInfo'), 0.2, {css:{opacity:0}, delay:0}),
		]);
	});
	
	// ------------------------------------------------------ INDEX
	
	$("#archMain").mouseenter(function() {
		$("#archTitle").css('color','#F90');
		$('.indexFrameMiniImage').css('z-index',100);
		show = (new TimelineLite())
		.append([
			TweenMax.to( $('#inteMainImg'), 1, {css:{opacity:opaqueMain}, delay:0}),
			TweenMax.to( $('#planMainImg'), 1, {css:{opacity:opaqueMain}, delay:0}),
			TweenMax.to( $('.archMini1'), 1, {css:{opacity:1}, delay:0}),
			TweenMax.to( $('.archMini2'), 1, {css:{opacity:1}, delay:0.2}),
			TweenMax.to( $('.archMini3'), 1, {css:{opacity:1}, delay:0.4}),
			TweenMax.to( $('.archMini4'), 1, {css:{opacity:1}, delay:0.6}),
			TweenMax.to( $('.archMini5'), 1, {css:{opacity:1}, delay:0.8}),
		]);
	}).mouseleave(function() {
		$("#archTitle").css('color','darkGrey');
		show.stop();
		(new TimelineLite())
		.append([
			TweenMax.to( $('#inteMainImg'), 0.2, {css:{opacity:1}, delay:0}),
			TweenMax.to( $('#planMainImg'), 0.2, {css:{opacity:1}, delay:0}),
			TweenMax.to( $('.archMini1'), 0.2, {css:{opacity:0, 'z-index':00}, delay:0.00}),
			TweenMax.to( $('.archMini2'), 0.2, {css:{opacity:0, 'z-index':00} , delay:0.02}),
			TweenMax.to( $('.archMini3'), 0.2, {css:{opacity:0, 'z-index':00}, delay:0.04}),
			TweenMax.to( $('.archMini4'), 0.2, {css:{opacity:0, 'z-index':00}, delay:0.06}),
			TweenMax.to( $('.archMini5'), 0.2, {css:{opacity:0, 'z-index':00}, delay:0.08}),
		]);
	});
	
	$("#inteMain").mouseenter(function() {
		$("#inteTitle").css('color','#F90');
		show = (new TimelineLite())
		.append([
			TweenMax.to( $('#archMainImg'), 1, {css:{opacity:opaqueMain}, delay:0}),
			TweenMax.to( $('#planMainImg'), 1, {css:{opacity:opaqueMain}, delay:0}),
			TweenMax.to( $('.inteMini1'), 1, {css:{opacity:1}, delay:0}),
			TweenMax.to( $('.inteMini2'), 1, {css:{opacity:1}, delay:0.2}),
		]);
	}).mouseleave(function() {
		$("#inteTitle").css('color','darkGrey');
		show.stop();
		(new TimelineLite())
		.append([
			TweenMax.to( $('#archMainImg'), 0.2, {css:{opacity:1}, delay:0}),
			TweenMax.to( $('#planMainImg'), 0.2, {css:{opacity:1}, delay:0}),
			TweenMax.to( $('.inteMini1'), 0.2, {css:{opacity:0}, delay:0.00}),
			TweenMax.to( $('.inteMini2'), 0.2, {css:{opacity:0}, delay:0.02}),
		]);
	});	
	
	$("#planMain").mouseenter(function() {
		$("#planTitle").css('color','#F90');
		show = (new TimelineLite())
		.append([
			TweenMax.to( $('#archMainImg'), 1, {css:{opacity:opaqueMain}, delay:0}),
			TweenMax.to( $('#inteMainImg'), 1, {css:{opacity:opaqueMain}, delay:0}),
			TweenMax.to( $('.planMini1'), 1, {css:{opacity:1}, delay:0}),
			TweenMax.to( $('.planMini2'), 1, {css:{opacity:1}, delay:0.2}),
		]);
	}).mouseleave(function() {
		$("#planTitle").css('color','darkGrey');
		show.stop();
		(new TimelineLite())
		.append([
			TweenMax.to( $('#archMainImg'), 0.2, {css:{opacity:1}, delay:0}),
			TweenMax.to( $('#inteMainImg'), 0.2, {css:{opacity:1}, delay:0}),
			TweenMax.to( $('.planMini1'), 0.2, {css:{opacity:0}, delay:0.00}),
			TweenMax.to( $('.planMini2'), 0.2, {css:{opacity:0}, delay:0.02}),
		]);
	}); 
	
	// ------------------------------------------------------ Contact Us 
	
	$('.member').click(function(){
		show.stop();
		if(!$(this).hasClass('showing')){
			$('.showing').removeClass('showing');
			$(this).addClass('showing');
			$('.memberDetail').css('opacity',0);
			$('.member').css('opacity',.2);
			show = (new TimelineLite())
			.append([
				TweenMax.to($(this).find('.memberDetail'), 0.2, {css:{opacity:1}}),
				TweenMax.to($(this), 0, {css:{opacity:1}}),
			]);
		}else{
			$(this).removeClass('showing');
			$('.memberDetail').css('opacity',0);
			$('.member').css('opacity',1);
		}
	});
	$('.member').mouseenter(function(){
		show = (new TimelineLite())
		.append([
			TweenMax.to($(this).find('.memberPhoto'), 0, {css:{border:'5px solid #FFB23D'}}),
			TweenMax.to($(this).find('.memberName'), 0, {css:{color:'#FFB23D'}})
		]);
		
	}).mouseleave(function(){
		show.stop();
		(new TimelineLite())
		.append([
			TweenMax.to($(this).find('.memberPhoto'), 0, {css:{border:'5px solid white'}}),
			TweenMax.to($(this).find('.memberName'), 0, {css:{color:'#A9A9A9'}})
		]);
	});

	// ------------------------------------------------------ Mapa 
	
	$('.location').mouseenter(function(){
		var target = $(this).attr('target');
		$('.vertical').css('height',$(document).height());
		$('.horizontal').css('width',$(document).width());
		$('.horizontal').css('left',-($(document).width() - $('.mapPlaces').width())/2);
		$('.locationPhotos').css('opacity',0);
		$('.locationPhotos').css('z-index',1);
		show = (new TimelineLite())
		.append([
			TweenMax.to($('#'+target), 0.5, {css:{opacity:1}}),
			TweenMax.to($('.vertical'), 0.5, {css:{left:$(this).position().left + 15}}),
			TweenMax.to($('.horizontal'), 0.5, {css:{top:$(this).position().top + 15}}),
		]);
		
	}).mouseleave(function(){
		var target = $(this).attr('target');
		(new TimelineLite())
		.append([
			TweenMax.to($('#'+target), 0.5, {css:{opacity:0}}),
			TweenMax.to($('locationPhotos'), 0, {css:{opacity:0}}),
		]);
	});
 

	
});