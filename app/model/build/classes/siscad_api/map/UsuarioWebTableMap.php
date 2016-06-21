<?php

namespace Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'usuario_web' table.
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
class UsuarioWebTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'siscad_api.map.UsuarioWebTableMap';

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
        $this->setName('usuario_web');
        $this->setPhpName('UsuarioWeb');
        $this->setClassname('Model\\UsuarioWeb');
        $this->setPackage('siscad_api');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('nome', 'Nome', 'VARCHAR', true, 30, null);
        $this->addColumn('senha', 'Senha', 'VARCHAR', true, 30, null);
        // validators
        $this->addValidator('nome', 'maxLength', 'propel.validator.MaxLengthValidator', '30', 'Nome: Tamanho máximo 30');
        $this->addValidator('nome', 'required', 'propel.validator.RequiredValidator', '', 'Nome de usuário é obrigatório');
        $this->addValidator('senha', 'maxLength', 'propel.validator.MaxLengthValidator', '30', 'Senha: Tamanho máximo 30');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // UsuarioWebTableMap
