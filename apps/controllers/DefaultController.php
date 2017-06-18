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

    $form['Shout']['user_id'] = $auth['User']['id'];
    $this->set('Shout', $form['Shout']);
    
    $shouts = $shout->offset(0)->limit(10)->find('all');

    $user_ids = $shout->getUserIds($shouts);
    $user = new UserModel($this->dbh);
    if (count($user_ids) > 0) {
        $users = $user->where('User.id', 'IN', $user_ids)->find('all');
        $shouts = ShoutService::setUserInfoToShout($shouts, $users);
    }

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