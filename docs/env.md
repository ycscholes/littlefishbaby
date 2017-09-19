# 开发环境安装

## Server
具体参考[Lumen官方文档](https://lumen.laravel.com/docs/5.5/installation "Lumen官方文档")

### 环境准备

#### 预先安装
- VirtualBox 5.1, VMWare 或者 Parallels (以下使用Parallels)
- [Vagrant](https://www.vagrantup.com/downloads.html "Vagrant")

#### 安装composer
``
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
``

#### 安装全局Homestead
``
composer require laravel/homestead --dev
``
为了能全局使用homestead命令，在~/.zshrc(或者.bashrc) 中加入
``
export PATH=~/.composer/vendor/bin:$PATH
``
安装 laravel/homestead box
``
vagrant box add laravel/homestead
``

#### 项目本地使用Homestead
在项目根目录安装Homestead
``
composer require laravel/homestead --dev
php vendor/bin/homestead make
``
修改Homestead.yaml

#### 使用lumen生成server并安装依赖
``
lumen new server
cd server
composer
``

#### 启动vagrant
``
vagrant up
``