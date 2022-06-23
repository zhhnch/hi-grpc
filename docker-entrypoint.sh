#!/usr/bin/env bash

dir=$(dirname "$0")

if [[ ! -d $dir/vendor ]]; then
  composer config -g repo.packagist composer https://mirrors.aliyun.com/composer
  composer install -q -o
fi

php "$dir"/bin/hyperf.php start

echo "$@"