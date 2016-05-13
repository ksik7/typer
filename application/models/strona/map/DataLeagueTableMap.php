<?php



/**
 * This class defines the structure of the 'data_league' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.strona.map
 */
class DataLeagueTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'strona.map.DataLeagueTableMap';

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
        $this->setName('data_league');
        $this->setPhpName('DataLeague');
        $this->setClassname('DataLeague');
        $this->setPackage('strona');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('leuge_id', 'LeugeId', 'INTEGER', 'leagues', 'id', true, null, null);
        $this->addForeignKey('match_id', 'MatchId', 'INTEGER', 'matches', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Leagues', 'Leagues', RelationMap::MANY_TO_ONE, array('leuge_id' => 'id', ), null, null);
        $this->addRelation('Matches', 'Matches', RelationMap::MANY_TO_ONE, array('match_id' => 'id', ), null, null);
    } // buildRelations()

} // DataLeagueTableMap
