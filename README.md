# PHP ORM Benchmark

The Docker based project to facilitate PHP ORM benchmarks.

## Contents <sup>[↑](#php-orm-benchmark)</sup>

* [Requirements](#requirements-)
* [ORMs to Benchmark](#orms-to-benchmark-)
* [Getting Started](#getting-started-)
  * [Running Benchmark](#running-benchmark-)
  * [Results](#results-)
    * [Benchmarking Environment](#benchmarking-environment-)
    * [First run](#first-run-)
      * [Insert a record to the Database](#insert-a-record-to-the-database-)
      * [Get first record with relation](#get-first-record-with-relation-)
    * [10-fold method call](#10-fold-method-call-)
      * [Insert a record to the Database](#insert-a-record-to-the-database--1)
      * [Get first record with relation](#get-first-record-with-relation--1)
    * [First run with metadata caching](#first-run-with-metadata-caching-)
      * [Get first record with relation](#get-first-record-with-relation--2)
    * [10-fold method call with metadata caching](#10-fold-method-call-with-metadata-caching-)
      * [Get first record with relation](#get-first-record-with-relation--3)
* [Contributing](#contributing-)
* [Discussion](#discussion-)
* [References](#references-)
* [License](#license-)

## Requirements <sup>[↑](#php-orm-benchmark)</sup>

* Linux or BDS System
* Docker CE/EE >= 17.09.0
* Docker Compose >= 1.17
* PHP >= 7.0
* Composer

## ORMs to Benchmark <sup>[↑](#php-orm-benchmark)</sup>

* Phalcon 3.3.0
* Propel ORM 2.0.0-alpha7
* Eloquent 5.5.28
* CakePHP ORM 3.5.10
* Yii ActiveRecord 2.0.13.1
* Doctrine ORM 2.5.14
* PHP ActiveRecord 1.2.0

## Getting Started <sup>[↑](#php-orm-benchmark)</sup>

First you have to build the benchmark application. Go to project root and run command as follows:

```sh
git clone git@github.com:sergeyklay/php-orm-benchmark.git
cd php-orm-benchmark
docker-compose build --force-rm --no-cache
```

I advise you to rely on [Composer](https://getcomposer.org) to manage projects’ dependencies.
You have to download and install Composer itself in a common location or in project root by executing in a terminal the command like this:

```sh
$ wget http://getcomposer.org/composer.phar
# If you haven't wget on your computer
$ curl -s http://getcomposer.org/installer | php
```

Then, to install all project's dependencies, type the following from the project root:

```sh
php composer.phar install
```

**Note:** You may skip Phalcon by running `php composer.phar install --ignore-platform-reqs`, if you don't have it installed at host system.

Finally, start the benchmark application:

```sh
docker-compose run benchmark
```

### Running Benchmark <sup>[↑](#php-orm-benchmark)</sup>

To run benchmark simple run command as follows:

```sh
php run <provider> <test>
```

Available providers are:

* `phalcon`
* `propel`
* `eloquent`
* `cake`
* `yii`
* `doctrine`
* `activerecord`

Available tests are:

* `create`
* `read`

To run benchmark multiple times use:

```sh
php run <provider> <test> <times>
```

Some ORMs rely (depends) on models metadata caching. Thus, to avoid [controversy](https://github.com/sergeyklay/php-orm-benchmark/issues/4)
there is an ability to create and run test with metadata caching support. To use models metadata caching (if supports) you can use the
4th command line argument as follows:

```sh
php run <provider> <test> <times> 1
```

To destroy the application use the following command from the host system:

```sh
docker-compose down
docker volume rm phpormbenchmark_mysql
```

## Results <sup>[↑](#php-orm-benchmark)</sup>

These are my benchmarks, not yours. **I encourage you to run on your (production equivalent) environments.**
By sharing underlying software stacks, the benchmark results vary only according to the host machine's hardware specs and differing code implementations.

### Benchmarking Environment <sup>[↑](#php-orm-benchmark)</sup>

* Debian GNU/Linux 8.10 (jessie) 64bit (Docker)
* PHP 7.0.26
* Zend OPcache 7.0.26
* MySQL 5.7

### First run <sup>[↑](#php-orm-benchmark)</sup>

#### Insert a record to the Database <sup>[↑](#php-orm-benchmark)</sup>

| ORM               |   Elapsed time (ms) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| Doctrine          |              180.52 |            764.05 |             1,992,804.41 | `flush`      |
| CakePHP           |              288.97 |            836.86 |             1,546,380.41 | `save`       |
| Eloquent          |              130.20 |            520.95 |             1,530,852.41 | `save`       |
| Propel            |              101.60 |            278.77 |               977,372.41 | `save`       |
| Yii               |               40.72 |            225.01 |             1,180,652.41 | `save`       |
| PHP ActiveRecord  |               28.12 |            118.91 |               804,852.41 | `save`       |
| Phalcon           |                9.13 |             32.66 |               720,812.41 | `save`       |

#### Get first record with relation <sup>[↑](#php-orm-benchmark)</sup>

| ORM               |   Elapsed time (ms) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| Doctrine          |              202.51 |            798.64 |             2,028,596.41 | `findOneBy`  |
| CakePHP           |              282.98 |            977.05 |             1,690,308.41 | `find`       |
| Eloquent          |              127.85 |            559.12 |             1,570,316.41 | `firstOrFail`|
| Propel            |              154.12 |            725.33 |             1,435,020.41 | `findPk`     |
| Yii               |               69.66 |            325.98 |             1,284,428.41 | `findOne`    |
| PHP ActiveRecord  |               28.19 |             57.23 |               742,100.41 | `first`      |
| Phalcon           |               10.79 |             67.12 |               756,092.41 | `findFirst`  |

### 10-fold method call <sup>[↑](#php-orm-benchmark)</sup>

#### Insert a record to the Database <sup>[↑](#php-orm-benchmark)</sup>

| ORM               |   Elapsed time (ms) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| Doctrine          |               19.36 |             78.26 |             2,011,436.41 | `flush`      |
| CakePHP           |               24.61 |             83.72 |             1,546,380.41 | `save`       |
| Eloquent          |               14.80 |             52.13 |             1,530,852.41 | `save`       |
| Propel            |                9.05 |             28.16 |               979,996.41 | `save`       |
| Yii               |                5.46 |             23.94 |             1,195,028.41 | `save`       |
| PHP ActiveRecord  |                4.98 |             11.95 |               804,852.41 | `save`       |
| Phalcon           |                2.13 |              3.33 |               721,420.41 | `save`       |

#### Get first record with relation <sup>[↑](#php-orm-benchmark)</sup>

| ORM               |   Elapsed time (ms) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| Doctrine          |               18.96 |             83.29 |             2,063,724.41 | `findOneBy`  |
| CakePHP           |               29.33 |             97.70 |             1,690,308.41 | `find`       |
| Eloquent          |               13.55 |             55.91 |             1,570,316.41 | `firstOrFail`|
| Propel            |               15.44 |             73.15 |             1,441,348.41 | `findPk`     |
| Yii               |                8.03 |             35.40 |             1,313,084.41 | `findOne`    |
| PHP ActiveRecord  |                2.95 |              5.72 |               742,100.41 | `first`      |
| Phalcon           |                1.54 |             15.54 |               846,444.41 | `findFirst`  |

### First run with metadata caching <sup>[↑](#php-orm-benchmark)</sup>

#### Get first record with relation <sup>[↑](#php-orm-benchmark)</sup>

| ORM               |   Elapsed time (ms) | Used memory (KiB) | Total memory usage (KiB) | MetaData Storage |
|-------------------|--------------------:|------------------:|-------------------------:|------------------|
| Doctrine          |              145.61 |            264.44 |             2,033,836.41 | File System      |
| Phalcon           |               18.69 |             60.75 |               750,268.41 | File System      |

### 10-fold method call with metadata caching <sup>[↑](#php-orm-benchmark)</sup>

#### Get first record with relation <sup>[↑](#php-orm-benchmark)</sup>

| ORM               |   Elapsed time (ms) | Used memory (KiB) | Total memory usage (KiB) | MetaData Storage |
|-------------------|--------------------:|------------------:|-------------------------:|------------------|
| Doctrine          |               15.65 |             29.87 |             2,068,964.41 | File System      |
| Phalcon           |                2.27 |             14.90 |               840,620.41 | File System      |

## Contributing <sup>[↑](#php-orm-benchmark)</sup>

The source for this extension is available on [GitHub](https://github.com/sergeyklay/php-orm-benchmark). If anyone feels that there is
something missing or would like to suggest improvements please [open a new issue](https://github.com/sergeyklay/php-orm-benchmark/issues)
or send a pull request.

## Discussion <sup>[↑](#php-orm-benchmark)</sup>

There is an `#general` channel on the Phalcon [Discord Server](https://discord.gg/PNFsSsr).
If you would like to discuss an idea or need help or have other feedback you can usually find me (`@klay`) idling there.

## References <sup>[↑](#php-orm-benchmark)</sup>

* [Eloquent ORM](https://laravel.com/docs/5.5/eloquent)
* [Phalcon ORM](https://docs.phalconphp.com/en/3.2/db-models)
* [Propel ORM](http://propelorm.org/documentation/)
* [CakePHP ORM](https://book.cakephp.org/3.0/en/orm.html)
* [Yii 2 ActiveRecord](http://www.yiiframework.com/doc-2.0/guide-db-active-record.html)
* [Doctrine ORM](http://www.doctrine-project.org/projects/orm.html)
* [PHP ActiveRecord](http://www.phpactiverecord.org/projects/main/wiki)

## License <sup>[↑](#php-orm-benchmark)</sup>

The "PHP ORM Benchmark" is open source software licensed under the MIT License.
See the [LICENSE](https://github.com/sergeyklay/php-orm-benchmark/blob/master/LICENSE) file for more.

---

<p align="center">Copyright &copy; 2018 Serghei Iakovlev</p>
