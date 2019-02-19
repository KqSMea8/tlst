<?php

namespace app\index\controller;

use think\Controller;

/**
 * 购物车
 * Class Cart
 * @package app\index\controller
 */
class Cart extends Controller
{
    /**
     * @return mixed
     */
    public function add_cart()
    {
        $user = session("member");
        $cart = db("store_goods_cart")
            ->alias("gc")
            ->field("gc.*,sg.goods_title,sg.goods_logo,sg.freight")
            ->join("store_goods sg", "sg.id=gc.gid")
            ->where("gc.mid", $user['id'])
            ->fetchSql(false)
            ->select();
        foreach ($cart as $k => $v) {
            $cart[$k]["total"] = ($v['selling_price'] + $v['freight']) * $v['num'];
        }

        $co = db("store_goods_cart")->where("mid", $user['id'])->count();
        return $this->fetch("", ["cart" => $cart, "co" => $co]);
    }

    /**
     * 添加购物车操作
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function goods_do()
    {
        $p = input("param.");
        $user = session("member");
        $goods = model("Goods");
        $goods_list = model("GoodsList");
        $bool = db("store_goods_cart")->where(["gid" => $p['goods_id'], "spec" => $p['spec'], "mid" => $user['id']])->find();
        $spec = db("store_goods_list")->find($p['spec']);
        if (empty($user)) {
            echo json_encode(["code" => 3, "msg" => "请您先登陆"]);
            die;
        }
        $data = [
            "gid" => $p['goods_id'],//产品id
            "mid" => $user['id'],//会员
            "market_price" => $spec['market_price'],//市价
            "selling_price" => $spec['selling_price'],//优惠价
            "goods_spec" => $spec['goods_spec'],
            "spec" => $p['spec'],
        ];
        if ($bool) {//购物车存在
            $data['num'] = $p['num'] + $bool['num'];
            if ($data['num'] > $spec['goods_stock']) {
                echo json_encode(["code" => 4, "msg" => "库存不足喽"]);
                die;
            }
            db("store_goods_cart")->where("id", $bool['id'])->setInc("num", $p['num']);
            $info = [
                "code" => 1,
                "msg" => "添加购物车成功",
                "url" => "/add_cart",
            ];
            $goods_list->up_sale($p['spec'], $p['num']);//产品规格销量增加
            $goods_list->dn_stock($p['spec'], $p['num']);//产品规格库存减少

            echo json_encode($info);
            die;
        } else {
            $data['num'] = $p['num'];
            if ($data['num'] > $spec['goods_stock']) {
                echo json_encode(["code" => 4, "msg" => "库存不足喽"]);
                die;
            }
            $bb = db("store_goods_cart")->insertGetId($data);
            if ($bb) {
                $info = [
                    "code" => 1,
                    "msg" => "添加购物车成功",
                    "url" => "/add_cart",
                ];
                $goods_list->up_sale($p['spec'], $p['num']);//产品规格销量增加
                $goods_list->dn_stock($p['spec'], $p['num']);//产品规格库存减少
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

    /**
     * 更新购买数量
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function up_num()
    {
        if (request()->isPost()) {
            $p = input("param.");
            $goods = model("Goods");
            $goods_list = model("GoodsList");
            unset($p['/up_num']);
            $n = db("store_goods_cart")->find($p['id']);
            if ($n > $p['num']) {
                $ss = 1;
            } else {
                $ss = 2;
            }
            $b = db("store_goods_cart")->fetchSql(false)->update($p);
            if ($b) {
                $in = [
                    "code" => 1,
                    "msg" => "更新数量成功",
                ];
                $gid = db("store_goods_cart")->field("id,spec,gid")->where(["id" => $p['id']])->find();
                switch ($ss) {
                    case 1://加数目
                        $b = $p['num'] - $n;
                        $goods_list->up_sale($gid['spec'], $b);//产品规格销量增加
                        $goods_list->dn_stock($gid['spec'], $b);//产品规格库存减少
                        break;
                    case 2://减数目
                        $b = $n - $p['num'];
                        $goods_list->up_sale($gid['spec'], $b);//产品规格销量增加
                        $goods_list->up_stock($gid['spec'], $b);//产品规格库存减少
                        break;
                    default:
                }

            } else {
                $in = [
                    "code" => 2,
                    "msg" => "系统故障",
                ];
            }
            echo json_encode($in);
            die;
        }
    }

    /**
     * 删除购物车
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function cart_del()
    {
        if (request()->isPost()) {
            $p = input("param.");
            $goods = model("Goods");
            $goods_list = model("GoodsList");
            $cart = db("store_goods_cart")->where(["id" => $p['id']])->find();
            $bb = db("store_goods_cart")->delete($p['id']);
            if ($bb) {
                $info = [
                    "code" => 1,
                    "msg" => "购物车删除成功",
                ];
                $goods_list->dn_sale($cart['spec'], $cart['num']);
                $goods_list->up_stock($cart['spec'], $cart['num']);
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
}