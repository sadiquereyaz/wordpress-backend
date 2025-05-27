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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '?K6TQ`.|u7:IQoF2&eB,I?kk76^RnZV$_ $ 6>:MLy!Bi,NvE(z?np_tMfaNhnxz' );
define( 'SECURE_AUTH_KEY',   'XlmFl{{f?sUN+5%Byt5!Tyx_<RsY,31(uK;>]U;?l ~XJrgqb!L~L(`Ad29rJO4:' );
define( 'LOGGED_IN_KEY',     '}}uTK6EoW?L:|iqYZq<F*?H{Bu+-8lf&D--4j!tq+gEMP;~~2lZ6T!!O_D8d320J' );
define( 'NONCE_KEY',         '~FUHlmA:Yc N6MbLT4$KqRkLT[/!U@? y{nQ]GcOl(W~-wE$BPN89034fd&<5l71' );
define( 'AUTH_SALT',         'KIIQZ9.zIbV@F)a+{x)/$0|BqMK5D~gD[0{r@-&Dp2-ae!SRHHz=[))oEx74cck?' );
define( 'SECURE_AUTH_SALT',  'K&HriKE88dPO_6[)l([](JHvMZ89dt@<JF)?As0JY3Q;4E7PJhO+7-uw;8NGd#~t' );
define( 'LOGGED_IN_SALT',    'x}?Jt//WqI~:TQ(HdwdNX@v6gc4v+(!cuQ]y;w J2p`p}rkm)PHWuIAcSR#:9d`-' );
define( 'NONCE_SALT',        '|m~._GhRRQ,krJ(u0/#>WpESOiL8ecWHr  &{ww_>6w{;,.Nk<,a,nDKY51v#i?^' );
define( 'WP_CACHE_KEY_SALT', ',$xH7r%5$D6a:3Fq~&_%gB?duYA~gpy50KwEW]LXCBEy~f6_<n1If{/IMtjm+HCl' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );

define('JWT_AUTH_SECRET_KEY', 'Tj85u/Kj/7GdWeKmtChxWg==');
define('JWT_AUTH_CORS_ENABLE', true);			// rest api change

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
