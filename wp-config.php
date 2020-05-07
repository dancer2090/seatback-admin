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
define( 'DB_NAME', 'seatback' );

/** MySQL database username */
define( 'DB_USER', 'u_seatback' );

/** MySQL database password */
define( 'DB_PASSWORD', 'OQyxFmp0' );

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
define( 'AUTH_KEY',         '=#t^(kz]>5T13Fx5Y<3CWPCPk/nAw1S#]wo~qGd,I}QyF5C(tj/0aq[N$9_!90$ ' );
define( 'SECURE_AUTH_KEY',  'CFw<kcj~9r+}*)X|Zu;AW <x7M/1;MMps dMa<WFyz;G$x$KUB5XZRF4Q`92:KrG' );
define( 'LOGGED_IN_KEY',    ')rU[frjDP;R7ndn[bfXBo*P2Rx6K(R;NANC*i?Q3kjlQw/!~ouX=e f*Z)ZW&@{]' );
define( 'NONCE_KEY',        'OziS3R&6FiZTKC+Q+O4Fv_=z1/`w~29C88>Nd.EIVIyDBi}!}lNgW(4qF$9SHK9l' );
define( 'AUTH_SALT',        '1NL2c!n_*&R__:kAyNiQZ{G8cB-6Z?Oeri4}c#tj4w,cS*%?CGJ:{)y,W/qTG^av' );
define( 'SECURE_AUTH_SALT', ',@k$2F]!c6dZ4b(hV~@)+%+W9*vI(iz^zi*fr5#gdg4~=6tzMNzeLudJ`;nC0!;M' );
define( 'LOGGED_IN_SALT',   'dj~9hFSt~z=BZ-rt:OO/MIY?aZW*KLmd6#dKp*Y;rQM_E* 9:f<5qORe>xY2g|{C' );
define( 'NONCE_SALT',       '`yv@`,2XTu&gu}QL8/Ig4#&f[lyv*JzB;-SWE_eK7_+PYsPhb3P]U3-epYP$9:2,' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'sb_';

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
