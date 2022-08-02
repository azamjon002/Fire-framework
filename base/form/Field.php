<?php

namespace app\base\form;

use app\base\Model;

class Field
{

    public string $type = 'text';
    public Model $model;
    public string $attribute;

    public function __construct($model, $attribute, $type='text')
    {
        if ($type!='text'){
            $this->type = $type;
        }
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString(): string
    {
        $type = $this->type;
        $attribute = $this->attribute;
        $model = $this->model;

        return sprintf(' <div class="mb-3">
                        <label for="%s" class="form-label">%s</label>
                        <input type="%s" class="form-control %s" value="%s" id="%s" name="%s">
                        <div class="invalid-feedback">
                            %s
                        </div>
                    </div>',
        $attribute,
        ucfirst($attribute),
        $type,
        $model->hasErrors($attribute)?'is-invalid':'',
        $model->{$attribute},
        $attribute,
        $attribute,
        $model->getFirstError($attribute));
    }


}