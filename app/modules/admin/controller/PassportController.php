<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018-12-07
 * Time: 15:24
 */

namespace App\Module\Admin\Controller;

use Phalcon\Mvc\View;

class PassportController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->view->disableLevel(
            View::LEVEL_MAIN_LAYOUT
        );
    }

    public function loginAction()
    {
        if($this->request->isPost()) {
            if($this->security->checkToken()) {


                if ($model->login()) {
                    $data = [
                        'code' => 1,
                        'msg'  => '登录成功',
                        'data' => ['url' => \Yii::$app->urlManager->createUrl(['mch/store/index'])]
                    ];
                } else {
                    $data = [
                        'code' => -1,
                        'msg'  => '登录失败，请检查账号密码是否正确'
                    ];
                }
                return $this->response->setContent($data);
            }
        }

    }

    public function logoutAction()
    {

        $this->response->redirect('passport/login');
    }
}