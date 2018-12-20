# Corner

[![Linux Build Status](https://travis-ci.org/paragonie/corner.svg?branch=master)](https://travis-ci.org/paragonie/corner)
[![Latest Stable Version](https://poser.pugx.org/paragonie/corner/v/stable)](https://packagist.org/packages/paragonie/corner)
[![Latest Unstable Version](https://poser.pugx.org/paragonie/corner/v/unstable)](https://packagist.org/packages/paragonie/corner)
[![License](https://poser.pugx.org/paragonie/corner/license)](https://packagist.org/packages/paragonie/corner)
[![Downloads](https://img.shields.io/packagist/dt/paragonie/corner.svg)](https://packagist.org/packages/paragonie/corner)

PHP Exceptions and Errors designed to prevent your users from sharp corners.
Inspired by [Rust's helpful error messages](https://twitter.com/acfoltzer/status/1074813646625169408).

* Version 2.x: **Requires PHP 7.1 or newer.**
* Version 1.x: Requires PHP 5.4 or newer.

## Motivation 

There are already libraries like [Whoops](https://github.com/filp/whoops) which
focus on taking existing uncaught Exceptions and giving them a user interface.

Rather than take control of your entire UI output, Corner extends the base
`Throwable` interface and `Exception`/`Error` classes and makes them more useful
even in non-UI contexts.

## Corner's Extended Exception API

### `getHelpfulMessage()`

> What *exactly* is going on here?

Imagine an email. `Throwable::getMessage()` can be likened to the
subject line. In traditional exceptions, the closest thing you have
to a message body is `getTraceAsString()`.

In Corner, the "helpful message" is meant to be a full-text explanation
of the problem. ASCII art diagrams (hard-coded or generated from the
source code, if applicable) are permitted.

### `getSnippet($before = 0, $after = 0, $traceWalk = 0)`

> What was the code surrounding the exception doing?

By default, this returns the line of PHP code that triggered the exception.

You can optionally pass a number of leading and trailing lines to this method
to read more text from the source code file. The third argument allows you
to excerpt snippets of code from within the stack trace.

The main use case for `getSnippet()` is to generate helpful error messages
for `getHelpfulMessage()`.

### `getSupportLink()`

> Where can I find help?

The intent of this method is to give the developer using your project the
quickest possible path to troubleshooting and solving the problem that
they're most likely facing if this Exception / Error gets thrown.

If possible, link to a specific section of your project's documentation
(including page anchors, if applicable) to get the developer closer to
the solution to whatever problem they're encountering.
