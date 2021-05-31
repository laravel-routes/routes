# Command Options

---

- [Command Options](#command)

<a name="command"></a>

## Introduction

Artisan is the command line interface included with Laravel. Artisan exists at the root of your application as the `artisan` script and provides a number of helpful commands that can assist you while you build your application. To view a list of all available Artisan commands, you may use the `list` command:

```bash
php artisan list
```
Every command also includes a "help" screen which displays and describes the command's available arguments and options. To view a help screen, precede the name of the command with `help`:

```bash
php artisan make:route --help
````

To generate a route class you can check in the [basic](/docs/#/en/1.0.0/usage/basic)

```options
Description:
  Create a new route class

Usage:
  make:route [options] [--] <name>

Arguments:
  name                         The name of the class

Options:
  -f, --force                  Create the route class even if the class already exists
  -r, --resource               Create new route class with resource mode
  -c, --controller=CONTROLLER  Add controller to the route class
  -F, --facade                 Create a new facade for route class
  -a, --aliases[=ALIASES]      Customize name on aliases
  -h, --help                   Display this help message
  -q, --quiet                  Do not output any message
  -V, --version                Display this application version
      --ansi                   Force ANSI output
      --no-ansi                Disable ANSI output
  -n, --no-interaction         Do not ask any interactive question
      --env[=ENV]              The environment the command should run under
  -v|vv|vvv, --verbose         Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```
