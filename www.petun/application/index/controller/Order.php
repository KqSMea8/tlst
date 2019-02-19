<?php

namespace app\index\controller;

use app\index\model\OrderList;
use think\Controller;
use think\facade\Validate;
use app\store\service\OrderService;

/**
 * 订单
 * Class Order
 * @package app\index\controller
 */
class Order extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {

        return $this->fetch("");
    }


    /**
     * 添加订单
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function add_order()
    {
        $cart = [];
        $user = session("member");
        if (request()->isPost()) {
            $p = input("param.");
            $cid = $p['cid'];
            $cart = db("store_goods_cart")
                ->alias("gc")
                ->field("gc.*,sg.goods_title,sg.id as gid,sg.goods_title,sg.freight,sg.goods_logo")
                ->join("store_goods sg", "sg.id=gc.gid")
//                ->join("store_goods_list gl", "gl.id=gc.spec")
                ->where("gc.id", "in", $cid)
                ->select();
            $xiao = 0;
            $freight = 0;
            $total = 0;

            foreach ($cart as $k => $v) {
                $xiao += $v['selling_price'] * $v['num'];
                $freight += $v['freight'] * $v['num'];
                $total += ($v['selling_price'] + $v['freight']) * $v['num'];
            }
            $this->assign([
                "xiao" => $xiao,
                "freight" => $freight,
                "total" => $total,
            ]);

        }
        $address = db("StoreMemberAddress")->where(["mid" => $user['id']])->select();

        return $this->fetch("", ["cart" => $cart, "address" => $address]);
    }

    /**
     *
     * @throws \Exception
     */
    public function order_do()
    {
        if (request()->isPost()) {
            if (empty($p['shdd'])) {
                echo "<script>alert('请先添加地址再执行操作');window.location.href='/address_list'</script>";
            }
            $p = input("param.");
            $user = session("member");
            $da = db("store_goods_cart")
                ->alias("gc")
                ->field("gc.*,sg.goods_title,sg.id as gid,sg.freight,sg.goods_logo")
                ->join("store_goods sg", "sg.id=gc.gid")
                ->where("gc.id", "in", $p['cid'])
                ->where("gc.mid", $user['id'])
                ->select();
            $tt = 0;
            foreach ($da as $k => $v) {
                $tt += ($v['selling_price'] + $v['freight']) * $v['num'];
            }
            $order = [
                "type" => 1,
                "mid" => $user['id'],
                "order_no" => time() - 1,
                "is_pay" => 1,
                "pay_type" => $p['pay'],
                "pay_no" => "",
                "pay_price" => $tt,
                "desc" => "",
                "aid" => $p['shdd']
            ];
            $bb = db("store_order")->insertGetId($order);
            if ($bb) {
                /*添加订单附表start*/
                $log = [];
                $ol = model("OrderList");
                foreach ($da as $k1 => $v1) {
                    $log = [
                        "mid" => $user['id'],
                        "gid" => $v1['gid'],
                        "order_id" => $bb,
                        "market_price" => $v1['market_price'],
                        "selling_price" => $v1['selling_price'],
                        "status" => 1,
                        "num" => $v1['num'],
                        "goods_spec" => $v1['goods_spec'],
                    ];
                    db("store_order_list")->insertGetId($log);
                }

                /*添加订单附表end*/
                /*清理购物车start*/

                if (count($p['cid']) > 1) {
                    $bc = db("store_goods_cart")->where("id", "in", $p['cid'])->fetchSql(false)->delete();
                } else {
                    $bc = db("store_goods_cart")->where("id", $p['cid'][0])->fetchSql(false)->delete();
                }

                /*清理购物车end*/
                $url = url('Payment/index') . "?oid=" . $bb;
                header("Location:" . $url);
                exit();
            }
        }

    }

    public function cart()
    {
        return $this->fetch();
    }

    /**
     * 订单列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function order_list()
    {
        $user = session("member");
        $order = db("store_order")->where(["mid" => $user['id']])->select();
        foreach ($order as $k => $v) {
            $ol = db("store_order_list")
                ->alias("ol")
                ->field("ol.*,sg.goods_title,sg.goods_logo")
                ->join("store_goods sg", "sg.id=ol.gid")
                ->where(["ol.order_id" => $v['id']])
                ->select();
            $order[$k]['list'] = $ol;
        }
        return $this->fetch("", ["order" => $order]);
    }

    /**
     * 删除订单
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function order_del()
    {
        if (request()->isPost()) {
            $p = input("param.");
            $bb = db("store_order")->delete($p['id']);
            if ($bb) {
                $info = [
                    "code" => 1,
                    "msg" => "订单删除成功",
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


}