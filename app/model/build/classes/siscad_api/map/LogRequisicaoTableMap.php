<?php

namespace Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'log_requisicao' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.siscad_api.map
 */
class LogRequisicaoTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'siscad_api.map.LogRequisicaoTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('log_requisicao');
        $this->setPhpName('LogRequisicao');
        $this->setClassname('Model\\LogRequisicao');
        $this->setPackage('siscad_api');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('usuario_id', 'UsuarioId', 'INTEGER', 'usuario', 'id', true, null, null);
        $this->addColumn('requisicao', 'Requisicao', 'VARCHAR', true, 255, null);
        $this->addColumn('nonce', 'Nonce', 'VARCHAR', true, 20, null);
        $this->addColumn('data', 'Data', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('ip', 'Ip', 'VARCHAR', false, 20, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Usuario', 'Model\\Usuario', RelationMap::MANY_TO_ONE, array('usuario_id' => 'id', ), null, null);
        $this->addRelation('LogAtividade', 'Model\\LogAtividade', RelationMap::ONE_TO_MANY, array('id' => 'log_requisicao_id', ), null, null, 'LogAtividades');
    } // buildRelations()

} // LogRequisicaoTableMap
