<?php
namespace application\controllers;
use application\core\Controller;
use application\models\Main;
use application\core\View;
use application\lib\Pagination;

class AdminController extends Controller {
    
    public function __construct($route) {
    	parent::__construct($route);
		$this->view->layout = 'default';
	}
    
    public function loginAction() {
    	if (isset($_SESSION['admin'])) {
			$this->view->redirect('admin/tasks');
		}
		if (!empty($_POST)) {
			if (!$this->model->loginValidate($_POST)) {
				$this->view->message('error', $this->model->error);
			}
			$_SESSION['admin'] = true;
			$this->view->location('admin/tasks');
		}
		$this->view->render('Вход');
	}
     public function logoutAction(){
       unset($_SESSION['admin']);
    	$this->view->redirect('admin/login');
    }
    
    public function editAction() {
        $vars = [
			'data' => $this->model->taskData($this->route['id'])[0],
		];
    	if (!$this->model->isTaskExists($this->route['id'])) {
           
			$this->view->errorCode(404);
		}
#        if ($_POST['description'] == 1){
#            $this->view->adminDescription();
#        }
		
		if (!empty($_POST)) {
			$this->model->taskEdit($_POST, $this->route['id'], $vars);
			$this->view->message('success', 'Сохранено');
		}

		$this->view->render('Редактировать задачу', $vars);
	}
    public function tasksAction() {
    	if(isset($this->route['page'])){
			$page = (int)$this->route['page'];
		}else{
			$page = 1;
		}

		if(isset($_GET['limit'])){
			$limit = (int)$_GET['limit'];
		}else{
			$limit = 3;
		}

		if(isset($_GET['sort'])){
			$sort = $_GET['sort'];
		}else{
			$sort = false;
		}

		if(isset($_GET['order'])){
			$order = $_GET['order'];
		}else{
			$order = false;
		}

		if(isset($_GET['filter_status'])){
			$filter_status = (int)$_GET['filter_status'];
		}else{
			$filter_status = false;
		}

		$filter_data = [
			'filter_status' => $filter_status,
			'start'               => ($page - 1) * $limit,
			'limit'               => $limit,
			'sort'                => $sort,
			'order'               => $order,
		];

    	$mainModel = new Main;
		$pagination = new Pagination($this->route, $mainModel->taskCount($filter_data), $limit, array_filter(['sort' => $sort, 'order' => $order, 'order' => $order, 'filter_status' => $filter_status], 'strlen'));
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $mainModel->taskList($this->route, $filter_data),
			'sort' => $sort,
			'order' => $order,
			'filter_status' => $filter_status,
		];
		$this->view->render('Список всех задач', $vars);
	}
    
}
	