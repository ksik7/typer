<?php


/**
 * Base class that represents a query for the 'data_league' table.
 *
 *
 *
 * @method DataLeagueQuery orderById($order = Criteria::ASC) Order by the id column
 * @method DataLeagueQuery orderByLeugeId($order = Criteria::ASC) Order by the leuge_id column
 * @method DataLeagueQuery orderByMatchId($order = Criteria::ASC) Order by the match_id column
 *
 * @method DataLeagueQuery groupById() Group by the id column
 * @method DataLeagueQuery groupByLeugeId() Group by the leuge_id column
 * @method DataLeagueQuery groupByMatchId() Group by the match_id column
 *
 * @method DataLeagueQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DataLeagueQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DataLeagueQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DataLeagueQuery leftJoinLeagues($relationAlias = null) Adds a LEFT JOIN clause to the query using the Leagues relation
 * @method DataLeagueQuery rightJoinLeagues($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Leagues relation
 * @method DataLeagueQuery innerJoinLeagues($relationAlias = null) Adds a INNER JOIN clause to the query using the Leagues relation
 *
 * @method DataLeagueQuery leftJoinMatches($relationAlias = null) Adds a LEFT JOIN clause to the query using the Matches relation
 * @method DataLeagueQuery rightJoinMatches($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Matches relation
 * @method DataLeagueQuery innerJoinMatches($relationAlias = null) Adds a INNER JOIN clause to the query using the Matches relation
 *
 * @method DataLeague findOne(PropelPDO $con = null) Return the first DataLeague matching the query
 * @method DataLeague findOneOrCreate(PropelPDO $con = null) Return the first DataLeague matching the query, or a new DataLeague object populated from the query conditions when no match is found
 *
 * @method DataLeague findOneByLeugeId(int $leuge_id) Return the first DataLeague filtered by the leuge_id column
 * @method DataLeague findOneByMatchId(int $match_id) Return the first DataLeague filtered by the match_id column
 *
 * @method array findById(int $id) Return DataLeague objects filtered by the id column
 * @method array findByLeugeId(int $leuge_id) Return DataLeague objects filtered by the leuge_id column
 * @method array findByMatchId(int $match_id) Return DataLeague objects filtered by the match_id column
 *
 * @package    propel.generator.strona.om
 */
abstract class BaseDataLeagueQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDataLeagueQuery object.
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
            $modelName = 'DataLeague';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DataLeagueQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   DataLeagueQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DataLeagueQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DataLeagueQuery) {
            return $criteria;
        }
        $query = new DataLeagueQuery(null, null, $modelAlias);

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
     * @return   DataLeague|DataLeague[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DataLeaguePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DataLeaguePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 DataLeague A model object, or null if the key is not found
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
     * @return                 DataLeague A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `leuge_id`, `match_id` FROM `data_league` WHERE `id` = :p0';
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
            $obj = new DataLeague();
            $obj->hydrate($row);
            DataLeaguePeer::addInstanceToPool($obj, (string) $key);
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
     * @return DataLeague|DataLeague[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|DataLeague[]|mixed the list of results, formatted by the current formatter
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
     * @return DataLeagueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DataLeaguePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DataLeagueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DataLeaguePeer::ID, $keys, Criteria::IN);
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
     * @return DataLeagueQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DataLeaguePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DataLeaguePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DataLeaguePeer::ID, $id, $comparison);
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
     * @see       filterByLeagues()
     *
     * @param     mixed $leugeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DataLeagueQuery The current query, for fluid interface
     */
    public function filterByLeugeId($leugeId = null, $comparison = null)
    {
        if (is_array($leugeId)) {
            $useMinMax = false;
            if (isset($leugeId['min'])) {
                $this->addUsingAlias(DataLeaguePeer::LEUGE_ID, $leugeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leugeId['max'])) {
                $this->addUsingAlias(DataLeaguePeer::LEUGE_ID, $leugeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DataLeaguePeer::LEUGE_ID, $leugeId, $comparison);
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
     * @see       filterByMatches()
     *
     * @param     mixed $matchId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DataLeagueQuery The current query, for fluid interface
     */
    public function filterByMatchId($matchId = null, $comparison = null)
    {
        if (is_array($matchId)) {
            $useMinMax = false;
            if (isset($matchId['min'])) {
                $this->addUsingAlias(DataLeaguePeer::MATCH_ID, $matchId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($matchId['max'])) {
                $this->addUsingAlias(DataLeaguePeer::MATCH_ID, $matchId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DataLeaguePeer::MATCH_ID, $matchId, $comparison);
    }

    /**
     * Filter the query by a related Leagues object
     *
     * @param   Leagues|PropelObjectCollection $leagues The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 DataLeagueQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeagues($leagues, $comparison = null)
    {
        if ($leagues instanceof Leagues) {
            return $this
                ->addUsingAlias(DataLeaguePeer::LEUGE_ID, $leagues->getId(), $comparison);
        } elseif ($leagues instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DataLeaguePeer::LEUGE_ID, $leagues->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeagues() only accepts arguments of type Leagues or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Leagues relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DataLeagueQuery The current query, for fluid interface
     */
    public function joinLeagues($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Leagues');

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
            $this->addJoinObject($join, 'Leagues');
        }

        return $this;
    }

    /**
     * Use the Leagues relation Leagues object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   LeaguesQuery A secondary query class using the current class as primary query
     */
    public function useLeaguesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLeagues($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Leagues', 'LeaguesQuery');
    }

    /**
     * Filter the query by a related Matches object
     *
     * @param   Matches|PropelObjectCollection $matches The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 DataLeagueQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByMatches($matches, $comparison = null)
    {
        if ($matches instanceof Matches) {
            return $this
                ->addUsingAlias(DataLeaguePeer::MATCH_ID, $matches->getId(), $comparison);
        } elseif ($matches instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DataLeaguePeer::MATCH_ID, $matches->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMatches() only accepts arguments of type Matches or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Matches relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DataLeagueQuery The current query, for fluid interface
     */
    public function joinMatches($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Matches');

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
            $this->addJoinObject($join, 'Matches');
        }

        return $this;
    }

    /**
     * Use the Matches relation Matches object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   MatchesQuery A secondary query class using the current class as primary query
     */
    public function useMatchesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMatches($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Matches', 'MatchesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   DataLeague $dataLeague Object to remove from the list of results
     *
     * @return DataLeagueQuery The current query, for fluid interface
     */
    public function prune($dataLeague = null)
    {
        if ($dataLeague) {
            $this->addUsingAlias(DataLeaguePeer::ID, $dataLeague->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
