<?php
class ShoutController extends BaseController{
  public function __construct($uri, $url = null) {
    $conf = Config::get('database.config');
    $database = $conf['default_database'];
    parent::__construct($database, $uri, $url);
    $this->controller_class_name = str_replace('Controller', '', get_class($this));;
    //$this->role_ids = Config::get('acc/shouts');
  }

  public function index() {
    $shouts = new ShoutModel($this->dbh);
    $limit = 10 * (isset($this->request['page']) ? $this->request['page'] : 1);
    $offset = 10 * (isset($this->request['page']) ? $this->request['page'] - 1 : 0);

    $datas = $shouts->where('Shout.id', '>', 0)->limit($limit)->offset($offset)->find('all');

    $ref = isset($this->request['page']) ? $this->request['page'] : 0;
    $next = isset($this->request['page']) ? $this->request['page'] + 1 : 2;

    $this->set('Title', 'Shout List');
    $this->set('datas', $datas);
    $this->set('Shout', $datas);
    $this->set('ref', $ref);
    $this->set('next', $next);
  }

  public function show() {
    $datas = null;
    $id = $this->request['id'];

    $shouts = new ShoutModel($this->dbh);
    $datas = $shouts->where('Shout.id', '=', $id)->find('first');
    $this->set('Title', 'Shout Ditail');
    $this->set('Shout', $datas['Shout']);
    $this->set('datas', $datas);
  }

  public function create() {
    $shouts = new ShoutModel($this->dbh);
    $form = $shouts->createForm();
    $this->set('Title', 'Shout Create');
    $this->set('Shout', $form['Shout']);
  }

  public function save(){
    try {
      $this->dbh->beginTransaction();
      $shouts = new ShoutModel($this->dbh);
      $shouts->save($this->request);
      $this->dbh->commit();
      $url = BASE_URL . 'Shout' . '/show/' . $shouts->primary_key_value . '/';
      $this->redirect($url);
    } catch (Exception $e) {
      $this->debug->log("ShoutController::create() error:" . $e->getMessage());
      $this->set('Title', 'Shout Save Error');
      $this->set('error_message', '保存ができませんでした。');
    }
  }

  public function edit() {
    try {
      $datas = null;
      $id = $this->request['id'];

      $shouts = new ShoutModel($this->dbh);
      $datas = $shouts->where('Shout.id', '=', $id)->find('first');
      $this->set('Title', 'Shout Edit');
      $this->set('Shout', $datas['Shout']);
      $this->set('datas', $datas);
    } catch (Exception $e) {
      $this->debug->log("ShoutController::edit() error:" . $e->getMessage());
    }
  }

  public function delete() {
    try {
      $this->dbh->beginTransaction();
      $shouts = new ShoutModel($this->dbh);
      $shouts->delete($this->request['id']);
      $this->dbh->commit();
      $url = BASE_URL . 'Shout' . '/index/';
    } catch (Exception $e) {
      $this->debug->log("UsersController::delete() error:" . $e->getMessage());
    }
  }

  public function getShoutsWithJson()
  {
    // $this->debug->log("ShoutController::getShoutsWithJson() request:".print_r($this->request, true));
    try{
      $shouts = new ShoutModel($this->dbh);
      $form = $shouts->createForm();
      foreach ($this->request as $key => $value) {
        if($key == 'Shout') {
          foreach ($value as $k => $v) {
            $form['Shout'][$k] = $v;
          }
        }
        $form['Shout'][$key] = $value;
      }
      if (isset($form['Shout']['outline']) && $form['Shout']['outline'] !== ''){
        $this->dbh->beginTransaction();
        $shouts = new ShoutModel($this->dbh);
        // $shouts->save($form);
        $shouts->save($this->request);
        $this->dbh->commit();
      }
      $shouts = ShoutService::getShoutTimeLine($this->dbh, $form);
      echo json_encode($shouts);
      exit();
    } catch (Exception $e) {
      $this->debug->log("UsersController::getShoutsWithJson() error:" . $e->getMessage());
    }
  }
}