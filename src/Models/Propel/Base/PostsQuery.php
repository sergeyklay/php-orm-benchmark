<?php

namespace OrmBench\Models\Propel\Base;

use \Exception;
use \PDO;
use OrmBench\Models\Propel\Posts as BasePosts;
use OrmBench\Models\Propel\PostsQuery as BasePostsQuery;
use OrmBench\Models\Propel\Map\PostsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'posts' table.
 *
 * @method     BasePostsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     BasePostsQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     BasePostsQuery orderByBody($order = Criteria::ASC) Order by the body column
 * @method     BasePostsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     BasePostsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     BasePostsQuery groupById() Group by the id column
 * @method     BasePostsQuery groupByTitle() Group by the title column
 * @method     BasePostsQuery groupByBody() Group by the body column
 * @method     BasePostsQuery groupByCreatedAt() Group by the created_at column
 * @method     BasePostsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     BasePostsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BasePostsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BasePostsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     BasePostsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     BasePostsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     BasePostsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     BasePostsQuery leftJoinComments($relationAlias = null) Adds a LEFT JOIN clause to the query using the Comments relation
 * @method     BasePostsQuery rightJoinComments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Comments relation
 * @method     BasePostsQuery innerJoinComments($relationAlias = null) Adds a INNER JOIN clause to the query using the Comments relation
 *
 * @method     BasePostsQuery joinWithComments($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Comments relation
 *
 * @method     BasePostsQuery leftJoinWithComments() Adds a LEFT JOIN clause and with to the query using the Comments relation
 * @method     BasePostsQuery rightJoinWithComments() Adds a RIGHT JOIN clause and with to the query using the Comments relation
 * @method     BasePostsQuery innerJoinWithComments() Adds a INNER JOIN clause and with to the query using the Comments relation
 *
 * @method     \OrmBench\Models\Propel\CommentsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     BasePosts findOne(ConnectionInterface $con = null) Return the first BasePosts matching the query
 * @method     BasePosts findOneOrCreate(ConnectionInterface $con = null) Return the first BasePosts matching the query, or a new BasePosts object populated from the query conditions when no match is found
 *
 * @method     BasePosts findOneById(int $id) Return the first BasePosts filtered by the id column
 * @method     BasePosts findOneByTitle(string $title) Return the first BasePosts filtered by the title column
 * @method     BasePosts findOneByBody(string $body) Return the first BasePosts filtered by the body column
 * @method     BasePosts findOneByCreatedAt(int $created_at) Return the first BasePosts filtered by the created_at column
 * @method     BasePosts findOneByUpdatedAt(int $updated_at) Return the first BasePosts filtered by the updated_at column *

 * @method     BasePosts requirePk($key, ConnectionInterface $con = null) Return the BasePosts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     BasePosts requireOne(ConnectionInterface $con = null) Return the first BasePosts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     BasePosts requireOneById(int $id) Return the first BasePosts filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     BasePosts requireOneByTitle(string $title) Return the first BasePosts filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     BasePosts requireOneByBody(string $body) Return the first BasePosts filtered by the body column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     BasePosts requireOneByCreatedAt(int $created_at) Return the first BasePosts filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     BasePosts requireOneByUpdatedAt(int $updated_at) Return the first BasePosts filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     BasePosts[]|ObjectCollection find(ConnectionInterface $con = null) Return BasePosts objects based on current ModelCriteria
 * @method     BasePosts[]|ObjectCollection findById(int $id) Return BasePosts objects filtered by the id column
 * @method     BasePosts[]|ObjectCollection findByTitle(string $title) Return BasePosts objects filtered by the title column
 * @method     BasePosts[]|ObjectCollection findByBody(string $body) Return BasePosts objects filtered by the body column
 * @method     BasePosts[]|ObjectCollection findByCreatedAt(int $created_at) Return BasePosts objects filtered by the created_at column
 * @method     BasePosts[]|ObjectCollection findByUpdatedAt(int $updated_at) Return BasePosts objects filtered by the updated_at column
 * @method     BasePosts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PostsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \OrmBench\Models\Propel\PostsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\OrmBench\\Models\\Propel\\Posts', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BasePostsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return BasePostsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof BasePostsQuery) {
            return $criteria;
        }
        $query = new BasePostsQuery();
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
     * @return BasePosts|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PostsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PostsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return BasePosts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, title, body, created_at, updated_at FROM posts WHERE id = :p0';
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
            /** @var BasePosts $obj */
            $obj = new BasePosts();
            $obj->hydrate($row);
            PostsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return BasePosts|array|mixed the result, formatted by the current formatter
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
     * @return $this|BasePostsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PostsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|BasePostsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PostsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|BasePostsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PostsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PostsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PostsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|BasePostsQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PostsTableMap::COL_TITLE, $title, $comparison);
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
     * @return $this|BasePostsQuery The current query, for fluid interface
     */
    public function filterByBody($body = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($body)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PostsTableMap::COL_BODY, $body, $comparison);
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
     * @return $this|BasePostsQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PostsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PostsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PostsTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|BasePostsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PostsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PostsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PostsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \OrmBench\Models\Propel\Comments object
     *
     * @param \OrmBench\Models\Propel\Comments|ObjectCollection $comments the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BasePostsQuery The current query, for fluid interface
     */
    public function filterByComments($comments, $comparison = null)
    {
        if ($comments instanceof \OrmBench\Models\Propel\Comments) {
            return $this
                ->addUsingAlias(PostsTableMap::COL_ID, $comments->getPostId(), $comparison);
        } elseif ($comments instanceof ObjectCollection) {
            return $this
                ->useCommentsQuery()
                ->filterByPrimaryKeys($comments->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByComments() only accepts arguments of type \OrmBench\Models\Propel\Comments or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Comments relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|BasePostsQuery The current query, for fluid interface
     */
    public function joinComments($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Comments');

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
            $this->addJoinObject($join, 'Comments');
        }

        return $this;
    }

    /**
     * Use the Comments relation Comments object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrmBench\Models\Propel\CommentsQuery A secondary query class using the current class as primary query
     */
    public function useCommentsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinComments($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Comments', '\OrmBench\Models\Propel\CommentsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   BasePosts $posts Object to remove from the list of results
     *
     * @return $this|BasePostsQuery The current query, for fluid interface
     */
    public function prune($posts = null)
    {
        if ($posts) {
            $this->addUsingAlias(PostsTableMap::COL_ID, $posts->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the posts table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PostsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PostsTableMap::clearInstancePool();
            PostsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PostsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PostsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PostsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PostsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PostsQuery
