<?php
class DefaultController extends BaseController {
  public function __construct($uri, $url = null) {
    $conf = Config::get('database.config');
    $database = $conf['default_database'];
    parent::__construct($database, $uri, $url);
    $this->controller_class_name = str_replace('Controller', '', get_class($this));;
    $this->default = Config::get('acc/default');
  }

  public function index() {
    $shout = new ShoutModel($this->dbh);
    $form = $shout->createForm();

    $session = Session::get();
    $auth = $session['Auth'];
    $this->debug->log("DefaultController::index() session".print_r($session, true));
    $form['Shout']['user_id'] = $auth['User']['id'];
    $this->debug->log("DefaultController::index() form".print_r($form, true));

    $shout2 = new ShoutModel($this->dbh);
    $shouts = $shout2->offset(0)->limit(10)->find('all');
    $this->debug->log("DefaultController::index() shouts".print_r($shouts, true));

    $this->set('action_name', 'Home');
    $this->set('Title', 'Home');
    $this->set('Shouts', $shouts);
  }

  public function error() {
    $this->set('action_name', 'Error');
    $this->set('Title', 'Home');
    $this->set('datas', null);
  }
}