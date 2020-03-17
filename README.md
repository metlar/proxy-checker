# Proxy-checker

A PHP class to check proxy.

There are a ton of different methods of check proxy using PHP.

I created this class for quick and multi threads proxy servers checking.

## Usage

Pretty simple. 
 - add proxy to file `source/proxylist`
 - create an instance, and run `execute()`

```php
use Metlar\Proxy\ProxyChecker;
 
$proxy = new ProxyChecker();
$proxy->saveFile('txt');
$proxy->execute();
```

- and see result active proxy in file `logs/result.txt` or in `logs/result.json` if set `$proxy->saveFile('json')`

You can change the class settings using the additional methods:
```php
$proxy->thread(5);
$proxy->saveFile('json');
$proxy->logging(true);
$proxy->shuffle(true);
$proxy->loadProxyList(null);
$proxy->checkUrl('http://httpbin.org/get');
$proxy->setGetArrayResult(true);
```

```php 
$proxy->thread(5);
``` 
- sets quantity threads for curl, default settings: `15`
```php 
$proxy->saveFile('json');
``` 
- sets format save data
```php 
$proxy->logging(true);
``` 
- sets logging to file `logs/result-scan.log`
```php 
$proxy->shuffle(true);
``` 
- sets scan shuffle  list proxys, default settings: `false`
```php 
$proxy->loadProxyList(null);
``` 
- sets name file proxy list, default settings: `proxylist`
```php 
$proxy->checkUrl('http://httpbin.org/get');
``` 
- sets checked url, default settings: `http://httpbin.org/get`  
```php 
$proxy->setGetArrayResult(true);
``` 
- sets settings to `true` to return array result scaned list proxy, default settings: `false`




## License

Imap is licensed under the MIT license. See included LICENSE.md.