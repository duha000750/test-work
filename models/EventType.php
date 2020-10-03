<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event_type".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property Event[] $events
 */
class EventType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['type_id' => 'id']);
    }

    public static function getEventTypeId($title) {
        $model = self::findOne(['title'=>$title]);

        if (is_null($model)) return false;

        return $model->id;

    }
}
