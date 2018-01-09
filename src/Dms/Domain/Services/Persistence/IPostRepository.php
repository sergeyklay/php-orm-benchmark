<?php declare(strict_types = 1);

namespace OrmBench\Dms\Domain\Services\Persistence;

use Dms\Core\Exception;
use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use OrmBench\Dms\Domain\Entities\Post;

/**
 * @author Ali Hamza <ali@iddigital.com.au>
 */
interface IPostRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Post[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Post
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Post[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Post|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Post[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Post[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Post[]
     */
    public function satisfying(ISpecification $specification) : array;
}
