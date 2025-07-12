
1) install pecl:
```shell
sudo apt-get install php-dev php-pear
```



2) install before swoole:
 ```shell
   sudo apt-get install libcurl4-openssl-dev
   apt install libbrotli-dev
```

```shell
sudo apt update
sudo apt install -y \
build-essential \
php-dev \
php-pear \
libssl-dev \
libc-ares-dev \
libcurl4-openssl-dev \
libnghttp2-dev \
autoconf \
pkg-config \
re2c
```




3) install swoole:
```shell
pecl install -D 'enable-sockets="yes" enable-openssl="yes" enable-http2="yes" enable-mysqlnd="yes" enable-swoole-json="no" enable-swoole-curl="yes" enable-cares="yes"' swoole
```







4) add ex on ini:
```
   /etc/php/8.4/cli/conf.d/20-swoole.ini
```
append-->
   extension=swoole.so




5) install ex swoole on php:
```shell
   sudo apt install php8.4-curl
   php -m | grep curl
   sudo apt install php8.4-mysql
   php -m | grep mysql
```




6) successful
  ```shell
 php -m
```
   show all installed modules - find swoole


-----
ide helper
`
composer require --dev swoole/ide-helper
`