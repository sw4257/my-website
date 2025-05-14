<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
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
define( 'DB_NAME', 'aodrn133' );

/** MySQL database username */
define( 'DB_USER', 'aodrn133' );

/** MySQL database password */
define( 'DB_PASSWORD', 'tlfhtkzl275@@' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'LY}u%H>NI%CK?!+womc}1vPHp l_7uA8jXIt9ekyfj,i?AT;}U$u&6TNJEb-MI:$' );
define( 'SECURE_AUTH_KEY',  '91<JVF2b6fXV^Yf<JvKFTLf^JIbAahl$-fTeylRwxYy_t^+:Ku$k-$8&(Cxva&m1' );
define( 'LOGGED_IN_KEY',    '3d73Dwv1$L.^QF|Dec|1ge.U{(23EErvQ85?8YIDw+u!lK6>_LLu|;q[DrEB,vPk' );
define( 'NONCE_KEY',        'gjn[+n:esWVFg<9Ak1+)*U9X N/O.24kgr>&vSA0HQ/nysuT#kMe4o>p+a,McZ){' );
define( 'AUTH_SALT',        '#@h(j8+u=qKTG;hPJD-i{HUHlZpCDII~ P`xg)W;R>4_ykPp3{jUgmNg7_/07oz7' );
define( 'SECURE_AUTH_SALT', '{a,$:u5m<Jb)z!9MpDPth2rSj-!BZ**,UF|kto^6jK@0 }gvr<k==..2uM:l3/ct' );
define( 'LOGGED_IN_SALT',   'LdXSDBa?.@o682rZ`W+Iqp.*1Fm>B@D4)k;:Ph+4y}Lxk:w 5edE7iXG-c6clE ^' );
define( 'NONCE_SALT',       'wvB1py~~;HQztOYAV.6O[G.k>/W{Ko6fLNnS~#(7=!Tr[B{hvKk9cm).k3{>~51y' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/* enable core major update */
define( 'WP_AUTO_UPDATE_CORE', 'true' );
/* custom security setting */
define('DISALLOW_FILE_EDIT',true);
define('WP_POST_REVISIONS',7);
define('IMAGE_EDIT_OVERWRITE',true);
define('DISABLE_WP_CRON',true);
define('EMPTY_TRASH_DAYS',7);
