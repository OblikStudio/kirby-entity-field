# Kirby Entity Field

Kirby field that allows you to add other fields to it with the intention of scoping them. It works like a Structure with one entry but with much cleaner UI.

![panel screenshot](screen.png)

## Installation

From [oblik/kirby-entity-field on Packagist](https://packagist.org/packages/oblik/kirby-entity-field) using Composer:

```
composer require oblik/kirby-entity-field
```

## Usage

In the blueprint:

```yml
fields:
  header:
    type: entity
    icon: title # optional
    toggle: true # optional
    fields:
      title:
        type: text
      logo:
        type: files
```

In the template, use the `toEntity()` method:

```php
$header = $page->header()->toEntity();
echo $header->title();
```

### Toggle

When the `toggle` option is enabled, the field form can be collapsed. The state is persisted in `localStorage` for when the user navigates away from the page and back.

To enable this option globally for all fields (instead of explicitly setting it in the blueprint for each field), add the following to your `site/config/config.php`:

```php
return [
    'oblik.entity-field' => [
        'toggle' => true
    ]
];
```
