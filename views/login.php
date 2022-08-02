<div class="row">
    <div class="col-md-8 offset-md-2">
        <?php
        $form = \app\base\form\Form::begin('/login', 'post');
        echo $form->field($model, 'email');
        echo $form->field($model, 'password', 'password');
        echo $form->button('submit');
        $form::end();
        ?>
    </div>
</div>