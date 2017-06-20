<?php
class DefaultController extends BaseController {
  public function __construct($uri, $url = null) {
    $conf = Config::get('database.config');
    $database = $conf['default_database'];
    parent::__construct($database, $uri, $url);
    $this->controller_class_name = str_replace('Controller', '', get_class($this));
    $this->default = Config::get('acc/default');
  }

  public function index() {
    $shout = new ShoutModel($dbh);
    $form = $shout->createForm();
    $form['Shout']['user_id'] = $this->auth['User']['id'];
    $this->set('Shout', $form['Shout']);
    $shouts = ShoutService::getShoutTimeLine($this->dbh);
    if ($shouts && count($shouts)) {
      $timeline_from = $shouts[0]['Shout']['modified_at'];
      $timeline_from = str_replace(' ', '', $timeline_from);
      $timeline_from = str_replace('-', '', $timeline_from);
      $timeline_from = str_replace(':', '', $timeline_from);
    }
    else {
      $timeline_from = '19700101000000';
    }

    $this->set('action_name', 'Home');
    $this->set('timeline_from', $timeline_from);
    $this->set('Title', 'Home');
    $this->set('Shouts', $shouts);
  }

  public function error() {
    $this->set('action_name', 'Error');
    $this->set('Title', 'Home');
    $this->set('datas', null);
  }
}