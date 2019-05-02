<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit118845d804b9384f31ff42d88ab15c6d
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit118845d804b9384f31ff42d88ab15c6d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit118845d804b9384f31ff42d88ab15c6d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
