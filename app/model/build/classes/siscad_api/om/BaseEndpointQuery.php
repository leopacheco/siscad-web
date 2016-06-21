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
use Model\EndpointPeer;
use Model\EndpointQuery;
use Model\PerfilEndpoint;

/**
 * Base class that represents a query for the 'endpoint' table.
 *
 *
 *
 * @method EndpointQuery orderById($order = Criteria::ASC) Order by the id column
 * @method EndpointQuery orderByMethod($order = Criteria::ASC) Order by the method column
 * @method EndpointQuery orderByUri($order = Criteria::ASC) Order by the uri column
 * @method EndpointQuery orderByDescricao($order = Criteria::ASC) Order by the descricao column
 * @method EndpointQuery orderByAtivo($order = Criteria::ASC) Order by the ativo column
 * @method EndpointQuery orderByRestrito($order = Criteria::ASC) Order by the restrito column
 *
 * @method EndpointQuery groupById() Group by the id column
 * @method EndpointQuery groupByMethod() Group by the method column
 * @method EndpointQuery groupByUri() Group by the uri column
 * @method EndpointQuery groupByDescricao() Group by the descricao column
 * @method EndpointQuery groupByAtivo() Group by the ativo column
 * @method EndpointQuery groupByRestrito() Group by the restrito column
 *
 * @method EndpointQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EndpointQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EndpointQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EndpointQuery leftJoinPerfilEndpoint($relationAlias = null) Adds a LEFT JOIN clause to the query using the PerfilEndpoint relation
 * @method EndpointQuery rightJoinPerfilEndpoint($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PerfilEndpoint relation
 * @method EndpointQuery innerJoinPerfilEndpoint($relationAlias = null) Adds a INNER JOIN clause to the query using the PerfilEndpoint relation
 *
 * @method Endpoint findOne(PropelPDO $con = null) Return the first Endpoint matching the query
 * @method Endpoint findOneOrCreate(PropelPDO $con = null) Return the first Endpoint matching the query, or a new Endpoint object populated from the query conditions when no match is found
 *
 * @method Endpoint findOneByMethod(string $method) Return the first Endpoint filtered by the method column
 * @method Endpoint findOneByUri(string $uri) Return the first Endpoint filtered by the uri column
 * @method Endpoint findOneByDescricao(string $descricao) Return the first Endpoint filtered by the descricao column
 * @method Endpoint findOneByAtivo(boolean $ativo) Return the first Endpoint filtered by the ativo column
 * @method Endpoint findOneByRestrito(boolean $restrito) Return the first Endpoint filtered by the restrito column
 *
 * @method array findById(int $id) Return Endpoint objects filtered by the id column
 * @method array findByMethod(string $method) Return Endpoint objects filtered by the method column
 * @method array findByUri(string $uri) Return Endpoint objects filtered by the uri column
 * @method array findByDescricao(string $descricao) Return Endpoint objects filtered by the descricao column
 * @method array findByAtivo(boolean $ativo) Return Endpoint objects filtered by the ativo column
 * @method array findByRestrito(boolean $restrito) Return Endpoint objects filtered by the restrito column
 *
 * @package    propel.generator.siscad_api.om
 */
