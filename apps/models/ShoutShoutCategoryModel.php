<?php
class ShoutShoutCategoryModel extends BaseModel {
  public $table_name  = 'shout_shout_categories';
  public $model_name  = 'ShoutShoutCategory';
  public $model_class_name  = 'ShoutShoutCategoryModel';

  //  Relation
  public $belongthTo = null;
  public $has = null;
  public $has_many_and_belongs_to = null;

  public $columns = [
    'id' => array('type' => 'int', 'length' => 8, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
    'shout_id' => array('type' => 'int', 'length' => 8, 'null' => false, 'key' => '', 'default' => null, ), 
    'shout_category_id' => array('type' => 'int', 'length' => 8, 'null' => false, 'key' => '', 'default' => null, ), 
    'created_at' => array('type' => 'datetime', 'length' => 19, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
    'modified_at' => array('type' => 'datetime', 'length' => 19, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
  ];

  public function __construct(&$dbh) {
    parent::__construct($dbh);
  }
}
