<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'zadmin_retailwire');

/** MySQL database username */
define('DB_USER', 'retailwire');

/** MySQL database password */
define('DB_PASSWORD', 'y8azu9yhe');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '9lQ;n/v6h3J$vzW1p(`Kv%cbr<Uc0-o#pVEkpn1^tSGsTVe@[aaqyV$IGRtpjp5~');
define('SECURE_AUTH_KEY',  ':$-9rj.6_vIQ!0eZ,Bur?Q>lw!#F@a,8zeH|%RiGB>iwg-yttzL|q4}Pe#6ApR41');
define('LOGGED_IN_KEY',    'X8i5JpyFdlxj=AEvp8vw|MRTBBavj~RB54x<-U;+- L_O<)}M_DA?%ngPF$TsxJQ');
define('NONCE_KEY',        '^%%E^hpR8nKr;Zf4I|5d29QD|Se+:(8So4$cdoQlQ+jxz9)!yz{jprp+sr@?CY`N');
define('AUTH_SALT',        '9R+~<Au$+fugh:a7V2]^n{P&#uSIu1*/[,a;20t)1x:6K1Rg-=R??rC>r?9)^]1<');
define('SECURE_AUTH_SALT', ']I{V}EFW<8:c2q%JsUfj+~1HTq!2Z.JOv41Um|,cx3pz3ym?aDZ+,eAp,PB<4v[;');
define('LOGGED_IN_SALT',   'cUdh-7bSB)z`-+0Fg[h=i8/e+Kmdl_X6+!dzqh&;{0/g>qk[}h3^jM/Ny UV]BiV');
define('NONCE_SALT',       'Q@3$7/kT,*u49PYh88dila=brNIK!F@gm|?&gzzjcP~Ez*>+dsZ)1h;j,[-.{&Gc');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
