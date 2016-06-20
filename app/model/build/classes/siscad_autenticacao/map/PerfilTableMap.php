<?php

namespace Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'perfil' table.
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
class PerfilTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'siscad_autenticacao.map.PerfilTableMap';

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
        $this->setName('perfil');
        $this->setPhpName('Perfil');
        $this->setClassname('Model\\Perfil');
        $this->setPackage('siscad_autenticacao');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('nome', 'Nome', 'VARCHAR', true, 30, null);
        $this->addColumn('descricao', 'Descricao', 'VARCHAR', false, 255, null);
        // validators
        $this->addValidator('nome', 'maxLength', 'propel.validator.MaxLengthValidator', '30', 'Nome: Tamanho máximo 30');
        $this->addValidator('descricao', 'maxLength', 'propel.validator.MaxLengthValidator', '255', 'Descrição: Tamanho máximo 255');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PerfilEndpoint', 'Model\\PerfilEndpoint', RelationMap::ONE_TO_MANY, array('id' => 'perfil_id', ), null, null, 'PerfilEndpoints');
        $this->addRelation('Usuario', 'Model\\Usuario', RelationMap::ONE_TO_MANY, array('id' => 'perfil_id', ), null, null, 'Usuarios');
    } // buildRelations()

} // PerfilTableMap
