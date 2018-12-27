# A11Y Menu PHP Version

This package is a PHP version of the npm a11y-menu markup generation utilities.

The goal is to provide a developer experience similar to the a11y-menu javascript package. That includes:

- Generating menus from JSON
- Providing access to the minimal styles and script from the a11y-menu package
- Allowing developers a straightforward menu generation experience

## Installation
This package should be installed with composer - `composer require aberkow/a11y-menu-php`.

## Requirements
Using the markup generator requires a JSON file with the following format.
```json
{
  "menu": [
    {
      "name": "Display Name",
      "slug": "slugified-name",
      "link": "/route",
      "sub": false,
      "classes": ["optional", "classes"]
    }
  ]
}
```

if a submenu is required, mark the `sub` property as `true` and provide a `menu` property with an array of menu items. For example

```json
{
  "menu": [
    {
      "name": "Display Name",
      "slug": "slugified-name",
      "link": "/route",
      "sub": true,
      "classes": ["optional", "classes"],
      "menu": [
        {
          "name": "Submenu Item 1",
          "slug": "submenu-item-1",
          "link": "/submenu-item-1",
          "sub": false
        },
        {
          "name": "Submenu Item 2",
          "slug": "submenu-item-2",
          "link": "/submenu-item-2",
          "sub": false
        }
      ]
    }
  ]
}
```

## Use

Using the menu generator is straightforward. It requires

- the base stylesheet
- the base Navigation script
- using the generator's `display_menu` method

### Steps

- require the generator class
- get a json file as above and decode it
- create navigation markup
- echo the results of the generator

```php

<head>
  <link rel="stylesheet" href="vendor/ucomm/a11y-menu/dist/main.css">
</head>

<nav id="am-navigation">
  <ul id="am-php-menu">
    <?php echo A11y\Menu_Generator::display_menu($decoded->menu); ?>
  </ul>
</nav>

// before the closing body tag...
  <script src="vendor/ucomm/a11y-menu/dist/Navigation.js"></script>
```



