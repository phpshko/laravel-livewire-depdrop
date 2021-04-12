# Livewire DepDrop

This package provides a dependent dropdown

## :rocket: Installation

You can install the package via composer:

```bash

composer require phpshko/laravel-livewire-depdrop

```

## Publishing Assets

Publishing assets are optional unless you want to customize this package.

```bash

php artisan vendor:publish --provider="Phpshko\LaravelLivewireDepDrop\LaravelLivewireDepDropProvider" --tag=views

```

## Usage

Create you livewire component and extends 

like this

```php
<?php

namespace App\Http\Livewire;

use Phpshko\LaravelLivewireDepDrop\DepDropComponent;

class CountryDropdown extends DepDropComponent
{
    public function getValues(): array
    {
        return Country::get()->pluck('name', 'id');
    }
}


```

or this (use parent dropdown value)

```php
<?php

namespace App\Http\Livewire;

use Phpshko\LaravelLivewireDepDrop\DepDropComponent;

class StateDropdown extends DepDropComponent
{
    public function getValues(): array
    {
        return State::where('country_id', $this->parentValue)->pluck('name', 'id');
    }
}


```

### In view

for root dropdown

```
@livewire('country-dropdown', ['depId' => 'country', 'placeholder' => 'Select country'])

```

for depended dropdown need set **parentId** like

```
@livewire('state-dropdown', ['depId' => 'state', 'parentId' => 'country', 'placeholder' => 'Select state'])

```

### You can also set properties (in view or class of component)

**placeholder**

**name**

**cssClass**

**hideOnParentEmpty**

**hideOnValuesEmpty**

There is no limit on the number of dropdowns

```
    @livewire('country-dropdown', ['depId' => 'country', 'placeholder' => 'Select country'])

    @livewire('state-dropdown', ['depId' => 'state', 'parentId' => 'country', 'placeholder' => 'Select state'])

    @livewire('city-dropdown', ['depId' => 'city', 'parentId' => 'state', 'placeholder' => 'Select city'])

    @livewire('area-dropdown', ['depId' => 'area', 'parentId' => 'city'])

```

### Event

You can listen event **depdropSelected** to catch when dropdown is selected

## Demo

![Demo 1](https://github.com/phpshko/files/raw/main/depdrop/1.gif)

With hideOnParentEmpty and hideOnValuesEmpty is true

![Demo 2](https://github.com/phpshko/files/raw/main/depdrop/2.gif)