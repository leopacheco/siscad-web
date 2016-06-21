<?php

namespace Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'perfil_endpoint' table.
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
class PerfilEndpointTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'siscad_api.map.PerfilEndpointTableMap';

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
        $this->setName('perfil_endpoint');
        $this->setPhpName('PerfilEndpoint');
        $this->setClassname('Model\\PerfilEndpoint');
        $this->setPackage('siscad_api');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('perfil_id', 'PerfilId', 'INTEGER' , 'perfil', 'id', true, null, null);
        $this->addForeignPrimaryKey('endpoint_id', 'EndpointId', 'INTEGER' , 'endpoint', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Endpoint', 'Model\\Endpoint', RelationMap::MANY_TO_ONE, array('endpoint_id' => 'id', ), null, null);
        $this->addRelation('Perfil', 'Model\\Perfil', RelationMap::MANY_TO_ONE, array('perfil_id' => 'id', ), null, null);
    } // buildRelations()

} // PerfilEndpointTableMap
