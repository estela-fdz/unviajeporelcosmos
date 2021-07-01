<?php
//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL

define('WP_CACHE', true); // Added by WP Rocket
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
define( 'DB_NAME', 'wp_tiovn' );

/** MySQL database username */
define( 'DB_USER', 'wp_ffcn3' );

/** MySQL database password */
define( 'DB_PASSWORD', 'duG9dL0$&i7RdQEZ' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '2kIa5N4V+(Q+-D7jGf-5d5h#V!9LJ;Zdg&oL~4NJZ/LK2:(Hvs5jD9uk_j0Eut-q');
define('SECURE_AUTH_KEY', 'c/#c73GLvYz[@dD|e|a9X4E-Fp8_2e#@6zE@8IZzJ:+7J_&B9;829oM1v*vj!Mtq');
define('LOGGED_IN_KEY', ']ns1K:):6gYNLdPSnbi05D1M-76+68b4u#_2uD3|b3(j1A71(;kvX23_az0kKiKF');
define('NONCE_KEY', '#td5PjF3#;I]9&D&X)XH+b9C%vs)4w7&5]#))0KDPF#rP7Xo%0nj|G-FV#003E85');
define('AUTH_SALT', '15E]toh9u!9|i!jT/944Agc~dh|0;XuXo|Rev/]2)ob~&3c]&jR9S4a*8~g24l1|');
define('SECURE_AUTH_SALT', 'Z/F]u/Xc[OD2%I0]%1f2O#y#)GKl0+vO&[FhD~a0x1@5e;76&~lbr|JsO0MOcr1Z');
define('LOGGED_IN_SALT', '*2_r%5DnC#10vLPv;;B1q+@]@VXok62ghVFO)3FdBDR|rj949uqt19/&%E;39St%');
define('NONCE_SALT', 'zOYy[b6[d#a_-@5uk#5P68Dk1ef/3yRt0Q/kF:3Y2Olp09k)xx7)2H0!WO9nk5v#');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'itriSm_';


define('WP_ALLOW_MULTISITE', true);
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
