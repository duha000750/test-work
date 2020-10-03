<?php

namespace app\models;

use Yii;

use app\models\EventType;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property int $type_id
 * @property string $cid
 * @property int $campaign_id
 * @property string $event_time
 * @property string $sub1
 *
 * @property EventType $type
 */
class Event extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'cid', 'campaign_id', 'event_time', 'sub1'], 'required'],
            [['type_id', 'campaign_id'], 'integer'],
            [['event_time'], 'string', 'max' => 64],
            [['cid', 'sub1'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'cid' => 'Cid',
            'campaign_id' => 'Campaign ID',
            'event_time' => 'Event Time',
            'sub1' => 'Sub1',
        ];
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(EventType::className(), ['id' => 'type_id']);
    }

}
