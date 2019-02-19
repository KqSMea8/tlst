<?php

namespace app\index\model;

use think\Db;
use think\Model;

class Goods extends Model
{
    protected $table = "store_goods_list";

    /**增加销量
     * @param $gid
     * @param $num
     * @return bool
     * @throws \think\Exception
     */
    public function up_sale($gid, $num)
    {
        $bl = $this->where(["id" => $gid])->setInc("goods_sale", $num);
        return $bl;
    }

    /**
     * 增加库存
     * @param $gid
     * @param $num
     * @return bool
     * @throws \think\Exception
     */
    public function up_stock($gid, $num)
    {
        $bl = $this->where(["id" => $gid])->setInc("goods_stock", $num);
        return $bl;
    }

    /**
     * 减库存
     * @param $gid
     * @param $num
     * @return bool
     * @throws \think\Exception
     */
    public function dn_stock($gid, $num)
    {
        $bl = $this->where(["id" => $gid])->setDec("goods_stock", $num);
        return $bl;
    }

    /**
     * 减销量
     * @param $gid
     * @param $num
     * @return bool
     * @throws \think\Exception
     */
    public function dn_sale($gid, $num)
    {
        $bl = $this->where(["id" => $gid])->setDec("goods_sale", $num);
        return $bl;
    }

}