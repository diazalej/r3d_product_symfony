# R3D Product Test

## Requirements
* Symfony3
* Mysql

## Before starting

### Project configuration
Before start running the project. Go to `app/config/parameters.yml` and change parameters for `database` and `mailer` to use the desired credentials:

For the database setup: 

``` yaml
    database_port: 8889 # using MAMP mysql instance port
    database_name: r3d_products
    database_user: root
    database_password: root
```
For mailer settings, in this case I'm using gmail smtp. Change to desired config. ex:

``` yaml
    mailer_transport: smtp
    mailer_host: smtp.gmail.com
    mailer_user: diazalej@gmail.com
    mailer_password: __CHANGEME__
    mailer_auth_mode: login
    mailer_port: 587
    mailer_encryption: tls

    product_email_from: diazalej@gmail.com
    product_email_to: diazalej@gmail.com
    product_email_subject: New product added...
```

### Migrations

Once the project paramaters are set, execute doctrine migrations

``` bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force --dump-sql
```

## Running Symfony. 

``` bash
$ php bin/console server:run
```
Open the application at: http://127.0.0.1:8000/