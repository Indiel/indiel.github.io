<?php

umask(0002);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__.'/../vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/.env')) {
    (new Dotenv())->load(dirname(__DIR__).'/.env');
}

if ($_SERVER['HTTP_HOST'] == 'dev.cashyou.ua') {
    $environment = 'dev';
} else {
    $environment = getenv('SYMFONY_ENV') ? getenv('SYMFONY_ENV') : 'prod';
}

if ($environment == 'dev' && isset($_GET['cc'])) {
        chdir('..');
        $command = 'php bin/console cache:clear --env=prod --no-debug --no-ansi';
        echo exec($command, $output, $return_var);
        echo '<pre>'; print_r($output); echo '<pre>';
        echo '<pre>'; print_r($return_var); echo '<pre>';
        exit;
}
$debugEnabled = !in_array($environment, array('prod'));

if (PHP_VERSION_ID < 70000 && !$debugEnabled) {
    include_once __DIR__.'/../var/bootstrap.php.cache';
}

if ($debugEnabled) {
    Debug::enable();
}

$kernel = new AppKernel($environment, $debugEnabled);
if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
