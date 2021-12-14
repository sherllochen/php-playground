## Dockerifle for base environment.
**path:** ./vendor/laravel/sail/runtimes/8.1

## Once you need to edit the Dockerfile of base env. Run command below, and then all Docker related file will be copy to \docker, and the dockerfile references in docker-compose.yml will be updated automaticlly. 
```shell
./vendor/bin/sail artisan sail:publish
```

## How to enable Xdebug
1. Add env value to .env.
```text
SAIL_XDEBUG_MODE=develop,debug
```
2. Toggle the Start Listen PHP Debug Connections button start listening php debug connections on the PhpStorm toolbar.
3. Install Xdebug helper in browser.
https://chrome.google.com/webstore/detail/eadndfjplgieldjbigjakmdgkmoaaaoc
4. Enable Xdebug helper extension to 'DEBUG' mode.
Reference: https://www.jetbrains.com/help/phpstorm/zero-configuration-debugging.html#enable-listening-connections
5. Add break point in PHPStorm, visit same page, and then the debug will be activated.

## Start whole environment for developing by running docker compose.
```shell
./vendor/bin/sail up
```

## Debug with tinker
```shell
./vendor/bin/sail tinker
```

## Other Commands 
1. Update local composer package
```shell
composer update sherllochen/notion-sdk-php --prefer-source
```
