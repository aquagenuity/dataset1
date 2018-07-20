<?php

  ini_set('apc.enabled', 1);

	define('SESSION_NAME', 'aq-php-mvc');
	define('SITE_OFFLINE', false);
	define('SITE_OFFLINE_IP', '127.0.0.1');

	$s = $_SERVER['PHP_SELF'];
	$p = substr($s,0,strrpos($s,'/'));

	define('APP_NAME', 'aq');
	define('APP_PATH', $p);
	define('APP_ID', '2fb39867-39dd-11e8-ad23-801934a0ac26');

	define('TRACE_ENABLED', true);
	define('SINGLE_LINE_OUTPUT', false);

	define('PASSWORD_MASK', '********');


	$s = $_SERVER['DOCUMENT_ROOT'];
  if( (strrpos($s, '/') !== (strlen($s)-strlen('/'))) ){
    $s = sprintf("%s/", $s);
  }

  define('CSS_VERSION', '20171049');
  define('JS_VERSION', CSS_VERSION);

  define('SITE_URL', 'https://app.aquagenuity.com');

	define('TRACE_FILE_UNC', $s.'application/logs/trace.log');

	define('FILE_UNC', $s.'public/files');
	define('IMG_UNC', $s.'public/img');
	define('PHOTO_UNC', $s.'public/ph');
	define('PRINTS_UNC', $s.'public/prints');

	define('EMAIL_CONTACT', 'info@qeala.com');
	define('EMAIL_NOTIFY', 'sys@qeala.com');
	define('EMAIL_ADMIN', 'admin@qeala.com');
	define('EMAIL_TEST_PRINT', 'test@qeala.com');
	define('EMAIL_SIGNUP', 'signup@qeala.com');

  define('SMTP_HOST', 'smtp.google.com');
  define('SMTP_USERNAME', 'user@google.com');
  define('SMTP_PASSWORD', 'password');

	define('META_KEYWORDS', '');
	define('META_DESCRIPTION', '');

	define('BLOWFISH_KEY', 'py7TP4AcaNmhZHjN');
	define('APC_KEY', 'aq');

	define('MYSQL_SERVER', '127.0.0.1');
	define('MYSQL_DATABASE', 'aq');
  define('MYSQL_USERNAME', 'webuser');
  define('MYSQL_PASSWORD', 'ouTYY5p0q06Ebk67fCQX');
	define('MYSQL_DATETIME', 'Y-m-d H:i:s');
  define('MYSQL_FILTER', 'call sp_');
	define('MYSQL_INT_UNSIGNED_MAX', 4294967295);
	define('MYSQL_INT_MAX', 2147483647);

	define('FORMAT_JSON', 'Json');

	define('PHOTO_WIDTH_FULL', 120);
	define('MAX_FILE_UPLOAD_NAME', '100Mb');
	define('MAX_FILE_UPLOAD_SIZE', (100 * 1024 * 1024));

	define('SELECT_NONE', 'SelectNone');
	define('SELECT_ALL', 'SelectAll');

	define('ROLE_TYPE_ADMIN', 1);
	define('ROLE_TYPE_OWNER', 2);
	define('ROLE_TYPE_CUSTOMER', 3);

	define('CMD_SUBMIT', 'Submit');
	define('CMD_LOGIN', 'Login');
	define('CMD_EDIT', 'Edit');
	define('CMD_SAVE', 'Save');
	define('CMD_CANCEL', 'Cancel');
	define('CMD_PAGE', 'Page');
	define('CMD_SEARCH', 'Search');
	define('CMD_LIST', 'List');
	define('CMD_VIEW', 'View');
	define('CMD_BACK', 'Back');
	define('CMD_NEW', 'New');
	define('CMD_DELETE', 'Delete');
	define('CMD_RESET', 'Reset');
	define('CMD_CLEAR', 'Clear');
	define('CMD_FILTER', 'Filter');
	define('CMD_PRINT', 'Print');
	define('CMD_EXPORT', 'Export');
	define('CMD_PURGE', 'Purge');
	define('CMD_SORT', 'Sort');
	define('CMD_PREVIEW', 'Preview');
	define('CMD_UNMASK', 'Unmask');
	define('CMD_DEAL', 'Deal');

	define('CMD_NEW_CHILD', 'NewChild');
	define('CMD_SAVE_CHILD', 'SaveChild');
	define('CMD_EDIT_CHILD', 'EditChild');
	define('CMD_CANCEL_CHILD', 'CancelChild');
	define('CMD_LIST_CHILD', 'ListChild');
