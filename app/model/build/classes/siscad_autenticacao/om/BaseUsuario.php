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
use Model\LogRequisicao;
use Model\LogRequisicaoQuery;
use Model\Perfil;
use Model\PerfilQuery;
use Model\Usuario;
use Model\UsuarioPeer;
use Model\UsuarioQuery;

/**
 * Base class that represents a row from the 'usuario' table.
 *
 *
 *
 * @package    propel.generator.siscad_autenticacao.om
 */
abstract class BaseUsuario extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Model\\UsuarioPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        UsuarioPeer
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
     * The value for the nome field.
     * @var        string
     */
    protected $nome;

    /**
     * The value for the descricao field.
     * @var        string
     */
    protected $descricao;

    /**
     * The value for the secret field.
     * @var        string
     */
    protected $secret;

    /**
     * The value for the ativo field.
     * @var        boolean
     */
    protected $ativo;

    /**
     * The value for the perfil_id field.
     * @var        int
     */
    protected $perfil_id;

    /**
     * @var        Perfil
     */
    protected $aPerfil;

    /**
     * @var        PropelObjectCollection|LogRequisicao[] Collection to store aggregation of LogRequisicao objects.
     */
    protected $collLogRequisicaos;
    protected $collLogRequisicaosPartial;

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
    protected $logRequisicaosScheduledForDeletion = null;

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
     * Get the [nome] column value.
     *
     * @return string
     */
    public function getNome()
    {

        return $this->nome;
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
     * Get the [secret] column value.
     *
     * @return string
     */
    public function getSecret()
    {

        return $this->secret;
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
     * Get the [perfil_id] column value.
     *
     * @return int
     */
    public function getPerfilId()
    {

        return $this->perfil_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = UsuarioPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [nome] column.
     *
     * @param  string $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setNome($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nome !== $v) {
            $this->nome = $v;
            $this->modifiedColumns[] = UsuarioPeer::NOME;
        }


        return $this;
    } // setNome()

    /**
     * Set the value of [descricao] column.
     *
     * @param  string $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setDescricao($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descricao !== $v) {
            $this->descricao = $v;
            $this->modifiedColumns[] = UsuarioPeer::DESCRICAO;
        }


        return $this;
    } // setDescricao()

    /**
     * Set the value of [secret] column.
     *
     * @param  string $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setSecret($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->secret !== $v) {
            $this->secret = $v;
            $this->modifiedColumns[] = UsuarioPeer::SECRET;
        }


        return $this;
    } // setSecret()

    /**
     * Sets the value of the [ativo] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Usuario The current object (for fluent API support)
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
            $this->modifiedColumns[] = UsuarioPeer::ATIVO;
        }


        return $this;
    } // setAtivo()

    /**
     * Set the value of [perfil_id] column.
     *
     * @param  int $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setPerfilId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->perfil_id !== $v) {
            $this->perfil_id = $v;
            $this->modifiedColumns[] = UsuarioPeer::PERFIL_ID;
        }

        if ($this->aPerfil !== null && $this->aPerfil->getId() !== $v) {
            $this->aPerfil = null;
        }


        return $this;
    } // setPerfilId()

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
            $this->nome = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->descricao = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->secret = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->ativo = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
            $this->perfil_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 6; // 6 = UsuarioPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Usuario object", $e);
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

        if ($this->aPerfil !== null && $this->perfil_id !== $this->aPerfil->getId()) {
            $this->aPerfil = null;
        }
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
            $con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = UsuarioPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPerfil = null;
            $this->collLogRequisicaos = null;

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
            $con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = UsuarioQuery::create()
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
            $con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                UsuarioPeer::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aPerfil !== null) {
                if ($this->aPerfil->isModified() || $this->aPerfil->isNew()) {
                    $affectedRows += $this->aPerfil->save($con);
                }
                $this->setPerfil($this->aPerfil);
            }

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

            if ($this->logRequisicaosScheduledForDeletion !== null) {
                if (!$this->logRequisicaosScheduledForDeletion->isEmpty()) {
                    LogRequisicaoQuery::create()
                        ->filterByPrimaryKeys($this->logRequisicaosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->logRequisicaosScheduledForDeletion = null;
                }
            }

            if ($this->collLogRequisicaos !== null) {
                foreach ($this->collLogRequisicaos as $referrerFK) {
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

        $this->modifiedColumns[] = UsuarioPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsuarioPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsuarioPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(UsuarioPeer::NOME)) {
            $modifiedColumns[':p' . $index++]  = '`nome`';
        }
        if ($this->isColumnModified(UsuarioPeer::DESCRICAO)) {
            $modifiedColumns[':p' . $index++]  = '`descricao`';
        }
        if ($this->isColumnModified(UsuarioPeer::SECRET)) {
            $modifiedColumns[':p' . $index++]  = '`secret`';
        }
        if ($this->isColumnModified(UsuarioPeer::ATIVO)) {
            $modifiedColumns[':p' . $index++]  = '`ativo`';
        }
        if ($this->isColumnModified(UsuarioPeer::PERFIL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`perfil_id`';
        }

        $sql = sprintf(
            'INSERT INTO `usuario` (%s) VALUES (%s)',
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
                    case '`nome`':
                        $stmt->bindValue($identifier, $this->nome, PDO::PARAM_STR);
                        break;
                    case '`descricao`':
                        $stmt->bindValue($identifier, $this->descricao, PDO::PARAM_STR);
                        break;
                    case '`secret`':
                        $stmt->bindValue($identifier, $this->secret, PDO::PARAM_STR);
                        break;
                    case '`ativo`':
                        $stmt->bindValue($identifier, (int) $this->ativo, PDO::PARAM_INT);
                        break;
                    case '`perfil_id`':
                        $stmt->bindValue($identifier, $this->perfil_id, PDO::PARAM_INT);
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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aPerfil !== null) {
                if (!$this->aPerfil->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aPerfil->getValidationFailures());
                }
            }


            if (($retval = UsuarioPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLogRequisicaos !== null) {
                    foreach ($this->collLogRequisicaos as $referrerFK) {
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
        $pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getNome();
                break;
            case 2:
                return $this->getDescricao();
                break;
            case 3:
                return $this->getSecret();
                break;
            case 4:
                return $this->getAtivo();
                break;
            case 5:
                return $this->getPerfilId();
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
        if (isset($alreadyDumpedObjects['Usuario'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Usuario'][$this->getPrimaryKey()] = true;
        $keys = UsuarioPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getNome(),
            $keys[2] => $this->getDescricao(),
            $keys[3] => $this->getSecret(),
            $keys[4] => $this->getAtivo(),
            $keys[5] => $this->getPerfilId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aPerfil) {
                $result['Perfil'] = $this->aPerfil->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLogRequisicaos) {
                $result['LogRequisicaos'] = $this->collLogRequisicaos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setNome($value);
                break;
            case 2:
                $this->setDescricao($value);
                break;
            case 3:
                $this->setSecret($value);
                break;
            case 4:
                $this->setAtivo($value);
                break;
            case 5:
                $this->setPerfilId($value);
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
        $keys = UsuarioPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setNome($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDescricao($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setSecret($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAtivo($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setPerfilId($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

        if ($this->isColumnModified(UsuarioPeer::ID)) $criteria->add(UsuarioPeer::ID, $this->id);
        if ($this->isColumnModified(UsuarioPeer::NOME)) $criteria->add(UsuarioPeer::NOME, $this->nome);
        if ($this->isColumnModified(UsuarioPeer::DESCRICAO)) $criteria->add(UsuarioPeer::DESCRICAO, $this->descricao);
        if ($this->isColumnModified(UsuarioPeer::SECRET)) $criteria->add(UsuarioPeer::SECRET, $this->secret);
        if ($this->isColumnModified(UsuarioPeer::ATIVO)) $criteria->add(UsuarioPeer::ATIVO, $this->ativo);
        if ($this->isColumnModified(UsuarioPeer::PERFIL_ID)) $criteria->add(UsuarioPeer::PERFIL_ID, $this->perfil_id);

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
        $criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
        $criteria->add(UsuarioPeer::ID, $this->id);

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
     * @param object $copyObj An object of Usuario (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNome($this->getNome());
        $copyObj->setDescricao($this->getDescricao());
        $copyObj->setSecret($this->getSecret());
        $copyObj->setAtivo($this->getAtivo());
        $copyObj->setPerfilId($this->getPerfilId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getLogRequisicaos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogRequisicao($relObj->copy($deepCopy));
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
     * @return Usuario Clone of current object.
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
     * @return UsuarioPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new UsuarioPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Perfil object.
     *
     * @param                  Perfil $v
     * @return Usuario The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPerfil(Perfil $v = null)
    {
        if ($v === null) {
            $this->setPerfilId(NULL);
        } else {
            $this->setPerfilId($v->getId());
        }

        $this->aPerfil = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Perfil object, it will not be re-added.
        if ($v !== null) {
            $v->addUsuario($this);
        }


        return $this;
    }


    /**
     * Get the associated Perfil object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Perfil The associated Perfil object.
     * @throws PropelException
     */
    public function getPerfil(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aPerfil === null && ($this->perfil_id !== null) && $doQuery) {
            $this->aPerfil = PerfilQuery::create()->findPk($this->perfil_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPerfil->addUsuarios($this);
             */
        }

        return $this->aPerfil;
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
        if ('LogRequisicao' == $relationName) {
            $this->initLogRequisicaos();
        }
    }

    /**
     * Clears out the collLogRequisicaos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Usuario The current object (for fluent API support)
     * @see        addLogRequisicaos()
     */
    public function clearLogRequisicaos()
    {
        $this->collLogRequisicaos = null; // important to set this to null since that means it is uninitialized
        $this->collLogRequisicaosPartial = null;

        return $this;
    }

    /**
     * reset is the collLogRequisicaos collection loaded partially
     *
     * @return void
     */
    public function resetPartialLogRequisicaos($v = true)
    {
        $this->collLogRequisicaosPartial = $v;
    }

    /**
     * Initializes the collLogRequisicaos collection.
     *
     * By default this just sets the collLogRequisicaos collection to an empty array (like clearcollLogRequisicaos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLogRequisicaos($overrideExisting = true)
    {
        if (null !== $this->collLogRequisicaos && !$overrideExisting) {
            return;
        }
        $this->collLogRequisicaos = new PropelObjectCollection();
        $this->collLogRequisicaos->setModel('LogRequisicao');
    }

    /**
     * Gets an array of LogRequisicao objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Usuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LogRequisicao[] List of LogRequisicao objects
     * @throws PropelException
     */
    public function getLogRequisicaos($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLogRequisicaosPartial && !$this->isNew();
        if (null === $this->collLogRequisicaos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLogRequisicaos) {
                // return empty collection
                $this->initLogRequisicaos();
            } else {
                $collLogRequisicaos = LogRequisicaoQuery::create(null, $criteria)
                    ->filterByUsuario($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLogRequisicaosPartial && count($collLogRequisicaos)) {
                      $this->initLogRequisicaos(false);

                      foreach ($collLogRequisicaos as $obj) {
                        if (false == $this->collLogRequisicaos->contains($obj)) {
                          $this->collLogRequisicaos->append($obj);
                        }
                      }

                      $this->collLogRequisicaosPartial = true;
                    }

                    $collLogRequisicaos->getInternalIterator()->rewind();

                    return $collLogRequisicaos;
                }

                if ($partial && $this->collLogRequisicaos) {
                    foreach ($this->collLogRequisicaos as $obj) {
                        if ($obj->isNew()) {
                            $collLogRequisicaos[] = $obj;
                        }
                    }
                }

                $this->collLogRequisicaos = $collLogRequisicaos;
                $this->collLogRequisicaosPartial = false;
            }
        }

        return $this->collLogRequisicaos;
    }

    /**
     * Sets a collection of LogRequisicao objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $logRequisicaos A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Usuario The current object (for fluent API support)
     */
    public function setLogRequisicaos(PropelCollection $logRequisicaos, PropelPDO $con = null)
    {
        $logRequisicaosToDelete = $this->getLogRequisicaos(new Criteria(), $con)->diff($logRequisicaos);


        $this->logRequisicaosScheduledForDeletion = $logRequisicaosToDelete;

        foreach ($logRequisicaosToDelete as $logRequisicaoRemoved) {
            $logRequisicaoRemoved->setUsuario(null);
        }

        $this->collLogRequisicaos = null;
        foreach ($logRequisicaos as $logRequisicao) {
            $this->addLogRequisicao($logRequisicao);
        }

        $this->collLogRequisicaos = $logRequisicaos;
        $this->collLogRequisicaosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LogRequisicao objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LogRequisicao objects.
     * @throws PropelException
     */
    public function countLogRequisicaos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLogRequisicaosPartial && !$this->isNew();
        if (null === $this->collLogRequisicaos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLogRequisicaos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLogRequisicaos());
            }
            $query = LogRequisicaoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collLogRequisicaos);
    }

    /**
     * Method called to associate a LogRequisicao object to this object
     * through the LogRequisicao foreign key attribute.
     *
     * @param    LogRequisicao $l LogRequisicao
     * @return Usuario The current object (for fluent API support)
     */
    public function addLogRequisicao(LogRequisicao $l)
    {
        if ($this->collLogRequisicaos === null) {
            $this->initLogRequisicaos();
            $this->collLogRequisicaosPartial = true;
        }

        if (!in_array($l, $this->collLogRequisicaos->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLogRequisicao($l);

            if ($this->logRequisicaosScheduledForDeletion and $this->logRequisicaosScheduledForDeletion->contains($l)) {
                $this->logRequisicaosScheduledForDeletion->remove($this->logRequisicaosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LogRequisicao $logRequisicao The logRequisicao object to add.
     */
    protected function doAddLogRequisicao($logRequisicao)
    {
        $this->collLogRequisicaos[]= $logRequisicao;
        $logRequisicao->setUsuario($this);
    }

    /**
     * @param	LogRequisicao $logRequisicao The logRequisicao object to remove.
     * @return Usuario The current object (for fluent API support)
     */
    public function removeLogRequisicao($logRequisicao)
    {
        if ($this->getLogRequisicaos()->contains($logRequisicao)) {
            $this->collLogRequisicaos->remove($this->collLogRequisicaos->search($logRequisicao));
            if (null === $this->logRequisicaosScheduledForDeletion) {
                $this->logRequisicaosScheduledForDeletion = clone $this->collLogRequisicaos;
                $this->logRequisicaosScheduledForDeletion->clear();
            }
            $this->logRequisicaosScheduledForDeletion[]= clone $logRequisicao;
            $logRequisicao->setUsuario(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->nome = null;
        $this->descricao = null;
        $this->secret = null;
        $this->ativo = null;
        $this->perfil_id = null;
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
            if ($this->collLogRequisicaos) {
                foreach ($this->collLogRequisicaos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aPerfil instanceof Persistent) {
              $this->aPerfil->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLogRequisicaos instanceof PropelCollection) {
            $this->collLogRequisicaos->clearIterator();
        }
        $this->collLogRequisicaos = null;
        $this->aPerfil = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsuarioPeer::DEFAULT_STRING_FORMAT);
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
