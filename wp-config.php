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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wpEtcetera' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'N+)fX1QEkcn-w~2N~ GOLVai_8>&VHpdx0?C1ZeVA*-`{&*$%s;Y)j0`RMOMcVc!' );
define( 'SECURE_AUTH_KEY',  'mh{5eDAECQ_9BHeT&s2SFD8u57!#|vRHbWIr@2.V#aJ@=KFh<:c.g.T/[DKP1fET' );
define( 'LOGGED_IN_KEY',    '8NpiD&b1Q.SizKO%1{)&%`k;J`O9EUOlpcar+mis%keM)0V9L=,Dbv0_{kEQBtg/' );
define( 'NONCE_KEY',        '3ig{oEQ.mWS|~pf6ChWN2l4cOG>g9sN^E4Z5iIPfEleQ,V._{q#{+-!_;zvqqtCF' );
define( 'AUTH_SALT',        'GThI58E(>?Y7TVL4BEYsaXTV~M;3{GDnKv ys^SO(DU w6QV.PNqnGmz7jx1{o53' );
define( 'SECURE_AUTH_SALT', '414TL=E!tybqF.M#b7NiV`Kx>vH9uhr%|(7rkh1WjdzrEDfh4@}%o-4ZyzSsvdtx' );
define( 'LOGGED_IN_SALT',   'yNxK/v8O3rQo}],?j{#liPu!KrSB0|~/DTho$@K%H80Xy7NCV+}(f(EAYT:Z%JSP' );
define( 'NONCE_SALT',       '.tq>PyHosy%fir&gtK`d WF9AT5j*,*1aPQ%!,m*rg{PT >Q(vL+c*G$CeP)fIMC' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
