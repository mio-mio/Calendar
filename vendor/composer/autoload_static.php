<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc72db87a63acc5700bda1271c073e10e
{
    public static $prefixLengthsPsr4 = array (
        'Y' => 
        array (
            'Yasumi\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Yasumi\\' => 
        array (
            0 => __DIR__ . '/..' . '/azuyalabs/yasumi/src/Yasumi',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc72db87a63acc5700bda1271c073e10e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc72db87a63acc5700bda1271c073e10e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
