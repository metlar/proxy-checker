# Proxy-checker

A PHP class to check proxy.

There are a ton of different methods of check proxy using PHP.

I created this class for quick and multi threads proxy servers checking.
## Installation (via composer)

[Get composer](http://getcomposer.org/doc/00-intro.md) and add this in your requires section of the composer.json:

```
{
    "require": {
        "metlar/proxy-checker": "*"
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
 - add proxy to file `source/proxylist`
 - create an instance, and run `execute()`

```php
use Metlar\Proxy\ProxyChecker;
 
$proxy = new ProxyChecker();
$proxy->save('txt');
$proxy->execute();
```

- and see result active proxy in file `logs/result.txt` or in `logs/result.json` if set `$proxy->save('json')`

You can change the class settings using the additional methods:
```php
$proxy->save('txt');
$proxy->log(true);
$proxy->thread(15);
$proxy->shuffle(true);
$proxy->load('proxylist');
//$proxy->load(['127.0.0.1:80', '127.0.0.1:8080']);
$proxy->url('http://httpbin.org/get');
$proxy->consoleShow(true);
$proxy->execute();
$proxy->getArrayResult();
```

- sets quantity threads for curl, default settings: `15`
```php 
$proxy->thread(5);
``` 

- sets format save data , default settings: `txt`, can save to `json`
```php 
$proxy->save('json');
``` 

- sets logging to file `logs/result-scan.log`, default settings: `false`
```php 
$proxy->log(true);
``` 

- sets scan shuffle  list proxys, default settings: `false`
```php 
$proxy->shuffle(true);
``` 

- sets name file proxy list, default settings: `proxylist`, can take array `$proxy->load(['127.0.0.1:80', '127.0.0.1:8080']);`
```php 
$proxy->load('proxylist');
``` 

- sets checked url, default settings: `http://httpbin.org/get` 
```php 
$proxy->url('http://httpbin.org/get');
``` 

- sets show results in console, default settings: `false`
```php 
$proxy->consoleShow(true);
```

- run scan proxy 
```php 
$proxy->execute();
```

- get array result scaned list proxy, after `$proxy->execute()`
```php 
$proxy->getArrayResult();
``` 




## License

MIT license. See included LICENSE.md.