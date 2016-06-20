tour
=================

Module tour

## Installation

The preferred way to install this extension is through composer.

Either run

```
php composer.phar require "giicms/tour" "dev-master"
```
or add

```json
"giicms/tour": "dev-master"
```

to the require section of your application's `composer.json` file.

## Usage Example
~~~php

 'modules' => [
        'tour' => [
            'class' => 'giicms\tour\Module',
        ],
  ],
~~~
