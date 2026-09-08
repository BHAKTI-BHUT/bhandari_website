<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|   ['dsn']      The full DSN string describe a connection to the database.
|   ['hostname'] The hostname of your database server.
|   ['username'] The username used to connect to the database
|   ['password'] The password used to connect to the database
|   ['database'] The name of the database you want to connect to
|   ['dbdriver'] The database driver. e.g.: mysqli.
|           Currently supported:
|                cubrid, ibase, mssql, mysql, mysqli, oci8,
|                odbc, pdo, postgre, sqlite, sqlite3, sqlsrv
|   ['dbprefix'] You can add an optional prefix, which will be added
|                to the table name when using the  Query Builder class
|   ['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|   ['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|   ['cache_on'] TRUE/FALSE - Enables/disables query caching
|   ['cachedir'] The path to the folder where cache files should be stored
|   ['char_set'] The character set used in communicating with the database
|   ['dbcollat'] The character collation used in communicating with the database
|                NOTE: For MySQL and MySQLi databases, this setting is only used
|                as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|                (and in table creation queries made with DB Forge).
|                There is an incompatibility in PHP with mysql_real_escape_string() which
|                can make your site vulnerable to SQL injection if you are using a
|                multi-byte character set and are running versions lower than these.
|                Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|   ['swap_pre'] A default table prefix that should be swapped with the dbprefix
|   ['encrypt']  Whether or not to use an encrypted connection.
|
|           'mysql' (deprecated), 'sqlsrv' and 'pdo/sqlsrv' drivers accept TRUE/FALSE
|           'mysqli' and 'pdo/mysql' drivers accept an array with the following options:
|
|               'ssl_key'    - Path to the private key file
|               'ssl_cert'   - Path to the public key certificate file
|               'ssl_ca'     - Path to the certificate authority file
|               'ssl_capath' - Path to a directory containing trusted CA certificats in PEM format
|               'ssl_cipher' - List of *allowed* ciphers to be used for the encryption, separated by colons (':')
|               'ssl_verify' - TRUE/FALSE; Whether verify the server certificate or not ('mysqli' only)
|
|   ['compress'] Whether or not to use client compression (MySQL only)
|   ['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|                           - good for ensuring strict SQL while developing
|   ['ssl_options'] Used to set various SSL options that can be used when making SSL connections.
|   ['failover'] array - A array with 0 or more data for connections if the main should fail.
|   ['save_queries'] TRUE/FALSE - Whether to "save" all executed queries.
|               NOTE: Disabling this will also effectively disable both
|               $this->db->last_query() and profiling of DB queries.
|               When you run a query, with this setting set to TRUE (default),
|               CodeIgniter will store the SQL statement for debugging purposes.
|               However, this may cause high memory usage, especially if you run
|               a lot of SQL queries ... disable this to avoid that problem.
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $query_builder variables lets you determine whether or not to load
| the query builder class.
*/
$active_group = 'default';
$query_builder = TRUE;

$is_localhost = (
    (DIRECTORY_SEPARATOR === '\\') || 
    (strpos(__FILE__, 'xampp') !== false) ||
    (isset($_SERVER['HTTP_HOST']) && in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '::1']))
);

if ($is_localhost) {
    $db_username = 'root';
    $db_password = '';
    $db_default_name = 'service_hub_web';
    $db_admin_name = 'service_hub';
    
    $db_default_username = $db_username;
    $db_default_password = $db_password;

    $db_admin_username = $db_username;
    $db_admin_password = $db_password;
} else {
    // Default production credentials extracted from live backup
    $db_default_username = 'u466475909_bhndusr';
    $db_default_password = '5+r3nqp+*R?V';
    $db_default_name = 'u466475909_bhandaridb';

    $db_admin_username = 'u466475909_bhandari_user';
    $db_admin_password = 'Bh@ndari2026Bp!';
    $db_admin_name = 'u466475909_bhandari_admin';

    // Load actual live credentials from Laravel's .env file dynamically if possible
    $live_env_path = '/home/u466475909/domains/bhandaripackersandmovers.in/ServiceHub/.env';
    if (file_exists($live_env_path)) {
        $env_content = file_get_contents($live_env_path);
        $lines = explode("\n", $env_content);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) continue;
            $parts = explode('=', $line, 2);
            if (count($parts) === 2) {
                $key = trim($parts[0]);
                $val = trim($parts[1], " \t\n\r\0\x0B\"'");
                if ($key === 'DB_USERNAME') $db_admin_username = $val;
                if ($key === 'DB_PASSWORD') $db_admin_password = $val;
                if ($key === 'DB_DATABASE') $db_admin_name = $val;
            }
        }
        $db_default_username = $db_admin_username;
        $db_default_password = $db_admin_password;
        $db_default_name = $db_admin_name;
    }
}

$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => $db_default_username,
    'password' => $db_default_password,
    'database' => $db_default_name,
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

// Admin Panel Database (ServiceHub Laravel) - Website bookings yahan bhi save honge
// Yeh connection CodeIgniter website se admin panel me data bhejne ke liye use hota hai
$db['admin_hub'] = array(
    'dsn'      => '',
    'hostname' => 'localhost',
    'username' => $db_admin_username,
    'password' => $db_admin_password,
    'database' => $db_admin_name,
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => FALSE, // Admin DB errors silently fail karein (website ko affect na kare)
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt'  => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
