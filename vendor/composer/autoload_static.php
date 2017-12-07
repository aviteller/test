<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite60b847d55d54dbbdb571d322ee08f20
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpImap\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpImap\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-imap/php-imap/src/PhpImap',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite60b847d55d54dbbdb571d322ee08f20::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite60b847d55d54dbbdb571d322ee08f20::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
