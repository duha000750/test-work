<?php


namespace app\controllers;


use app\models\Event;
use app\models\EventType;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\helpers\HtmlPurifier;
use Yii;

class PostbackController extends Controller
{

    public function actionCreate() {

        $body = Yii::$app->request->bodyParams;
        $event = new Event();
        $event->cid = HtmlPurifier::process($body['cid']);
        $event->type_id = HtmlPurifier::process(EventType::getEventTypeId($body['event']));
        $event->campaign_id = HtmlPurifier::process($body['campaign_id']);
        $event->event_time = HtmlPurifier::process($body['time']);
        $event->sub1 = HtmlPurifier::process($body['sub1']);

        if ($event->validate() && $event->save()) {
            Yii::$app->response->statusCode = 201;
            return ['error'=> false];
        }

        Yii::$app->response->statusCode = 400;
        return array_merge(
            ['error' => true],
            $event->getErrors()
        );
    }

    public function actionAdd() {

    }


}