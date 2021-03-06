<?php
// 应用入口

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
// 设置开发模式，LOCAL使用本地模式，其他则是远程运行模式
define('DEV_MODE', 'LOCAL'); // LOCAL REMOTE
// 定义应用目录
define('APP_PATH','./Apps/');
// 定义模块绑定
$mapping = array(
	'LOCAL' => array(
		'108' => 'Web',
		'124' => 'Demo',
		'106' => 'Vshop',
		'112' => 'Api',
		'116' => 'Shop',
		'114' => 'Mobile',
		'118' => 'Control',
		'120' => 'Wechat',
		'121' => 'Admin',
		'122' => 'Site',
		'100' => 'Crm',
		'105' => 'Ciiq',
		'107' => 'Janusking',
	),
	'REMOTE' => array(
		'f-fusion.com'      => 'Web',
		'www.f-fusion.com'  => 'Web',
		'it.f-fusion.com'   => 'Web',
		'd.f-fusion.com'    => 'Demo',
		'v.f-fusion.com'    => 'Vshop',
		'a.f-fusion.com'    => 'Api',
		's.f-fusion.com'    => 'Shop',
		'm.f-fusion.com'    => 'Mobile',
		'c.f-fusion.com'    => 'Control',
		'w.f-fusion.com'    => 'Wechat',
		'xx.f-fusion.com'   => 'Janusking',
		'x.f-fusion.com'    => 'Site',
		'crm.f-fusion.com'  => 'Crm',
		'ciiq.f-fusion.com' => 'Ciiq',
		'janusking.f-fusion.com'=> 'Janusking',
	),
);
// process
if (strcmp(constant('DEV_MODE'), 'LOCAL') == 0) {
	define('APP_DEBUG', true);
	define('APP_STATUS', 'local');
	$def = $mapping[constant('DEV_MODE')];
	$pos = strripos($_SERVER['HTTP_HOST'], ':');
	if ($pos === false) {} else {
		$key = (string)substr($_SERVER['HTTP_HOST'], $pos+1);
		if (array_key_exists($key, $def)) {
			define('BIND_MODULE', $def[$key]);
		};
	};
};
if (strcmp(constant('DEV_MODE'), 'REMOTE') == 0) {
	define('APP_DEBUG', false);
	define('APP_STATUS', 'remote');
	$def = $mapping[constant('DEV_MODE')];
	$key = (string)strtolower($_SERVER['HTTP_HOST']);
	if (array_key_exists($key, $def)) {
		define('BIND_MODULE', $def[$key]);
	};
};
if (defined('BIND_MODULE') === true) {
	// 引入ThinkPHP入口文件
	require './ThinkPHP/ThinkPHP.php';
};