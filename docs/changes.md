---
title: Facile Change Log

---

## Version 2.2 {#v2-2}

### v2.2.0 {#v2-2-0}

* Bump minimum version to PHP v5.4.0.
* Rename `Orchestra\Facile\Environment` to `Orchestra\Facile\Factory`.

## Version 2.1 {#v2-1}

### v2.1.0 {#v2-1-0}

* Update code to support `Illuminate\Support\Contracts\ArrayableInterface` support in `Illuminate\Pagination\Paginator`
* Refactor `Orchestra\Facile` to only include minimal dependency injection.

## Version 2.0 {#v2-0}

### v2.0.5 {#v2-0-5}

* Implement [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) coding standard.

### v2.0.4 {#v2-0-4}

* Update code to support `Illuminate\Support\Contracts\ArrayableInterface` support in `Illuminate\Pagination\Paginator` and refactor Facile to receive app instance.
* Multiple refactors.

### v2.0.3 {#v2-0-3}

* Fixed `Orchestra\Facile\FacileServiceProvider` causing an infinite loop while trying to register the deferred service.

### v2.0.2 {#v2-0-2}

* Check request header to detect allowed Content-Type instead of manually figuring out the format.
* Fixed typehinting to `Eloquent`.

### v2.0.1 {#v2-0-1}

* Code improvements.

### v2.0.0 {#v2-0-0}

* Migrate `Orchestra\Facile` from Orchestra Platform 1.2.
