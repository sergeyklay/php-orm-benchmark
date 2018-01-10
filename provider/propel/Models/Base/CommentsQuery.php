<?php

namespace OrmBench\Propel\Models\Base;

use \Exception;
use \PDO;
use OrmBench\Propel\Models\Comments as BaseComments;
use OrmBench\Propel\Models\CommentsQuery as BaseCommentsQuery;
use OrmBench\Propel\Models\Map\CommentsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'comments' table.
 *
 * @method     BaseCommentsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     BaseCommentsQuery orderByPostId($order = Criteria::ASC) Order by the post_id column
 * @method     BaseCommentsQuery orderByBody($order = Criteria::ASC) Order by the body column
 * @method     BaseCommentsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     BaseCommentsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     BaseCommentsQuery groupById() Group by the id column
 * @method     BaseCommentsQuery groupByPostId() Group by the post_id column
 * @method     BaseCommentsQuery groupByBody() Group by the body column
 * @method     BaseCommentsQuery groupByCreatedAt() Group by the created_at column
 * @method     BaseCommentsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     BaseCommentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BaseCommentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BaseCommentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     BaseCommentsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     BaseCommentsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     BaseCommentsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     BaseCommentsQuery leftJoinPosts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Posts relation
 * @method     BaseCommentsQuery rightJoinPosts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Posts relation
 * @method     BaseCommentsQuery innerJoinPosts($relationAlias = null) Adds a INNER JOIN clause to the query using the Posts relation
 *
 * @method     BaseCommentsQuery joinWithPosts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Posts relation
 *
 * @method     BaseCommentsQuery leftJoinWithPosts() Adds a LEFT JOIN clause and with to the query using the Posts relation
 * @method     BaseCommentsQuery rightJoinWithPosts() Adds a RIGHT JOIN clause and with to the query using the Posts relation
 * @method     BaseCommentsQuery innerJoinWithPosts() Adds a INNER JOIN clause and with to the query using the Posts relation
 *
 * @method     \OrmBench\Propel\Models\PostsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     BaseComments findOne(ConnectionInterface $con = null) Return the first BaseComments matching the query
 * @method     BaseComments findOneOrCreate(ConnectionInterface $con = null) Return the first BaseComments matching the query, or a new BaseComments object populated from the query conditions when no match is found
 *
 * @method     BaseComments findOneById(int $id) Return the first BaseComments filtered by the id column
 * @method     BaseComments findOneByPostId(int $post_id) Return the first BaseComments filtered by the post_id column
 * @method     BaseComments findOneByBody(string $body) Return the first BaseComments filtered by the body column
 * @method     BaseComments findOneByCreatedAt(int $created_at) Return the first BaseComments filtered by the created_at column
 * @method     BaseComments findOneByUpdatedAt(int $updated_at) Return the first BaseComments filtered by the updated_at column *

 * @method     BaseComments requirePk($key, ConnectionInterface $con = null) Return the BaseComments by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     BaseComments requireOne(ConnectionInterface $con = null) Return the first BaseComments matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     BaseComments requireOneById(int $id) Return the first BaseComments filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     BaseComments requireOneByPostId(int $post_id) Return the first BaseComments filtered by the post_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     BaseComments requireOneByBody(string $body) Return the first BaseComments filtered by the body column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     BaseComments requireOneByCreatedAt(int $created_at) Return the first BaseComments filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     BaseComments requireOneByUpdatedAt(int $updated_at) Return the first BaseComments filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     BaseComments[]|ObjectCollection find(ConnectionInterface $con = null) Return BaseComments objects based on current ModelCriteria
 * @method     BaseComments[]|ObjectCollection findById(int $id) Return BaseComments objects filtered by the id column
 * @method     BaseComments[]|ObjectCollection findByPostId(int $post_id) Return BaseComments objects filtered by the post_id column
 * @method     BaseComments[]|ObjectCollection findByBody(string $body) Return BaseComments objects filtered by the body column
 * @method     BaseComments[]|ObjectCollection findByCreatedAt(int $created_at) Return BaseComments objects filtered by the created_at column
 * @method     BaseComments[]|ObjectCollection findByUpdatedAt(int $updated_at) Return BaseComments objects filtered by the updated_at column
 * @method     BaseComments[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CommentsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \OrmBench\Propel\Models\Base\CommentsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\OrmBench\\Propel\\Models\\Comments', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BaseCommentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return BaseCommentsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof BaseCommentsQuery) {
            return $criteria;
        }
        $query = new BaseCommentsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return BaseComments|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CommentsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CommentsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return BaseComments A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, post_id, body, created_at, updated_at FROM comments WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var BaseComments $obj */
            $obj = new BaseComments();
            $obj->hydrate($row);
            CommentsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return BaseComments|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|BaseCommentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CommentsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|BaseCommentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CommentsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|BaseCommentsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the post_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPostId(1234); // WHERE post_id = 1234
     * $query->filterByPostId(array(12, 34)); // WHERE post_id IN (12, 34)
     * $query->filterByPostId(array('min' => 12)); // WHERE post_id > 12
     * </code>
     *
     * @see       filterByPosts()
     *
     * @param     mixed $postId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|BaseCommentsQuery The current query, for fluid interface
     */
    public function filterByPostId($postId = null, $comparison = null)
    {
        if (is_array($postId)) {
            $useMinMax = false;
            if (isset($postId['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_POST_ID, $postId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postId['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_POST_ID, $postId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_POST_ID, $postId, $comparison);
    }

    /**
     * Filter the query on the body column
     *
     * Example usage:
     * <code>
     * $query->filterByBody('fooValue');   // WHERE body = 'fooValue'
     * $query->filterByBody('%fooValue%', Criteria::LIKE); // WHERE body LIKE '%fooValue%'
     * </code>
     *
     * @param     string $body The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|BaseCommentsQuery The current query, for fluid interface
     */
    public function filterByBody($body = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($body)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_BODY, $body, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt(1234); // WHERE created_at = 1234
     * $query->filterByCreatedAt(array(12, 34)); // WHERE created_at IN (12, 34)
     * $query->filterByCreatedAt(array('min' => 12)); // WHERE created_at > 12
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|BaseCommentsQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt(1234); // WHERE updated_at = 1234
     * $query->filterByUpdatedAt(array(12, 34)); // WHERE updated_at IN (12, 34)
     * $query->filterByUpdatedAt(array('min' => 12)); // WHERE updated_at > 12
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|BaseCommentsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \OrmBench\Propel\Models\Posts object
     *
     * @param \OrmBench\Propel\Models\Posts|ObjectCollection $posts The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return BaseCommentsQuery The current query, for fluid interface
     */
    public function filterByPosts($posts, $comparison = null)
    {
        if ($posts instanceof \OrmBench\Propel\Models\Posts) {
            return $this
                ->addUsingAlias(CommentsTableMap::COL_POST_ID, $posts->getId(), $comparison);
        } elseif ($posts instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommentsTableMap::COL_POST_ID, $posts->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPosts() only accepts arguments of type \OrmBench\Propel\Models\Posts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Posts relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|BaseCommentsQuery The current query, for fluid interface
     */
    public function joinPosts($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Posts');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Posts');
        }

        return $this;
    }

    /**
     * Use the Posts relation Posts object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrmBench\Propel\Models\PostsQuery A secondary query class using the current class as primary query
     */
    public function usePostsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPosts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Posts', '\OrmBench\Propel\Models\PostsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   BaseComments $comments Object to remove from the list of results
     *
     * @return $this|BaseCommentsQuery The current query, for fluid interface
     */
    public function prune($comments = null)
    {
        if ($comments) {
            $this->addUsingAlias(CommentsTableMap::COL_ID, $comments->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the comments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommentsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CommentsTableMap::clearInstancePool();
            CommentsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommentsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CommentsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CommentsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CommentsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CommentsQuery
