<?php

namespace app\index\controller;

use think\Controller;
use think\facade\Validate;

/**
 * 地址
 * Class Address
 * @package app\index\controller
 */
class Address extends Controller
{
    protected $tb = "StoreMemberAddress";

    /**
     * 地址列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function address_list()
    {
        $member = session("member");
        $address = db($this->tb)->where("mid", $member['id'])->select();
        return $this->fetch("", ["address" => $address]);
    }

    /**
     * 添加地址
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function edit_address()
    {
        $p = input("param.");
        if (isset($p['aid'])) {
            $aid = $p['aid'];
            $address = db("store_member_address")->find($aid);

        } else {
            $aid = 0;
            $address = [];
        }


        return $this->fetch("", ["address" => $address, "aid" => $aid]);
    }

    /**
     * 添加，编辑地址处理
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function add_address()
    {
        if (request()->isPost()) {
            $p = input("param.");
            $member = session("member");
            if (empty($member)) {
                return json(["code" => 4, "msg" => "请您先登陆"]);
            }
            $validate = Validate::make([
                'username' => 'require',
                'phone' => 'require',
                "province" => "require",
                "city" => "require",
                "area" => "require",
                "address" => "require",
                "zip_code" => "require"
            ], [
                'username.require' => '收货人不能为空！',
                'phone.require' => '手机号不能为空！',
                'province.require' => '省份不能为空',
                'city.require' => '市不能为空',
                'area.require' => '区不能为空',
                'address.require' => '详细地址不能为空',
                "zip_code.require" => "邮编不能为空"
            ]);
            $data = [
                'username' => $p['username'],
                "phone" => $p['phone'],
                "province" => $p['province'],
                "city" => $p['city'],
                "area" => $p['area'],
                "address" => $p['address'],
                "zip_code" => $p['zip_code']


            ];
            $in = "";
            $inf = "";
            $validate->check($data) || $in = ["code" => 3, "msg" => $validate->getError()];
            if ($in) {
                return json($in);
            }
            if ($p['ajax'] == "add") {//添加地址
                $data['mid'] = $member['id'];
                $bb = db("store_member_address")->insertGetId($data);
                if ($bb) {
                    $inf = [
                        "code" => 1,
                        "msg" => "添加地址成功",
                    ];
                } else {
                    $inf = [
                        "code" => 2,
                        "msg" => "系统故障",
                    ];
                }
                return json($inf);
            } else if ($p["ajax"] == "edit") {
                $data['id'] = $p['aid'];
                $bb = db("store_member_address")->update($data);
                if ($bb) {
                    $inf = [
                        "code" => 1,
                        "msg" => "修改地址成功",
                    ];
                } else {
                    $inf = [
                        "code" => 2,
                        "msg" => "系统故障",
                    ];
                }
                return json($inf);
            }


        }
    }

}