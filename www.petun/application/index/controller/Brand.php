<?php

namespace app\index\controller;

use think\Controller;

class Brand extends Controller
{
    public function index()
    {
        $p = input("param.");
        $tit = db("store_goods_brand")->field("initials")->where(["is_deleted" => 0])->group("initials");
        if (isset($p['slid'])) {
            $tit->where(["initials" => $p['slid']]);
        }
        $tit = $tit->select();
        foreach ($tit as $k => $v) {
            $lst = db("store_goods_brand")->field("id,brand_title")->where(["initials" => $v['initials']])->select();
            $tit[$k]['list'] = $lst;
        }
        $brand = db("store_goods_brand")->field("id,brand_title,brand_logo")->where(["is_deleted"=>0,"is_intro"=>2])->select();
        return $this->fetch("", ["tit" => $tit, "brand" => $brand]);
    }
}