<div class="container">
    <h1 style="text-align: center">Список задач в управлении администратора</h1>
</div>
<div class="container">
    <div class="d-flex justify-content-around" style="margin-bottom: 10px">
        <?php if($sort == 'name' && $order == 'DESC') { ?>
    	<a href="/admin/tasks/1?<?php echo http_build_query(array_filter(['sort' => 'name', 'order' => 'ASC', 'filter_status' => $filter_status], 'strlen')); ?>" class="btn btn-primary btn-sort-desc">Имя пользователя</a>
    	<?php } elseif($sort == 'name' && $order == 'ASC') {?>
    	<?php if($filter_status !== false) { ?>	
    	<a href="/admin/tasks/1?<?php echo http_build_query(['filter_status' => $filter_status]); ?>" class="btn btn-primary btn-sort-asc">Имя пользователя</a>
    	<?php } else { ?>
    	<a href="/admin/tasks/1" class="btn btn-primary btn-sort-asc">Имя пользователя</a>
		<?php } ?>
    	<?php } else { ?>
    	<a href="/admin/tasks/1?<?php echo http_build_query(array_filter(['sort' => 'name', 'order' => 'DESC', 'filter_status' => $filter_status], 'strlen')); ?>" class="btn btn-primary">Имя пользователя</a>
    	<?php } ?>

    	<?php if($sort == 'email' && $order == 'DESC') { ?>
    	<a href="/admin/tasks/1?<?php echo http_build_query(array_filter(['sort' => 'email', 'order' => 'ASC', 'filter_status' => $filter_status], 'strlen')); ?>" class="btn btn-primary btn-sort-desc">E-mail</a>
    	<?php } elseif($sort == 'email' && $order == 'ASC') {?>
    	<?php if($filter_status !== false) { ?>	
    	<a href="/admin/tasks/1?<?php echo http_build_query(['filter_status' => $filter_status]); ?>" class="btn btn-primary btn-sort-asc">E-mail</a>
    	<?php } else { ?>
    	<a href="/admin/tasks/1" class="btn btn-primary btn-sort-asc">E-mail</a>
		<?php } ?>
    	<?php } else { ?>
    	<a href="/admin/tasks/1?<?php echo http_build_query(array_filter(['sort' => 'email', 'order' => 'DESC', 'filter_status' => $filter_status], 'strlen')); ?>" class="btn btn-primary">E-mail</a>
    	<?php } ?>

        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Статус</button>
            <div class="dropdown-menu">
            	<?php if($sort || $order) { ?>
                <a href="/admin/tasks/1?<?php echo http_build_query(['sort' => $sort, 'order' => $order, 'filter_status' => 1]); ?>" class="dropdown-item">Выполненные задачи</a>
                <a href="/admin/tasks/1?<?php echo http_build_query(['sort' => $sort, 'order' => $order, 'filter_status' => 0]); ?>" class="dropdown-item">Невыполненные задачи</a>
                <a href="/admin/tasks/1?<?php echo http_build_query(['sort' => $sort, 'order' => $order]); ?>" class="dropdown-item">Все задачи</a>
                <?php } else { ?>
 				<a href="/admin/tasks/1?<?php echo http_build_query(['filter_status' => 1]); ?>" class="dropdown-item">Выполненные задачи</a>
                <a href="/admin/tasks/1?<?php echo http_build_query(['filter_status' => 0]); ?>" class="dropdown-item">Невыполненные задачи</a>	
                <a href="/admin/tasks/1" class="dropdown-item">Все задачи</a>	
                <?php } ?>
            </div>
        </div>       
        <a href = '/add'> <button type="button" class="btn btn-info">Добавить задачу</button></a>
        <a href = '/admin/logout'><button type="button" class="btn btn-success">Выйти</button></a>
    </div>
   <div class="col">
        <div class="card">
         <?php if (empty($list)): ?>
                <p>Список задач пуст</p>
            <?php else: ?>
            <table class="table">
                                <tr>
                                    <th>Номер задачи</th>
                                    <th>Текст задачи</th>
                                    <th>Статус</th>
                                    <th>Отредактировано администратором</th>
                                    <th>Редактировать</th>
                                </tr>
                                <?php foreach ($list as $val): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($val['id'], ENT_QUOTES); ?></td>
                                        <td><?php echo htmlspecialchars($val['description'], ENT_QUOTES); ?></td>
                                         <td><?php if( htmlspecialchars($val['status'], ENT_QUOTES) == 1){
                                         echo "Выполнена";
                                         } else {echo "Не выполнена";}?></td>
                                         <td><?php if( htmlspecialchars($val['is_admin'], ENT_QUOTES) == 1){
                                         echo "Да";
                                         } else {echo "Нет";}?></td>
                                        <td><a href="/admin/edit/<?php echo $val['id']; ?>" class="btn btn-primary">Редактировать</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                <div class="clearfix" style="margin-left:20px; margin-top:10px;">
                    <?php echo $pagination; ?>
                </div>
                   <?php endif; ?>
                   </div>
   </div>
                
</div>
<div class="row" style ="display: flex;align-items: center; justify-content: center;"><p><a href="/">Перейти на главную страницу</a></p></div>


<style type="text/css">
	
	.btn-sort-desc:after {
		content: " ";
		background-image: url("/public/image/desc.svg");
		width: 21px;
		height: 21px;
		display: block;
		float: right;
		background-size: 21px 21px;
	}

	.btn-sort-asc:after {
		content: " ";
		background-image: url("/public/image/asc.svg");
		width: 21px;
		height: 21px;
		display: block;
		float: right;
		background-size: 21px 21px;
	}
</style>