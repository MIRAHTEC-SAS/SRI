<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit133173957253f255bec446dd7eeb0fef
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/src/Twilio',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit133173957253f255bec446dd7eeb0fef::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit133173957253f255bec446dd7eeb0fef::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit133173957253f255bec446dd7eeb0fef::$classMap;

        }, null, ClassLoader::class);
    }
}
