<?php

namespace Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Model\Endpoint;
use Model\EndpointPeer;
use Model\EndpointQuery;
use Model\PerfilEndpoint;
use Model\PerfilEndpointQuery;

/**
 * Base class that represents a row from the 'endpoint' table.
 *
 *
 *
 * @package    propel.generator.siscad_autenticacao.om
 */
abstract class BaseEndpoint extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Model\\EndpointPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        EndpointPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the method field.
     * @var        string
     */
    protected $method;

    /**
     * The value for the uri field.
     * @var        string
     */
    protected $uri;

    /**
     * The value for the descricao field.
     * @var        string
     */
    protected $descricao;

    /**
     * The value for the ativo field.
     * @var        boolean
     */
    protected $ativo;

    /**
     * The value for the restrito field.
     * @var        boolean
     */
    protected $restrito;

    /**
     * @var        PropelObjectCollection|PerfilEndpoint[] Collection to store aggregation of PerfilEndpoint objects.
     */
    protected $collPerfilEndpoints;
    protected $collPerfilEndpointsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $perfilEndpointsScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [method] column value.
     *
     * @return string
     */
    public function getMethod()
    {

        return $this->method;
    }

    /**
     * Get the [uri] column value.
     *
     * @return string
     */
    public function getUri()
    {

        return $this->uri;
    }

    /**
     * Get the [descricao] column value.
     *
     * @return string
     */
    public function getDescricao()
    {

        return $this->descricao;
    }

    /**
     * Get the [ativo] column value.
     *
     * @return boolean
     */
    public function getAtivo()
    {

        return $this->ativo;
    }

    /**
     * Get the [restrito] column value.
     *
     * @return boolean
     */
    public function getRestrito()
    {

        return $this->restrito;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Endpoint The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = EndpointPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [method] column.
     *
     * @param  string $v new value
     * @return Endpoint The current object (for fluent API support)
     */
    public function setMethod($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->method !== $v) {
            $this->method = $v;
            $this->modifiedColumns[] = EndpointPeer::METHOD;
        }


        return $this;
    } // setMethod()

    /**
     * Set the value of [uri] column.
     *
     * @param  string $v new value
     * @return Endpoint The current object (for fluent API support)
     */
    public function setUri($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uri !== $v) {
            $this->uri = $v;
            $this->modifiedColumns[] = EndpointPeer::URI;
        }


        return $this;
    } // setUri()

    /**
     * Set the value of [descricao] column.
     *
     * @param  string $v new value
     * @return Endpoint The current object (for fluent API support)
     */
    public function setDescricao($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descricao !== $v) {
            $this->descricao = $v;
            $this->modifiedColumns[] = EndpointPeer::DESCRICAO;
        }


        return $this;
    } // setDescricao()

    /**
     * Sets the value of the [ativo] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Endpoint The current object (for fluent API support)
     */
    public function setAtivo($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->ativo !== $v) {
            $this->ativo = $v;
            $this->modifiedColumns[] = EndpointPeer::ATIVO;
        }


        return $this;
    } // setAtivo()

    /**
     * Sets the value of the [restrito] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Endpoint The current object (for fluent API support)
     */
    public function setRestrito($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->restrito !== $v) {
            $this->restrito = $v;
            $this->modifiedColumns[] = EndpointPeer::RESTRITO;
        }


        return $this;
    } // setRestrito()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->method = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->uri = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->descricao = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->ativo = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
            $this->restrito = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 6; // 6 = EndpointPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Endpoint object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EndpointPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = EndpointPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPerfilEndpoints = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EndpointPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = EndpointQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EndpointPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                EndpointPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->perfilEndpointsScheduledForDeletion !== null) {
                if (!$this->perfilEndpointsScheduledForDeletion->isEmpty()) {
                    PerfilEndpointQuery::create()
                        ->filterByPrimaryKeys($this->perfilEndpointsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->perfilEndpointsScheduledForDeletion = null;
                }
            }

            if ($this->collPerfilEndpoints !== null) {
                foreach ($this->collPerfilEndpoints as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = EndpointPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EndpointPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EndpointPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(EndpointPeer::METHOD)) {
            $modifiedColumns[':p' . $index++]  = '`method`';
        }
        if ($this->isColumnModified(EndpointPeer::URI)) {
            $modifiedColumns[':p' . $index++]  = '`uri`';
        }
        if ($this->isColumnModified(EndpointPeer::DESCRICAO)) {
            $modifiedColumns[':p' . $index++]  = '`descricao`';
        }
        if ($this->isColumnModified(EndpointPeer::ATIVO)) {
            $modifiedColumns[':p' . $index++]  = '`ativo`';
        }
        if ($this->isColumnModified(EndpointPeer::RESTRITO)) {
            $modifiedColumns[':p' . $index++]  = '`restrito`';
        }

        $sql = sprintf(
            'INSERT INTO `endpoint` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`method`':
                        $stmt->bindValue($identifier, $this->method, PDO::PARAM_STR);
                        break;
                    case '`uri`':
                        $stmt->bindValue($identifier, $this->uri, PDO::PARAM_STR);
                        break;
                    case '`descricao`':
                        $stmt->bindValue($identifier, $this->descricao, PDO::PARAM_STR);
                        break;
                    case '`ativo`':
                        $stmt->bindValue($identifier, (int) $this->ativo, PDO::PARAM_INT);
                        break;
                    case '`restrito`':
                        $stmt->bindValue($identifier, (int) $this->restrito, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = EndpointPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPerfilEndpoints !== null) {
                    foreach ($this->collPerfilEndpoints as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = EndpointPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getMethod();
                break;
            case 2:
                return $this->getUri();
                break;
            case 3:
                return $this->getDescricao();
                break;
            case 4:
                return $this->getAtivo();
                break;
            case 5:
                return $this->getRestrito();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Endpoint'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Endpoint'][$this->getPrimaryKey()] = true;
        $keys = EndpointPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getMethod(),
            $keys[2] => $this->getUri(),
            $keys[3] => $this->getDescricao(),
            $keys[4] => $this->getAtivo(),
            $keys[5] => $this->getRestrito(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collPerfilEndpoints) {
                $result['PerfilEndpoints'] = $this->collPerfilEndpoints->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = EndpointPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setMethod($value);
                break;
            case 2:
                $this->setUri($value);
                break;
            case 3:
                $this->setDescricao($value);
                break;
            case 4:
                $this->setAtivo($value);
                break;
            case 5:
                $this->setRestrito($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = EndpointPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setMethod($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUri($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDescricao($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAtivo($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setRestrito($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(EndpointPeer::DATABASE_NAME);

        if ($this->isColumnModified(EndpointPeer::ID)) $criteria->add(EndpointPeer::ID, $this->id);
        if ($this->isColumnModified(EndpointPeer::METHOD)) $criteria->add(EndpointPeer::METHOD, $this->method);
        if ($this->isColumnModified(EndpointPeer::URI)) $criteria->add(EndpointPeer::URI, $this->uri);
        if ($this->isColumnModified(EndpointPeer::DESCRICAO)) $criteria->add(EndpointPeer::DESCRICAO, $this->descricao);
        if ($this->isColumnModified(EndpointPeer::ATIVO)) $criteria->add(EndpointPeer::ATIVO, $this->ativo);
        if ($this->isColumnModified(EndpointPeer::RESTRITO)) $criteria->add(EndpointPeer::RESTRITO, $this->restrito);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(EndpointPeer::DATABASE_NAME);
        $criteria->add(EndpointPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Endpoint (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setMethod($this->getMethod());
        $copyObj->setUri($this->getUri());
        $copyObj->setDescricao($this->getDescricao());
        $copyObj->setAtivo($this->getAtivo());
        $copyObj->setRestrito($this->getRestrito());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getPerfilEndpoints() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPerfilEndpoint($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Endpoint Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return EndpointPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new EndpointPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('PerfilEndpoint' == $relationName) {
            $this->initPerfilEndpoints();
        }
    }

    /**
     * Clears out the collPerfilEndpoints collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Endpoint The current object (for fluent API support)
     * @see        addPerfilEndpoints()
     */
    public function clearPerfilEndpoints()
    {
        $this->collPerfilEndpoints = null; // important to set this to null since that means it is uninitialized
        $this->collPerfilEndpointsPartial = null;

        return $this;
    }

    /**
     * reset is the collPerfilEndpoints collection loaded partially
     *
     * @return void
     */
    public function resetPartialPerfilEndpoints($v = true)
    {
        $this->collPerfilEndpointsPartial = $v;
    }

    /**
     * Initializes the collPerfilEndpoints collection.
     *
     * By default this just sets the collPerfilEndpoints collection to an empty array (like clearcollPerfilEndpoints());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPerfilEndpoints($overrideExisting = true)
    {
        if (null !== $this->collPerfilEndpoints && !$overrideExisting) {
            return;
        }
        $this->collPerfilEndpoints = new PropelObjectCollection();
        $this->collPerfilEndpoints->setModel('PerfilEndpoint');
    }

    /**
     * Gets an array of PerfilEndpoint objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Endpoint is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PerfilEndpoint[] List of PerfilEndpoint objects
     * @throws PropelException
     */
    public function getPerfilEndpoints($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPerfilEndpointsPartial && !$this->isNew();
        if (null === $this->collPerfilEndpoints || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPerfilEndpoints) {
                // return empty collection
                $this->initPerfilEndpoints();
            } else {
                $collPerfilEndpoints = PerfilEndpointQuery::create(null, $criteria)
                    ->filterByEndpoint($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPerfilEndpointsPartial && count($collPerfilEndpoints)) {
                      $this->initPerfilEndpoints(false);

                      foreach ($collPerfilEndpoints as $obj) {
                        if (false == $this->collPerfilEndpoints->contains($obj)) {
                          $this->collPerfilEndpoints->append($obj);
                        }
                      }

                      $this->collPerfilEndpointsPartial = true;
                    }

                    $collPerfilEndpoints->getInternalIterator()->rewind();

                    return $collPerfilEndpoints;
                }

                if ($partial && $this->collPerfilEndpoints) {
                    foreach ($this->collPerfilEndpoints as $obj) {
                        if ($obj->isNew()) {
                            $collPerfilEndpoints[] = $obj;
                        }
                    }
                }

                $this->collPerfilEndpoints = $collPerfilEndpoints;
                $this->collPerfilEndpointsPartial = false;
            }
        }

        return $this->collPerfilEndpoints;
    }

    /**
     * Sets a collection of PerfilEndpoint objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $perfilEndpoints A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Endpoint The current object (for fluent API support)
     */
    public function setPerfilEndpoints(PropelCollection $perfilEndpoints, PropelPDO $con = null)
    {
        $perfilEndpointsToDelete = $this->getPerfilEndpoints(new Criteria(), $con)->diff($perfilEndpoints);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->perfilEndpointsScheduledForDeletion = clone $perfilEndpointsToDelete;

        foreach ($perfilEndpointsToDelete as $perfilEndpointRemoved) {
            $perfilEndpointRemoved->setEndpoint(null);
        }

        $this->collPerfilEndpoints = null;
        foreach ($perfilEndpoints as $perfilEndpoint) {
            $this->addPerfilEndpoint($perfilEndpoint);
        }

        $this->collPerfilEndpoints = $perfilEndpoints;
        $this->collPerfilEndpointsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PerfilEndpoint objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PerfilEndpoint objects.
     * @throws PropelException
     */
    public function countPerfilEndpoints(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPerfilEndpointsPartial && !$this->isNew();
        if (null === $this->collPerfilEndpoints || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPerfilEndpoints) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPerfilEndpoints());
            }
            $query = PerfilEndpointQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEndpoint($this)
                ->count($con);
        }

        return count($this->collPerfilEndpoints);
    }

    /**
     * Method called to associate a PerfilEndpoint object to this object
     * through the PerfilEndpoint foreign key attribute.
     *
     * @param    PerfilEndpoint $l PerfilEndpoint
     * @return Endpoint The current object (for fluent API support)
     */
    public function addPerfilEndpoint(PerfilEndpoint $l)
    {
        if ($this->collPerfilEndpoints === null) {
            $this->initPerfilEndpoints();
            $this->collPerfilEndpointsPartial = true;
        }

        if (!in_array($l, $this->collPerfilEndpoints->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPerfilEndpoint($l);

            if ($this->perfilEndpointsScheduledForDeletion and $this->perfilEndpointsScheduledForDeletion->contains($l)) {
                $this->perfilEndpointsScheduledForDeletion->remove($this->perfilEndpointsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	PerfilEndpoint $perfilEndpoint The perfilEndpoint object to add.
     */
    protected function doAddPerfilEndpoint($perfilEndpoint)
    {
        $this->collPerfilEndpoints[]= $perfilEndpoint;
        $perfilEndpoint->setEndpoint($this);
    }

    /**
     * @param	PerfilEndpoint $perfilEndpoint The perfilEndpoint object to remove.
     * @return Endpoint The current object (for fluent API support)
     */
    public function removePerfilEndpoint($perfilEndpoint)
    {
        if ($this->getPerfilEndpoints()->contains($perfilEndpoint)) {
            $this->collPerfilEndpoints->remove($this->collPerfilEndpoints->search($perfilEndpoint));
            if (null === $this->perfilEndpointsScheduledForDeletion) {
                $this->perfilEndpointsScheduledForDeletion = clone $this->collPerfilEndpoints;
                $this->perfilEndpointsScheduledForDeletion->clear();
            }
            $this->perfilEndpointsScheduledForDeletion[]= clone $perfilEndpoint;
            $perfilEndpoint->setEndpoint(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Endpoint is new, it will return
     * an empty collection; or if this Endpoint has previously
     * been saved, it will retrieve related PerfilEndpoints from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Endpoint.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PerfilEndpoint[] List of PerfilEndpoint objects
     */
    public function getPerfilEndpointsJoinPerfil($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PerfilEndpointQuery::create(null, $criteria);
        $query->joinWith('Perfil', $join_behavior);

        return $this->getPerfilEndpoints($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->method = null;
        $this->uri = null;
        $this->descricao = null;
        $this->ativo = null;
        $this->restrito = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collPerfilEndpoints) {
                foreach ($this->collPerfilEndpoints as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collPerfilEndpoints instanceof PropelCollection) {
            $this->collPerfilEndpoints->clearIterator();
        }
        $this->collPerfilEndpoints = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EndpointPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
