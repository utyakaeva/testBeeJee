<?php

namespace application\models;

use application\core\Model;

class Admin extends Model {

	public $error;
    

	public function loginValidate($post) {
	    $config = require 'application/config/admin.php';
    	if ($config['login'] != $post['login'] || $config['password'] != $post['password']) {
			$this->error = 'Логин или пароль указан неверно';
			return false;
		}
		return true;
	
	}
   

	public function taskEdit($post, $id) {
		 $tasks = $this->db->row('SELECT * FROM tasks WHERE id = :id', ['id' => $id]);

		 $is_admin = 0;

		 if($tasks){
		 	foreach($tasks as $task){
		 		if($task['description'] != $post['description']){
		 			$is_admin = 1;
		 		}

		 		if($task['is_admin']){
		 			$is_admin = 1;
		 		}

		 		break;
		 	}
		 }

        if(!isset($post['status'])){
            $params = [
        	'id' => $id,
            'description' => $post['description'],
            'status' => 0,
            'is_admin' => $is_admin
            ];
        } else{
            $params = [
    		'id' => $id,
            'description' => $post['description'],
            'status' => $post['status'],
            'is_admin' => $is_admin
		];
        }
             $this->db->query('UPDATE tasks SET description = :description, status = :status, is_admin = :is_admin WHERE id = :id',$params);
    
	}


	public function isTaskExists($id) {
		$params = [
			'id' => $id,
		];
	return $this->db->column('SELECT id FROM tasks WHERE id = :id', $params);
        
	}


	public function taskData($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->row('SELECT * FROM tasks WHERE id = :id', $params);
	}
    
     

}
