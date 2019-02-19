<?php

namespace app\index\model;

use think\Model;

class GoodsList extends Model
{
    protected $table = "store_goods_list";

    public function up_sale($spec, $num)
    {
        $bl = $this->where(["id" => $spec])->setInc("goods_sale", $num);
        return $bl;
    }

    public function up_stock($spec, $num)
    {
        $bl = $this->where(["id" => $spec])->setInc("goods_stock", $num);
        return $bl;
    }

    public function dn_stock($spec, $num)
    {
        $bl = $this->where(["id" => $spec])->setDec("goods_stock", $num);
        return $bl;
    }

    public function dn_sale($spec, $num)
    {
        $bl = $this->where(["id" => $spec])->setDec("goods_sale", $num);
        return $bl;
    }
}