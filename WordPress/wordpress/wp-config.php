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
define( 'DB_NAME', 'agence' );

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
define( 'AUTH_KEY',         'K;J,$490>Yr0?NUO]_jXD6B;-W4QAcVWvS>K]RN3bF45}hx}{z^:r1oVdIifyo 2' );
define( 'SECURE_AUTH_KEY',  'S=>u{86,PT]}Q vZ&VPZKXP8)@[%xwseW*<1S=7=lF%hLd7uy(b-.N2fVE$/g26e' );
define( 'LOGGED_IN_KEY',    'oL(n{H#*2=PtA{?_}j%^*OXr@E~?V)oYj!:$vC5LT&JhZv-a3oe[0m!Qee<sr|Y2' );
define( 'NONCE_KEY',        '&tYWfTnK(vHL9X-4V=8b2hsNn!YEYVmYPz3plnGR_a>#_4F92qwY[+V^AZA;%sw)' );
define( 'AUTH_SALT',        'Veu8>CZ.&abb*S|h}9mk7qoj-wiEmLvyuE>E$.E#I,p8:~9+~`4*(|1)i wP{y?`' );
define( 'SECURE_AUTH_SALT', '>G%jl{fOeob<E8n)mOxias1#10^}T2ewCA e8cA`?tu$$gL{Elvy}4;H(0pr6j{X' );
define( 'LOGGED_IN_SALT',   'ln0oD9>eYC7`XeQxfTo+dt+%*K6z-ejU1eCzCzsE]otR`}B$C0pb0#A&>^Rp<sF4' );
define( 'NONCE_SALT',       '10%ut5o-9tgsU2bxz1fF}k4m-cC#pcgRs.@0o59nl,fk4cAn$Dk(FP^z+^EGC1^0' );

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
