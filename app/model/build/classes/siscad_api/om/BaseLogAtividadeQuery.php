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
use Model\LogAtividadePeer;
use Model\LogAtividadeQuery;
use Model\LogRequisicao;

/**
 * Base class that represents a query for the 'log_atividade' table.
 *
 *
 *
 * @method LogAtividadeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LogAtividadeQuery orderByLogRequisicaoId($order = Criteria::ASC) Order by the log_requisicao_id column
 * @method LogAtividadeQuery orderByValorAnterior($order = Criteria::ASC) Order by the valor_anterior column
 * @method LogAtividadeQuery orderByValorAtual($order = Criteria::ASC) Order by the valor_atual column
 *
 * @method LogAtividadeQuery groupById() Group by the id column
 * @method LogAtividadeQuery groupByLogRequisicaoId() Group by the log_requisicao_id column
 * @method LogAtividadeQuery groupByValorAnterior() Group by the valor_anterior column
 * @method LogAtividadeQuery groupByValorAtual() Group by the valor_atual column
 *
 * @method LogAtividadeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LogAtividadeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LogAtividadeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LogAtividadeQuery leftJoinLogRequisicao($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogRequisicao relation
 * @method LogAtividadeQuery rightJoinLogRequisicao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogRequisicao relation
 * @method LogAtividadeQuery innerJoinLogRequisicao($relationAlias = null) Adds a INNER JOIN clause to the query using the LogRequisicao relation
 *
 * @method LogAtividade findOne(PropelPDO $con = null) Return the first LogAtividade matching the query
 * @method LogAtividade findOneOrCreate(PropelPDO $con = null) Return the first LogAtividade matching the query, or a new LogAtividade object populated from the query conditions when no match is found
 *
 * @method LogAtividade findOneByLogRequisicaoId(int $log_requisicao_id) Return the first LogAtividade filtered by the log_requisicao_id column
 * @method LogAtividade findOneByValorAnterior(string $valor_anterior) Return the first LogAtividade filtered by the valor_anterior column
 * @method LogAtividade findOneByValorAtual(string $valor_atual) Return the first LogAtividade filtered by the valor_atual column
 *
 * @method array findById(int $id) Return LogAtividade objects filtered by the id column
 * @method array findByLogRequisicaoId(int $log_requisicao_id) Return LogAtividade objects filtered by the log_requisicao_id column
 * @method array findByValorAnterior(string $valor_anterior) Return LogAtividade objects filtered by the valor_anterior column
 * @method array findByValorAtual(string $valor_atual) Return LogAtividade objects filtered by the valor_atual column
 *
 * @package    propel.generator.siscad_api.om
 */
