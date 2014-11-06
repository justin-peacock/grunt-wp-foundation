# grunt-wp-foundation

> Create a WordPress theme with [grunt-init][].

[grunt-init]: http://gruntjs.com/project-scaffolding

## Installation
If you haven't already done so, install [grunt-init][].

Once grunt-init is installed, place this template in your `~/.grunt-init/` directory. It's recommended that you use git to clone this template into that directory, as follows:

### Linux/Mac Users

```
git clone git@github.com:mrdink/grunt-wp-foundation.git ~/.grunt-init/wp-foundation
```

### Windows Users

```
git clone git@github.com:mrdink/grunt-wp-foundation.git %USERPROFILE%/.grunt-init/wp-foundation
```

## Usage

At the command-line, cd into an empty directory, run this command and follow the prompts.

```
grunt-init wp-foundation
```

_Note that this template will generate files in the current directory, so be sure to change to a new directory first if you don't want to overwrite existing files._

## Development

Set the following to use un-minified versions of the assets.

```php
define( 'WP_ENV', 'development' );
```

### Install Grunt and Bower

**Unfamiliar with npm? Don't have node installed?** [Download and install node.js](http://nodejs.org/download/) before proceeding.

From the command line:

1. Install `grunt-cli` and `bower` globally with `npm install -g grunt-cli bower`.
2. Navigate to the theme directory, then run `npm install`. npm will look at `package.json` and automatically install the necessary dependencies. It will also automatically run `bower install`, which installs front-end packages defined in `bower.json`.

When completed, you'll be able to run the various Grunt commands provided from the command line.

You will need write permission to the global npm directory to install `grunt-cli` and `bower`. You will also likely have to be using an elevated terminal or prefix the command with `sudo`, i.e., `sudo npm install -g grunt-cli bower`.

### Available Grunt commands

* `grunt dev` — Compile Sass to CSS, concatenate and validate JS
* `grunt watch` — Compile assets when file changes are made
* `grunt build` — Create minified assets that are used on non-development environments

## Credit

Forked from [grunt-wp-theme](https://github.com/10up/grunt-wp-theme/) by [10up](http://10up.com/).
