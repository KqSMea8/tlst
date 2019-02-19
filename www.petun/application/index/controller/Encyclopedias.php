<?php

namespace app\index\controller;

use think\Controller;

/**
 * 百科
 * Class Encyclopedias
 * @package app\index\controller
 */
class Encyclopedias extends Controller
{
    /**
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $article = db("store_article")->where(["is_deleted" => 0]);
        $p = input("param.");
        if (isset($p['key'])) {//关键词
            $article->where("keys", "like", "%" . $p['key'] . "%");
        }
        if (isset($p['eid'])) {//二级分类
            $article->where("pid", $p['eid']);
        }
        if (isset($p['zid'])) {//顶级分类
            $cate = db("store_art_cate")->where("pid", $p['zid'])->column("id");
            $article->where("pid", "in", $cate);
        }

        if (isset($p['pid'])) {//所有文章
            $cate = db("store_art_cate")->where("pid", "<>", 0)->column("id");
            $article->where("pid", "in", $cate);
        }
        $hot = db("store_art_cate")->field("id,title")->where("pid", "<>", "0")->select();
        return $this->fetch("", ["article" => $article->paginate(3), "hot" => $hot]);
    }

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function detail()
    {
        $p = input("param.");
        $one = db("store_article")->find($p['eid']);
        return $this->fetch("", ["one" => $one]);
    }
}