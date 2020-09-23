<?php

return [
    //mainComtroller
    
    '' => [
        'controller' => 'main', //главная страница со всеми задачами
        'action' => 'index',
    ],
    'main/index/{page:\d+}' => [
		'controller' => 'main',
		'action' => 'index',
	],
     'add' => [ // добавление задачи
        'controller' => 'main',
        'action' => 'add',
    ],
     //adminController
     
    'admin/edit/{id:\d+}' => [ // изменение задачи
        'controller' => 'admin',
        'action' => 'edit',
    ],
   
    'admin/login' => [ 
        'controller' => 'admin',
        'action' => 'login',
    ],
    
     'admin/logout' => [ 
        'controller' => 'admin',
        'action' => 'logout',
    ],
    
     'admin/tasks/{page:\d+}' => [ 
        'controller' => 'admin',
        'action' => 'tasks',
    ],
     'admin/tasks' => [ 
        'controller' => 'admin',
        'action' => 'tasks',
    ],
    
];
