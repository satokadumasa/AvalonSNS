<?php
class ShoutModel extends BaseModel {
  public $table_name  = 'shouts';
  public $model_name  = 'Shout';
  public $model_class_name  = 'ShoutModel';

  //  Relation
  public $belongthTo = [
    'User' => [
      'JOIN_COND' => 'INNER',
      'conditions' => [
        'User.id' => 'Shout.user_id'
      ],
    ]
  ];
  public $has = null;
  public $has_many_and_belongs_to = null;

  public $columns = [
    'id' => array('type' => 'int', 'length' => 8, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
    'user_id' => array('type' => 'int', 'length' => 8, 'null' => false, 'key' => '', 'default' => null, ), 
    'outline' => array('type' => 'string', 'length' => 254, 'null' => false, 'key' => '', 'default' => null, ), 
    'detail' => array('type' => 'text', 'length' => 2000, 'null' => true, 'key' => '', 'default' => null, ), 
    'created_at' => array('type' => 'datetime', 'length' => 19, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
    'modified_at' => array('type' => 'datetime', 'length' => 19, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
  ];

  public function __construct(&$dbh) {
    parent::__construct($dbh);
  }

  public function getUserIds($shouts) {
    $user_ids = [];
    foreach ($shouts as $key => $datum) {
      $user_ids[] = $datum[$this->model_name]['user_id'];
    }
    return $user_ids;
  }
}
