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
define('DB_NAME', 'eud');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root_p@ssword');

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
define('AUTH_KEY',         'Uw4+GOx?kEyP{Kr45%h4/>Ps^#5i+Ac86U:h&Uy}C 6oj4%h%JT<S;eh:e=42F-<');
define('SECURE_AUTH_KEY',  'paA47q5x(4(V]0cb.8syz<rm}Ko/YNtctkP)!*O&ylTaA*wC!!2<a[EA5HO?<8w@');
define('LOGGED_IN_KEY',    'VHKJG~5o7XwdM}({9H N%a8x{2|~+]@1a[}5<tCn5G3C$1G8d#GU.(+fu;k_w0Q:');
define('NONCE_KEY',        '7EFOT}Xo.FlE*#w(GxN_G8]nn&R}`=.eDD!@i{YdUNj9kyJ}?NW|&:&ffw6IMZ14');
define('AUTH_SALT',        'UJS:M)4FB}7k7iQ95LhyS/$b4:I6S!Z$;*>:e?L$o6<aw7DCKh7PmF[?1czsJW&{');
define('SECURE_AUTH_SALT', '%P`d>4LfKQfXqCfsoVLeW44LE6S2eZ% h&a]awj2%NeR8o8m)Zx&9.w3]:Z*tOz_');
define('LOGGED_IN_SALT',   'Dx*f[Jk;U[[++6~!cMH,DwoP%ocZz/e(^EgtbGc:gRYmeq5NHyeA!4B(7yms[+Yw');
define('NONCE_SALT',       'Ef,-&A:&6Vf7kEI eM]Yg1NqH&Q<{U2=z~&-T~j>< 0gZTRIb2(kqP9*NfDI5:B2');

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
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
