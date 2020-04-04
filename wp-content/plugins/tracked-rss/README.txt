=== Tracked RSS ===
Contributors: JMcIntyre
Tags: rss, google
Requires at least: 2.7.1
Tested up to: 2.7.1
Stable tag: 0.2

A Simple plugin that adds Google Analytics tracking to your RSS feed. Google Analytics Campaign variable is set to post title. Works well with <a href="http://www.jackmcintyre.net/projects/tracked-tweets/">Tracked Tweets</a>

== Description ==

Very simple plugin. Variables are set as follows:

* utm_source=rss
* utm_medium=rss
* utm_campaign is set as the post slug

Note that the utm_campaign variable works in the same way as my <a href="http://www.jackmcintyre.net/projects/tracked-tweets/?utm_source=wordpress&utm_medium=plugin&utm_campaign=tracked-rss">Tracked Tweets</a> plugin, so you can track a single campaign in Google with data from Twitter and RSS.

For support and queries, please leave a comment at <a href="http://www.jackmcintyre.net/projects/tracked-rss/?utm_source=wordpress&utm_medium=plugin&utm_campaign=tracked-rss">www.jackmcintyre.net/projects/tracked-rss/</a>

== Roadmap ==

* Nothing planned unless requested. This was just something I wanted. Feel free to let me know if you want anything though

== Known Issues==

* None - <a href="http://www.jackmcintyre.net/projects/tracked-rss/?utm_source=wordpress&utm_medium=plugin&utm_campaign=tracked-rss">let me know</a> if you find any.

== Installation ==

1. Upload the tracked-tweets folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. No additional config required

== Version History ==

= v 0.2 =

* Plugin re-written by <a href="http://www.dot-chris.com/">Chris</a> from Dot-Chris Development to use native wordpress code. Thanks Chris!

= v 0.1 =

* Campaign name set to post title
* Other variables hard coded