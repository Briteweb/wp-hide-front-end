<?php

require 'vendor/autoload.php';

$functions = [
    'wp_die',
    'is_admin',
    'add_action',
];

//  Make sure we've got all the WP functions we need.
$isSafeToRun = collect($functions)->every(function ($func) {
    return function_exists($func);
});

if (! $isSafeToRun) {
    return false;
}

add_action('init', function () {
    $isLogin = in_array($GLOBALS['pagenow'], ['wp-login.php']);

    if (! is_admin() && ! $isLogin) {
        exit();
    }
});
