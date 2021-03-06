<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6e72dccf967b384280ef1e488a91880a
{
    public static $files = array (
        '4690a9e7c83fb47f18a4e2fd55ea4358' => __DIR__ . '/..' . '/textmagic/sdk/Services/TextmagicRestClient.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
        'P' => 
        array (
            'PhpAmqpLib\\' => 11,
        ),
        'D' => 
        array (
            'DrewM\\MailChimp\\' => 16,
        ),
        'A' => 
        array (
            'ActiveCollab\\SDK\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
        'PhpAmqpLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/romainrg/codeigniter-php-amqplib/PhpAmqpLib',
        ),
        'DrewM\\MailChimp\\' => 
        array (
            0 => __DIR__ . '/..' . '/drewm/mailchimp-api/src',
        ),
        'ActiveCollab\\SDK\\' => 
        array (
            0 => __DIR__ . '/..' . '/activecollab/activecollab-feather-sdk/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Mandrill' => 
            array (
                0 => __DIR__ . '/..' . '/mandrill/mandrill/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6e72dccf967b384280ef1e488a91880a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6e72dccf967b384280ef1e488a91880a::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit6e72dccf967b384280ef1e488a91880a::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
