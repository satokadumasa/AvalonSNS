<?php
class FriendModel extends BaseModel {
  public $table_name  = 'users';
  public $model_name  = 'Friend';
  public $model_class_name  = 'FriendModel';

  //  Relation
  public $belongthTo = null;
  public $has = null;
  public $has_many_and_belongs_to = null;
  // public $has_many_and_belongs_to = array(
  //   'User' => array(
  //     'through' => 'UserFriend',
  //     'foreign_key' => 'friend_id',
  //   ),
  // );

  public $columns = [
    'id' => ['type' => 'int', 'length' => 8, 'null' => false, 'key' => 'PRI', 'default' => null, ], 
    'username' => array('type' => 'string', 'length' => 64, 'null' => false, 'key' => '', 'default' => null, ), 
    'password' => array('type' => 'string', 'length' => 64, 'null' => false, 'key' => '', 'default' => null, ), 
    'role_id' => array('type' => 'int', 'length' => 64, 'null' => false, 'key' => '', 'default' => null, ), 
    'email' => array('type' => 'string', 'length' => 128, 'null' => false, 'key' => '', 'default' => null, ), 
    'notified_at' => array('type' => 'datetime', 'length' => 64, 'null' => false, 'key' => '', 'default' => null, ), 
    'authentication_key' => array('type' => 'string', 'length' => 128, 'null' => true, 'key' => '', 'default' => null, ), 
    'created_at' => array('type' => 'datetime', 'length' => 19, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
    'modified_at' => array('type' => 'datetime', 'length' => 19, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
  ];

  public function __construct(&$dbh) {
    parent::__construct($dbh);
  }
}
