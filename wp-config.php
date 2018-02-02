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
define('DB_NAME', 'wp_deblen_db');

/** MySQL database username */
define('DB_USER', 'wp_deblen');

/** MySQL database password */
define('DB_PASSWORD', 'password');

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
define('AUTH_KEY',         '@H8N_^]IV_;[MGO7-@YmWaKG=aWi4TN#;K|^u>pQqYc5l%nY+;L#nB=i@DJVmmvx');
define('SECURE_AUTH_KEY',  'N{lmr>:c<Y{u^s,wb-A!h|6j^~#n&i9G%%#g->|N0?`vcjAj:2% 3B=O#}#>gFvC');
define('LOGGED_IN_KEY',    'or>EKU$EEND?SU=S$[/pfAbPsP[t_jT1ToE[,kt_Mf>aP}x!kwFQ2}dsvY!`=d=a');
define('NONCE_KEY',        'w (r9Y#.H kAua|*1ej*KF80|wcRHL)7&q&o:t72ufx?M9+^IFf/B /ldw[v%Fi3');
define('AUTH_SALT',        '=SJp#HQvU*Nhh^g$xIw.Oqc|:b(>G{t$=8.ul;S!V#(Fcy)+u>pWKqkXz;W0xg}%');
define('SECURE_AUTH_SALT', 'Byq?n]GfYTkW82w|zjy1%]#aEurJS4l&*uwJ08r8];g?1}8CPQ!v7t(uV;PgXFBY');
define('LOGGED_IN_SALT',   'CrA{Ss%>u;tq5Kd<tG5e}Bho,( =.KZ0Lg15<h9QodD)?qLK&{ilMKh huThU ZE');
define('NONCE_SALT',       '^PPxVIci?j* ~[$Q mQ$I?exDM(/yRK#XP5:L^>EO!AzPA=E6V1tt)8+!*kM|mP*');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dl_';

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

