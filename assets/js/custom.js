/***************************************************

	ANY CHANGES TO THIS FILE MUST BE MINIFIED 
	& PLACED IN JS/SCRIPTS.MIN.JS

****************************************************/

var Page = {

	init: function () {

		console.log("Page.init");

		this.bindEvents();

		// IF PREVIEW PAGE: LAZYLOAD
		if ( $("#preview_page").length ) {
			this.previewLazyLoad();
		} 

		// IF SINGLE: LAZYLOAD
		if ( $(".article").length ) {
			this.imagesPrep();
			this.singleLazyLoad();
		} 	

		// IF NEWS PAGE: FIX IMAGES
		if ( $(".news_cols").length ) {
			this.newsPrep();
		} 		

	},

	bindEvents: function () {

		console.log("Page.bindEvents");

		var self = this;

		$("#alphabetical_sorting").on("click", function(){

			self.sortList("alphabetical");

		});

		$("#chronological_sorting").on("click", function(){

			self.sortList("chronological");

		});

		// $(".jcepopup").on("click", function(e){

		// 	e.preventDefault();
		// 	console.log( 54, "img click" );
		// 	self.openPopup( $(this) );

		// });

		// $("body").on("click", "#lightbox_bg", function(e){

		// 	if( !$(e.target).closest('#lightbox_nav').length ) {
		// 		console.log( 61 );
		// 		self.closePopup();
		// 	}

		// });

		$("body").on("click", ".lightbox_next", function(e){

			e.preventDefault();
			self.lightboxNext();

		});


		$("body").on("click", ".lightbox_prev", function(){

			self.lightboxPrev();

		});

		$("body").on("click", ".lightbox_close", function(){

			self.closePopup();

		});

	},

	sortList: function ( type ) {

		console.log("Page.sortList", type);

		var wrapper = $("#archive_list"),
			list = wrapper.children(".line").get();

		function descToggle ( type ) {
			console.log("descToggle");
			wrapper.removeClass("asc").addClass("desc");
			$("#" + type + "_sorting").siblings(".sort_desc").css("opacity","1").siblings(".sort_asc").css("opacity","0");
		}

		function ascToggle ( type ) {
			console.log("ascToggle");
			wrapper.removeClass("desc").addClass("asc");
			$("#" + type + "_sorting").siblings(".sort_asc").css("opacity","1").siblings(".sort_desc").css("opacity","0");
		}

		// GET TYPE
		if ( type === "alphabetical" ) {
	
		    if ( wrapper.hasClass("asc") ) {
		    	list.sort( function( a, b ) {
					return $(a).text().toUpperCase().localeCompare( $(b).text().toUpperCase() );
				});
		    	descToggle(type);
		    } else {
		    	list.sort( function( b, a ) {
					return $(a).text().toUpperCase().localeCompare( $(b).text().toUpperCase() );
				});
				ascToggle(type);
		    }

		    // HIDE ARROWS ON OTHER BUTTON
		    $(".title .right span").css("opacity","0");
			
		} else if ( type === "chronological" ) {

		    if ( wrapper.hasClass("asc") ) {
		    	list.sort( function( b, a ) {
					return $(a).attr("data-date").localeCompare( $(b).attr("data-date") );
				});
				descToggle(type);
		    } else {
		    	list.sort( function( a, b ) {
					return $(a).attr("data-date").localeCompare( $(b).attr("data-date") );
				});
				ascToggle(type);
		    }
		
		 	// HIDE ARROWS ON OTHER BUTTON
		    $(".title .left span").css("opacity","0");

		}

		$.each( list, function(idx, itm) { wrapper.append(itm); } );

	},

	loadingLoop: function ( selector, eq ) {

		console.log("Page.loadingLoop");

		var self = this,
			nextImg;

		if ( selector === "img" ) {
			nextImg = $(selector).eq( eq );
		} else {
			nextImg = $(selector).eq( eq ).find("img"); 
		}

		nextImg.attr( "src", nextImg.attr("data-src") ).on("load", function(){

			$(selector).eq( eq ).addClass("loaded");
			if ( eq < $(selector).length ) {

				eq++;
				self.loadingLoop ( selector, eq );
			}

		});

	},

	previewLazyLoad: function () {

		console.log("Page.previewLazyLoad");

		// CALCULATE HOW MANY IMAGES TO LOAD INITIALLY
		var elemH = 250,
			elemW = 140;

		var elemPerRow = Math.floor( $(window).width() / elemW ),
			elemPerCol = Math.floor( $(window).height() / elemH );

		var toLoad = elemPerCol * elemPerRow,
			img,
			noImages = $(".preview").length,
			self = this;

		// INITIAL LOADING LOOP
		$(".preview").each( function(i){

			if ( i < toLoad ) {
				// ADD SRC + LOADED CLASS
				img = $(this).find("img");
				img.attr( "src", img.attr("data-src") );
				$(this).addClass("loaded");
			}

		});

		// ADD MOVEMENT EVENT
		$(window).one("scroll resize", function(){

			// START LOOP WITH FIRST NON LOADED ELEMENT
			self.loadingLoop ( ".preview" ,toLoad );

		});

	},

	singleLazyLoad: function () {

		console.log("Page.singleLazyLoad");

		this.loadingLoop ( "img", 0 );

	},

	newsPrep: function () {

		console.log("Page.newsPrep");

		$(".newsblock").each( function(){

			// REMOVE LINKS FROM IMAGES
			$(this).find("img").each( function(){
				if ( $(this).parent("a").length ) {
					$(this).unwrap();
				}
			});

			// IF NOT AN EMPTY WRAPPER
			if ( !$(this).is(':empty')){

				// CHECK IF IMG IS FIRST ELEM
				var beginStr = $(this).find(".news_item_content").html().trim().substring(0, 4);
				if ( beginStr === "<img" ) {

					$(this).find("img").first().css("margin-top","0");

				}

			}

		});

	},

	imagesPrep: function () {

		console.log("Page.imagesPrep");

		var totalImages = 0;

		$(".article img").each( function(i){

			$(this).attr("data-count", i+1);
			totalImages = i+1;

		});

		$(".article").attr("data-total",totalImages);

	},

	openPopup: function ( imgLink ) {

		console.log("Page.openPopup");

		// IF LIGHTBOX NOT ALREADY ADDED
		if ( $("#lightbox_bg").length < 1 ) {
			
			// APPEND BG + WRAPPER
			var html = "<div id='lightbox_bg'><div id='img_wrapper'></div>";
			html += "<div id='lightbox_nav'>";
			html += "<span class='lightbox_count'></span><span class='lightbox_prev'>Previous</span><span class='lightbox_next'>Next</span><span class='lightbox_close'>Close</span>";
			html += "</div></div>";
			$("body").append(html);

		} 

		// ADD IMG SRC AS BG
		var imgSrc = imgLink.find("img").attr("src");
		// IF SMALL VERSION: GET BIG ONE
		if ( imgSrc.indexOf("-small") !== -1 ) {
			// REMOVE "-SMALL" FROM PATH
			imgSrc = imgSrc.split("-small")[0] + imgSrc.split("-small")[1];
		} else {
			console.log ( 292 );			
		}
	
		$("#img_wrapper").css( "background-image", "url(" + imgSrc + ")" );	
	
		// ADD IMG COUNT TO NAV
		var thisNo = imgLink.find("img").attr("data-count"),
			total = parseInt( $(".article").attr("data-total") );

		$("#img_wrapper").attr("data-current",thisNo);

		$(".lightbox_count").text( thisNo + " of " + total );

		$("#lightbox_bg").show();
		setTimeout( function(){
			$("#lightbox_bg").css("opacity","1");	
		}, 100 );

	},

	closePopup: function (){

		console.log("Page.closePopup");

		$("#lightbox_bg").css("opacity","");
		setTimeout( function(){
			$("#lightbox_bg").hide();
		}, 1000 );

	},

	lightboxNext: function () {

		console.log("Page.lightboxNext");

		// NEXTNO USES ZERO-INDEXED EQ

		var nextNo = parseInt( $("#img_wrapper").attr("data-current") ),
			src;

		console.log( $("#img_wrapper").attr("data-current"), $(".article").attr("data-total") );

		if ( nextNo < parseInt( $(".article").attr("data-total") ) ) {
			// IF NEXT EXISTS
			src = $(".article img").eq(nextNo).attr("src");
			nextNo++;
		} else {
			// BACK TO BEGINNING
			src = $(".article img").eq(0).attr("src");
			nextNo = 1;
		}

		$("#img_wrapper").attr("data-current", nextNo );
		$(".lightbox_count").text( nextNo + " of " + $(".article").attr("data-total") );
		$("#img_wrapper").css( "background-image", "url(" + src + ")" );

	},

	lightboxPrev: function () {

		console.log("Page.lightboxPrev");

		// PREVNO USES ZERO-INDEXED EQ

		var prevNo = parseInt( $("#img_wrapper").attr("data-current") - 1 ),
			total = parseInt( $(".article").attr("data-total") ),
			src;

		console.log( 353, prevNo );

		if ( prevNo > 0 ) {
			console.log( 350 );
			// IF NEXT EXISTS
			src = $(".article img").eq(prevNo-1).attr("src");
			prevNo + 1;
		} else {
			console.log( 355 );
			// BACK TO END
			src = $(".article img").eq( total-1 ).attr("src");
			prevNo = total;
		}

		$("#img_wrapper").attr("data-current", prevNo );
		$(".lightbox_count").text( prevNo + " of " + total );
		$("#img_wrapper").css( "background-image", "url(" + src + ")" );

	}

}

$(document).on("ready", function(){

	Page.init();

});