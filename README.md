WP Blog Alias
===============

#### Developer info here. ####


Installation
------------

### Production (Stand-Alone)
 - Head over to [releases](../../releases)
 - Download 'wp-blog-alias.zip'
 - Upload and activate it like any other WordPress plugin
 - AutoUpdate will run as long as the plugin is active

### Production (using Github Updater – recommended for Multisite)
 - Install [Andy Fragen's GitHub Updater](https://github.com/afragen/github-updater) first.
 - In WP Admin go to Settings / GitHub Updater / Install Plugin. Enter `mcguffin/wp-blog-alias` as a Plugin-URI.

### Development
 - cd into your plugin directory
 - $ `git clone git@github.com:mcguffin/wp-blog-alias.git`
 - $ `cd wp-blog-alias`
 - $ `npm install`
 - $ `gulp`