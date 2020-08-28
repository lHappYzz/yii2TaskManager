<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Task extends ActiveRecord
{
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class ,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }
    public static function tableName() {
        return '{{task}}';
    }
    public function rules() {
        return [
            [['title', 'status_id', 'start_date', 'end_date'], 'required'],
            [['title', 'description', 'status_id', 'start_date', 'end_date'], 'filter', 'filter' => 'strip_tags'],
            [['title'], 'string', 'max' => 190],
            [['description'], 'default'],
            [['status_id', 'created_at', 'updated_at'], 'integer'],
            [['status_id'], 'exist', 'targetRelation' => 'status'],
        ];
    }

    public function getStatus() {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }
}
