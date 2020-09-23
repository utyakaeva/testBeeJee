<?php
namespace application\controllers;
use application\core\Controller;
use application\lib\Pagination;
use application\models\Admin;
use application\core\View;


class MainController extends Controller {
    
    public function indexAction(){
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

        $pagination = new Pagination($this->route, $this->model->taskCount($filter_data), $limit, array_filter(['sort' => $sort, 'order' => $order, 'order' => $order, 'filter_status' => $filter_status], 'strlen'));
        
    	$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->taskList($this->route, $filter_data),
			'sort' => $sort,
			'order' => $order,
			'filter_status' => $filter_status,
#            'message' => $this->view->adminDescription(),
		];
		$this->view->render('Главная страница', $vars);
        
    }
    
    public function addAction() {
        
    	if (!empty($_POST)) {
			if (!$this->model->addValidate($_POST, 'add')) {
				$this->view->message('error', $this->model->error);
			}
			$id = $this->model->taskAdd($_POST);
    		if (!$id) {
				$this->view->message('success', 'Ошибка обработки запроса');
			}

			$this->view->message('success', 'Задача добавлена');

		}
		$this->view->render('Добавить задачу');
	}
    
}

