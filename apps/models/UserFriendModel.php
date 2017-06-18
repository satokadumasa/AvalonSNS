<?php
class UserFriendModel extends BaseModel {
  public $table_name  = 'user_friends';
  public $model_name  = 'UserFriend';
  public $model_class_name  = 'UserFriendModel';

  //  Relation
  public $belongthTo = array(
    'User' => array(
      'JOIN_COND' => 'INNER', 
      'conditions' => array('User.id' => 'UserFriend.user_id'), 
    ), 
    'Friend' => array(
      'JOIN_COND' => 'INNER', 
      'conditions' => array('Friend.id' => 'UserFriend.friend_id'), 
    ), 
  );
  public $has = null;
  public $has_many_and_belongs_to = null;

  public $columns = [
    'id' => array('type' => 'int', 'length' => 8, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
    'user_id' => array('type' => 'int', 'length' => 8, 'null' => false, 'key' => '', 'default' => null, ), 
    'friend_id' => array('type' => 'int', 'length' => 8, 'null' => false, 'key' => '', 'default' => null, ), 
    'created_at' => array('type' => 'datetime', 'length' => 19, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
    'modified_at' => array('type' => 'datetime', 'length' => 19, 'null' => false, 'key' => 'PRI', 'default' => null, ), 
  ];

  public function __construct(&$dbh) {
    parent::__construct($dbh);
  }

  public function getFriendIds($auth) {
    $user_friend_ids = [];
    $user_friends = $this->where('UserFriend.id', '=', $auth['User']['id'])->find('all');
    foreach ($user_friends as $key => $user_friend) {
      $user_friend_ids[] = $user_friend['UserFriend']['friend_id'];
    }
    return $user_friend_ids;
  }
}
