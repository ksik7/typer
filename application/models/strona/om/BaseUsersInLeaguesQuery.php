<?php


/**
 * Base class that represents a query for the 'users_in_leagues' table.
 *
 *
 *
 * @method UsersInLeaguesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method UsersInLeaguesQuery orderByLeagueId($order = Criteria::ASC) Order by the league_id column
 * @method UsersInLeaguesQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 *
 * @method UsersInLeaguesQuery groupById() Group by the id column
 * @method UsersInLeaguesQuery groupByLeagueId() Group by the league_id column
 * @method UsersInLeaguesQuery groupByUserId() Group by the user_id column
 *
 * @method UsersInLeaguesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UsersInLeaguesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UsersInLeaguesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UsersInLeagues findOne(PropelPDO $con = null) Return the first UsersInLeagues matching the query
 * @method UsersInLeagues findOneOrCreate(PropelPDO $con = null) Return the first UsersInLeagues matching the query, or a new UsersInLeagues object populated from the query conditions when no match is found
 *
 * @method UsersInLeagues findOneByLeagueId(int $league_id) Return the first UsersInLeagues filtered by the league_id column
 * @method UsersInLeagues findOneByUserId(int $user_id) Return the first UsersInLeagues filtered by the user_id column
 *
 * @method array findById(int $id) Return UsersInLeagues objects filtered by the id column
 * @method array findByLeagueId(int $league_id) Return UsersInLeagues objects filtered by the league_id column
 * @method array findByUserId(int $user_id) Return UsersInLeagues objects filtered by the user_id column
 *
 * @package    propel.generator.strona.om
 */
abstract class BaseUsersInLeaguesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUsersInLeaguesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'strona';
        }
        if (null === $modelName) {
            $modelName = 'UsersInLeagues';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UsersInLeaguesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   UsersInLeaguesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UsersInLeaguesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UsersInLeaguesQuery) {
            return $criteria;
        }
        $query = new UsersInLeaguesQuery(null, null, $modelAlias);

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
     * @param     PropelPDO $con an optional connection object
     *
     * @return   UsersInLeagues|UsersInLeagues[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsersInLeaguesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UsersInLeaguesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 UsersInLeagues A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 UsersInLeagues A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `league_id`, `user_id` FROM `users_in_leagues` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new UsersInLeagues();
            $obj->hydrate($row);
            UsersInLeaguesPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return UsersInLeagues|UsersInLeagues[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|UsersInLeagues[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return UsersInLeaguesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersInLeaguesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UsersInLeaguesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersInLeaguesPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsersInLeaguesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersInLeaguesPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersInLeaguesPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersInLeaguesPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the league_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLeagueId(1234); // WHERE league_id = 1234
     * $query->filterByLeagueId(array(12, 34)); // WHERE league_id IN (12, 34)
     * $query->filterByLeagueId(array('min' => 12)); // WHERE league_id >= 12
     * $query->filterByLeagueId(array('max' => 12)); // WHERE league_id <= 12
     * </code>
     *
     * @param     mixed $leagueId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsersInLeaguesQuery The current query, for fluid interface
     */
    public function filterByLeagueId($leagueId = null, $comparison = null)
    {
        if (is_array($leagueId)) {
            $useMinMax = false;
            if (isset($leagueId['min'])) {
                $this->addUsingAlias(UsersInLeaguesPeer::LEAGUE_ID, $leagueId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leagueId['max'])) {
                $this->addUsingAlias(UsersInLeaguesPeer::LEAGUE_ID, $leagueId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersInLeaguesPeer::LEAGUE_ID, $leagueId, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id >= 12
     * $query->filterByUserId(array('max' => 12)); // WHERE user_id <= 12
     * </code>
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsersInLeaguesQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UsersInLeaguesPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UsersInLeaguesPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersInLeaguesPeer::USER_ID, $userId, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   UsersInLeagues $usersInLeagues Object to remove from the list of results
     *
     * @return UsersInLeaguesQuery The current query, for fluid interface
     */
    public function prune($usersInLeagues = null)
    {
        if ($usersInLeagues) {
            $this->addUsingAlias(UsersInLeaguesPeer::ID, $usersInLeagues->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
