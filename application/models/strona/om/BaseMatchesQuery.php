<?php


/**
 * Base class that represents a query for the 'matches' table.
 *
 *
 *
 * @method MatchesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method MatchesQuery orderByTeam1($order = Criteria::ASC) Order by the team1 column
 * @method MatchesQuery orderByTeam2($order = Criteria::ASC) Order by the team2 column
 *
 * @method MatchesQuery groupById() Group by the id column
 * @method MatchesQuery groupByTeam1() Group by the team1 column
 * @method MatchesQuery groupByTeam2() Group by the team2 column
 *
 * @method MatchesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MatchesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MatchesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Matches findOne(PropelPDO $con = null) Return the first Matches matching the query
 * @method Matches findOneOrCreate(PropelPDO $con = null) Return the first Matches matching the query, or a new Matches object populated from the query conditions when no match is found
 *
 * @method Matches findOneByTeam1(string $team1) Return the first Matches filtered by the team1 column
 * @method Matches findOneByTeam2(string $team2) Return the first Matches filtered by the team2 column
 *
 * @method array findById(int $id) Return Matches objects filtered by the id column
 * @method array findByTeam1(string $team1) Return Matches objects filtered by the team1 column
 * @method array findByTeam2(string $team2) Return Matches objects filtered by the team2 column
 *
 * @package    propel.generator.strona.om
 */
abstract class BaseMatchesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMatchesQuery object.
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
            $modelName = 'Matches';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MatchesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   MatchesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MatchesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MatchesQuery) {
            return $criteria;
        }
        $query = new MatchesQuery(null, null, $modelAlias);

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
     * @return   Matches|Matches[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MatchesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MatchesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Matches A model object, or null if the key is not found
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
     * @return                 Matches A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `team1`, `team2` FROM `matches` WHERE `id` = :p0';
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
            $obj = new Matches();
            $obj->hydrate($row);
            MatchesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Matches|Matches[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Matches[]|mixed the list of results, formatted by the current formatter
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
     * @return MatchesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MatchesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MatchesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MatchesPeer::ID, $keys, Criteria::IN);
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
     * @return MatchesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MatchesPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MatchesPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatchesPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the team1 column
     *
     * Example usage:
     * <code>
     * $query->filterByTeam1('fooValue');   // WHERE team1 = 'fooValue'
     * $query->filterByTeam1('%fooValue%'); // WHERE team1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $team1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MatchesQuery The current query, for fluid interface
     */
    public function filterByTeam1($team1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($team1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $team1)) {
                $team1 = str_replace('*', '%', $team1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MatchesPeer::TEAM1, $team1, $comparison);
    }

    /**
     * Filter the query on the team2 column
     *
     * Example usage:
     * <code>
     * $query->filterByTeam2('fooValue');   // WHERE team2 = 'fooValue'
     * $query->filterByTeam2('%fooValue%'); // WHERE team2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $team2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MatchesQuery The current query, for fluid interface
     */
    public function filterByTeam2($team2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($team2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $team2)) {
                $team2 = str_replace('*', '%', $team2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MatchesPeer::TEAM2, $team2, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Matches $matches Object to remove from the list of results
     *
     * @return MatchesQuery The current query, for fluid interface
     */
    public function prune($matches = null)
    {
        if ($matches) {
            $this->addUsingAlias(MatchesPeer::ID, $matches->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
