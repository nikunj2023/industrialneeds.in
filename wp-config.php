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
define( 'DB_NAME', 'ruffusec_inneeds' );

/** MySQL database username */
define( 'DB_USER', 'ruffusec_inneeds' );

/** MySQL database password */
define( 'DB_PASSWORD', '_#]e3LbpMU1O]gqaZ8[Ij3_r' );

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
define( 'AUTH_KEY',         '(E7tEc1n&u-JF()sjGBTzq6u0R5$Yf$w87=asqC@;#QnyiJB%2jIqi}i_ayx<a5w' );
define( 'SECURE_AUTH_KEY',  'yj$?^hP3x&UxWJLZkQYsh _;yAXvr5mT9>N5s_0h?**!R{tQ79K7b5Ty&ZejM1PY' );
define( 'LOGGED_IN_KEY',    ',/q$T:53wlX#|Qb79YwBG|CN&rQ= P2oU^1ayV^wRYL.Vc?.?GRo#=aw93!3DaQ+' );
define( 'NONCE_KEY',        'e_D*Hj}DD>-:v9WJKoP}Qpc<n5T?#9C6]_w5uC`,eqAli2AB*qEqU=PGb|5cz^hX' );
define( 'AUTH_SALT',        '[VwZ5Z;}5ovI895L]8xpTWZ3JGL>n<$E<4P/K:4+KB-gu_{Q?OewM<Ua)jjV*F3p' );
define( 'SECURE_AUTH_SALT', 'Z9f^45w+{]K5BPA_7IEWh/<C&m^P=f.+aDV3nC#Lv#p?W2>lx4jVI;RL2JjOc`:!' );
define( 'LOGGED_IN_SALT',   'hsyM![/Hy?YYyO}`3wd]`:E;Y6B}s^v~Z!bo~n|reZ@r+4<qyTAWiwx>r;|vM1&k' );
define( 'NONCE_SALT',       'em3rWoJMR01BMwKXc;]<jaVv&itB4Q&_f|F1DasfQI.-!>QN{:l?gWM)!two+/By' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'in_';

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
