# Quick start

```bash
composer install
docker-compose up -d
```

Then access to http://127.0.0.1:[port]/, [port] could be found in docker-compose.yml.

# Laravel example app

### Add defaule route

Please check routes\web.php\Route::get('/{controller}/{action}' and app\Http\Controllers\ExampleController.php

Route::get('/{module}/{controller}/{action}' and app\Http\Controllers\api\TestController.php
