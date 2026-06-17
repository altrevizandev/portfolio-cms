<?php

define('HOST', getenv('DB_HOST') ?: 'flowaccess-postgres');
define('PORT', getenv('DB_PORT') ?: '5432');
define('USER', getenv('DB_USER') ?: 'portfolio_user');
define('PASSWORD', getenv('DB_PASSWORD') ?: '');
define('DB', getenv('DB_NAME') ?: 'portfolio');
define('ROOT_PATH', dirname(__DIR__) . '/');