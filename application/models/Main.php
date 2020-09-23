<?php

namespace application\models;

use application\core\Model;

class Main extends Model {

	public $error;
    

	public function addValidate($post, $type) {
        
	    if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error = 'E-mail указан неверно';
			return false;
		} 
		return true;
	}
    
    public function taskAdd($post) {
        
    	if(!isset($post['status'])){
            $params = [
            'id' => 0,
            'email' => $post['email'],
            'name' => $post['name'],
            'description' => $post['description'],
            'status' => 0,
            'is_admin'=> 0
            ];
        } else{
            $params = [
    		'id' => 0,
            'email' => $post['email'],
            'name' => $post['name'],
            'description' => $post['description'],
            'status' => $post['status'],
            'is_admin'=> 0
		];
        }
        
		$this->db->query('INSERT INTO tasks VALUES (:id, :email, :name, :description, :status, :is_admin)', $params);
	    return $this->db->lastInsertId();
	}


	public function taskCount($data = []) {
		$params = [];

		$sql = 'SELECT COUNT(id) FROM tasks';

		if(isset($data['filter_status']) && $data['filter_status'] !== false){
			$sql .= ' WHERE status = :filter_status';

			$params['filter_status'] = $data['filter_status'];
		}

		return $this->db->column($sql, $params);
	}

	public function taskList($route, $data = []) {
		$params = [];

		$sql = 'SELECT * FROM tasks';

		if(isset($data['filter_status']) && $data['filter_status'] !== false){
			$sql .= ' WHERE status = :filter_status';

			$params['filter_status'] = $data['filter_status'];
		}

		if (isset($data['sort']) && in_array($data['sort'], [
			'email',
			'name'
		])) {
			$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$params['start'] = $data['start'];
			$params['limit'] = $data['limit'];

			$sql .= " LIMIT :start, :limit";
		}

        return $this->db->row($sql, $params);

	}
	public function taskData($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->row('SELECT * FROM tasks WHERE id = :id', $params);
	}

}

