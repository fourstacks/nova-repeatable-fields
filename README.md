# A repeatable field for Nova apps

This package contains a Laravel Nova field that enables the creation of repeatable sets of fields.  Nova users are free to create, reorder and delete multiple rows of data with the fields you define.  Data is saved to the database as JSON.

## Examples

![Nova repeatble field set on Nova form view](https://raw.githubusercontent.com/fourstacks/nova-repeatable-fields/master/repeatable-fields.gif)


## Installation

You can install this package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require fourstacks/nova-repeatable-fields
```
    

## Usage

To add a repeater field, use the `Fourstacks\NovaRepeatableFields\Repeater` field in your Nova resource:

```php
namespace App\Nova;

use Fourstacks\NovaRepeatableFields\Repeater;

// ...

class Petstore extends Resource
{
    // ...
    
    public function fields(Request $request)
    {
        return [
            // ...
            
            Repeater::make('Dogs'),

            // ...
        ];
    }
}
```
In order to use this package you should also ensure the Eloquent model that your Nova resource represents, is casting the attribute you wish to use a repeater field for, to an array:

```php
namespace App;

// ...

class Petstore extends Model
{
    protected $casts = [
        'dogs' => 'array'
    ]
}
```

The underlying database field should be either a `string` or `text` type field.


## Configuration

This package comes with various options that you can use to define the sub-fields within your repeater and 


#### addField

Parameters: `array`

Every repeater field you create should contain at least one field added via `addField`.  The `addField` method accepts an array of field configuration options:

```php

Repeater::make('Dogs')
    ->addField([
        // configuation options
    ])
         
```

Configuration options are:

##### label

```php
[ 
    'label' => 'Dog name',
    //...
]
```

All fields must, at a minimum, be defined with a 'label'.  This is a human-readable string that will appear in the Nova UI.

##### name

```php
[ 
    'name' => 'dog_name',
    //...
]
```

By default, the name of the field (used when saving the data in the database) will be generated automatically using a snake case version of the field `label`.  Alternatively you are free to override this convention and define a custom name to be used.

##### type

```php
[ 
    'type' => 'number',
    //...
]
```

By default, the input type of the field will be a standard text field.  You are free to define a different field type if you wish.  Currently supported field types are: 'text', 'number', 'select'.

##### placeholder

```php
[ 
    'placeholder' => 'Name that dog',
    //...
]
```

By default, the input placeholder will be the same as the field `label`.  However you are free to define a custom placeholder using this option that will appear instead.

```php
[ 
    'width' => 'w-1/2',
    //...
]
```

If you choose to display your fields in a row (rather than stacked - see the `displayStackedForm` option below) you can define the widths of your fields using [Tailwind's fractional width classes](https://tailwindcss.com/docs/width/#app). You do not need to define widths for all your fields unless you want to.  

Furthermore if you are displaying your form as a stacked form then width options will have no effect.

##### options

```php
[ 
    'options' => [
        'fido' => 'Fido',
        'mr_bubbles' => 'Mr Bubbles',
        'preston' => 'Preston'
    ]',
    //...
]
```

If the `type` of the field you are defining is 'select', you will need to define an array of options for the select field.  These are defined using an array of key/value pairs.


#### addButtonText

```php
Repeater::make('Dogs')
    ->addButtonText('Add new dog');
```

You are free to configure the text for the button used to add a new repeater row in the Nova UI.  By default this button is labelled 'Add row' but you can override this using the `addButtonText` option.


#### addButtonText

```php
Repeater::make('Dogs')
    ->summaryLabel('Dogs');
```

The detail and index views show a summary of the data added using the repeater field.  By default this will show the count of the rows e.g. '3 rows' along with a link to expand to show the full data that was inputted.  You can overrides this summary text to something more specific  e.g. '3 Dogs'.


#### displayStackedForm

```php
Repeater::make('Dogs')
    ->displayStackedForm();
```

By default, a repeater 'row' will appear as a series of  horizontally aligned fields.  This works well for repeater fields with only 2 or 3 subfields, however for larger field sets a stacked form that displays repeater subfields above one another will generally be a more usable layout.  You can switch to a stacked layout using this option.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Credits

- [John Wyles](https://github.com/fourstacks)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.