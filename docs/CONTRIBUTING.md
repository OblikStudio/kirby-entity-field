# Contributing

Thank you for showing interest in helping out! Please, note that code and pull requests are not the only way you can contribute. You can also:

- Submit bug reports on the [Issues page](https://github.com/OblikStudio/kirby-entity-field/issues)
- Clarify things in [the README documentation](https://github.com/OblikStudio/kirby-entity-field/blob/master/docs/README.md)
- Support development by [sponsoring us](https://github.com/sponsors/OblikStudio) 💖

## Development

Here's what you need to set up a local development environment.

### Tools

The versions listed below are recommended, not required.

- [Apache](https://httpd.apache.org/download.cgi) 2.4.53
- [PHP](https://www.php.net/downloads.php) 8.1.6
  - [Composer](https://getcomposer.org/download/) 2.3.7
- [Volta](https://volta.sh/) 1.0.8 (optional)
  - [Node](https://nodejs.org/en/download/) 18.7.0
  - [npm](https://www.npmjs.com/) 8.15.0

### Setup

1. Clone the repo `git clone git@github.com:OblikStudio/kirby-entity-field.git`
1. Install npm dependencies with `npm i`
1. Install Composer dependencies with `composer install`

### Workflow

#### Test Site

This repo also doubles as a test website for the plugin. Once you run `composer install`, you'll download Kirby. After you've started Apache, you'll be able to open the project in the browser and see a simple webpage. Then, you can navigate to `http://localhost/panel` and test how the link field behaves in the admin interface.

This is done with the help of `index.site.php`. All files related to the test site are excluded from the final package in `.gitattributes`.

#### Code Formatting

I follow PSR for PHP and Prettier defaults for everything else. The only exception is the use of spaces. I like tabs for their accessibility, flexibility, and ease of use. Please, don't switch the project to spaces.

If you use VS Code for editing code, you can install the following extensions to get auto-formatting:

- [Prettier](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode)
- [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)

---

Thank you! 🙏
