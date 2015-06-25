# DotA2信息管理系统(mydota)

> mydota是一个DotA2信息管理系统，基于`Laravel 5` 开发而成，通过Steam官方提供的接口采集DotA2的比赛数据，由于采用了[beanstalkd](https://github.com/kr/beanstalkd)队列，推荐采用Linux作为服务器。

###环境要求
* PHP5.5+
* Laravel5
* node.js 
* mysql



###安装说明

① 下载源码包：

Linux下执行下面命令：

```bash
git clone https://github.com/copyrenzhe/mydota.git
cd mydota
composer install
npm install
touch .env
touch api-key.php
apt-get install beanstalkd
```
② 导入数据库，并修改 `.env` 配置文件：

>将源码包根目录下的 `dota2_db.sql` 导入数据库，默认使用 `UTF-8` 编码，`utf8_unicode_ci`作为排序规则。
根据数据库与服务器实际情况修改 `.env` 配置文件
然后在根目录下执行下面命令：
```bash
php artisan migrate
```

>配制api-key.php如下：
>**API_KEY**可以在[steam申请](http://steamcommunity.com/dev/apikey)
```php
define('API_KEY','*********');	
\Dota2Api\Api::init(API_KEY,array('localhost','user','password','db_name',''),true);	//根椐数据库实际情况修改
```


③ 运行系统：
保证8000端口未被占用后
执行命令：
```bash
php artisan serve
```
然后在浏览器中输入`localhost:8000` 访问首页

④数据采集
>运行：
>`beanstalkd -l 127.0.0.1 -p 11300` 			*运行beanstalkd*
>`localhost:8000/queue/items` 				*采集物品信息*
>`localhost:8000/queue/heroes` 				*采集英雄信息*
>`localhost:8000/queue/history/matches/1` 	*采集难度为`normal`的最近的25场比赛*
>`localhost:8000/queue/history/matches/2` 	*采集难度为`hard`的最近的25场比赛*
>`localhost:8000/queue/history/matches/2` 	*采集难度为`very hard`的最近的25场比赛*

###TODO
* 用户搜索，未采集到的用户，可以加入采集
* 英雄胜率排名
* 邮件推送最近比赛详情


### 引用的框架与包
* [Laravel/laravel](https://github.com/laravel/laravel)
* [kronusme/dota2-api](https://github.com/kronusme/dota2-api)
* [wittiws/phpquery](https://github.com/wittiws/phpquery)
* [pda/pheanstalk](https://github.com/pda/pheanstalk)

### 联系作者
Email: copyrenzhe <copyrenzhe@gmail.com>  
