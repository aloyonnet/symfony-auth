symfony auth
========================

This project is a simple website which uses symfony elements to make a user system.
It cover some different things :
  * Authentication
  * Registration
  * Logout
  * Administration (to use roles and access restrictions)

Needs (what I used)
------------

  * PHP 8 or more;
  * more on [needs of symfony][1].

Install
------------

Clone the project :

```bash
$ git clone https://github.com/aloyonnet/symfony-auth.git
```

Create the .env file:

```bash
$ cp .env-template .env
```

Then, install the dependencies:

```bash
$ composer install
```

Create the link with the database:
```bash
/.env
$ DATABASE_URL=...
```

We will now create the database and all the columns :
```bash
//create the database
$ php bin/console doctrine:database:create
//generate the migration
$ php bin/console make:migration
//execute the migration
$ php bin/console doctrine:migrations:migrate
```

For the default users, you will need to execute the fixtures :
```bash
$ php bin/console doctrine:fixtures:load
```

Use
-----

for non production use, you can launch a server (with <https://localhost:8000> by default) using :

```bash
$ cd projet/
$ symfony serve
```

If symfony binary is not installed, you can replace the command with:
`php -S localhost:8000 -t public/`

[1]: https://symfony.com/doc/current/reference/requirements.html
