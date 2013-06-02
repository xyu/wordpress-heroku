<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Heroku Postgres settings - from Heroku Environment ** //
$db = parse_url($_ENV["DATABASE_URL"]);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', trim($db["path"],"/"));

/** MySQL database username */
define('DB_USER', $db["user"]);

/** MySQL database password */
define('DB_PASSWORD', $db["pass"]);

/** MySQL hostname */
define('DB_HOST', $db["host"]);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'g@#dFdv* nn[q;#<d[2=oB{4{uW([wp-=}Vh:|rn+e+2>CEo-<N;=|3) C600wx1');
define('SECURE_AUTH_KEY',  '|q8KVz<lnI]5fI7jX8>E@}:N?b[9?nRq(qD|SRXw;3u,1P!@#Znlq^G7/7+}eq0l');
define('LOGGED_IN_KEY',    ')U94PX6$_v%#!o6pE9%=k~rUsvkM7/ZL(AFvo$jla5:!4~A_J :-uRx_lH/:{!O>');
define('NONCE_KEY',        'WDKD5,(X`@?(Xw(.TRwc1nGw{f,hoGQ]s7y%<?*}PoJsk|PJ)^bX;DzM3%v0Eb$/');
define('AUTH_SALT',        '|u5w787GE;Jk) #X|KM<YH9~nhJxrmOI(94>IK65yZ_W_90`yC2(,r2Rb}OuBybN');
define('SECURE_AUTH_SALT', 'dz,N7Q%/K=2n,pVMG<n[0qCrPG@rN{7uu++[=j8xmKgy%a^be$Yx^iG[~_P5O.N(');
define('LOGGED_IN_SALT',   'm2je*ni-WT38OYz45]Ltz]&punqNLJX-eQ@|(T YR5/CGB)`T=S2T}gs}u+` Fg$');
define('NONCE_SALT',       'C5EiY$e}J}*yA|kpRo+L+Z+n/%h!oEUmqMPBtwzSw^]x[o/=S6;y-c(3!4ue<(ee');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
