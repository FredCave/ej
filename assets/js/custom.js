/***************************************************

	ANY CHANGES TO THIS FILE MUST BE MINIFIED 
	& PLACED IN JS/SCRIPTS.MIN.JS

****************************************************/

// IIFE TO AVOID CONFLICT WITH OTHER SCRIPTS
(function( $ ) {

	var Page = {

		previewFullyLoaded: false, 

		init: function () {

			console.log("Page.init");

			this.queryCheck();

			this.bindEvents();

			// IF PREVIEW PAGE: LAZYLOAD
			if ( $("#preview_page").length ) {
				this.previewLazyLoad();
			} 

			// IF SINGLE: LAZYLOAD
			if ( $(".article").length ) {
				// IF COLUMNS
				if ( $(".widecol").length || $(".col").length ) {
					this.setImageHeight();
				}
				this.singleLazyLoad();
			} 	

			// IF NEWS PAGE: FIX IMAGES
			if ( $(".news_cols").length ) {
				this.setImageHeight();
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

			// CATEGORIES DROPDOWN
			$("#cat_select option").on("change", function(e){
				e.preventDefault();
			});

		},

		sortList: function ( type ) {

			console.log("Page.sortList", type);

			var wrapper = $("#archive_list"),
				list = wrapper.children(".line").get();

			function descToggle ( type ) {
				wrapper.removeClass("asc").addClass("desc");
				$("#" + type + "_sorting").siblings(".sort_arrows").find(".sort_desc").css("opacity","1").siblings(".sort_asc").css("opacity","0");
			}

			function ascToggle ( type ) {
				wrapper.removeClass("desc").addClass("asc");
				$("#" + type + "_sorting").siblings(".sort_arrows").find(".sort_asc").css("opacity","1").siblings(".sort_desc").css("opacity","0");
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

			var dataSrc = nextImg.attr("data-src") 

			// HACK FOR LOCAL IMAGES
			if  ( dataSrc !== undefined && dataSrc.indexOf("www.experimentaljetset.nl") > -1 ) {
				dataSrc = dataSrc.replace( "https://", "http://" );
				dataSrc = dataSrc.replace( "http://www.experimentaljetset.nl/", ROOT );
			}
			nextImg.attr( "src", dataSrc ).on("load error", function(){

				// RESET HEIGHT
				if ( selector === "img" ) {
					$(selector).css("height","");
				} else {
					$(selector).find("img").css("height",""); 
				}

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
				if ( !self.previewFullyLoaded ) {
					self.loadingLoop ( ".preview" ,toLoad );
				}
				self.previewFullyLoaded = true;

			});

		},

		singleLazyLoad: function () {

			console.log("Page.singleLazyLoad");

			this.loadingLoop ( "img", 0 );

		},

		newsPrep: function () {

			console.log("Page.newsPrep");

			$(".newsblock").each( function(){

				// IF NOT AN EMPTY WRAPPER
				if ( !$(this).is(':empty')){

					var beginStr = $(this).find(".news_item_content").html().trim().substring(0, 3);

					// IF STARTS WITH A LINK:
					if ( beginStr === "<a " ) {
						// GET FIRST LINK
						var firstLink = $(this).find("a").eq(0);
						// IF CONTAINS IMG
						if ( firstLink.find("img").length ) {
							firstLink.find("img").css("margin-top","0");
						}
						
					}

				}

			});

			// RUN LAZYLOAD ON IMAGES
			this.loadingLoop ( "img", 0 );

		},

		catSelect: function ( option ) {

			console.log("Page.catSelect",option);

			// LOOP THROUGH LIST
			$(".line").each( function(){

				// IF DATA-KEY CONTAINS "OPTION": SHOW ELEMENT
				if ( $(this).attr("data-key").indexOf( option ) !== -1 ) {
					$(this).show();
				} else {
					// ELSE: HIDE ELEMENT
					$(this).hide();
				}

			});

			$("#cat_select").val( option );

		},

		queryCheck: function () {

			console.log("Page.queryCheck");

			// IF QUERY
			if ( window.location.href.indexOf("?tag=") > -1 ) {

				// GET QUERY
				var qry = decodeURIComponent( window.location.href.split("?tag=")[1] );
				qry = qry.replace(/\+/g, " ");

				this.catSelect(qry);

			} else {

				$(".line").show();

			}

		},

		setImageHeight: function () {

			console.log("Page.setImageHeight");

			var mainContentW = $("#main_content").width(),
				wrapperW,
				imgH;

			// IF NEWS
			if ( $(".newsblock").length ) {
				var wrapperPerc = parseInt( $(".newsblock").css("flex-basis") ) / 100, 
					wrapperW = wrapperPerc * mainContentW;
			} else if ( $(".widecol").length ) {
				// WIDTH IN EM
				wrapperW = $(".widecol a").width() - 12;
			} else if ( $(".col").length ) {
				wrapperW = $(".col a").width() - 12;
			}

			$("#main_content img").each( function(){

				var img = $(this), 
					imgW = parseInt( $(this).attr("width") ), 
					ratio = imgW / $(this).attr("height");
				// IF RATIO AVAILABLE
				if ( $.isNumeric( ratio ) ) {
					// MAX SIZE IS IMG SIZE
					if ( wrapperW > imgW ) {
						// MAX-WIDTH
						wrapperW = imgW;
					}
					// CALC + SET HEIGHT
					imgH = wrapperW / ratio;
					img.css( "height", imgH );
					// HEIGHT IS RESET IN IMAGELOAD FUNCTION
				}

			});

		}

	}

	jQuery( function(){

		Page.init();

	});

})( jQuery );
