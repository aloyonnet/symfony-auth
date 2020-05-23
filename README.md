symfony5 auth
========================

This project is a simple website wich use symfony elements to make a user system.
It cover some different things :
  * Authentication
  * Registration
  * Logout
  * Remember me

Needs (what I used)
------------

  * PHP 7.2.5 or more;
  * more on [needs of symfony][1].

Installation
------------

Get the project from github:

```bash
$ git clone https://github.com/aloyonnet/symfony5-auth.git
```

Install the dependencies:

```bash
$ composer install
```

link your app to a database:
```bash
/.env
$ DATABASE_URL=...
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
$ cd my_projet/public/
$ symfony serve
```

If symfony binary is not installed, you can replace the command with: 
`php -S localhost:8000 -t public/`


[1]: https://symfony.com/doc/current/reference/requirements.html