<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 15.05.2016
 * Time: 16:27
 */
class RequestCommentsController extends Controller
{
    /** @var $Employee Employee */
    public $Employee;

    public function init()
    {
        $userId = Yii::app()->user->id;

        $this->Employee = Employee::model()->findByPk($userId);
    }

    public function actionAddComment()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $requestId = Yii::app()->request->getPost('requestId');
            $text = Yii::app()->request->getPost('text');

            $RequestLib = new RequestLib($this->Employee);
            try {
                $RequestComments = $RequestLib->addComment($requestId, $text);
            } catch(\Exception $e) {
                $this->outJson(['result' => false, 'comment' => $e->getMessage()]);
            }

            $htmlEmployee = $this->renderPartial('comment', array(
                'CurrentRequestComment' => $RequestComments
            ), true);

            $this->outJson(['result' => true, 'html' => $htmlEmployee]);
        }
    }
}
