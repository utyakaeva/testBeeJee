<div class="card-header"><?php echo $title; ?></div>
<div class="container">
    <div class="col">
        <form action="/admin/edit/<?php echo $data['id']; ?>" method="post">
            <div class="form-group">
                <label for="exampleFormControlInput1">Номер задачи:<?php echo $data['id']; ?></label>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Текст задачи:</label>
                <textarea class="form-control" name = "description" rows="3"><?php echo htmlspecialchars($data['description'], ENT_QUOTES); ?></textarea>
            </div>
            <div class="form-check" style="margin-left:20px;">
                    <input type="checkbox" name="status" value='1' <?php if (htmlspecialchars($data['status'], ENT_QUOTES) == 1) 
                        echo "checked='checked'";
                    ?>>
                    <label class="form-check-label" for="exampleCheck1">Задача выполнена</label>
                    </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
        <div class="row" style ="display: flex;align-items: center; justify-content: center;"><p><a href="/admin/tasks">Перейти на главную администратора</a></p></div>
    </div>
</div>
