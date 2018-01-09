<?php declare(strict_types = 1);

namespace OrmBench\Dms\Ioc;

use Dms\Core\Exception\InvalidArgumentException;
use Dms\Core\Ioc\IIocContainer;
use Dms\Core\Util\Debug;
use Illuminate\Container\Container;

/**
 * The laravel ioc container.
 *
 * @author Elliot Levin <elliotlevin@hotmail.com>
 */
class LaravelIocContainer implements IIocContainer
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var array
     */
    private $cacheForHas = [];

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }


    /**
     * Binds the supplied class or interface to the supplied
     * concrete class name.
     *
     * @param string $scope
     * @param string $abstract
     * @param string $concrete
     *
     * @return void
     */
    public function bind(string $scope, string $abstract, string $concrete)
    {
        $this->validateScope(__METHOD__, $scope);

        if ($scope === self::SCOPE_INSTANCE_PER_RESOLVE) {
            $this->container->bind($abstract, $concrete);
        } else {
            $this->container->singleton($abstract, $concrete);
        }
    }

    /**
     * Binds the supplied class or interface to the return value
     * of the supplied callback.
     *
     * @param string   $scope
     * @param string   $abstract
     * @param callable $factory
     *
     * @return void
     */
    public function bindCallback(string $scope, string $abstract, callable $factory)
    {
        $this->validateScope(__METHOD__, $scope);

        if ($scope === self::SCOPE_INSTANCE_PER_RESOLVE) {
            $this->container->bind($abstract, $factory);
        } else {
            $this->container->singleton($abstract, $factory);
        }
    }

    /**
     * Binds the supplied abstract class or interface to the supplied value.
     *
     * @param string $abstract
     * @param mixed  $concrete
     *
     * @return void
     */
    public function bindValue(string $abstract, $concrete)
    {
        $this->container->instance($abstract, $concrete);
    }

    /**
     * Binds the supplied class or interface to the supplied value for the duration
     * of the supplied callback.
     *
     * @param string   $abstract
     * @param mixed    $concrete
     * @param callable $callback
     *
     * @return mixed The value returned from the callback
     */
    public function bindForCallback(string $abstract, $concrete, callable $callback)
    {
        $hasOriginal      = $this->container->bound($abstract);
        $originalInstance = false;

        if ($hasOriginal) {
            $binding = $this->container->getBindings()[$abstract] ?? null;

            $hasInstance = $binding && $binding['shared'] && $this->container->resolved($abstract);

            if ($hasInstance) {
                $originalInstance = $this->container->make($abstract);
            }
        }

        $this->container->instance($abstract, $concrete);

        try {
            $return = $callback();
            return $return;
        } finally {
            unset($this->container[$abstract]);

            if ($hasOriginal && $binding) {
                $this->container->bind($abstract, $binding['concrete'], $binding['shared']);

                if ($originalInstance) {
                    $this->container->instance($abstract, $originalInstance);
                }
            }
        }
    }

    private function validateScope(string $method, string $scope)
    {
        $validScopes = [self::SCOPE_INSTANCE_PER_RESOLVE, self::SCOPE_SINGLETON];

        if (!in_array($scope, $validScopes, true)) {
            throw InvalidArgumentException::format(
                'Invalid scope supplied to %s: expecting one of (%s), \'%s\' given',
                $method, Debug::formatValues($validScopes), $scope
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        return $this->container->make($id);
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        if ($this->hasIsCached($id)) {
            return $this->hasFromCache($id);
        }

        $has = $this->container->bound($id) || $this->isInstantiable($id);

        $this->cacheHas($id, $has);

        return $has;
    }

    private function hasIsCached($id)
    {
        return array_key_exists($id, $this->cacheForHas);
    }

    private function hasFromCache($id)
    {
        return $this->cacheForHas[$id];
    }

    private function cacheHas($id, $has)
    {
        $this->cacheForHas[$id] = $has;
    }

    private function isInstantiable($id)
    {
        if (class_exists($id)) {
            return true;
        }

        try {
            $reflectionClass = new \ReflectionClass($id);

            return $reflectionClass->isInstantiable();
        } catch (\ReflectionException $e) {
            return false;
        }
    }
}
