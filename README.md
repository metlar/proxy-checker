# Proxy-checker

A PHP class to check proxy.

There are a ton of different methods of check proxy using PHP.

I created this class for quick and multi threads proxy servers checking.
## Installation (via composer)

[Get composer](http://getcomposer.org/doc/00-intro.md) and add this in your requires section of the composer.json:

```
{
    "require": {
        "metlar/proxy-checker": "dev-master"
    }
}
```

and then

```
composer install
```
or

Simply require the package by its name with composer:
```bash
$ composer require metlar/proxy-checker
```

Run scan proxy in composer:
```bash
$ composer run:proxy
```

## Usage

Pretty simple. 
 - add proxy to file `source/proxylist.txt`
 - create an instance, and run `execute()`

```php
<?php
 require_once __DIR__ . '/../vendor/autoload.php';
 
 use \Metlar\Proxy\ProxyChecker;
 
 $container = require __DIR__ . '/../config/bootstrap/container.php';
 
 $proxy = $container->get(ProxyChecker::class);
 $proxy
     //->setProxy(["176.9.63.62:3128", "176.9.75.42:3128","47.243.228.222:59394","20.105.253.176:8080","117.127.16.205:8080"])
     ->saveToFormat('json')
     ->getResultArray();
```

- and see result active proxy in file `logs/result.txt` or in `logs/result.json` if set `$proxy->save('json')`

You can change the class settings using the additional methods:
```php
     ->setProxy(["176.9.63.62:3128", "176.9.75.42:3128","47.243.228.222:59394","20.105.253.176:8080","117.127.16.205:8080"])
     ->saveToFormat('json')
     ->getResultArray();
```


- sets format save data , default settings: `txt`, can save to `json`, `csv`
```php 
$proxy->saveToFormat('json');
``` 

- get array result scaned list proxy
```php 
$proxy->getResultArray();
``` 

- file settings `config/settings/default.yml`
```yaml 
proxy_checker:
  curl:
    checkpoint_url: 'http://httpbin.org/get'
    thread: 5
  console:
    show: true
  log_results:
    filename: 'result'
    path: '/../../../logs/'
  proxy-list:
    path: '/../../../source/'
    filename: 'proxylist.txt'
``` 

## License

MIT license. See included LICENSE.md.