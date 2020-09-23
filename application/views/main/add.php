<div class="card-header"><?php echo $title; ?></div>
<div class="container">
    <div class="col">
        <form action="add/" method="post">
            <div class="form-group">
                <label for="exampleFormControlInput1">Email address:</label>
                <input type="text" class="form-control" name='email' placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Имя пользователя:</label>
                <input type="text" class="form-control" name ="name" >
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Текст задачи:</label>
                <textarea class="form-control" name = "description" ></textarea>
            </div>
            <div class="form-check" style="margin-left:20px;">
                   <input type="checkbox" name="status" value ='1' <?php if (!isset($_SESSION['admin'])) {
    		echo "disabled";} ?>>
                    <label class="form-check-label" for="exampleCheck1">Задача выполнена</label>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
        <div class="row" style ="display: flex;align-items: center; justify-content: center;"><p><a href="/">Перейти на главную</a></p></div>
    </div>
</div>