abstract class BaseLogAtividadeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLogAtividadeQuery object.
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
            $modelName = 'Model\\LogAtividade';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LogAtividadeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LogAtividadeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LogAtividadeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LogAtividadeQuery) {
            return $criteria;
        }
        $query = new LogAtividadeQuery(null, null, $modelAlias);

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
     * @return   LogAtividade|LogAtividade[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LogAtividadePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LogAtividadePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LogAtividade A model object, or null if the key is not found
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
     * @return                 LogAtividade A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `log_requisicao_id`, `valor_anterior`, `valor_atual` FROM `log_atividade` WHERE `id` = :p0';
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
            $obj = new LogAtividade();
            $obj->hydrate($row);
            LogAtividadePeer::addInstanceToPool($obj, (string) $key);
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
     * @return LogAtividade|LogAtividade[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LogAtividade[]|mixed the list of results, formatted by the current formatter
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
     * @return LogAtividadeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LogAtividadePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LogAtividadeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LogAtividadePeer::ID, $keys, Criteria::IN);
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
     * @return LogAtividadeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LogAtividadePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LogAtividadePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogAtividadePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the log_requisicao_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLogRequisicaoId(1234); // WHERE log_requisicao_id = 1234
     * $query->filterByLogRequisicaoId(array(12, 34)); // WHERE log_requisicao_id IN (12, 34)
     * $query->filterByLogRequisicaoId(array('min' => 12)); // WHERE log_requisicao_id >= 12
     * $query->filterByLogRequisicaoId(array('max' => 12)); // WHERE log_requisicao_id <= 12
     * </code>
     *
     * @see       filterByLogRequisicao()
     *
     * @param     mixed $logRequisicaoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LogAtividadeQuery The current query, for fluid interface
     */
    public function filterByLogRequisicaoId($logRequisicaoId = null, $comparison = null)
    {
        if (is_array($logRequisicaoId)) {
            $useMinMax = false;
            if (isset($logRequisicaoId['min'])) {
                $this->addUsingAlias(LogAtividadePeer::LOG_REQUISICAO_ID, $logRequisicaoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($logRequisicaoId['max'])) {
                $this->addUsingAlias(LogAtividadePeer::LOG_REQUISICAO_ID, $logRequisicaoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogAtividadePeer::LOG_REQUISICAO_ID, $logRequisicaoId, $comparison);
    }

    /**
     * Filter the query on the valor_anterior column
     *
     * Example usage:
     * <code>
     * $query->filterByValorAnterior('fooValue');   // WHERE valor_anterior = 'fooValue'
     * $query->filterByValorAnterior('%fooValue%'); // WHERE valor_anterior LIKE '%fooValue%'
     * </code>
     *
     * @param     string $valorAnterior The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LogAtividadeQuery The current query, for fluid interface
     */
    public function filterByValorAnterior($valorAnterior = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($valorAnterior)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $valorAnterior)) {
                $valorAnterior = str_replace('*', '%', $valorAnterior);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LogAtividadePeer::VALOR_ANTERIOR, $valorAnterior, $comparison);
    }

    /**
     * Filter the query on the valor_atual column
     *
     * Example usage:
     * <code>
     * $query->filterByValorAtual('fooValue');   // WHERE valor_atual = 'fooValue'
     * $query->filterByValorAtual('%fooValue%'); // WHERE valor_atual LIKE '%fooValue%'
     * </code>
     *
     * @param     string $valorAtual The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LogAtividadeQuery The current query, for fluid interface
     */
    public function filterByValorAtual($valorAtual = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($valorAtual)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $valorAtual)) {
                $valorAtual = str_replace('*', '%', $valorAtual);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LogAtividadePeer::VALOR_ATUAL, $valorAtual, $comparison);
    }

    /**
     * Filter the query by a related LogRequisicao object
     *
     * @param   LogRequisicao|PropelObjectCollection $logRequisicao The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LogAtividadeQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLogRequisicao($logRequisicao, $comparison = null)
    {
        if ($logRequisicao instanceof LogRequisicao) {
            return $this
                ->addUsingAlias(LogAtividadePeer::LOG_REQUISICAO_ID, $logRequisicao->getId(), $comparison);
        } elseif ($logRequisicao instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogAtividadePeer::LOG_REQUISICAO_ID, $logRequisicao->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLogRequisicao() only accepts arguments of type LogRequisicao or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogRequisicao relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LogAtividadeQuery The current query, for fluid interface
     */
    public function joinLogRequisicao($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogRequisicao');

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
            $this->addJoinObject($join, 'LogRequisicao');
        }

        return $this;
    }

    /**
     * Use the LogRequisicao relation LogRequisicao object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Model\LogRequisicaoQuery A secondary query class using the current class as primary query
     */
    public function useLogRequisicaoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogRequisicao($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogRequisicao', '\Model\LogRequisicaoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LogAtividade $logAtividade Object to remove from the list of results
     *
     * @return LogAtividadeQuery The current query, for fluid interface
     */
    public function prune($logAtividade = null)
    {
        if ($logAtividade) {
            $this->addUsingAlias(LogAtividadePeer::ID, $logAtividade->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
