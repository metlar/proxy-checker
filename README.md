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
$proxy = $container->get(ProxyChecker::class);
$proxy
    ->thread(5)
    ->setProxy(["176.9.63.62:3128", "176.9.75.42:3128"])
    //->saveFormat('json')
    ->getArray();
```

- and see result active proxy in file `logs/result.txt` or in `logs/result.json` if set `$proxy->save('json')`

You can change the class settings using the additional methods:
```php
$proxy->thread(15);
$proxy->execute();
$proxy->getArray();
```

- sets quantity threads for curl, default settings: `15`
```php 
$proxy->thread(5);
``` 

- sets format save data , default settings: `txt`, can save to `json`, `csv`
```php 
$proxy->saveFormat('json');
``` 

- run scan proxy 
```php 
$proxy->execute();
```

- get array result scaned list proxy
```php 
$proxy->getArray();
``` 

- file settings `config/settings/default.yml`
```php 
path_proxy_list: '/../../../source/' 
filename_proxy_list: 'proxylist.txt'
path_results: '/../../../logs/'
filename_results: 'result'
checkpoint_url: 'http://httpbin.org/get'
show_result_in_console: true
``` 

## License

MIT license. See included LICENSE.md.