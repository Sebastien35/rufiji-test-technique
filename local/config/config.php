<?php

    session_cache_expire(120);
    ini_set("session.gc_maxlifetime","7200");
    session_start();

    if(getenv('DEV_MODE')) {
        $devMode = getenv('DEV_MODE');
    } else {
        $devMode = 'prod';
    }
    defined('DEV_MODE') || define('DEV_MODE', $devMode);

    // Dev mode params
    switch(DEV_MODE){
        case 'server_test' :
            error_reporting(E_ERROR | E_PARSE);
            $dbHost           = 'db';
            $dbName           = 'cms';
            $dbUsername       = 'root';
            $dbPwd            = 'docker1234';
            $serverImg        = '/var/www/local/public/';
            $serverCms        = '/var/www/local/public/';
            $serverDir        = '/var/www/local/';
            $http             = 'https://';
            $websiteUrl       = $http . $_SERVER['HTTP_HOST'];
            $keyHashJwt       = '^t8_KNi`PW~*czf';
            $coinGeckoApiUrl  = "https://api.coingecko.com/api/v3/";
            $coinGeckoApiKey =  "";
            $currencyApiKey = "";
        break;
        case 'prod' :
        break;
    }
    defined('SERVER_DIR_URL')     || define('SERVER_DIR_URL', $serverDir);
    defined('SERVER_IMG_URL')     || define('SERVER_IMG_URL', $serverImg);
    defined('SERVER_CMS_URL')     || define('SERVER_CMS_URL', $serverCms);
    defined('URL_HTTP')           || define('URL_HTTP', $http);
    defined('WEBSITE_URL')        || define('WEBSITE_URL', $websiteUrl);
    defined('KEY_HASH_JWT')       || define('KEY_HASH_JWT', $keyHashJwt);
    defined('COINGECKO_API_URL')  || define('COINGECKO_API_URL', $coinGeckoApiUrl);
    defined('COINGECKO_API_KEY')  || define('COINGECKO_API_KEY', $coinGeckoApiKey);
    defined('CURRENCY_API_KEY')   || define('CURRENCY_API_KEY', $currencyApiKey);

    if(DEV_MODE == 'prod'){
        ini_set("display_errors", 1);
        set_error_handler('my_error_handler');
        set_exception_handler('my_exception_handler');
    }

    // Define bdd ids
    defined('DB_HOST') || define('DB_HOST', $dbHost);
    defined('DB_NAME') || define('DB_NAME', $dbName);
    defined('DB_USERNAME') || define('DB_USERNAME', $dbUsername);
    defined('DB_PWD') || define('DB_PWD', $dbPwd);
    
    // Liste des langues disponibles
    defined('AVAILABLE_LANGUAGES') || define('AVAILABLE_LANGUAGES', array(
        'en_EN' => array(
            'lang'         => 'en',
            'currencyName' => 'usd',
            'lang_f'       => 'English'
        ),
        'fr_FR' => array(
            'lang'         => 'fr',
            'currencyName' => 'eur',
            'lang_f'       => 'Français'
        )
    ));

    // Define lang
    if (isset($_GET['lang']) && $_GET['lang'] == 'en') {
        $lang = 'en_EN';
    } else if (isset($_COOKIE['languser'])) {
        $lang = $_COOKIE['languser'];
    } else {
        $navigatorLanguage = 'FR';

        if ($navigatorLanguage == 'EN') {
            $lang = 'en_EN' ;
        } else {
            $lang = 'fr_FR' ;
        }

        setcookie('languser', $lang, time()+7776000, '/');
    }

    if ($lang == 'en_EN') {
        $idlang       = 1;
        $currency     = '$';
        $currencyName = 'usd';
    }
    else {
        $idlang       = 2;
        $currency     = '€';
        $currencyName = 'eur';
    }

    defined('IDLANG')    || define('IDLANG', $idlang);
    defined('LANG_FILE') || define('LANG_FILE', $lang);
    defined('LANG')      || define('LANG', substr($lang, 0, 2));

    defined('CURRENCY')      || define('CURRENCY', $currency);
    defined('CURRENCY_NAME') || define('CURRENCY_NAME', $currencyName, true);

    function autoloader($className){
        if(strstr($className, 'Controller')) {
            include_once(SERVER_DIR_URL.'/modules/common/controllers/'.$className.'.php');
        } else {
            include_once(SERVER_DIR_URL.'/models/'.$className.'.php');
        }
    }
    spl_autoload_register('autoloader');

    // On récupère les variables globales en BDD
    $commonModels = new CommonModels();

    $pdo      = $commonModels->pdoConnect();
    $result   = $pdo->prepare("SELECT * FROM `general_settings` WHERE 1");
    $result->execute();

    $settings = $result->fetchAll(PDO::FETCH_ASSOC);
    foreach ($settings as $setting) {
        defined($setting['ENV']) || define($setting['ENV'], $setting['value']);
    }

    $pdo      = $commonModels->pdoConnect();
    $result   = $pdo->prepare("SELECT * FROM `website_settings` LEFT JOIN `website_settings_lang` ON `website_settings`.`id` = `website_settings_lang`.`id_setting` WHERE `id_lang` = " . IDLANG);
    $result->execute();

    $settings = $result->fetchAll(PDO::FETCH_ASSOC);
    foreach ($settings as $setting) {
        defined($setting['ENV']) || define($setting['ENV'], $setting['value']);
    }

    $pdo      = $commonModels->pdoConnect();
    $result   = $pdo->prepare("SELECT * FROM `blog_settings` LEFT JOIN `blog_settings_lang` ON `blog_settings`.`id` = `blog_settings_lang`.`id_setting` WHERE `id_lang` = " . IDLANG);
    $result->execute();
    $settings = $result->fetchAll(PDO::FETCH_ASSOC);
    foreach ($settings as $setting) {
        defined($setting['ENV']) || define($setting['ENV'], $setting['value']);
    }

    include_once 'lang/'. LANG_FILE .'.php';
