<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit62abead06b7c90dcb32d684559f60262
{
    public static $files = array (
        'c65d09b6820da036953a371c8c73a9b1' => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook/polyfills.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Facebook\\' => 9,
        ),
        'A' => 
        array (
            'Abraham\\TwitterOAuth\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
        'Abraham\\TwitterOAuth\\' => 
        array (
            0 => __DIR__ . '/..' . '/abraham/twitteroauth/src',
        ),
    );

    public static $classMap = array (
        'TwitterAPIExchange' => __DIR__ . '/..' . '/j7mbo/twitter-api-php/TwitterAPIExchange.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit62abead06b7c90dcb32d684559f60262::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit62abead06b7c90dcb32d684559f60262::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit62abead06b7c90dcb32d684559f60262::$classMap;

        }, null, ClassLoader::class);
    }
}
