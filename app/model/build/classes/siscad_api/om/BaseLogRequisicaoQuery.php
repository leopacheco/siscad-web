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
use Model\LogAtividade;
use Model\LogRequisicao;
use Model\LogRequisicaoPeer;
use Model\LogRequisicaoQuery;
use Model\Usuario;

/**
 * Base class that represents a query for the 'log_requisicao' table.
 *
 *
 *
 * @method LogRequisicaoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LogRequisicaoQuery orderByUsuarioId($order = Criteria::ASC) Order by the usuario_id column
 * @method LogRequisicaoQuery orderByRequisicao($order = Criteria::ASC) Order by the requisicao column
 * @method LogRequisicaoQuery orderByNonce($order = Criteria::ASC) Order by the nonce column
 * @method LogRequisicaoQuery orderByData($order = Criteria::ASC) Order by the data column
 * @method LogRequisicaoQuery orderByIp($order = Criteria::ASC) Order by the ip column
 *
 * @method LogRequisicaoQuery groupById() Group by the id column
 * @method LogRequisicaoQuery groupByUsuarioId() Group by the usuario_id column
 * @method LogRequisicaoQuery groupByRequisicao() Group by the requisicao column
 * @method LogRequisicaoQuery groupByNonce() Group by the nonce column
 * @method LogRequisicaoQuery groupByData() Group by the data column
 * @method LogRequisicaoQuery groupByIp() Group by the ip column
 *
 * @method LogRequisicaoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LogRequisicaoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LogRequisicaoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LogRequisicaoQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method LogRequisicaoQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method LogRequisicaoQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method LogRequisicaoQuery leftJoinLogAtividade($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogAtividade relation
 * @method LogRequisicaoQuery rightJoinLogAtividade($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogAtividade relation
 * @method LogRequisicaoQuery innerJoinLogAtividade($relationAlias = null) Adds a INNER JOIN clause to the query using the LogAtividade relation
 *
 * @method LogRequisicao findOne(PropelPDO $con = null) Return the first LogRequisicao matching the query
 * @method LogRequisicao findOneOrCreate(PropelPDO $con = null) Return the first LogRequisicao matching the query, or a new LogRequisicao object populated from the query conditions when no match is found
 *
 * @method LogRequisicao findOneByUsuarioId(int $usuario_id) Return the first LogRequisicao filtered by the usuario_id column
 * @method LogRequisicao findOneByRequisicao(string $requisicao) Return the first LogRequisicao filtered by the requisicao column
 * @method LogRequisicao findOneByNonce(string $nonce) Return the first LogRequisicao filtered by the nonce column
 * @method LogRequisicao findOneByData(string $data) Return the first LogRequisicao filtered by the data column
 * @method LogRequisicao findOneByIp(string $ip) Return the first LogRequisicao filtered by the ip column
 *
 * @method array findById(int $id) Return LogRequisicao objects filtered by the id column
 * @method array findByUsuarioId(int $usuario_id) Return LogRequisicao objects filtered by the usuario_id column
 * @method array findByRequisicao(string $requisicao) Return LogRequisicao objects filtered by the requisicao column
 * @method array findByNonce(string $nonce) Return LogRequisicao objects filtered by the nonce column
 * @method array findByData(string $data) Return LogRequisicao objects filtered by the data column
 * @method array findByIp(string $ip) Return LogRequisicao objects filtered by the ip column
 *
 * @package    propel.generator.siscad_api.om
 */
