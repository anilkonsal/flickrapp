<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "user_search".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $term
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserSearch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_search';
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['term'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'term' => 'Term',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public static function saveSearch($userId, $term) {
        
        UserSearch::deleteAll(['term' => $term, 'user_id' => $userId]);
        
        $us = new UserSearch;
        $us->user_id = $userId;
        $us->term = $term;
        $us->save();
        return $us;
    }
    
    public static function getRecentSearches($user_id, $count = 5) {
        $recentSearches = UserSearch::find()
                ->where(['user_id' => $user_id])
                ->orderBy('id desc')
                ->limit($count)->asArray()->all();
        $recentSearchesArr = \yii\helpers\ArrayHelper::map($recentSearches, 'id', 'term');
        return $recentSearchesArr;
    }
}
