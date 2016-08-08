<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 08.04.2016
 * Time: 14:56
 */
class ActController extends Controller
{
    /** @var $Employee Employee */
    public $Employee;

    /** @var array */
    private $requestGeneralParams;

    public $part = 'act';

    public function init()
    {
        $userId = Yii::app()->user->id;

        $this->Employee = Employee::model()->findByPk($userId);

        $EmployeeGroup = EmployeeGroup::model()->findAll(array("order" => "id"));
        $requestCount = RequestCount::init($this->Employee)->count();

        $requestId = Yii::app()->request->getQuery('id', false);
        $Request = Request::model()->findByPk($requestId);
        if ($Request) {
            if ($Request->state == Request::STATE_DONE) {
                $requestCount = RequestCount::init($this->Employee)->countArchive();
                $this->part = 'archive';
            } elseif ($Request->state == Request::STATE_REFUSED) {
                $requestCount = RequestCount::init($this->Employee)->countRefused();
                $this->part = 'refused';
            }
        }

        /** @var EmployeeGroupRequestType $EmployeeGroupRequestType */
        $EmployeeGroupRequestType = $this->Employee->EmployeeGroup->EmployeeGroupRequestType;

        /** @var EmployeeGroupArchiveRequestType $EmployeeGroupArchiveRequestType */
        $EmployeeGroupArchiveRequestType = $this->Employee->EmployeeGroup->EmployeeGroupArchiveRequestType;

        $this->requestGeneralParams = array_merge(
            array("Employee" => $this->Employee),
            array("EmployeeGroup" => $EmployeeGroup),
            array("EmployeeGroupRequestType" => $EmployeeGroupRequestType),
            array("EmployeeGroupArchiveRequestType" => $EmployeeGroupArchiveRequestType),
            $requestCount
        );
    }

    public function actionList()
    {
        $EmployeeGroupLib = new EmployeeGroupLib($this->Employee);
        $group = $EmployeeGroupLib->getFirstRequestType();

        if (isset($_GET['group'])) {
            $group = Yii::app()->request->getQuery('group');
        }
        $translateGroup = Request::getTranslate($group);

        $sort = new CSort();
        $sort->defaultOrder = 'new DESC, next_communication_date';

        $Act = new Act();
        $Act->service = $group;

        $grid = $this->renderPartial('_grid', array(
            'model' => $Act,
        ), true);

        $this->render('act', [
            'list' => $grid,
            'translateGroup' => $translateGroup,
        ] + $this->requestGeneralParams);
    }
}
