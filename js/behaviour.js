$(document).ready(function(){

	var windowWidth = $(document).width();
	var windowHeight = $(document).height();
	if($('.mapPlaces').length > 0){
		var yOffset = $('.mapPlaces').position().top;
		var xOffset = (windowWidth - $('.mapPlaces').width())/2;
	}
	
	//project y single
	$('.indexFrameMiniImage').css('opacity',0);
	$('.proCarTxt').css('opacity',0);
	$('.colorLayer').css('opacity',0);
	$('.postInfo').css('opacity',0);
	$('.postMainImage').css('opacity',0);
	$('.selectColorFilter').css('opacity',0);
	$('.mainPhotoTitle').css('opacity',0);
	$('.activePhotoTitle').css('opacity',1);
	$('.first').css('opacity',1);
	$('.active').css('opacity',1);
	$('.postArea').css('height',900);
	
	var photoMatrixHeight = $('#photoMatrix').attr('frameHeight');
	var newTop = $('#photoHolder1').attr('newHeight');
	var newHeight = parseInt(newTop) + $('.postContent').outerHeight(true);
	
	$('.postContent').css('top',newTop+'px');
	$('.imgFondo').css('height',newTop-1); 
	$('.postArea').css('height',Math.max(newHeight,photoMatrixHeight));
	 
	/*$('.postContent').hide();*/
	
	/*
	$('.active').load(function(){
		var theDiv = $('.active');
		var totalHeight = theDiv.outerHeight(true);
		var photoMatrixHeight = $('#photoMatrix').attr('frameHeight');
		totalHeight += $('.postContent').outerHeight(true);
		$('.postArea').css('height',Math.max(totalHeight,photoMatrixHeight));
		$('.imgFondo').css('height',theDiv.outerHeight(true));
		$('.postContent').css('top',theDiv.outerHeight(true));
		$('.postContent').fadeIn(); 
	});
	*/
	
	//contactos
	$('.memberDetail').css('opacity',0);
	$('.vertical').css('height',windowHeight);
	$('.vertical').css('top',-yOffset);
	$('.horizontal').css('width',windowWidth);
	$('.horizontal').css('left',-xOffset);
	//mapa
	$('.locationName').css('opacity',0);
	$('.locationPhotos').css('opacity',0);
});