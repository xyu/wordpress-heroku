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
/**#@-*/
define('AUTH_KEY',         'XRg9v,]Pnu/&i$yTv-&|Nm.Ja*{XE&%6}0kgudf+_@$Q/-&?V*QFYVLyZrJ!Un`V');
define('SECURE_AUTH_KEY',  'h8xcY`ZIP91Waye5K=0AkBjdV.qk%|<!U4*hTO*:Vq@ZdDU _e{gNw_ M*&t`%7f');
define('LOGGED_IN_KEY',    '@8!e7t@Wr,c.c;^umK$4oG{rvS ,|H6#HM,C)>BI(ff;Pe6nDKc*#4h2p8[%_N/&');
define('NONCE_KEY',        'kU4}pL&bcr}<ftvHnD[Fu-q}J+(QCgRH+`wee#28?W{8WvAq[r7[]4&bT2V39qPe');
define('AUTH_SALT',        'P~/Cc@JC.9=xA|gsO-&D9s+g*{$Hw)}v:3de{/,etkB*m QrYgKVEC[Sy;+6{qtb');
define('SECURE_AUTH_SALT', ':c-)Nce98qkhL- ?O;8OD-ubg1L?Q#g49V`nY`s-o^jY2E:]d9_Ck#|f8C*@g{:z');
define('LOGGED_IN_SALT',   'wJ}IlQbAa-pz|CX%y{=Z)N 2:1$L?{PaQ1?|XJj+1ijjbU6+k?+4f-)OzI^JyHI+');
define('NONCE_SALT',       'L&+%z@L i}I|9uDp$`%9IO-_p0eVqe}{&iTRF5m%|f&8k&oSztc|H(c~=hQ!-+IY');

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
