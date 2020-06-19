symfony auth
========================

This project is a simple website which use symfony elements to make a user system.
It cover some different things :
  * Authentication
  * Registration
  * Logout
  * Remember me
  * Administration (to use roles and access restrictions)

Needs (what I used)
------------

  * PHP 7.2.5 or more;
  * more on [needs of symfony][1].

Installation
------------

Get the project from github:

```bash
$ git clone https://github.com/aloyonnet/symfony-auth.git
```

link your app to a database:
copy .env.example and rename the file to .env
```bash
/.env
$ DATABASE_URL=...
```

Install the dependencies:

```bash
$ composer install
```

create the content of the database:
```bash
$ php bin/console make:migration
$ php bin/console doctrine:migrations:migrate 
```

Use
-----
for non production use, you can launch a server (with <https://localhost:8000> by default) using :

```bash
$ cd my_project/public/
$ symfony serve
```

If symfony binary is not installed, you can replace the command with: 
`php -S localhost:8000 -t public/`

Data fixtures :
```bash
$ php bin/console doctrine:fixtures:load
```


[1]: https://symfony.com/doc/current/reference/requirements.html
