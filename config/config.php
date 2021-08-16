<?php

define('APP_NAME', 'Module 29');
define('URL', '/'); // URL текущей страницы

/**
 * VK OAuth settings
 */

 define("VK_OAUTH", 
    array(
        "clientId"      => '7819482', // ID приложения
        "clientSecret"  => '5mMNTgCJaqoeJMfIS13s',// Защищённый ключ
        // "redirectUri"   => 'https://oauth.vk.com/blank.html',
        "redirectUri"   => 'http://project.test/vk-auth',
        // "display"       => 'popup',
        'response_type' => 'code',
        'v'             => '5.126', // (обязательный параметр) версиb API https://vk.com/dev/versions
        // Права доступа приложения https://vk.com/dev/permissions
	// Если указать "offline", полученный access_token будет "вечным" (токен умрёт, если пользователь сменит свой пароль или удалит приложение).
	// Если не указать "offline", то полученный токен будет жить 12 часов.
	    'scope'         => 'email',//'photos,offline',
    )
);