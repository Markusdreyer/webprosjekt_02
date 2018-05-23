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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '=xg,X5K!2|T**9aUETQ:LI^,Li3~bH0^Of],6mlGKI00}8` _V:&*!M}n/+BJB5i');
define('SECURE_AUTH_KEY',  '/}V%FP&2<3*v[! D<$b+:ouPN#nTcQg5>I|nF]*8b_@S<f+]v>r3P}ZDLLB#1_&Y');
define('LOGGED_IN_KEY',    'KLo)WK-4/8*B@,V<=0!r<vB.^eBKe!+T4*~B+G7%<>:=/H*V{q4xpTy$y,8BBn#1');
define('NONCE_KEY',        'h5ZSC BD~ur8#4Wq=xrwte*1 ZG@5e?5~VF!Ocvx>L>o$8~O{IkEJh=}s9(K#9#r');
define('AUTH_SALT',        'ZEfk``nRu>:^XnR?Wr3&=NG*yRIGW(79*7ZYA&fqf#g4oq{ [pfH<9kctE,.>8Sj');
define('SECURE_AUTH_SALT', 'ae;4:rMrH <$7Iw4;>8{v:;6Ak3W{=wQ.Y7@|hAY%f#t*#?7ro}ib8eFWL4OjWLj');
define('LOGGED_IN_SALT',   '*P XUc7^{53^+U(}h+ x$j}G&zihljWCPL>4m.xTI4lW&/v0{)~(1:I(Hv|;j }H');
define('NONCE_SALT',       'QRm3O6v$WXG#RLa(!hn,;Ei]Bhy0c1dWW&pn9.2m${u$y9uYYRt4?OQ](948A-<n');

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
