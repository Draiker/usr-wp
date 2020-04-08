/**====================================================================
 *
 *  Main Script File
 *
 *====================================================================*/
(function($) {
	"use strict";

	var wpcastDebugEnabled = 0, // set to 1 to enable console logging
	wpcastDebug = function(msg){
		if(wpcastDebugEnabled){
			if ( typeof(console) !== 'undefined' ) { 
				if( typeof(console.log) === 'function' ){
					console.log(msg);
				}
			}
		}
	};

	$.qantumthemesMainObj = {
		/**
		 * Global function variables and main objects
		 */
		body: $("body"),
		window: $(window),
		document: $(document),
		htmlAndbody: $('html,body'),
		scrolledTop: 0, // global value of the amount of top scrolling
		oldScroll: 0,
		scroDirect: false,
		clock: false,
		OTS: $("#wpcast-Sticky"), // Object To Stick

		/**
		 * ======================================================================================================================================== |
		 * 																																			|
		 * 																																			|
		 * START SITE FUNCTIONS 																													|
		 * 																																			|
		 *																																			|
		 * ======================================================================================================================================== |
		 */
		
		fn: {
			isExplorer: function(){
				return /Trident/i.test(navigator.userAgent) ;
			},
			isSafari: function(){
				return /Safari/i.test(navigator.userAgent) ;
			},
			isMobile: function(){
				return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || $.qantumthemesMainObj.window.width() < 1170 ;
			},

			/** random id when required
			====================================================================*/
			uniqId: function() {
			  return Math.round(new Date().getTime() + (Math.random() * 100));
			},

			/** Check if pics are loaded for given cotnainer
			====================================================================*/
			imagesLoaded: function (container) {
				var f = $.wpcastXtendObj.fn;
				var $imgs = $(container).find('img[src!=""]');
				if (!$imgs.length) {return $.Deferred().resolve().promise();}
				var dfds = [];  
				$imgs.each(function(){
					var dfd = $.Deferred();
					dfds.push(dfd);
					var img = new Image();
					img.onload = function(){dfd.resolve();}
					img.onerror = function(){dfd.resolve();}
					img.src = this.src;
				});
				// return a master promise object which will resolve when all the deferred objects have resolved
				// IE - when all the images are loaded
				return $.when.apply($,dfds);
			},

			// Website tree menu			
			treeMenu: function() {
				$( ".wpcast-menu-tree li.menu-item-has-children" ).each(function(i,c){
					var t = $(c);
					t.find('> a').after("<a class='wpcast-openthis'><i class='material-icons'>keyboard_arrow_down</i></a>");
					t.on("click","> .wpcast-openthis", function(e){
						e.preventDefault();
						t.toggleClass("wpcast-open");
						return false;
					});
					return;
				});
				return true;
			},
			
			/* activates
			*  Adds and removes the class "wpcast-active" from the target item	
			====================================================================*/
			activates: function(){
				var t, // target
					o = $.qantumthemesMainObj,
					s = false;
				o.body.off("click", "[data-wpcast-activates]");
				o.body.on("click", "[data-wpcast-activates]", function(e){
					e.preventDefault();
					s = $(this).attr("data-wpcast-activates")
					t = $(s);
					if(!s || s === ''){
						t = $(this);
					}
					if( s == 'parent'){
						t = $(this).parent();
					}
					if( s == 'gparent'){
						t = $(this).parent().parent();
					}
					t.toggleClass("wpcast-active");
					return;
				});
			},

			/* switchClass
			*  toggles the class defined with "data-wpcast-switch" from the target element data-wpcast-target
			*  used to change state of other items (search and similar)
			====================================================================*/
			switchClass: function(){
				var t,tc, // target
					c, // class to switch
					o = $.qantumthemesMainObj;
				o.body.off("click", "[data-wpcast-switch]");
				o.body.on("click", "[data-wpcast-switch]", function(e){
					e.preventDefault();
					tc = $(this).attr("data-wpcast-target");
					t = $(tc);
					c = $(this).attr("data-wpcast-switch");
					t.toggleClass(c);
					if(tc === '#wpcastSearchBar'){
						setTimeout(function() { $('#wpcast-searchbar-input').focus() }, 100);
					}
				});
			},

			extractYoutubeId: function(url){
				if(void 0===url)return!1;
				var id=url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				return null!==id&&id[1];
			},

			/**
			 * Fix video background Page Builder rows su ajax load
			 */
			qtVcVideobg: function(){
				var o = $.qantumthemesMainObj,
					f = o.fn,
					ytu, t, vid;
				jQuery("[data-wpcast-video-bg]").each(
					function(){
						t = $(this);
						if( typeof( insertYoutubeVideoAsBackground ) == 'function' && typeof(vcResizeVideoBackground) == 'function' ){
							insertYoutubeVideoAsBackground(t, f.extractYoutubeId( t.data("wpcast-video-bg") ) );
							vcResizeVideoBackground(t);
						}
					}
				);
			},

			/* Responsive video resize
			====================================================================*/
			YTreszr: function  (){
				jQuery("iframe").each(function(i,c){ // .youtube-player
					var t = jQuery(this);
					if(t.attr("src")){
						var href = t.attr("src");
						if(href.match("youtube.com") || href.match("vimeo.com") || href.match("vevo.com") ){
							var width = t.parent().width(),
								height = t.height();
							t.css({"width":width});
							t.height(width/16*9);
						}; 
					};
				});
			},

		

			/* Trigger custom functions on window resize, with a delay for performance enhacement
			====================================================================*/
			windoeResized: function(){
				var rst,
					o = $.qantumthemesMainObj,
					f = o.fn,
					w = o.window,
					ww = w.width(),
					wh = w.height();
				
				$(window).on('resize', function(e) {
					clearTimeout(rst);
					rst = setTimeout(function() {
						if (w.height() != wh) {
							f.stickyHeaderPrep();
							f.themeScroll();
						}
						if (w.width() != ww){
							f.stickyHeaderPrep();
							f.YTreszr();
						}
					}, 80);
				});
			},

			ipadBgFix: function(){
				var o = $.qantumthemesMainObj,
					f = o.fn;
				if(f.isMobile() && f.isSafari()){
					o.body.addClass('wpcast-safari-mobile');
				}
			},

			/**===================================================================
			* REINITIALIZATION FOR AJAX ELEMENTS
			* --------------------------------------------------------------------
			* IMPORTANT: this function needs to be always called wpcastreinit in order
			* to work properly with the plugins (in particular the xTend)
			* ====================================================================
			* */
			wpcastreinit: function(cont){
				if(undefined === cont) {
					return;
				}
				var f = $.qantumthemesMainObj.fn;
				$(cont+' audio').mediaelementplayer();
			},

			/* Parallax background
			====================================================================*/
			qtParallax: function(){
				if('undefined'  == typeof($.stellar) ){
					return;
				}
				var o = $.qantumthemesMainObj,
					b = o.body;
				if(o.fn.isMobile()){return;}
				b.stellar('destroy');
				b.stellar({
					hideDistantElements: false,
				});
			},


			/* scrolledTop: set a global parameter with the amount of top scrolling
			*	Used by themeScroll
			====================================================================*/
			scrolledTop: function(){
				var o = $.qantumthemesMainObj,
					s = window.pageYOffset || document.documentElement.scrollTop,
					d = 0;
				d = o.scrolledTop - s;
				if(d != 0){
					o.scroDirect = d;
				}
				o.scrolledTop = s;
				return s;
			},

			/* Sticky header preparation
			====================================================================*/
			stickyHeaderPrep: function  (){
				var o = $.qantumthemesMainObj;
				o.OTS.css({'height': o.OTS.outerHeight()+'px'});
			},
			/* Sticky header
			====================================================================*/
			stickyHeader: function  (st){
				var o = $.qantumthemesMainObj; // object to stick
				if(o.fn.isMobile()){
					return;
				}
				if(o.OTS.length == 0 ){return;}
				if( o.OTS.position().top < st ){
					o.OTS.addClass("wpcast-stickme");
				} else {
					o.OTS.removeClass("wpcast-stickme");
				}
			},
			

			/* Theme clock: perform some actions at some interval
			====================================================================*/
			themeScroll: function(){
				var o = $.qantumthemesMainObj,
					f = o.fn,
					st, // scrolled top, global
					os; // old scrolled top value
				
				if(o.clock !== false){
					clearInterval( o.clock );
				}	
				o.clock = setInterval(
					function(){
						f.scrolledTop(); // updates the static value o.scrolledTop
						st = o.scrolledTop;
						os = o.oldScroll;
						if( os !== st  ){
							o.oldScroll = st;
							// be sure we perofm only when scroll changes
							f.stickyHeader(st);
						}
					},80
				);
			},

			/* Reinitialize manually the Page Builder functions after ajax page load
			====================================================================*/
			initializeVisualComposerAfterAjax: function(){
				if(typeof vc_toggleBehaviour === "function"){
					vc_toggleBehaviour();
				}
				if(typeof vc_tabsBehaviour === "function"){
					vc_tabsBehaviour();
				}
				if(typeof vc_accordionBehaviour === "function"){
					vc_accordionBehaviour();
				}
				if(typeof vc_teaserGrid === "function"){
					vc_teaserGrid();
				}
				if(typeof vc_carouselBehaviour === "function"){
					vc_carouselBehaviour();
				}
				if(typeof vc_slidersBehaviour === "function"){
					vc_slidersBehaviour();
				}
				if(typeof vc_prettyPhoto === "function"){
					vc_prettyPhoto();
				}
				if(typeof vc_googleplus === "function"){
					vc_googleplus();
				}
				if(typeof vc_pinterest === "function"){
					vc_pinterest();
				}
				// $(".not-collapse").on("click", function(e) { e.stopPropagation();  });
				if( typeof($.fn.qtChartvoteInit) === "function") {
					$.fn.qtChartvoteInit();
				}
				$("body [data-bgimagevc]").each(function() {
					var that = $(this),
						bg = that.attr("data-bgimagevc"),
						bgattachment = that.attr("data-bgattachment");
					if (bgattachment === undefined) {
						bgattachment = "static";
					}
					if (bg !== '') {
						that.css({
							"background-image": "url(" + bg + ")",
							"background-attachment": "fixed"
						});
					}
				});
			},

			resetOverlay: function(){
				$('.wpcast-overlayopen').removeClass('wpcast-overlayopen');
			},

			/**====================================================================
			 *
			 *	After ajax page initialization
			 * 	Used by QT Ajax Pageloader. 
			 * 	MUST RETURN TRUE IF ALL OK.
			 * 
			 ====================================================================*/
			initializeAfterAjax: function(){
				var f = $.qantumthemesMainObj.fn;
				f.resetOverlay();
				f.YTreszr();
				f.switchClass();
				f.activates();
				f.ipadBgFix();
				f.qtParallax();
				f.qtVcVideobg();
				if(typeof $.fn.qtPlacesInit === "function"){
					$.fn.qtPlacesInit();
				}
				return true;
			},

			/**====================================================================
			 *
			 * 
			 *  Functions to run once on first page load
			 *  
			 *
			 ====================================================================*/
			init: function() {
				var f = $.qantumthemesMainObj.fn;
				f.treeMenu();
				f.stickyHeaderPrep();
				f.themeScroll();
				f.initializeAfterAjax();
				f.windoeResized();// Always last
			},
		}
		/**
		 * ======================================================================================================================================== |
		 * 																																			|
		 * 																																			|
		 * END SITE FUNCTIONS 																														|
		 * 																																			|
		 *																																			|
		 * ======================================================================================================================================== |
		 */
	};
	/**====================================================================
	 *
	 *	Page Ready Trigger
	 * 
	 ====================================================================*/
	jQuery(document).ready(function() {
		$.qantumthemesMainObj.fn.init();		
	});
})(jQuery);
