<?php

namespace Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Model\Endpoint;
use Model\Perfil;
use Model\PerfilEndpoint;
use Model\PerfilEndpointPeer;
use Model\PerfilEndpointQuery;

/**
 * Base class that represents a query for the 'perfil_endpoint' table.
 *
 *
 *
 * @method PerfilEndpointQuery orderByPerfilId($order = Criteria::ASC) Order by the perfil_id column
 * @method PerfilEndpointQuery orderByEndpointId($order = Criteria::ASC) Order by the endpoint_id column
 *
 * @method PerfilEndpointQuery groupByPerfilId() Group by the perfil_id column
 * @method PerfilEndpointQuery groupByEndpointId() Group by the endpoint_id column
 *
 * @method PerfilEndpointQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PerfilEndpointQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PerfilEndpointQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PerfilEndpointQuery leftJoinEndpoint($relationAlias = null) Adds a LEFT JOIN clause to the query using the Endpoint relation
 * @method PerfilEndpointQuery rightJoinEndpoint($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Endpoint relation
 * @method PerfilEndpointQuery innerJoinEndpoint($relationAlias = null) Adds a INNER JOIN clause to the query using the Endpoint relation
 *
 * @method PerfilEndpointQuery leftJoinPerfil($relationAlias = null) Adds a LEFT JOIN clause to the query using the Perfil relation
 * @method PerfilEndpointQuery rightJoinPerfil($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Perfil relation
 * @method PerfilEndpointQuery innerJoinPerfil($relationAlias = null) Adds a INNER JOIN clause to the query using the Perfil relation
 *
 * @method PerfilEndpoint findOne(PropelPDO $con = null) Return the first PerfilEndpoint matching the query
 * @method PerfilEndpoint findOneOrCreate(PropelPDO $con = null) Return the first PerfilEndpoint matching the query, or a new PerfilEndpoint object populated from the query conditions when no match is found
 *
 * @method PerfilEndpoint findOneByPerfilId(int $perfil_id) Return the first PerfilEndpoint filtered by the perfil_id column
 * @method PerfilEndpoint findOneByEndpointId(int $endpoint_id) Return the first PerfilEndpoint filtered by the endpoint_id column
 *
 * @method array findByPerfilId(int $perfil_id) Return PerfilEndpoint objects filtered by the perfil_id column
 * @method array findByEndpointId(int $endpoint_id) Return PerfilEndpoint objects filtered by the endpoint_id column
 *
 * @package    propel.generator.siscad_autenticacao.om
 */
