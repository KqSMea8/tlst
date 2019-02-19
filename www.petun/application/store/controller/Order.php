<?php

// +----------------------------------------------------------------------
// | ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/ThinkAdmin
// +----------------------------------------------------------------------

namespace app\store\controller;

use controller\BasicAdmin;
use service\DataService;
use service\ToolsService;
use think\Db;
use service\NodeService;
use think\exception\HttpResponseException;

/**
 * 订单管理
 * Class Goods
 * @package app\store\controller
 * @author Anyon <zoujingli@qq.com>
 * @date 2017/03/27 14:43
 */
class Order extends BasicAdmin
{

    /**
     * 定义当前操作表名
     * @var string
     */
    public $table = 'StoreOrder';

    /**
     * 订单列表
     * @return array|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->title = '订单管理';
        $get = $this->request->get();
        $db = Db::name($this->table)
            ->alias("so")
            ->field("so.*,sm.nickname")
            ->join("store_member sm","sm.id=so.mid")
            ->where(['so.is_deleted' => '0']);
        if (isset($get['order_no']) && $get['order_no'] !== '') {
            $db->whereLike('so.order_no', "%{$get['order_no']}%");
        }
        if (isset($get['nickname']) && $get['nickname'] !== '') {
            $db->whereLike('sm.nickname', "%{$get['nickname']}%");
        }
        if (isset($get['create_at']) && $get['create_at'] !== '') {
            // var_dump($get['create_at']);die;
            list($start, $end) = explode(' - ', $get['create_at']);
            $db->whereBetween('create_at', ["{$start} 00:00:00", "{$end} 23:59:59"]);

        }
        return parent::_list($db->order('so.create_at desc,so.id desc'));
    }


    /**
     * 添加商品
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function add()
    {
        return $this->_form($this->table, 'form');

    }

    /**
     * 编辑订单
     * @return array|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function edit()
    {
        return $this->_form($this->table, 'form');
    }


    /**
     * 删除商品
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if (DataService::update($this->table)) {
            $this->success("订单删除成功！", '');
        }
        $this->error("订单删除失败，请稍候再试！");
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
        $xlsName = "会员订单表";
        $xlsCell = array(
            array('id', "编号"),
            array('nickname', '会员'),
            array('order_no', '订单号'),
            array('pay_no', '支付账号'),
            array('pay_price', "实际支付"),
            array('pay_at', '支付时间'),
            array('desc', '描述'),
            array('status', '订单状态'),
            array('address', '地址'),
            array('province', '省份'),
            array('city', '市'),
            array('area', '区县'),
            array('address', '详细地址'),
            array('express', '快递公司'),
            array('express_id', '快递单号'),
            array('phone', '手机号'),

        );
        $xlsData = db("store_order")
            ->alias("so")
            ->field("so.*,sm.nickname,sa.province,sa.city,sa.area,sa.address,sa.phone")
            ->join("store_member sm", "sm.id=so.mid")
            ->join("store_member_address sa", "sa.id=so.aid")
            ->where("so.is_exp", 1)
            ->select();

        db("store_order")->where("is_exp", 1)->update(["is_exp" => 2]);
        $a = exportExcel($xlsName, $xlsCell, $xlsData);

    }


}