abstract class BaseEndpointQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEndpointQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'siscad_api';
        }
        if (null === $modelName) {
            $modelName = 'Model\\Endpoint';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EndpointQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   EndpointQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EndpointQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EndpointQuery) {
            return $criteria;
        }
        $query = new EndpointQuery(null, null, $modelAlias);

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
     * @return   Endpoint|Endpoint[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EndpointPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EndpointPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Endpoint A model object, or null if the key is not found
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
     * @return                 Endpoint A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `method`, `uri`, `descricao`, `ativo`, `restrito` FROM `endpoint` WHERE `id` = :p0';
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
            $obj = new Endpoint();
            $obj->hydrate($row);
            EndpointPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Endpoint|Endpoint[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Endpoint[]|mixed the list of results, formatted by the current formatter
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
     * @return EndpointQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EndpointPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EndpointQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EndpointPeer::ID, $keys, Criteria::IN);
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
     * @return EndpointQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(EndpointPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(EndpointPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EndpointPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the method column
     *
     * Example usage:
     * <code>
     * $query->filterByMethod('fooValue');   // WHERE method = 'fooValue'
     * $query->filterByMethod('%fooValue%'); // WHERE method LIKE '%fooValue%'
     * </code>
     *
     * @param     string $method The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EndpointQuery The current query, for fluid interface
     */
    public function filterByMethod($method = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($method)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $method)) {
                $method = str_replace('*', '%', $method);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EndpointPeer::METHOD, $method, $comparison);
    }

    /**
     * Filter the query on the uri column
     *
     * Example usage:
     * <code>
     * $query->filterByUri('fooValue');   // WHERE uri = 'fooValue'
     * $query->filterByUri('%fooValue%'); // WHERE uri LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uri The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EndpointQuery The current query, for fluid interface
     */
    public function filterByUri($uri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uri)) {
                $uri = str_replace('*', '%', $uri);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EndpointPeer::URI, $uri, $comparison);
    }

    /**
     * Filter the query on the descricao column
     *
     * Example usage:
     * <code>
     * $query->filterByDescricao('fooValue');   // WHERE descricao = 'fooValue'
     * $query->filterByDescricao('%fooValue%'); // WHERE descricao LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descricao The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EndpointQuery The current query, for fluid interface
     */
    public function filterByDescricao($descricao = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descricao)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $descricao)) {
                $descricao = str_replace('*', '%', $descricao);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EndpointPeer::DESCRICAO, $descricao, $comparison);
    }

    /**
     * Filter the query on the ativo column
     *
     * Example usage:
     * <code>
     * $query->filterByAtivo(true); // WHERE ativo = true
     * $query->filterByAtivo('yes'); // WHERE ativo = true
     * </code>
     *
     * @param     boolean|string $ativo The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EndpointQuery The current query, for fluid interface
     */
    public function filterByAtivo($ativo = null, $comparison = null)
    {
        if (is_string($ativo)) {
            $ativo = in_array(strtolower($ativo), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EndpointPeer::ATIVO, $ativo, $comparison);
    }

    /**
     * Filter the query on the restrito column
     *
     * Example usage:
     * <code>
     * $query->filterByRestrito(true); // WHERE restrito = true
     * $query->filterByRestrito('yes'); // WHERE restrito = true
     * </code>
     *
     * @param     boolean|string $restrito The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EndpointQuery The current query, for fluid interface
     */
    public function filterByRestrito($restrito = null, $comparison = null)
    {
        if (is_string($restrito)) {
            $restrito = in_array(strtolower($restrito), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EndpointPeer::RESTRITO, $restrito, $comparison);
    }

    /**
     * Filter the query by a related PerfilEndpoint object
     *
     * @param   PerfilEndpoint|PropelObjectCollection $perfilEndpoint  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 EndpointQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPerfilEndpoint($perfilEndpoint, $comparison = null)
    {
        if ($perfilEndpoint instanceof PerfilEndpoint) {
            return $this
                ->addUsingAlias(EndpointPeer::ID, $perfilEndpoint->getEndpointId(), $comparison);
        } elseif ($perfilEndpoint instanceof PropelObjectCollection) {
            return $this
                ->usePerfilEndpointQuery()
                ->filterByPrimaryKeys($perfilEndpoint->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPerfilEndpoint() only accepts arguments of type PerfilEndpoint or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PerfilEndpoint relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EndpointQuery The current query, for fluid interface
     */
    public function joinPerfilEndpoint($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PerfilEndpoint');

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
            $this->addJoinObject($join, 'PerfilEndpoint');
        }

        return $this;
    }

    /**
     * Use the PerfilEndpoint relation PerfilEndpoint object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Model\PerfilEndpointQuery A secondary query class using the current class as primary query
     */
    public function usePerfilEndpointQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPerfilEndpoint($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PerfilEndpoint', '\Model\PerfilEndpointQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Endpoint $endpoint Object to remove from the list of results
     *
     * @return EndpointQuery The current query, for fluid interface
     */
    public function prune($endpoint = null)
    {
        if ($endpoint) {
            $this->addUsingAlias(EndpointPeer::ID, $endpoint->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
