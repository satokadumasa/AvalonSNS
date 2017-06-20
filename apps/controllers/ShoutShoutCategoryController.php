<?php
class ShoutShoutCategoryController extends BaseController{
  public function __construct($uri, $url = null) {
    $conf = Config::get('database.config');
    $database = $conf['default_database'];
    parent::__construct($database, $uri, $url);
    $this->controller_class_name = str_replace('Controller', '', get_class($this));;
    //$this->role_ids = Config::get('acc/shout_shout_categories');
  }

  public function index() {
    $shout_shout_categories = new ShoutShoutCategoryModel($this->dbh);
    $limit = 10 * (isset($this->request['page']) ? $this->request['page'] : 1);
    $offset = 10 * (isset($this->request['page']) ? $this->request['page'] - 1 : 0);

    $datas = $shout_shout_categories->where('ShoutShoutCategory.id', '>', 0)->limit($limit)->offset($offset)->find('all');

    $ref = isset($this->request['page']) ? $this->request['page'] : 0;
    $next = isset($this->request['page']) ? $this->request['page'] + 1 : 2;

    $this->set('Title', 'ShoutShoutCategory List');
    $this->set('datas', $datas);
    $this->set('ShoutShoutCategory', $datas);
    $this->set('ref', $ref);
    $this->set('next', $next);
  }

  public function show() {
    $datas = null;
    $id = $this->request['id'];

    $shout_shout_categories = new ShoutShoutCategoryModel($this->dbh);
    $datas = $shout_shout_categories->where('ShoutShoutCategory.id', '=', $id)->find('first');
    $this->set('Title', 'ShoutShoutCategory Ditail');
    $this->set('ShoutShoutCategory', $datas['ShoutShoutCategory']);
    $this->set('datas', $datas);
  }

  public function create() {
    $shout_shout_categories = new ShoutShoutCategoryModel($this->dbh);
    $form = $shout_shout_categories->createForm();
    $this->set('Title', 'ShoutShoutCategory Create');
    $this->set('ShoutShoutCategory', $form['ShoutShoutCategory']);
  }

  public function save(){
    try {
      $this->dbh->beginTransaction();
      $shout_shout_categories = new ShoutShoutCategoryModel($this->dbh);
      $shout_shout_categories->save($this->request);
      $this->dbh->commit();
      $url = BASE_URL . 'ShoutShoutCategory' . '/show/' . $shout_shout_categories->primary_key_value . '/';
      $this->redirect($url);
    } catch (Exception $e) {
      $this->debug->log("ShoutShoutCategoryController::create() error:" . $e->getMessage());
      $this->set('Title', 'ShoutShoutCategory Save Error');
      $this->set('error_message', '保存ができませんでした。');
    }
  }

  public function edit() {
    try {
      $datas = null;
      $id = $this->request['id'];

      $shout_shout_categories = new ShoutShoutCategoryModel($this->dbh);
      $datas = $shout_shout_categories->where('ShoutShoutCategory.id', '=', $id)->find('first');
      $this->set('Title', 'ShoutShoutCategory Edit');
      $this->set('ShoutShoutCategory', $datas['ShoutShoutCategory']);
      $this->set('datas', $datas);
    } catch (Exception $e) {
      $this->debug->log("ShoutShoutCategoryController::edit() error:" . $e->getMessage());
    }
  }

  public function delete() {
    try {
      $this->dbh->beginTransaction();
      $shout_shout_categories = new ShoutShoutCategoryModel($this->dbh);
      $shout_shout_categories->delete($this->request['id']);
      $this->dbh->commit();
      $url = BASE_URL . 'ShoutShoutCategory' . '/index/';
    } catch (Exception $e) {
      $this->debug->log("UsersController::delete() error:" . $e->getMessage());
    }
  }
}