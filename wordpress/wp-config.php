<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'cms');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '(%&wH_VGmuT.5#37O2VO+=t{]>8q(UT7?jg;uhmH<&>mhq2W=L{``E8)bCPsp9Xw');
define('SECURE_AUTH_KEY',  'S|+bmbZD5p^cO:X$}s#(:EXWeq2Vu.<M/1vk.K+01H5W!nHKwT/?WAs#chK0?Ebz');
define('LOGGED_IN_KEY',    'hCZnhq;om-byGd6zx0GiO2]x3ZWMT$krzL@66GEwxhaf}SC$uxr6]p=A2h6w,(YW');
define('NONCE_KEY',        '@.px0VzbQBCDhWL;J,M7cEZ?|7 M!OABX`e{]2,Vm|DGcyWy05<|  b%E2bm9Jg/');
define('AUTH_SALT',        'UI!zyhxFlKp hnA@4M0H~VWU<{<UKA~BN)TCT#AUHb&pOR4p_z;8a!JMtBXtxGWI');
define('SECURE_AUTH_SALT', 'A-ML)^/WLz. wU vFZ_!99?+l06s9O<99dQ-KR^Wp;v2b4]^G5use[peycj!t,GV');
define('LOGGED_IN_SALT',   'jSmDX-T~$<rQ:F4Jfce`UNTd6Nm;fUjC:)KUyzYp_L1xu>fCu0*},OdD@1JB4o<k');
define('NONCE_SALT',       '`Xe?dHhj@Z~n`#$RprFT5!Azot|k3(<*Pll}I5FxKoZCtUK6 [z*C-kU=bseS06C');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
