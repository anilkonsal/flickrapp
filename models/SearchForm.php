<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SearchForm is the model behind the search form.
 */
class SearchForm extends Model
{
    public $keyword;
    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['keyword', 'required'],
        ];
    }

    
}
