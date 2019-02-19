<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use think\facade\Validate;

/**
 * 登录
 * Class Mlogin
 * @package app\index\controller
 */
class Mlogin extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function log_go()
    {
        if (request()->isPost()) {
            $p = input("param.");
            unset($p['/log_go']);
            $validate = Validate::make([
                'email' => 'require',
                "password" => 'require|min:8'
            ], [
                'email.require' => '邮箱不能为空！',
                'password.require' => '登录密码不能为空！',
                'password.min' => '登录密码长度不能少于8位有效字符！',
            ]);
            $data = [
                'email' => $p['email'],
                "password" => $p['password']

            ];
            $in = "";
            $inf = "";
            $validate->check($data) || $in = ["code" => 2, "msg" => $validate->getError()];
            if ($in) {
                echo json_encode($in);
                die;
            }
            $user = db("store_member")->where("email", $p['email'])->find();
            empty($user) && $inf = ["code" => 3, "msg" => "会员不存在"];
            md5($p['password']) != $user['md5'] && $inf = ["code" => 4, "msg" => "登陆密码不正确"];
            if ($inf) {
                echo json_encode($inf);
                die;
            }
            session("member", $user);

            echo json_encode(["code" => 1, "msg" => "登陆成功"]);
            die;
        }
    }

    /**
     * @return mixed
     */

    public function register()
    {
        return $this->fetch();
    }

    /**
     *
     */
    public function register_do()
    {
        if (request()->isPost()) {
            $p = input("param.");
            unset($p['/register_do']);
            $validate = Validate::make([
                'nickname' => 'require|min:6',
                'email' => 'require',
                "password" => 'require|min:8'
            ], [
                'nickname.require' => '用户名不能为空！',
                'tel.min' => '用户名不能少于6位有效字符！',
                'email.require' => '邮箱不能为空！',
                'password.require' => '登录密码不能为空！',
                'password.min' => '登录密码长度不能少于8位有效字符！',
            ]);
            $data = [
                'nickname' => $p['nickname'],
                'email' => $p['email'],
                "password" => $p['password']
            ];
            $in = "";
            $inf = "";
            $validate->check($data) || $in = ["code" => "4", "msg" => $validate->getError()];
            if ($in) {
                echo json_encode($in);
                die;
            }
            $b = db("store_member")->where("nickname", $p['nickname'])->whereOr("email", $p['email'])->find();
            isset($b['nickname']) && $inf = ["code" => 3, "msg" => "会员已存在"];
            $p['password'] != $p['repass'] && $inf = ["code" => 5, "msg" => "两次密码不一致"];
            if ($inf) {
                echo json_encode($inf);
                die;
            }
            $data['md5'] = md5($p['password']);
            $bb = db("store_member")->insertGetId($data);
            if ($bb) {
                $info = [
                    "code" => 1,
                    "msg" => "会员注册成功",
                ];
            } else {
                $info = [
                    "code" => 2,
                    "msg" => "系统故障",
                ];
            }

            echo json_encode($info);
            die;
        }
    }

    public function log_out()
    {
        if (request()->isPost()) {
            $p = input("param.");
            session("member", null);

            echo json_encode(["code" => 1, "msg" => "退出登录成功", "url" => "/login"]);
            die;
        }
    }

    /** 导出会员卡
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function daochu()
    {
        $xlsName = "旅游线路会员卡";
        $xlsCell = array(
            array('id', "编号"),
            array('openid', '卡号'),
            array('phone', "卡密"),

        );
        $xlsData = Db::name('store_member')->where(["is_exp" => 1])->select();

        db("store_member")->where("is_exp", 1)->update(["is_exp" => 2]);
        $a = exportExcel($xlsName, $xlsCell, $xlsData);

    }

    /**
     *
     */
    public function export()
    {
        $excel = new Office();
        //设置表头：
        $head = ['订单编号', '商品总数', '收货人', '联系电话', '收货地址'];

        $keys = ['order_sn', 'num', 'consignee', 'phone', 'detail'];

        $excel->outdata('订单表', [], $head, $keys);

    }
}