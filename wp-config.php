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
define( 'DB_NAME', 'codeflex' );

/** Database username */
define( 'DB_USER', 'coa' );

/** Database password */
define( 'DB_PASSWORD', 'coa' );

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
define('AUTH_KEY',         'J)}8G&EfM?::&=I-YAhb({$foF_z%,}54W+wI_I)D]L4fsruOXj:<p&rH-7:?IC;');
define('SECURE_AUTH_KEY',  '(u%(9WZv-@8.(sM:mQxY)x~#ZQbc?la5(gY8S+m`VC*0/5q0?5,gqJ[_(h-^H;U*');
define('LOGGED_IN_KEY',    ' 24p,6JgT%/A%GH0`F-pS|q}lU,3U@+:oByERRnAg@6hy->TQniiRIFF4d5{hTe7');
define('NONCE_KEY',        'Id^O=b5H+];&vhg#~dsND3:CTjdQZ=-K]sI|~hRAWxj*@( Ww4@l|^+:I%h$bt[<');
define('AUTH_SALT',        '0:s%+M9l{Z:,:i;@xLq#e0L_.woP694_Jnw lOrHp3V5NQH+<L_!4Iy>Tdkd Kk@');
define('SECURE_AUTH_SALT', '>fCZ;T(T13$HhUq}^_|ai1=;1LGx|*I=m-7/O|s[v-tfo2lrl%v+?>Q+*xG;[Sip');
define('LOGGED_IN_SALT',   'dO,iK$$s|Ahh2Y>X^3K& +R~WT#BU|gPBrxjE{&4tc}YbzHjSwNa_teGCVcA>j>+');
define('NONCE_SALT',       'Xh,!J/}K:hZ/|UjkO5U+c -CQr++4^XiF< -+#An,Mujz1M*q$l&&7(yE>8m$EO7');

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
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('FS_METHOD', 'direct');

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
