<?php
  /**
	 * This single template includes a home (blog) page, a single page, search
	 * results, and a 404 page.
	 */
?>

<? // This section would usually go in a header.php file
   // And you would call it here with get_header();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<?php
		// https://developer.wordpress.org/reference/functions/bloginfo/
		// Encoding for pages and feeds” set in Settings > Reading
		// Defaults to UTF-8
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">

		<?php // for Internet Explorer 8-10, remove if unnecessary ?>
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<?php // Allow proper zooming and resizing ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Latest compiled and minified CSS -->
		<!-- Google Tag Manager -->
		<script>
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-PQ7LFNW');
		</script>
		<!-- End Google Tag Manager -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css" media="handheld">
		<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/assets/css/normalize.css">
		<script type="text/javascript" id="widget-wfp-script" src="https://secure.wayforpay.com/server/pay-widget.js?ref=button"></script>
		<script type="text/javascript">function runWfpWdgt(url){var wayforpay=new Wayforpay();wayforpay.invoice(url);}</script>
		<?php
		/**
		 * WordPress action hook to load <head> scripts and headers. Must include
		 * for proper WP functionality. Same deal with wp_footer() below.
		 */
		 ?>
	  <?php wp_head(); ?>
	</head>

	<?php // The WP body_class() adds helpful bonus classes to the body tag ?>
	<body <?php body_class(); ?>>
		<!-- Google Tag Manager (noscript) -->
		<noscript>
			<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PQ7LFNW" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		<!-- End Google Tag Manager (noscript) -->
		<main id="main">
			<div class="wrap">
				<header class="header">
					<div class="socials">
						<a href="https://www.facebook.com/urbanspaceradio" target="_blank" class="soc-fb"></a>
						<a href="https://twitter.com/UrbanSpaceRadio" target="_blank" class="soc-tw"></a>
						<a href="https://www.instagram.com/urban_space_radio" target="_blank" class="soc-instagram"></a>
						<a href="http://tunein.com/radio/Urban-Space-Radio-s246403" target="_blank" class="soc-tunein"></a>
						<a href="http://stream.urbanspaceradio.com:8000/urban-space-radio-m3u.m3u" target="_blank" class="soc-playlist"></a>
						<a href="https://www.mixcloud.com/UrbanSpaceRadio" target="_blank" class="soc-mixcloud"></a>
						<a href="https://podcasts.apple.com/ua/podcast/urban-space-radio/id1459038329" target="_blank" class="soc-applepodcasts"></a>
						<a href="https://www.google.com/podcasts?feed=aHR0cDovL3VyYmFuc3BhY2VyYWRpby5jb20vZmVlZC9wb2RjYXN0" target="_blank" class="soc-googlepodcasts"></a>
					</div>
					<h1 class="main-logo">
						<img src="<?php echo get_bloginfo('template_url'); ?>/assets/img/logo-usr.svg" width="200" height="76">
						<span>Urban Space Radio</span>
					</h1>
				</header>
				<section class="section1">
					<div id="jquery_jplayer_1" class="jp-jplayer"></div>
					<div id="jp_container_1" role="application" aria-label="media player" class="h-player jp-audio-stream">
						<div role="button" id="playRadioButton" class="h-player__btn jp-play">
							<div class="p-btn"><div class="p-btn__pause-cont"><div class="p-btn__pause"></div></div><div class="p-btn__play"></div></div>
						</div>
						<div class="h-player__desc">
							<div class="h-player__now-title">Зараз в ефірі</div>
							<div class="h-player__now-singer-and-song">
								<div class="h-player__now-singer js-singer"></div>
								<div class="h-player__now-song js-song"></div>
							</div>
						</div>
						<div class="jp-no-solution">Оновіть браузер</div>
					</div>
				</section>
				<section class="section-single">
          
					<?php
					// Start the loop.
					/*
					while ( have_posts() ) :
						the_post();

						// Include the single post content template.
						get_template_part( 'template-parts/content', 'single' );

						// End of the loop.
					endwhile;
					*/
					?>
					
				</section>
				<section class="section2">
					<div class="season">
                        <h1 class="season-logo">
							<p>LOADING</p>
                            <p class="seasontype">something new</br>on Urban Space Radio</p>
						</h1>
						<div onclick="runWfpWdgt('https://secure.wayforpay.com/button/b569b98266d95');" class="button-donation" onmouseout="this.style.opacity='0.6';" onmouseover="this.style.opacity='1';">
							<span class="button-donation-text">ПІДТРИМАТИ ПРОЕКТ</span>
						</div>
					</div>
					<div class="partners">
						<a href="http://warm.if.ua" target="_blank" class="partner-warm-city"></a>
						<a href="http://urbanspace.if.ua" target="_blank" class="partner-us-100"></a>
					</div>
				</section>
			</div>
		</main>
		<footer class="main-footer">
			<div class="footer-wrap">
				<div class="main-footer-text">
					<div class="made_in">Made in Ivano-Frankivsk</div>
					<div class="copyright">© 2016 Urban Space Radio. All Rights Reserved</div>
				</div>
			</div>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js" media="handheld"></script>
		<script src="<?php echo get_bloginfo('template_url'); ?>/assets/js/jplayer/jquery.jplayer.min.js"></script>
		<script src="<?php echo get_bloginfo('template_url'); ?>/assets/js/fastclick.js"></script>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,500,700&amp;subset=latin,cyrillic" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,500,700&subset=cyrillic" rel="stylesheet">
		<script type="text/javascript">
			$(document).ready(function(){
				
				updatePlaylist = function (songlist) {
					for (i = 0, total = songlist.length; i < total; i++) {
						var item = songlist[i];
						if (item.status == 'current') {
							$('.js-singer').html(item.artist);
							$('.js-song').html(item.title);
							//$('.js-singer').html("Urban Space Radio");
							//$('.js-song').html("new ukrainian music");
						}
					}
				};

				getPlaylist = function () {
					$.getJSON("http://urbanspaceradio.com/songinfo/?stream=/urban-space-radio", function (songlist) {
						updatePlaylist(songlist);
					});
				};

				getPlaylist();
				setInterval(getPlaylist, 5000);

				var streamURL = {
						mp3: "http://stream.urbanspaceradio.com:8000/urban-space-radio?cache-buster=" + Date.now()
					},
					o = !1,
					l = navigator.userAgent.toLowerCase().indexOf("chrome") > -1,
					u = "undefined" != typeof window.orientation,
					c = l && !u;
				
				$("#jquery_jplayer_1").jPlayer({
					ready: function () {
						o = !0, $(this).jPlayer("setMedia", streamURL).jPlayer("play")
					},
					pause: function () {
						$(this).jPlayer("clearMedia")
					},
					ended: function () { // The $.jPlayer.event.ended event
						$(this).jPlayer("play"); // Repeat the media
					},
					error: function (e) {
						o && e.jPlayer.error.type === $.jPlayer.error.URL_NOT_SET && $(this).jPlayer("setMedia", streamURL).jPlayer("play")
					},
					swfPath: "http://jplayer.org/latest/dist/jplayer",
					supplied: c ? "m4a,mp3" : "mp3",
					solution: "html",
					preload: "none",
					wmode: "window",
					useStateClassSkin: !0,
					autoBlur: !1,
					keyEnabled: !0
				});
				FastClick.attach(document.body);
			});
		</script>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-72089923-1', 'auto');
			ga('send', 'pageview');
			ga('send', 'event', 'Button', 'Play', 'PlayRadio');
		</script>
  <?php
	/**
	 * Close with another action hook for plugin and core script files
	 * The Twenty Seventeen theme places wp_footer() below </footer>
	 * so we will follow their lead and put it here at the very bottom.
	 */
	?>
  <?php wp_footer(); ?>
  </body>
</html>
