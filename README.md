# PHP ORM Benchmark

The Docker based project to facilitate PHP ORM benchmarks.

## Requirements <sup>[↑](#php-orm-benchmark)</sup>

* Linux or BDS System
* Docker CE/EE >= 17.09.0
* Docker Compose >= 1.17
* PHP >= 7.0

## ORMs to Benchmark <sup>[↑](#php-orm-benchmark)</sup>

1. Phalcon ORM 3.3.0
2. Eloquent ORM 5.5.28

## Getting Started <sup>[↑](#php-orm-benchmark)</sup>

First you have to build the benchmark application. Go to project root and run command as follows:

```sh
git clone git@github.com:sergeyklay/php-orm-benchmark.git
docker-compose build --force-rm --no-cache
```

Install [Composer](https://getcomposer.org) in a common location or in project root:

```sh
curl -s http://getcomposer.org/installer | php
```

Then run the composer installer from the project root:

```sh
php composer.phar install
```

_Note: You may skip Phalcon by running `php composer.phar install --ignore-platform-reqs`, if you don't have it installed at host system._

Than start the benchmark application:

```sh
docker-compose run benchmark
```

### Running Benchmark <sup>[↑](#php-orm-benchmark)</sup>

To run benchmark simple run command as follows:

```sh
php run <provider>
```

To destroy the application use the following command from the host system:

```sh
docker-compose down
docker volume rm phpormbenchmark_mysql
```

## Results <sup>[↑](#php-orm-benchmark)</sup>

These are my benchmarks, not yours. **I encourage you to run on your (production equivalent) environments.**
By sharing underlying software stacks, the benchmark results vary only according to the host machine's hardware specs and differing code implementations.

### Benchmarking Environment

* Debian GNU/Linux 8.10 (jessie) 64bit (Docker)
* PHP 7.0.26
* Zend OPcache 7.0.26
* MySQL 5.7

##### `Sat Jan  6 21:41:47 UTC 2018`
##### First run: Get first record with relation

| ORM               | Execution time (MS) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| Eloquent          |              180.03 |            856.87 |             1,300,604.56 | `findOrFail` |
| Phalcon           |               16.41 |             69.88 |               494,828.57 | `findFirst`  |

##### 10-fold method call: Get first record with relation

| ORM               | Execution time (MS) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| Eloquent          |              23.69  |             85.69 |             1,300,636.53 | `findOrFail` |
| Phalcon           |               2.60  |              6.99 |               494,860.54 | `findFirst`  |

## Contributing <sup>[↑](#php-orm-benchmark)</sup>

The source for this extension is available on [GitHub](https://github.com/sergeyklay/php-orm-benchmark). If anyone feels that there is
something missing or would like to suggest improvements please [open a new issue](https://github.com/sergeyklay/php-orm-benchmark/issues)
or send a pull request.

## Discussion <sup>[↑](#php-orm-benchmark)</sup>

There is an `#general` channel on the Phalcon [Discord Server](https://discord.gg/PNFsSsr).
If you would like to discuss an idea or need help or have other feedback you can usually find me (`@klay`) idling there.

## References

* [Eloquent ORM](https://laravel.com/docs/5.5/eloquent)
* [Phalcon ORM](https://docs.phalconphp.com/en/3.2/db-models)

## License <sup>[↑](#php-orm-benchmark)</sup>

The "PHP ORM Benchmark" is open source software licensed under the MIT License.
See the [LICENSE](https://github.com/sergeyklay/php-orm-benchmark/blob/master/LICENSE) file for more.

---

<p align="center">Copyright &copy; 2018 Serghei Iakovlev</p>
