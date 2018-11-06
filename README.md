Litwicki ChargifyBundle
===

A bundle intending to seamlessly integrate to [Chargify](http://chargify.com) via their Api.

![Development Status](https://img.shields.io/badge/development-active-green.svg) ![Seeking Maintainers](https://img.shields.io/badge/contributors-2-red.svg) ![License](https://img.shields.io/badge/License-MIT-blue.svg) ![Symfony](https://img.shields.io/badge/Symfony-3.*-green.svg) ![PHP](https://img.shields.io/badge/PHP-7.*-blue.svg)

![Build](https://img.shields.io/badge/maintainability-54-orange.svg) ![Accessibility](https://img.shields.io/badge/accessibility-69-blue.svg)  ![Simplicity](https://img.shields.io/badge/simplicity-75-green.svg) ![Bugs](https://img.shields.io/badge/bug_probability_reduction-46-orange.svg) 


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
    litwicki_chargify:
        # ...
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

    # app/config/services.yml
    services:
        # ...
        get_set_method_normalizer:
            class: Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer
            tags:
                - { name: serializer.normalizer }

## Usage

This Bundle functions as a middle-tier layer between your Symfony app and Chargify. The handler for each entity leverages the available RESTful operations available.

Please make sure to reference the [Chargify Api Docs](https://reference.chargify.com/) for available parameters for each object.

### `GET` - Find an object.

    //example load a Subscription by Id.
    $id = 12345;
    $handler = $this->get('chargify.handler.subscription');
    $subscription = $handler->get($id);
    
### `POST` - Create a new object.

    //let's create an example customer
    $data = array(
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com'
    );
    
    $handler = $this->get('chargify.handler.customer');
    $customer = $handler->post($data);
    
### `PUT` - Updating an existing object.

Let's update the customer record we just created (example above).

    //...
    $customer->setFirstName('Jonathan');
    $customer = $handler->put($customer);
    
### `DELETE` - Remove an object.

We changed our mind, let's remove this customer.

    $response = $handler->delete($customer);

## Contributing

Thank you for considering contributing to this bundle! This bundle is in early development and is actively seeking maintainers.

***I am particularly interested in help with the following:***

* Testing all the things
* Identityfing and patching any security issues
* Ongoing support and improvements

## Work-In-Progress Items:

+ Develop v2 API layer (handlers) for handling calls, signups, and card updates
+ Force all submissions to pass through Form validation
+ Setup serialization groups so read_only fields aren't submitted via POST or PUT when serializing a full entity.

## License

This bundle is open-sourced software licensed under the MIT license.
