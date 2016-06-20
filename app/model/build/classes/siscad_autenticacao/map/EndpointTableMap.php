<?php

namespace Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'endpoint' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.siscad_autenticacao.map
 */
class EndpointTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'siscad_autenticacao.map.EndpointTableMap';

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
        $this->setName('endpoint');
        $this->setPhpName('Endpoint');
        $this->setClassname('Model\\Endpoint');
        $this->setPackage('siscad_autenticacao');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('method', 'Method', 'VARCHAR', true, 10, null);
        $this->addColumn('uri', 'Uri', 'VARCHAR', true, 255, null);
        $this->addColumn('descricao', 'Descricao', 'VARCHAR', false, 255, null);
        $this->addColumn('ativo', 'Ativo', 'BOOLEAN', true, 1, null);
        $this->addColumn('restrito', 'Restrito', 'BOOLEAN', true, 1, null);
        // validators
        $this->addValidator('method', 'maxLength', 'propel.validator.MaxLengthValidator', '10', 'Method: Tamanho máximo 10');
        $this->addValidator('uri', 'maxLength', 'propel.validator.MaxLengthValidator', '255', 'Uri: Tamanho máximo 255');
        $this->addValidator('descricao', 'maxLength', 'propel.validator.MaxLengthValidator', '255', 'Descrição: Tamanho máximo 255');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PerfilEndpoint', 'Model\\PerfilEndpoint', RelationMap::ONE_TO_MANY, array('id' => 'endpoint_id', ), null, null, 'PerfilEndpoints');
    } // buildRelations()

} // EndpointTableMap
