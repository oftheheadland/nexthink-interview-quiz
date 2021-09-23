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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'NDSyXTq+OhMXdqRV84Dx7ziSZjZyednMRKe4Wacvvkccx08uwdIEG9X+HPtDUJInOZD7uu/xVueRoPph87uhww==');
define('SECURE_AUTH_KEY',  'yXQJvOR0hRZXZOGfHgpPNycmWwCnlnyHsimtE7JpHWrTX7RQZvwPPr7A3PQEJGjqJ036iT73o/3eoqMjpho/Lg==');
define('LOGGED_IN_KEY',    'Odxh9PuK7oDgYI4Kt9DtOjGity9rVogRolJCFnw4VFNq6BllIpFhfV1bdnI450hMIYrRwBO2zv5TTRgCKXcjbQ==');
define('NONCE_KEY',        'cvGD79NJ5gCd9Gj5MSSkpMpyaUOHriWw57AQ54/SGFKpj27FdgoAAeytBHFe7k5uu0p5/evb5r3e8Q9nd7XiIg==');
define('AUTH_SALT',        'FLhIzQkhJ+S9e4zzhNPYlNvEQFMYhJBtnFZassZOP3CxHkQPpqexxtucFKMq7nvGc7Uk3s4ISsOk2RiqyCx26g==');
define('SECURE_AUTH_SALT', '3aBO6FH64U5o9gJL2GeqDHZ3Ib9cvW+whGewY7gtjBW0a6wUOdiT5YuXaENVWPCGr/sKxn9r5lyCb5h1T/r2OQ==');
define('LOGGED_IN_SALT',   'x02sMPc6Uk80xYbvogWVFe6IB7IGbFxUxm0qwrkyRacVnQlQABwNdX/MiuQZDJX/Iqo2Du061GrOQb4AvgTmAw==');
define('NONCE_SALT',       'mxwErempU8hKM4znNZTBwoPBTs5wMAhihnY9SuDjntrLxL0NxmKKWQHLGnKLAUcCrMziQC3b3zVCY4rC05y11Q==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
