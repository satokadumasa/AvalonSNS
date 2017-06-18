<?php
class Migrate20170619014248CreateTableUserFriend extends BaseMigrate{
  private $dbh = null;
  public function __construct($default_database) {
    parent::__construct($default_database);
  }

  public function up() {
    $sql = <<<EOM
CREATE TABLE user_friends (
  id int(9) NOT NULL AUTO_INCREMENT,
  user_id int(8) NOT NULL,
  friend_id int(8) NOT NULL,
  created_at datetime NOT NULL,
  modified_at datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY index_user_friends_id (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
EOM;
    parent::up($sql);
  }

  public function down(){
    $sql = <<<EOM
DROP TABLE user_friends;
EOM;
    parent::down($sql);
  } 
}