abstract class BasePerfilEndpointQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePerfilEndpointQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'siscad_autenticacao';
        }
        if (null === $modelName) {
            $modelName = 'Model\\PerfilEndpoint';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PerfilEndpointQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PerfilEndpointQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PerfilEndpointQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PerfilEndpointQuery) {
            return $criteria;
        }
        $query = new PerfilEndpointQuery(null, null, $modelAlias);

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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$perfil_id, $endpoint_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   PerfilEndpoint|PerfilEndpoint[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PerfilEndpointPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PerfilEndpointPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 PerfilEndpoint A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `perfil_id`, `endpoint_id` FROM `perfil_endpoint` WHERE `perfil_id` = :p0 AND `endpoint_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new PerfilEndpoint();
            $obj->hydrate($row);
            PerfilEndpointPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return PerfilEndpoint|PerfilEndpoint[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|PerfilEndpoint[]|mixed the list of results, formatted by the current formatter
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
     * @return PerfilEndpointQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PerfilEndpointPeer::PERFIL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PerfilEndpointPeer::ENDPOINT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PerfilEndpointQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PerfilEndpointPeer::PERFIL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PerfilEndpointPeer::ENDPOINT_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the perfil_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPerfilId(1234); // WHERE perfil_id = 1234
     * $query->filterByPerfilId(array(12, 34)); // WHERE perfil_id IN (12, 34)
     * $query->filterByPerfilId(array('min' => 12)); // WHERE perfil_id >= 12
     * $query->filterByPerfilId(array('max' => 12)); // WHERE perfil_id <= 12
     * </code>
     *
     * @see       filterByPerfil()
     *
     * @param     mixed $perfilId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PerfilEndpointQuery The current query, for fluid interface
     */
    public function filterByPerfilId($perfilId = null, $comparison = null)
    {
        if (is_array($perfilId)) {
            $useMinMax = false;
            if (isset($perfilId['min'])) {
                $this->addUsingAlias(PerfilEndpointPeer::PERFIL_ID, $perfilId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($perfilId['max'])) {
                $this->addUsingAlias(PerfilEndpointPeer::PERFIL_ID, $perfilId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PerfilEndpointPeer::PERFIL_ID, $perfilId, $comparison);
    }

    /**
     * Filter the query on the endpoint_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEndpointId(1234); // WHERE endpoint_id = 1234
     * $query->filterByEndpointId(array(12, 34)); // WHERE endpoint_id IN (12, 34)
     * $query->filterByEndpointId(array('min' => 12)); // WHERE endpoint_id >= 12
     * $query->filterByEndpointId(array('max' => 12)); // WHERE endpoint_id <= 12
     * </code>
     *
     * @see       filterByEndpoint()
     *
     * @param     mixed $endpointId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PerfilEndpointQuery The current query, for fluid interface
     */
    public function filterByEndpointId($endpointId = null, $comparison = null)
    {
        if (is_array($endpointId)) {
            $useMinMax = false;
            if (isset($endpointId['min'])) {
                $this->addUsingAlias(PerfilEndpointPeer::ENDPOINT_ID, $endpointId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endpointId['max'])) {
                $this->addUsingAlias(PerfilEndpointPeer::ENDPOINT_ID, $endpointId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PerfilEndpointPeer::ENDPOINT_ID, $endpointId, $comparison);
    }

    /**
     * Filter the query by a related Endpoint object
     *
     * @param   Endpoint|PropelObjectCollection $endpoint The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PerfilEndpointQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByEndpoint($endpoint, $comparison = null)
    {
        if ($endpoint instanceof Endpoint) {
            return $this
                ->addUsingAlias(PerfilEndpointPeer::ENDPOINT_ID, $endpoint->getId(), $comparison);
        } elseif ($endpoint instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PerfilEndpointPeer::ENDPOINT_ID, $endpoint->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEndpoint() only accepts arguments of type Endpoint or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Endpoint relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PerfilEndpointQuery The current query, for fluid interface
     */
    public function joinEndpoint($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Endpoint');

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
            $this->addJoinObject($join, 'Endpoint');
        }

        return $this;
    }

    /**
     * Use the Endpoint relation Endpoint object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Model\EndpointQuery A secondary query class using the current class as primary query
     */
    public function useEndpointQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEndpoint($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Endpoint', '\Model\EndpointQuery');
    }

    /**
     * Filter the query by a related Perfil object
     *
     * @param   Perfil|PropelObjectCollection $perfil The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PerfilEndpointQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPerfil($perfil, $comparison = null)
    {
        if ($perfil instanceof Perfil) {
            return $this
                ->addUsingAlias(PerfilEndpointPeer::PERFIL_ID, $perfil->getId(), $comparison);
        } elseif ($perfil instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PerfilEndpointPeer::PERFIL_ID, $perfil->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPerfil() only accepts arguments of type Perfil or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Perfil relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PerfilEndpointQuery The current query, for fluid interface
     */
    public function joinPerfil($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Perfil');

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
            $this->addJoinObject($join, 'Perfil');
        }

        return $this;
    }

    /**
     * Use the Perfil relation Perfil object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Model\PerfilQuery A secondary query class using the current class as primary query
     */
    public function usePerfilQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPerfil($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Perfil', '\Model\PerfilQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PerfilEndpoint $perfilEndpoint Object to remove from the list of results
     *
     * @return PerfilEndpointQuery The current query, for fluid interface
     */
    public function prune($perfilEndpoint = null)
    {
        if ($perfilEndpoint) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PerfilEndpointPeer::PERFIL_ID), $perfilEndpoint->getPerfilId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PerfilEndpointPeer::ENDPOINT_ID), $perfilEndpoint->getEndpointId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
