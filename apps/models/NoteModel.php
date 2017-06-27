<?php
class NoteModel extends BaseModel {
  public $table_name  = 'notes';
  public $model_name  = 'Note';
  public $model_class_name  = 'NoteModel';

  //  Relation
  public $belongthTo = null;
  public $has = null;
  public $has_many_and_belongs_to = null;

  public $columns = [
    'id' => array('type' => 'int', 'length' => 8, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
    'user_id' => array('type' => 'int', 'length' => 8, 'null' => false, 'key' => '', 'default' => null, ), 
    'title' => array('type' => 'string', 'length' => 254, 'null' => false, 'key' => '', 'default' => null, ), 
    'detail' => array('type' => 'string', 'length' => 2000, 'null' => false, 'key' => '', 'default' => null, ), 
    'delete_flag' => array('type' => 'tinyint', 'length' => 1, 'null' => false, 'key' => '', 'default' => null, ), 
    'created_at' => array('type' => 'datetime', 'length' => 19, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
    'modified_at' => array('type' => 'datetime', 'length' => 19, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
  ];

  public function __construct(&$dbh) {
    parent::__construct($dbh);
  }
}
