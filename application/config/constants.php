<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|--------------------------------------------------------------------------
| 自定义字段类型名称
|--------------------------------------------------------------------------
|
|
*/
defined('FIELD_TYPE_TEXT')				OR define('FIELD_TYPE_TEXT', '单行文本');
defined('FIELD_TYPE_AREA')				OR define('FIELD_TYPE_AREA', '多行文本');
defined('FIELD_TYPE_SELECT')				OR define('FIELD_TYPE_SELECT', '下拉菜单');
defined('FIELD_TYPE_RADIO')				OR define('FIELD_TYPE_RADIO', '单选');
defined('FIELD_TYPE_CHECKBOX')				OR define('FIELD_TYPE_CHECKBOX', '复选');
defined('FIELD_TYPE_NUMBER')				OR define('FIELD_TYPE_NUMBER', '数值');
defined('FIELD_TYPE_IMAGE')				OR define('FIELD_TYPE_IMAGE', '图像');
defined('FIELD_TYPE_DATE')				OR define('FIELD_TYPE_DATE', '日期');



//URL
defined('OSS_URL')              OR define('OSS_URL','http://oss.yi-play.com'); //res.yogee.cn

/*
|--------------------------------------------------------------------------
| Database tables name
|--------------------------------------------------------------------------
|
| defined database tables name.
|
*/
defined('SYSTEM_MENU')				OR define('SYSTEM_MENU', 'system_menu');    //系统菜单表
defined('SYSTEM_ROLE')				OR define('SYSTEM_ROLE', 'system_role');    //系统管理员角色表
defined('SYSTEM_LOG')				OR define('SYSTEM_LOG', 'system_log');      //系统日志表
defined('SYSTEM_ADMIN')				OR define('SYSTEM_ADMIN', 'system_admin');  //系统管理员表

defined('USER')				OR define('USER', 'user');  //用户表
defined('USER_INFO')			OR define('USER_INFO', 'user_info');  //用户信息表

defined('MESSAGE')			OR define('MESSAGE', 'message');  //消息表
defined('NEWS_CHANNEL')			OR define('NEWS_CHANNEL', 'news_channel');  //渠道表
defined('ACTIVITY')			OR define('ACTIVITY', 'activity');  //活动表