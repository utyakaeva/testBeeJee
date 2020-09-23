<div class="container">
    <h1 style="text-align: center">Список задач</h1>
</div>
<div class="container">
    <div class="d-flex justify-content-around" style="margin-bottom: 10px">
    	<?php if($sort == 'name' && $order == 'DESC') { ?>
    	<a href="/main/index/1?<?php echo http_build_query(array_filter(['sort' => 'name', 'order' => 'ASC', 'filter_status' => $filter_status], 'strlen')); ?>" class="btn btn-primary btn-sort-desc">Имя пользователя</a>
    	<?php } elseif($sort == 'name' && $order == 'ASC') {?>
    	<?php if($filter_status !== false) { ?>	
    	<a href="/main/index/1?<?php echo http_build_query(['filter_status' => $filter_status]); ?>" class="btn btn-primary btn-sort-asc">Имя пользователя</a>
    	<?php } else { ?>
    	<a href="/main/index/1" class="btn btn-primary btn-sort-asc">Имя пользователя</a>
		<?php } ?>
    	<?php } else { ?>
    	<a href="/main/index/1?<?php echo http_build_query(array_filter(['sort' => 'name', 'order' => 'DESC', 'filter_status' => $filter_status], 'strlen')); ?>" class="btn btn-primary">Имя пользователя</a>
    	<?php } ?>

    	<?php if($sort == 'email' && $order == 'DESC') { ?>
    	<a href="/main/index/1?<?php echo http_build_query(array_filter(['sort' => 'email', 'order' => 'ASC', 'filter_status' => $filter_status], 'strlen')); ?>" class="btn btn-primary btn-sort-desc">E-mail</a>
    	<?php } elseif($sort == 'email' && $order == 'ASC') {?>
    	<?php if($filter_status !== false) { ?>	
    	<a href="/main/index/1?<?php echo http_build_query(['filter_status' => $filter_status]); ?>" class="btn btn-primary btn-sort-asc">E-mail</a>
    	<?php } else { ?>
    	<a href="/main/index/1" class="btn btn-primary btn-sort-asc">E-mail</a>
		<?php } ?>
    	<?php } else { ?>
    	<a href="/main/index/1?<?php echo http_build_query(array_filter(['sort' => 'email', 'order' => 'DESC', 'filter_status' => $filter_status], 'strlen')); ?>" class="btn btn-primary">E-mail</a>
    	<?php } ?>

        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Статус</button>
            <div class="dropdown-menu">
            	<?php if($sort || $order) { ?>
                <a href="/main/index/1?<?php echo http_build_query(['sort' => $sort, 'order' => $order, 'filter_status' => 1]); ?>" class="dropdown-item">Выполненные задачи</a>
                <a href="/main/index/1?<?php echo http_build_query(['sort' => $sort, 'order' => $order, 'filter_status' => 0]); ?>" class="dropdown-item">Невыполненные задачи</a>
                <a href="/main/index/1?<?php echo http_build_query(['sort' => $sort, 'order' => $order]); ?>" class="dropdown-item">Все задачи</a>
                <?php } else { ?>
 				<a href="/main/index/1?<?php echo http_build_query(['filter_status' => 1]); ?>" class="dropdown-item">Выполненные задачи</a>
                <a href="/main/index/1?<?php echo http_build_query(['filter_status' => 0]); ?>" class="dropdown-item">Невыполненные задачи</a>	
                <a href="/main/index/1" class="dropdown-item">Все задачи</a>	
                <?php } ?>
            </div>
        </div>

         </form>
         <a href = '/add'> <button type="button" class="btn btn-info">Добавить задачу</button></a>
        <?php if(isset ($_SESSION['admin'])) {?><a href = '/admin/tasks'><button type="button" class="btn btn-success">Администратор</button></a><?php }
        else{?><a href = '/admin/login'><button type="button" class="btn btn-success">Войти</button></a> <?php } ?>
        </div>
     <div class="col">
        <div class="card">
         <?php if (empty($list)): ?>
                <p>Список задач пуст</p>
            <?php else: ?>
            <div class="card-body">
             <?php foreach ($list as $val): ?>
                <h5 class="card-title">Номер задачи: <?php echo $val['id']; ?> <?php if($val['is_admin']) { ?><small class="text-muted">Отредактировано администратором</small><?php } ?></h5>
                <p class="card-">Текст задачи: <?php echo htmlspecialchars($val['description'], ENT_QUOTES); ?>
                </p> 
                <p class="card-text">Пользователь: <?php echo htmlspecialchars($val['name'], ENT_QUOTES); ?></p>
                <p class="card-email">Email: <?php echo htmlspecialchars($val['email'], ENT_QUOTES); ?></p>
                <div class="card-footer">
                   <div class="form-check" style="margin-left:20px;">
                   <input type="checkbox" name="status" value='1' disabled <?php if (htmlspecialchars($val['status'], ENT_QUOTES) == 1) 
                        echo "checked='checked'";
                    ?>>
                    <label class="form-check-label" for="exampleCheck1">Задача выполнена</label>
                    </div>
                </div>
                 <?php endforeach; ?>
                 <div class="clearfix" style="margin-left:20px; margin-top:10px;">
                    <?php echo $pagination; ?>
                </div>
            </div>
             <?php endif; ?>
        </div>
        
    </div>
</div>

<style type="text/css">
	
	.btn-sort-desc:after {
		content: " ";
		background-image: url("/public/image/asc.svg");
		width: 21px;
		height: 21px;
		display: block;
		float: right;
		background-size: 21px 21px;
	}

	.btn-sort-asc:after {
		content: " ";
		background-image: url("/public/image/desc.svg");
		width: 21px;
		height: 21px;
		display: block;
		float: right;
		background-size: 21px 21px;
	}
</style>