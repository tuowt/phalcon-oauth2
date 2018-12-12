<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018-12-11
 * Time: 16:09
 */

namespace App\Module\Admin\Element;

use Phalcon\Mvc\User\Component;

class HtmlElement extends Component
{

    public function getMenuList() {
        $menuList = [
            [
                'name'  => '系统设置',
                'route' => 'admin/system/wechat-setting',
                'icon'  => 'icon-setup',
                'list'  => [
                    [
                        'name'  => '系统设置',
                        'route' => 'mch/store/wechat-setting',
                        'list'  => [
                            [
                                'name'  => '微信配置',
                                'route' => 'mch/store/wechat-setting',
                            ],
                            [
                                'name'  => '模板消息',
                                'route' => 'mch/store/tpl-msg',
                            ],
                            [
                                'name'  => '短信通知',
                                'route' => 'mch/store/sms',
                            ],
                            [
                                'name'  => '邮件通知',
                                'route' => 'mch/store/mail',
                            ],
                        ],
                    ],
                    [
                        'name'  => '小程序设置',
                        'route' => 'mch/store/slide',
                        'list'  => [
                            [
                                'name'  => '轮播图',
                                'route' => 'mch/store/slide',
                                'sub'   => [
                                    'mch/store/slide-edit',
                                ],
                            ],
                            [
                                'name'  => '导航栏',
                                'route' => 'mch/store/navbar',
                            ],
                            [
                                'name'  => '首页布局',
                                'route' => 'mch/store/home-page',
                            ],
                            [
                                'name'  => '用户中心',
                                'route' => 'mch/store/user-center',
                            ],
                            [
                                'name'  => '下单表单',
                                'route' => 'mch/store/form',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name'  => '用户管理',
                'route' => 'admin/user/index',
                'icon'  => 'icon-people',
                'list'  => [
                    [
                        'name'  => '用户列表',
                        'route' => 'admin/user/index',
                    ],
                ],
            ],
        ];

        return $menuList;
    }

    public function activeMenu($item, $route) {
        if (isset($item['route']) && ($item['route'] == $route || (is_array($item['sub']) && in_array($route, $item['sub']))))
            return 'active';
        if (isset($item['list']) && is_array($item['list'])) {
            foreach ($item['list'] as $sub_item) {
                $active = $this->activeMenu($sub_item, $route);
                if ($active != '')
                    return $active;
            }
        }
        return '';
    }

    public function getCurrentMenu($menuList, $route) {
        foreach ($menuList as $item) {
            if (isset($item['route']) && ($item['route'] == $route || (is_array($item['sub']) && in_array($route, $item['sub'])))) {
                return $item;
            }
            if (isset($item['list']) && is_array($item['list'])) {
                foreach ($item['list'] as $sub_item) {
                    if (isset($sub_item['route']) && ($sub_item['route'] == $route || (is_array($sub_item['sub']) && in_array($route, $sub_item['sub']))))
                        return $item;
                    if (isset($sub_item['list']) && is_array($sub_item['list'])) {
                        foreach ($sub_item['list'] as $sub_sub_item) {
                            if (isset($sub_sub_item['route']) && ($sub_sub_item['route'] == $route || (is_array($sub_sub_item['sub']) && in_array($route, $sub_sub_item['sub']))))
                                return $item;
                        }
                    }
                }
            }
        }
        return null;
    }

    public function getRoute() {
        $route = [
            $this->dispatcher->getModuleName(),
            $this->dispatcher->getControllerName(),
            $this->dispatcher->getActionName(),
        ];
        return implode('/', $route);
    }

    public function getAccountName() {
        return $this->session->get('User');
    }
}
