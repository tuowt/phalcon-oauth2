<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018-12-07
 * Time: 15:24
 */

namespace App\Module\Admin\Controller;

use App\Module\Admin\Model\DesktopAdmin;
use App\Module\Admin\Service\AdminService;
use App\Module\Admin\Validation\LoginValidation;
use Phalcon\Mvc\View;

class PassportController extends ControllerBase
{
    public function initialize() {
        parent::initialize();
        $this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
    }

    public function loginAction() {
        if ($this->request->isPost()) {
            if ($this->security->checkToken()) {
                $validation = new LoginValidation();
                $messages = $validation->validate($this->request->getPost());
                if (count($messages)) {
                    return $this->response->sendFail('登录失败，请检查账号密码是否正确');
                }
                $adminService = new AdminService($this->request->getPost());
                if (!$adminService->login()) {
                    return $this->response->sendFail('登录失败，请检查账号密码是否正确');
                }

                $data = [
                    'url' => $this->url->get('admin/index/index'),
                ];
                return $this->response->sendSuccess($data, '登录成功');
            }
            return $this->response->sendFail('登录失败，请检查账号密码是否正确');
        }

    }

    public function logoutAction() {
        $this->session->destroy();
        return $this->response->redirect('passport/login');
    }
}