<?php
class UserInfoModel extends BaseModel {
  public $table_name  = 'user_infos';
  public $model_name  = 'UserInfo';
  public $model_class_name  = 'UserInfoModel';

  //  Relation
  public $belongthTo = [
    'User' => [
      'JOIN_COND' => 'INNER',
      'conditions' => [
        'User.id' => 'UserInfo.user_id'
      ],
    ]
  ];
  public $has = null;
  public $has_many_and_belongs_to = null;

  public $columns = [
    'id' => array('type' => 'int', 'length' => 8, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
    'user_id' => array('type' => 'int', 'length' => 8, 'null' => false, 'key' => '', 'default' => null, ), 
    'photo' => array('type' => 'string', 'length' => 64, 'null' => false, 'key' => '', 'default' => null, ), 
    'name' => array('type' => 'string', 'length' => 64, 'null' => false, 'key' => '', 'default' => null, ), 
    'zip_code' => array('type' => 'string', 'length' => 7, 'null' => true, 'key' => '', 'default' => null, ), 
    'pref_id' => array('type' => 'int', 'length' => 8, 'null' => true, 'key' => '', 'default' => null, ), 
    'city_id' => array('type' => 'int', 'length' => 8, 'null' => true, 'key' => '', 'default' => null, ), 
    'address' => array('type' => 'string', 'length' => 255, 'null' => true, 'key' => '', 'default' => null, ), 
    'telephone' => array('type' => 'string', 'length' => 32, 'null' => true, 'key' => '', 'default' => null, ), 
    'fax' => array('type' => 'string', 'length' => 32, 'null' => true, 'key' => '', 'default' => null, ), 
    'mobile_phone' => array('type' => 'string', 'length' => 32, 'null' => true, 'key' => '', 'default' => null, ), 
    'sites' => array('type' => 'text', 'length' => 2000, 'null' => true, 'key' => '', 'default' => null, ), 
    'detail' => array('type' => 'string', 'length' => 32, 'null' => true, 'key' => '', 'default' => null, ), 
    'created_at' => array('type' => 'datetime', 'length' => 19, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
    'modified_at' => array('type' => 'datetime', 'length' => 19, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
  ];

  public function __construct(&$dbh) {
    parent::__construct($dbh);
  }
}
