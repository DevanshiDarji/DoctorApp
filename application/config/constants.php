<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/*

|--------------------------------------------------------------------------

| File and Directory Modes

|--------------------------------------------------------------------------

|

| These prefs are used when checking and setting modes when working

| with the file system.  The defaults are fine on servers with proper

| security, but you may wish (or even need) to change the values in

| certain environments (Apache running a separate process for each

| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should

| always be used to set the mode correctly.

|

*/

define('FILE_READ_MODE', 0644);

define('FILE_WRITE_MODE', 0666);

define('DIR_READ_MODE', 0755);

define('DIR_WRITE_MODE', 0777);



define('SMARTY_STREET_ADDRESS_AUTH_TOKAIzaSyAJYMCPGEZ8tZWXLKJLU6Nd1JcavssWYrwEN',"P2az5pHUdfar9zDSqWwmqsJ5n3%2BIl0o3mPHbZ%2FpHOKrDcFmHU09ct3947BjF%2FwoS7XLpiG8YvT%2BEj3xj8I2CsA%3D%3D");

define('SMARTY_STREET_ADDRESS_AUTH_ID',"fdfed9fc-5ee0-4a38-b77b-a08a85481320");



define('OPENCNAM_ACCOUNT_SID',"AC67c92cb58fd64a63acc972df1246a23b");

define('OPENCNAM_AUTH_TOKEN',"AU21d13608c4f7446bb2eb2adba774f762");

define('API_KEY',"AIzaSyA47BtwayosRt2gF3JfZ3SViRr0t8mMpVs");



/*

|--------------------------------------------------------------------------

| File Stream Modes

|--------------------------------------------------------------------------

|

| These modes are used when working with fopen()/popen()

|

*/



define('FOPEN_READ',							'rb');

define('FOPEN_READ_WRITE',						'r+b');

define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care

define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care

define('FOPEN_WRITE_CREATE',					'ab');

define('FOPEN_READ_WRITE_CREATE',				'a+b');

define('FOPEN_WRITE_CREATE_STRICT',				'xb');

define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');





/* End of file constants.php */

/* Location: ./application/config/constants.php */