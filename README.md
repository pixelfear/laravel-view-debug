# Laravel View Debug

Adds HTML comments to the start and end of each view, so you can more easily keep track of what's being used.

[Inspired by this feature request.](https://github.com/statamic/ideas/issues/139)

## Example

You may have a Blade file like this:

```
My view file

    @include('sub-view')

More stuff
```

It will be rendered like this:

```
<!-- Start view: /path/to/views/my-view.blade.php -->
My view file

    <!-- Start view: /path/to/views/sub-view.blade.php -->
    Sub view
    <!-- End view: /path/to/views/sub-view.blade.php -->

More stuff
<!-- End view: /path/to/views/my-view.blade.php -->
```

Of course, since they are HTML comments, it will look no different unless you view the source.

## Installation

You can install the package via composer:

```bash
composer require pixelfear/laravel-view-debug --dev
```

## Usage

This package will be enabled while your app is in debug mode.

## Livewire

This package will conflict with Livewire because it would result in components having more than a single root node.