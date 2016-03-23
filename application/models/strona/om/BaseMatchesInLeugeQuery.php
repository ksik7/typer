<?php


/**
 * Base class that represents a query for the 'matches_in_leuge' table.
 *
 *
 *
 * @method MatchesInLeugeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method MatchesInLeugeQuery orderByLeugeId($order = Criteria::ASC) Order by the leuge_id column
 * @method MatchesInLeugeQuery orderByMatchId($order = Criteria::ASC) Order by the match_id column
 *
 * @method MatchesInLeugeQuery groupById() Group by the id column
 * @method MatchesInLeugeQuery groupByLeugeId() Group by the leuge_id column
 * @method MatchesInLeugeQuery groupByMatchId() Group by the match_id column
 *
 * @method MatchesInLeugeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MatchesInLeugeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MatchesInLeugeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MatchesInLeuge findOne(PropelPDO $con = null) Return the first MatchesInLeuge matching the query
 * @method MatchesInLeuge findOneOrCreate(PropelPDO $con = null) Return the first MatchesInLeuge matching the query, or a new MatchesInLeuge object populated from the query conditions when no match is found
 *
 * @method MatchesInLeuge findOneByLeugeId(int $leuge_id) Return the first MatchesInLeuge filtered by the leuge_id column
 * @method MatchesInLeuge findOneByMatchId(int $match_id) Return the first MatchesInLeuge filtered by the match_id column
 *
 * @method array findById(int $id) Return MatchesInLeuge objects filtered by the id column
 * @method array findByLeugeId(int $leuge_id) Return MatchesInLeuge objects filtered by the leuge_id column
 * @method array findByMatchId(int $match_id) Return MatchesInLeuge objects filtered by the match_id column
 *
 * @package    propel.generator.strona.om
 */
abstract class BaseMatchesInLeugeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMatchesInLeugeQuery object.
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
            $modelName = 'MatchesInLeuge';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MatchesInLeugeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   MatchesInLeugeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MatchesInLeugeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MatchesInLeugeQuery) {
            return $criteria;
        }
        $query = new MatchesInLeugeQuery(null, null, $modelAlias);

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
     * @return   MatchesInLeuge|MatchesInLeuge[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MatchesInLeugePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MatchesInLeugePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 MatchesInLeuge A model object, or null if the key is not found
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
     * @return                 MatchesInLeuge A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `leuge_id`, `match_id` FROM `matches_in_leuge` WHERE `id` = :p0';
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
            $obj = new MatchesInLeuge();
            $obj->hydrate($row);
            MatchesInLeugePeer::addInstanceToPool($obj, (string) $key);
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
     * @return MatchesInLeuge|MatchesInLeuge[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MatchesInLeuge[]|mixed the list of results, formatted by the current formatter
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
     * @return MatchesInLeugeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MatchesInLeugePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MatchesInLeugeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MatchesInLeugePeer::ID, $keys, Criteria::IN);
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
     * @return MatchesInLeugeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MatchesInLeugePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MatchesInLeugePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatchesInLeugePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the leuge_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLeugeId(1234); // WHERE leuge_id = 1234
     * $query->filterByLeugeId(array(12, 34)); // WHERE leuge_id IN (12, 34)
     * $query->filterByLeugeId(array('min' => 12)); // WHERE leuge_id >= 12
     * $query->filterByLeugeId(array('max' => 12)); // WHERE leuge_id <= 12
     * </code>
     *
     * @param     mixed $leugeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MatchesInLeugeQuery The current query, for fluid interface
     */
    public function filterByLeugeId($leugeId = null, $comparison = null)
    {
        if (is_array($leugeId)) {
            $useMinMax = false;
            if (isset($leugeId['min'])) {
                $this->addUsingAlias(MatchesInLeugePeer::LEUGE_ID, $leugeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leugeId['max'])) {
                $this->addUsingAlias(MatchesInLeugePeer::LEUGE_ID, $leugeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatchesInLeugePeer::LEUGE_ID, $leugeId, $comparison);
    }

    /**
     * Filter the query on the match_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMatchId(1234); // WHERE match_id = 1234
     * $query->filterByMatchId(array(12, 34)); // WHERE match_id IN (12, 34)
     * $query->filterByMatchId(array('min' => 12)); // WHERE match_id >= 12
     * $query->filterByMatchId(array('max' => 12)); // WHERE match_id <= 12
     * </code>
     *
     * @param     mixed $matchId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MatchesInLeugeQuery The current query, for fluid interface
     */
    public function filterByMatchId($matchId = null, $comparison = null)
    {
        if (is_array($matchId)) {
            $useMinMax = false;
            if (isset($matchId['min'])) {
                $this->addUsingAlias(MatchesInLeugePeer::MATCH_ID, $matchId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($matchId['max'])) {
                $this->addUsingAlias(MatchesInLeugePeer::MATCH_ID, $matchId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatchesInLeugePeer::MATCH_ID, $matchId, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   MatchesInLeuge $matchesInLeuge Object to remove from the list of results
     *
     * @return MatchesInLeugeQuery The current query, for fluid interface
     */
    public function prune($matchesInLeuge = null)
    {
        if ($matchesInLeuge) {
            $this->addUsingAlias(MatchesInLeugePeer::ID, $matchesInLeuge->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
