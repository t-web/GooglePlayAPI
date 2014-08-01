GooglePlayAPI
=============

Tiny (unofficial) GooglePlay API written in PHP

This API is written in PHP and use the fantastic [googleplay-api](https://github.com/egirault/googleplay-api) (Python) written by @egirault, he made all the work, thanks !

Disclaimer
==========

This is not an official API. I am not afiliated with Google in any way, and am not responsible of any damage that could be done with it. Use it at your own risk.

How to use it ?
===============

More info here : (How To Use, wiki page)[https://github.com/AMDG2/GooglePlayAPI/wiki/How-to-use]

To use the GooglePlayAPI you need to install the python [googleplay-api](https://github.com/egirault/googleplay-api) somewhere on your system.

Then you need to change the python API location in the main file, by default it's searching for the API in `/opt/googleplay-api/`.

Don't forget, the Python API folder must be writtable by the user who run the PHP API.

## Code
```php
$api = new GooglePlayAPI();

// Search for an app
$resultsList = $api->search("Firefox");

// Download an app
$pathToAPKFile = $api->download(__DIR__.'/packages/', 'org.mozilla.firefox', '2014060517');

// More to come

```

License
=======
This library is licensed under GPLv3+, the Python API used is under the BSD License
