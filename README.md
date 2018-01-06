# PHP ORM Benchmark

## Requirements <sup>[↑](#php-orm-benchmark)</sup>

* Linux or BDS System
* Docker CE/EE >= 17.09.0
* Docker Compose >= 1.17
* PHP >= 7.0

## ORMs to Benchmark <sup>[↑](#php-orm-benchmark)</sup>

1. Phalcon ORM 3.3.0

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
```

## Results <sup>[↑](#php-orm-benchmark)</sup>

## Contributing <sup>[↑](#php-orm-benchmark)</sup>

The source for this extension is available on [GitHub](https://github.com/sergeyklay/php-orm-benchmark). If anyone feels that there is
something missing or would like to suggest improvements please [open a new issue](https://github.com/sergeyklay/php-orm-benchmark/issues)
or send a pull request.

## Discussion <sup>[↑](#php-orm-benchmark)</sup>

There is an `#general` channel on the Phalcon [Discord Server](https://discord.gg/PNFsSsr).
If you would like to discuss an idea or need help or have other feedback you can usually find me (`@klay`) idling there.

## License <sup>[↑](#php-orm-benchmark)</sup>

The "PHP ORM Benchmark" is open source software licensed under the MIT License.
See the [LICENSE](https://github.com/sergeyklay/php-orm-benchmark/blob/master/LICENSE) file for more.

---

<p align="center">Copyright &copy; 2018 Serghei Iakovlev</p>
