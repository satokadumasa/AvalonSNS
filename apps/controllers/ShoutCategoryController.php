<?php
class ShoutCategoryController extends BaseController{
  public function __construct($uri, $url = null) {
    $conf = Config::get('database.config');
    $database = $conf['default_database'];
    parent::__construct($database, $uri, $url);
    $this->controller_class_name = str_replace('Controller', '', get_class($this));;
    //$this->role_ids = Config::get('acc/shout_categories');
  }

  public function index() {
    $shout_categories = new ShoutCategoryModel($this->dbh);
    $limit = 10 * (isset($this->request['page']) ? $this->request['page'] : 1);
    $offset = 10 * (isset($this->request['page']) ? $this->request['page'] - 1 : 0);

    $datas = $shout_categories->where('ShoutCategory.id', '>', 0)->limit($limit)->offset($offset)->find('all');

    $ref = isset($this->request['page']) ? $this->request['page'] : 0;
    $next = isset($this->request['page']) ? $this->request['page'] + 1 : 2;

    $this->set('Title', 'ShoutCategory List');
    $this->set('datas', $datas);
    $this->set('ShoutCategory', $datas);
    $this->set('ref', $ref);
    $this->set('next', $next);
  }

  public function show() {
    $datas = null;
    $id = $this->request['id'];

    $shout_categories = new ShoutCategoryModel($this->dbh);
    $datas = $shout_categories->where('ShoutCategory.id', '=', $id)->find('first');
    $this->set('Title', 'ShoutCategory Ditail');
    $this->set('ShoutCategory', $datas['ShoutCategory']);
    $this->set('datas', $datas);
  }

  public function create() {
    $shout_categories = new ShoutCategoryModel($this->dbh);
    $form = $shout_categories->createForm();
    $this->set('Title', 'ShoutCategory Create');
    $this->set('ShoutCategory', $form['ShoutCategory']);
  }

  public function save(){
    try {
      $this->dbh->beginTransaction();
      $shout_categories = new ShoutCategoryModel($this->dbh);
      $shout_categories->save($this->request);
      $this->dbh->commit();
      $url = BASE_URL . 'ShoutCategory' . '/show/' . $shout_categories->primary_key_value . '/';
      $this->redirect($url);
    } catch (Exception $e) {
      $this->debug->log("ShoutCategoryController::create() error:" . $e->getMessage());
      $this->set('Title', 'ShoutCategory Save Error');
      $this->set('error_message', '保存ができませんでした。');
    }
  }

  public function edit() {
    try {
      $datas = null;
      $id = $this->request['id'];

      $shout_categories = new ShoutCategoryModel($this->dbh);
      $datas = $shout_categories->where('ShoutCategory.id', '=', $id)->find('first');
      $this->set('Title', 'ShoutCategory Edit');
      $this->set('ShoutCategory', $datas['ShoutCategory']);
      $this->set('datas', $datas);
    } catch (Exception $e) {
      $this->debug->log("ShoutCategoryController::edit() error:" . $e->getMessage());
    }
  }

  public function delete() {
    try {
      $this->dbh->beginTransaction();
      $shout_categories = new ShoutCategoryModel($this->dbh);
      $shout_categories->delete($this->request['id']);
      $this->dbh->commit();
      $url = BASE_URL . 'ShoutCategory' . '/index/';
    } catch (Exception $e) {
      $this->debug->log("UsersController::delete() error:" . $e->getMessage());
    }
  }


}