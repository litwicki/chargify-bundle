Litwicki ChargifyBundle
===

A bundle intending to seamlessly integrate to [Chargify](http://chargify.com) via their Api.

![Development Status](https://img.shields.io/badge/development-active-green.svg) ![Seeking Maintainers](https://img.shields.io/badge/contributors-2-red.svg) ![License](https://img.shields.io/badge/License-MIT-blue.svg)

![Build](https://img.shields.io/badge/maintainability-54-orange.svg) ![Accessibility](https://img.shields.io/badge/accessibility-69-blue.svg)  ![Simplicity](https://img.shields.io/badge/simplicity-75-green.svg) ![Bugs](https://img.shields.io/badge/bug_probability_reduction-46-orange.svg) 

![Symfony](https://img.shields.io/badge/Symfony-3.*-green.svg) ![Laravel](https://img.shields.io/badge/Laravel-5.3.*-red.svg) ![PHP](https://img.shields.io/badge/PHP-7.*-blue.svg)


## Setup

Installation and configuration requires three simple steps.

### 1. Download the bundle

****IMPORTANT**** While in early development, you will need to set your `minimum-stability` to `dev-master` to use this bundle.

    $ composer require "litwicki/chargify-bundle"

### 2. Enable the bundle

    // app/AppKernel.php
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...
                new Litwicki\Bundle\ChargifyBundle\LitwickiChargifyBundle(),
            );

            // ...
        }
    }

### 3. Configure the bundle

    # app/config/config.yml
    litwicki_chargify:
        test_mode: false
        data_format: json
        route_prefix: /chargify
        domain: ~
        api_key: ~
        shared_key: ~

Optionally, you can include integration for [Chargify Direct](https://docs.chargify.com/api-call) (API V2)
        
        # app/config/config.yml
        chargify:
            direct:
                api_id: ~
                api_secret: ~
                api_password: ~

### 4. Serialization

Serialization is required to process Objects with the API so you will need to make sure you have enabled the serializer.

If not, you can do that by [following these instructions](http://symfony.com/doc/current/cookbook/serializer.html)

    # app/config/config.yml
    framework:
        # ...
        serializer:
            enabled: true
        
    get_set_method_normalizer:
        class: Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer
        tags:
            - { name: serializer.normalizer }

## Contributing

Thank you for considering contributing to this bundle! This bundle is in early development and is actively seeking maintainers.

***I am particularly interested in help with the following:***

* Testing all the things
* Identityfing and patching any security issues
* Rewrite the Entity layer into agnostic Models
* Forking/refactoring for use with Laravel

## Work-In-Progress Items:

+ Fix deserialization into Entity
+ Develop v2 API layer (handlers) for handling calls, signups, and card updates
+ For v2 API can we require HTTPS?
+ Build ability for saving all data locally
+ Force all submissions to pass through Form validation
+ Setup serialization groups so read_only fields aren't submitted via POST or PUT when serializing a full entity.

## License

This bundle is open-sourced software licensed under the MIT license.

### Thanks

This bundle is developed and sponsored by the team at [Zoadilack](http://www.zoadilack.com).