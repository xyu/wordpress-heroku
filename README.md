# WordPress Heroku

_**NOTE:** This is a fork of Matt Hoofman's [WordPress Heroku](https://github.com/mhoofman/wordpress-heroku)_

This project is a template for installing and running [WordPress](http://wordpress.org/) on [Heroku](http://www.heroku.com/). The repository comes bundled with the following plugins.
* [SASL object cache](https://github.com/xyu/SASL-object-cache) - For running with MemCachier add-on
* [Authy Two Factor Auth](https://www.authy.com/products/wordpress)
* [Batcache](http://wordpress.org/plugins/batcache/)
* [Jetpack](http://jetpack.me/)
* [WP Read-Only](http://wordpress.org/extend/plugins/wpro/)
* [WP SendGrid](http://wordpress.org/plugins/wp-sendgrid/)

Installation
============

Clone the repository from Github

    $ git clone git://github.com/xyu/wordpress-heroku.git

With the [Heroku gem](http://devcenter.heroku.com/articles/heroku-command), create your app

    $ cd wordpress-heroku
    $ heroku create
    > Creating strange-turtle-1234... done, stack is cedar
    > http://strange-turtle-1234.herokuapp.com/ | git@heroku.com:strange-turtle-1234.git
    > Git remote heroku added

Add a database to your app

    $ heroku addons:add cleardb:ignite
    > Adding cleardb:ignite on strange-turtle-1234... done, v2 (free)
    > Use `heroku addons:docs cleardb:ignite` to view documentation.

Add memcache to your app

    $ heroku addons:add memcachier:dev
    > Adding memcachier:dev on strange-turtle-1234... done, v3 (free)
    > MemCachier: added.  Your credentials may take up to 3 minutes to sync to our servers.
    > Use `heroku addons:docs memcachier:dev` to view documentation.

Add unique keys and salts to your Heroku config

    $ heroku config:set\
        WP_AUTH_KEY=`dd if=/dev/random bs=1 count=96 2>/dev/null | base64`\
        WP_SECURE_AUTH_KEY=`dd if=/dev/random bs=1 count=96 2>/dev/null | base64`\
        WP_LOGGED_IN_KEY=`dd if=/dev/random bs=1 count=96 2>/dev/null | base64`\
        WP_NONCE_KEY=`dd if=/dev/random bs=1 count=96 2>/dev/null | base64`\
        WP_AUTH_SALT=`dd if=/dev/random bs=1 count=96 2>/dev/null | base64`\
        WP_SECURE_AUTH_SALT=`dd if=/dev/random bs=1 count=96 2>/dev/null | base64`\
        WP_LOGGED_IN_SALT=`dd if=/dev/random bs=1 count=96 2>/dev/null | base64`\
        WP_NONCE_SALT=`dd if=/dev/random bs=1 count=96 2>/dev/null | base64`
    > Setting config vars and restarting strange-turtle-1234... done, v4
    > WP_AUTH_KEY:         ...
    > WP_AUTH_SALT:        ...
    > WP_LOGGED_IN_KEY:    ...
    > WP_LOGGED_IN_SALT:   ...
    > WP_NONCE_KEY:        ...
    > WP_NONCE_SALT:       ...
    > WP_SECURE_AUTH_KEY:  ...
    > WP_SECURE_AUTH_SALT: ...

Create a new production branch for your app

    $ git checkout -b production

Deploy to Heroku

    $ git push heroku production:master
    > -----> Heroku receiving push
    > -----> PHP app detected
    > -----> Bundling Apache v2.2.22
    > -----> Bundling PHP v5.3.10
    > -----> Discovering process types
    >        Procfile declares types -> (none)
    >        Default types for PHP   -> web
    > -----> Compiled slug size is 13.8MB
    > -----> Launcing... done, v5
    >        http://strange-turtle-1234.herokuapp.com deployed to Heroku
    >
    > To git@heroku:strange-turtle-1234.git
    > * [new branch]    production -> master

After deployment WordPress has a few more steps to setup and thats it!

Optional Installation
=====================

Installing and configuring the items below are not essential to get a working WordPress install but will make your site more functional.

Media Uploads
-------------

[WP Read-Only](http://wordpress.org/extend/plugins/wpro/) plugin is included in the repository allowing the use of [S3](http://aws.amazon.com/s3/) for media uploads.

1. Activate the plugin under 'Plugins', if not already activated.
2. Input your Amazon S3 credentials in 'Settings'->'WPRO Settings'.

Sending Email
-------------

[WP SendGrid](http://wordpress.org/plugins/wp-sendgrid/) plugin is included in the repository allowing the use of [SendGrid](https://addons.heroku.com/sendgrid/) for media uploads.

Add SendGrid to your app

    $ heroku addons:add sendgrid:starter
    > Adding sendgrid:starter on xyuio-staging... done, v11 (free)
    > Use `heroku addons:docs sendgrid:starter` to view documentation.

Get the credentials from Heroku

    $ heroku config:get SENDGRID_USERNAME
    > app***@heroku.com
    $ heroku config:get SENDGRID_PASSWORD
    > ***

Activate the plugin with Heroku SendGrid credentials

Usage
=====

* Because a file cannot be written to Heroku's file system, updating and installing plugins or themes should be done locally and then pushed to Heroku.

Setting up a Local Environment
==============================

Mac OS X
--------

* To run WordPress locally on Mac OS X try [MAMP](http://codex.wordpress.org/Installing_WordPress_Locally_on_Your_Mac_With_MAMP).
* Open /Applications/MAMP/Library/bin/envvars and add `export CLEARDB_DATABASE_URL="mysql://wordpress:wordpress@localhost/wordpress"`
* Start MAMP and open http://localhost/wp-admin/ in a browser.

## Linux, or manual Apache config
---------------------------------

* In your Apache config, add a `SetEnv` directive like `SetEnv CLEARDB_DATABASE_URL mysql://wordpress:wordpress@localhost/wordpress`
* Change the first line of your `wp-config.php` to use `$_SERVER["DATABASE_URL"]` if `DATABASE_URL` not found in `$_ENV`:

```
if (isset($_ENV["DATABASE_URL"]))
  $dbsettings = parse_url($_ENV["DATABASE_URL"]);
else
  $dbsettings = parse_url($_SERVER["DATABASE_URL"]);

```

* (Re)start Apache, and open http://localhost/wp-admin in a browser.

Updating
========

Updating your WordPress version is just a matter of merging the updates into
the branch created from the installation.

    $ git pull # Get the latest

Using the same branch name from our installation:

    $ git checkout production
    $ git merge master # Merge latest
    $ git push heroku production:master

WordPress needs to update the database. After push, navigate to:

    http://your-app-url.herokuapp.com/wp-admin

WordPress will prompt for updating the database. After that you'll be good
to go.

Custom Domains
==============

Heroku allows you to add custom domains to your site hosted with them.  To add your custom domain, enter in the follow commands.

    $ heroku domains:add www.example.com
    > Added www.example.com as a custom domain name to myapp.heroku.com
