<?php
define('SITE_NAME', '書庫セラエノ');

define('STRANGER_PATH', '/Users/satokadumasa/Project/PHP/strangerphp');
define('LIB_PATH', STRANGER_PATH.'/libs/');
define('SCAFFOLD_TEMPLATE_PATH', LIB_PATH.'/templates/');
define('BIN_PATH', LIB_PATH.'bin/');

define('PROJECT_ROOT', dirname(dirname(__FILE__)));
define('APP_PATH', PROJECT_ROOT.'/apps/');
define('CONFIG_PATH', PROJECT_ROOT.'/config/');
define('TEMP_PATH', PROJECT_ROOT.'/temp/');
define('LOG_PATH', PROJECT_ROOT.'/logs/');
define('MIGRATION_PATH', PROJECT_ROOT.'/db/migrate/');

define('CONTROLLER_PATH', APP_PATH . 'controllers/');
define('MODEL_PATH', APP_PATH . 'models/');
define('VIEW_TEMPLATE_PATH', APP_PATH . 'views/');
define('HELPER_PATH', APP_PATH . 'helpers/');
define('SERVICE_PATH', APP_PATH.'/services/');

define('_CONTROLLER', '([A-Z].*)');
define('_ACTION', '([A-Z].*)');
define('SP_TAG', '##');

define('PRODUCTION', 1);
define('DEVELOPEMENT', 3);
define('ENVIRONMENTS', 'development');
define('LOG_LEVEL', DEVELOPEMENT);

define('DOMAIN_NAME', 'avalonsns.example.com');
define('DOCUMENT_ROOT', '/');
define('BASE_URL', 'http://'.DOMAIN_NAME.DOCUMENT_ROOT);

define('SALT', 'lC0SlmdaMK');

define('COOKIE_LIFETIME', 86400);
define('COOKIE_NAME', 'AVALON');
define('USER_COOKIE_NAME_LENGTH', 64);
define('DEFAULT_FLAG_OF_AUTHENTICATION', true);

define('ADMIN_ROLE_ID', 1);
define('OPERATOR_ROLE_ID', 2);
define('USER_ROLE_ID', 3);

$CONV_STRING_LIST = array(
    'ID' => '\d',
    'YEAR' => '\d{4}',
    'MONTH' => '\d{2}',
    'MDAY' => '\d{2}',
    'CONFIRM_STRING' => '\w{16}',
    'SUBSCRIPTION_STRING' => '\w',
    'CREATED_AT' => '\d{14}',
  );