abstract class BaseLogRequisicaoQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLogRequisicaoQuery object.
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
            $modelName = 'Model\\LogRequisicao';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LogRequisicaoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LogRequisicaoQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LogRequisicaoQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LogRequisicaoQuery) {
            return $criteria;
        }
        $query = new LogRequisicaoQuery(null, null, $modelAlias);

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
     * @return   LogRequisicao|LogRequisicao[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LogRequisicaoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LogRequisicaoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LogRequisicao A model object, or null if the key is not found
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
     * @return                 LogRequisicao A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `usuario_id`, `requisicao`, `nonce`, `data`, `ip` FROM `log_requisicao` WHERE `id` = :p0';
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
            $obj = new LogRequisicao();
            $obj->hydrate($row);
            LogRequisicaoPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LogRequisicao|LogRequisicao[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LogRequisicao[]|mixed the list of results, formatted by the current formatter
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
     * @return LogRequisicaoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LogRequisicaoPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LogRequisicaoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LogRequisicaoPeer::ID, $keys, Criteria::IN);
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
     * @return LogRequisicaoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LogRequisicaoPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LogRequisicaoPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogRequisicaoPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the usuario_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuarioId(1234); // WHERE usuario_id = 1234
     * $query->filterByUsuarioId(array(12, 34)); // WHERE usuario_id IN (12, 34)
     * $query->filterByUsuarioId(array('min' => 12)); // WHERE usuario_id >= 12
     * $query->filterByUsuarioId(array('max' => 12)); // WHERE usuario_id <= 12
     * </code>
     *
     * @see       filterByUsuario()
     *
     * @param     mixed $usuarioId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LogRequisicaoQuery The current query, for fluid interface
     */
    public function filterByUsuarioId($usuarioId = null, $comparison = null)
    {
        if (is_array($usuarioId)) {
            $useMinMax = false;
            if (isset($usuarioId['min'])) {
                $this->addUsingAlias(LogRequisicaoPeer::USUARIO_ID, $usuarioId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuarioId['max'])) {
                $this->addUsingAlias(LogRequisicaoPeer::USUARIO_ID, $usuarioId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogRequisicaoPeer::USUARIO_ID, $usuarioId, $comparison);
    }

    /**
     * Filter the query on the requisicao column
     *
     * Example usage:
     * <code>
     * $query->filterByRequisicao('fooValue');   // WHERE requisicao = 'fooValue'
     * $query->filterByRequisicao('%fooValue%'); // WHERE requisicao LIKE '%fooValue%'
     * </code>
     *
     * @param     string $requisicao The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LogRequisicaoQuery The current query, for fluid interface
     */
    public function filterByRequisicao($requisicao = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($requisicao)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $requisicao)) {
                $requisicao = str_replace('*', '%', $requisicao);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LogRequisicaoPeer::REQUISICAO, $requisicao, $comparison);
    }

    /**
     * Filter the query on the nonce column
     *
     * Example usage:
     * <code>
     * $query->filterByNonce('fooValue');   // WHERE nonce = 'fooValue'
     * $query->filterByNonce('%fooValue%'); // WHERE nonce LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nonce The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LogRequisicaoQuery The current query, for fluid interface
     */
    public function filterByNonce($nonce = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nonce)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nonce)) {
                $nonce = str_replace('*', '%', $nonce);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LogRequisicaoPeer::NONCE, $nonce, $comparison);
    }

    /**
     * Filter the query on the data column
     *
     * Example usage:
     * <code>
     * $query->filterByData('2011-03-14'); // WHERE data = '2011-03-14'
     * $query->filterByData('now'); // WHERE data = '2011-03-14'
     * $query->filterByData(array('max' => 'yesterday')); // WHERE data < '2011-03-13'
     * </code>
     *
     * @param     mixed $data The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LogRequisicaoQuery The current query, for fluid interface
     */
    public function filterByData($data = null, $comparison = null)
    {
        if (is_array($data)) {
            $useMinMax = false;
            if (isset($data['min'])) {
                $this->addUsingAlias(LogRequisicaoPeer::DATA, $data['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($data['max'])) {
                $this->addUsingAlias(LogRequisicaoPeer::DATA, $data['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogRequisicaoPeer::DATA, $data, $comparison);
    }

    /**
     * Filter the query on the ip column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE ip = 'fooValue'
     * $query->filterByIp('%fooValue%'); // WHERE ip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ip The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LogRequisicaoQuery The current query, for fluid interface
     */
    public function filterByIp($ip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ip)) {
                $ip = str_replace('*', '%', $ip);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LogRequisicaoPeer::IP, $ip, $comparison);
    }

    /**
     * Filter the query by a related Usuario object
     *
     * @param   Usuario|PropelObjectCollection $usuario The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LogRequisicaoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof Usuario) {
            return $this
                ->addUsingAlias(LogRequisicaoPeer::USUARIO_ID, $usuario->getId(), $comparison);
        } elseif ($usuario instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogRequisicaoPeer::USUARIO_ID, $usuario->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsuario() only accepts arguments of type Usuario or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LogRequisicaoQuery The current query, for fluid interface
     */
    public function joinUsuario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usuario');

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
            $this->addJoinObject($join, 'Usuario');
        }

        return $this;
    }

    /**
     * Use the Usuario relation Usuario object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Model\UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usuario', '\Model\UsuarioQuery');
    }

    /**
     * Filter the query by a related LogAtividade object
     *
     * @param   LogAtividade|PropelObjectCollection $logAtividade  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LogRequisicaoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLogAtividade($logAtividade, $comparison = null)
    {
        if ($logAtividade instanceof LogAtividade) {
            return $this
                ->addUsingAlias(LogRequisicaoPeer::ID, $logAtividade->getLogRequisicaoId(), $comparison);
        } elseif ($logAtividade instanceof PropelObjectCollection) {
            return $this
                ->useLogAtividadeQuery()
                ->filterByPrimaryKeys($logAtividade->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogAtividade() only accepts arguments of type LogAtividade or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogAtividade relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LogRequisicaoQuery The current query, for fluid interface
     */
    public function joinLogAtividade($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogAtividade');

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
            $this->addJoinObject($join, 'LogAtividade');
        }

        return $this;
    }

    /**
     * Use the LogAtividade relation LogAtividade object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Model\LogAtividadeQuery A secondary query class using the current class as primary query
     */
    public function useLogAtividadeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogAtividade($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogAtividade', '\Model\LogAtividadeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LogRequisicao $logRequisicao Object to remove from the list of results
     *
     * @return LogRequisicaoQuery The current query, for fluid interface
     */
    public function prune($logRequisicao = null)
    {
        if ($logRequisicao) {
            $this->addUsingAlias(LogRequisicaoPeer::ID, $logRequisicao->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
