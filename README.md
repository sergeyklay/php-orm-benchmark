# PHP ORM Benchmark

The Docker based project to facilitate PHP ORM benchmarks.

## Contents <sup>[↑](#php-orm-benchmark)</sup>

* [Requirements](#requirements-)
* [ORMs to Benchmark](#orms-to-benchmark-)
* [Getting Started](#getting-started-)
  * [Running Benchmark](#running-benchmark-)
  * [Results](#results-)
    * [Benchmarking Environment](#benchmarking-environment-)
    * [First run](#first-run-get-)
      * [Insert a record to the Database](#insert-a-record-to-the-database-)
      * [Get first record with relation](#get-first-record-with-relation-)
    * [10-fold method call](#10-fold-method-)
      * [Insert a record to the Database](#insert-a-record-to-the-database--1)
      * [Get first record with relation](#get-first-record-with-relation--1)
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

1. Phalcon 3.3.0
2. Propel ORM 2.0.0-alpha7
3. Eloquent 5.5.28
4. CakePHP ORM 3.5.10
5. Yii ActiveRecord 2.0.13.1

## Getting Started <sup>[↑](#php-orm-benchmark)</sup>

First you have to build the benchmark application. Go to project root and run command as follows:

```sh
git clone git@github.com:sergeyklay/php-orm-benchmark.git
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

Available tests are:

* `create`
* `read`

To run benchmark multiple times use:

```sh
php run <provider> <test> <times>
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
| CakePHP           |              249.55 |            911.23 |             1,361,684.54 | `save`       |
| Eloquent          |              166.90 |            744.06 |             1,190,524.53 | `save`       |
| Propel            |              124.78 |            355.55 |               792,676.54 | `save`       |
| Yii               |              109.67 |            479.07 |               919,284.54 | `save`       |
| Phalcon           |               13.25 |             36.67 |               467,436.54 | `save`       |

#### Get first record with relation <sup>[↑](#php-orm-benchmark)</sup>

| ORM               |   Elapsed time (ms) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| CakePHP           |              283.29 |          1,043.41 |             1,496,972.57 | `find`       |
| Eloquent          |              184.39 |            856.87 |             1,305,964.56 | `findOrFail` |
| Propel            |              162.37 |            727.10 |             1,173,076.57 | `findPk`     |
| Yii               |              115.91 |            644.05 |             1,088,596.54 | `findOne`    |
| Phalcon           |               23.40 |             71.13 |               501,468.57 | `findFirst`  |

### 10-fold method call <sup>[↑](#php-orm-benchmark)</sup>

#### Insert a record to the Database <sup>[↑](#php-orm-benchmark)</sup>

| ORM               |   Elapsed time (ms) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| CakePHP           |               24.56 |             91.15 |             1,361,716.51 | `save`       |
| Eloquent          |               17.99 |             74.44 |             1,190,556.50 | `save`       |
| Propel            |               12.40 |             35.84 |               795,332.51 | `save`       |
| Yii               |               11.26 |             49.34 |               933,692.51 | `save`       |
| Phalcon           |                3.06 |              3.73 |               468,076.51 | `save`       |

#### Get first record with relation <sup>[↑](#php-orm-benchmark)</sup>

| ORM               |   Elapsed time (ms) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| CakePHP           |              28.24  |            104.34 |             1,497,004.54 | `find`       |
| Eloquent          |              22.86  |             85.69 |             1,305,996.53 | `findOrFail` |
| Propel            |              18.76  |             72.71 |             1,173,108.54 | `findPk`     |
| Yii               |               13.12 |             67.20 |             1,117,284.51 | `findOne`    |
| Phalcon           |               2.47  |              7.11 |               501,500.54 | `findFirst`  |

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

## License <sup>[↑](#php-orm-benchmark)</sup>

The "PHP ORM Benchmark" is open source software licensed under the MIT License.
See the [LICENSE](https://github.com/sergeyklay/php-orm-benchmark/blob/master/LICENSE) file for more.

---

<p align="center">Copyright &copy; 2018 Serghei Iakovlev</p>
