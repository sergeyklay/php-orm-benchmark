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
      * [Get first record with relation 1](#get-first-record-with-relation-1-)
    * [10-fold method call](#10-fold-method-)
      * [Get first record with relation 2](#get-first-record-with-relation-2-)
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
2. Propel 2.0.0-alpha7
3. Eloquent 5.5.28

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
php run <provider>
```

Available providers are:

* `phalcon`
* `propel`
* `eloquent`

To run benchmark miltiple times use:

```sh
php run <provider> <times>
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

#### Get first record with relation 1 <sup>[↑](#php-orm-benchmark)</sup>

| ORM               | Execution time (MS) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| Eloquent          |              180.03 |            856.87 |             1,300,604.56 | `findOrFail` |
| Propel            |              155.44 |            727.15 |             1,167,780.57 | `findPk`     |
| Phalcon           |               16.41 |             69.88 |               494,828.57 | `findFirst`  |

### 10-fold method call <sup>[↑](#php-orm-benchmark)</sup>

#### Get first record with relation 2 <sup>[↑](#php-orm-benchmark)</sup>

| ORM               | Execution time (MS) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| Eloquent          |              23.69  |             85.69 |             1,300,636.53 | `findOrFail` |
| Propel            |              15.67  |             72.71 |             1,167,764.54 | `findPk`     |
| Phalcon           |               2.60  |              6.99 |               494,860.54 | `findFirst`  |

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

## License <sup>[↑](#php-orm-benchmark)</sup>

The "PHP ORM Benchmark" is open source software licensed under the MIT License.
See the [LICENSE](https://github.com/sergeyklay/php-orm-benchmark/blob/master/LICENSE) file for more.

---

<p align="center">Copyright &copy; 2018 Serghei Iakovlev</p>
