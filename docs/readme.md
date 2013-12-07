---
title: Facile Component
---

* [Installation](#installation)
* [Configuration](#configuration)

`Orchestra\Facile` simplify the need to create API based response in your Laravel 4 application, with just the following code you are able to return multi format Response, either it be HTML (using `View`), json or etc.

	Route::get('users{format}', function ($format = '.html')
	{
		$users = User::all();

		return Facile::make('default')
			->view('users')
			->with(['users' => $users])
			->status(200)
			->format(substr($format, 1))
			->render();

	})->where('format', '\.?(json|html)?');

## Installation {#installation}

To install through composer, simply put the following in your `composer.json` file:

	{
		"require": {
			"orchestra/facile": "2.0.*"
		}
	}

## Configuration {#configuration}

Next add the service provider in `app/config/app.php`.

	'providers' => array(

		// ...

		'Orchestra\Facile\FacileServiceProvider',
	),

You might want to add `Orchestra\Support\Facades\Facile` to class aliases in `app/config/app.php`:

	'aliases' => array(

		// ...

		'Facile' => 'Orchestra\Support\Facades\Facile',
	),
