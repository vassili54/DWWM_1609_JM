<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'yoga_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'M](~:;[(O{/3.ky2%z{-%]dbvP/x[?$=vMEI<1Vn%0<y7Y A~>m>YJ|NQF-iUwy^' );
define( 'SECURE_AUTH_KEY',  'o~o,#`%WFy`|^-_*T5*XURsTCGQhC<D;=JLKPLGGOQ9^hcick35 *;SE5D#NlE<H' );
define( 'LOGGED_IN_KEY',    '.wJmch>!^8$(E18NHIzr+c)QON@ZaJ,;% QWlbgz_r>g`(%rN-O5b0)na&6!xCXr' );
define( 'NONCE_KEY',        '7zH/H 7KzBV^dEgv-]fPcl#WxP5dZhKD!O`Vt6lVMuK|]jXoe.]w0`EE<~9z9I*^' );
define( 'AUTH_SALT',        '+_w}pS*0[J([f3IS5l,NZ-J!st8!6!IsM(riA][~Z+w!840{Zq) mZSW!LUyyjtB' );
define( 'SECURE_AUTH_SALT', 'QiMeC6snhqw_{oy<bExaENeT7#]>k2-3jl*-HNjT-6X4%+!3e[/L3eXPG:@WR~R~' );
define( 'LOGGED_IN_SALT',   '#r5H?RN&+:5,YgMw7!h/bm5T;qWT4rHL?D[hU^)P[catOkyr?bJa8AC^|b~|chwd' );
define( 'NONCE_SALT',       'hw[[Hfi?|xD[B5E>NnU+ZRF,wYn*V!(X;g?Q$6Kt${i`/N#syb&]+www!m;E{cHz' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
