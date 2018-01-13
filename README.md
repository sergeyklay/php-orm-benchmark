# PHP ORM Benchmark [![Build Status](https://travis-ci.org/sergeyklay/php-orm-benchmark.svg?branch=master)](https://travis-ci.org/sergeyklay/php-orm-benchmark)

The benchmark to compare performance of PHP ORM solutions.

Initially this project used Docker to facilitate PHP ORM benchmarks. But after [repeated](https://github.com/sergeyklay/php-orm-benchmark/pull/12) [comments](https://github.com/sergeyklay/php-orm-benchmark/issues/7) I decided to transfer the benchmarks to [Travis CI](https://travis-ci.org/sergeyklay/php-orm-benchmark).

So everyone [can see the results](https://travis-ci.org/sergeyklay/php-orm-benchmark) or run them again. Actually I've enabled the daily [cron job on Travis CI](https://docs.travis-ci.com/user/cron-jobs/).

NOTE: Some ORMs rely (depends) on models metadata caching. Thus, to avoid [controversy](https://github.com/sergeyklay/php-orm-benchmark/issues/4) there is an ability to create and run test with metadata caching support.

## ORMs to Benchmark

* CakePHP ORM 3.5.10
* Doctrine ORM 2.5.14
* Eloquent 5.5.28
* PHP ActiveRecord 1.2.0
* Phalcon 3.3.1
* Propel ORM 2.0.0-alpha7
* Yii ActiveRecord 2.0.13.1
* DMS 0.8.2

## Benchmarking Environment

* Ubuntu 14.04.5 (Trusty) 64bit (Travis CI)
* PHP 7.0, 7.1, 7.2, 7.3
* Zend OPcache 7.0, 7.1, 7.2, 7.3
* MySQL 5.6

## What we test

* Insert a record to the Database
* Get first record with relation
* Get first record with relation and metadata caching
* Insert a record to the Database (10-fold method call)
* Get first record with relation (10-fold method call)
* Get first record with relation and metadata caching (10-fold method call)
* Get a batch of first 20 records with relation
* Get a batch of first 20 records with relation and metadata caching
* Get a batch of first 200 records with relation
* Get a batch of first 200 records with relation and metadata caching

## Results

Get first record with relation (10-fold method call). Build [#57](https://travis-ci.org/sergeyklay/php-orm-benchmark/builds/328442668), PHP 7.0.25.

| ORM               |   Elapsed time (ms) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| CakePHP           |                7.68 |             98.06 |             1,610,421.10 | `find`       |
| DMS               |                7.42 |            199.06 |             2,503,541.10 | `get`        |
| Doctrine          |                4.29 |             83.99 |             2,179,349.09 | `findOneBy`  |
| Eloquent          |                3.24 |             55.27 |             1,526,709.09 | `firstOrFail`|
| Propel            |                3.57 |             66.83 |             1,458,557.10 | `findPk`     |
| Yii               |                3.20 |             43.90 |             1,394,253.10 | `findOne`    |
| Phalcon           |                1.07 |             16.10 |               622,013.10 | `findFirst`  |
| PHP ActiveRecord  |                0.99 |              6.18 |               775,661.09 | `first`      |

Get first record with relation (10-fold method call) with metadata caching. Build [#57](https://travis-ci.org/sergeyklay/php-orm-benchmark/builds/328442668), PHP 7.0.25.

| ORM               |   Elapsed time (ms) | Used memory (KiB) | Total memory usage (KiB) | Method       |
|-------------------|--------------------:|------------------:|-------------------------:|--------------|
| CakePHP           |                5.82 |             84.56 |             1,383,373.10 | `find`       |
| Yii               |                2.55 |             41.84 |             1,373,901.07 | `findOne`    |
| Doctrine          |                2.21 |             30.31 |             1,844,677.05 | `findOneBy`  |
| Phalcon           |                1.04 |             16.25 |               611,445.07 | `findFirst`  |

Get a batch of 200 records with relation. # TBD

Get a batch of 200 records with relation and with metadata caching. # TBD

If you are interested in other resutls, see [Travis CI build results](https://travis-ci.org/sergeyklay/php-orm-benchmark).

## Contributing

Contributions for new ORMs are more than welcome! If anyone feels that there is something missing or would like to suggest improvements please [open a new issue](https://github.com/sergeyklay/php-orm-benchmark/issues) or send a pull request.

## References

* [Eloquent ORM](https://laravel.com/docs/5.5/eloquent)
* [Phalcon ORM](https://docs.phalconphp.com/en/3.2/db-models)
* [Propel ORM](http://propelorm.org/documentation/)
* [CakePHP ORM](https://book.cakephp.org/3.0/en/orm.html)
* [Yii 2 ActiveRecord](http://www.yiiframework.com/doc-2.0/guide-db-active-record.html)
* [Doctrine ORM](http://www.doctrine-project.org/projects/orm.html)
* [PHP ActiveRecord](http://www.phpactiverecord.org/projects/main/wiki)
* [DMS](http://dms-docs.readthedocs.io/en/latest/)

## License

The "PHP ORM Benchmark" is open source software licensed under the MIT License. See the [LICENSE](https://github.com/sergeyklay/php-orm-benchmark/blob/master/LICENSE) file for more.

---

<p align="center">Copyright &copy; 2018 Serghei Iakovlev</p>
