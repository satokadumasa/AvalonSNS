<?php
class Migrate20170617222448CreateTableSubscription extends BaseMigrate{
  private $dbh = null;
  public function __construct($default_database) {
    parent::__construct($default_database);
  }

  public function up() {
    $sql = <<<EOM
CREATE TABLE subscriptions (
  id int(9) NOT NULL AUTO_INCREMENT,
  subscriptionid varchar(128) NOT NULL,
  notified int(8) NOT NULL,
  created_at datetime NOT NULL,
  modified_at datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY index_subscriptions_id (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
EOM;
    parent::up($sql);
  }

  public function down(){
    $sql = <<<EOM
DROP TABLE subscriptions;
EOM;
    parent::down($sql);
  } 
}