<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitefb00bed5dd905e50190c2044a9d8c4c
{
    public static $prefixLengthsPsr4 = array (
        'e' => 
        array (
            'enshrined\\svgSanitize\\' => 22,
        ),
        'S' => 
        array (
            'ScssPhp\\ScssPhp\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'enshrined\\svgSanitize\\' => 
        array (
            0 => __DIR__ . '/..' . '/enshrined/svg-sanitize/src',
        ),
        'ScssPhp\\ScssPhp\\' => 
        array (
            0 => __DIR__ . '/..' . '/scssphp/scssphp/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitefb00bed5dd905e50190c2044a9d8c4c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitefb00bed5dd905e50190c2044a9d8c4c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitefb00bed5dd905e50190c2044a9d8c4c::$classMap;

        }, null, ClassLoader::class);
    }
}