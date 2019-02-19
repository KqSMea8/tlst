<?php

namespace app\index\controller;

use think\Controller;
use think\Db;

/**
 * 产品
 * Class Goods
 * @package app\index\controller
 */
class Goods extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {

        return $this->fetch();
    }

    /** 产品详情显示
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function detail()
    {
        $p = input("param.");
        $uid = session("member.id");
        $co = db("store_favorite")->where(["gid" => $p['gid'], "uid" => $uid])->count();
        $one = db("store_goods")->find($p['gid']);
        $comment = db("store_comment")->where(["gid" => $p['gid'], "mid" => $uid])->fetchSql(false)->select();
        foreach ($comment as $k => $v) {
            $bool = db("store_comment_zan")->where(["uid" => $uid, "cid" => $v['id']])->find();
            $cou = db("store_comment_zan")->where(["cid" => $v['id']])->count();
            if (empty($bool)) {
                $comment[$k]['zan'] = 1;
            } else {
                $comment[$k]['zan'] = 2;

            }
            $comment[$k]['cou'] = $cou;
        }
        $spec = db("store_goods_list")->where(["goods_id" => $one['id'], "status" => 1])->where("goods_stock", ">", 0)->select();
        $s1 = db("store_comment")->where(["gid" => $p['gid'], "star" => 1])->count();//一星评论
        $s2 = db("store_comment")->where(["gid" => $p['gid'], "star" => 2])->count();//二星评论
        $s3 = db("store_comment")->where(["gid" => $p['gid'], "star" => 3])->count();//三星评论
        $s4 = db("store_comment")->where(["gid" => $p['gid'], "star" => 4])->count();//四星评论
        $s5 = db("store_comment")->where(["gid" => $p['gid'], "star" => 5])->count();//五星评论
        $s = db("store_comment")->where(["gid" => $p['gid']])->count();//所有评论
        if ($s > 0) {
            $count = $s;
        } else {
            $count = 0;
        }
        if ($s1 && $s > 0) {
            $p1 = ($s1 / $s) * 100;//一星评论占比
            $this->assign("p1", $p1);
        }
        if ($s2 && $s > 0) {
            $p2 = ($s2 / $s) * 100;//二星评论占比
            $this->assign("p2", $p2);
        }
        if ($s3 && $s > 0) {
            $p3 = ($s3 / $s) * 100;//三星评论占比
            $this->assign("p3", $p3);
        }
        if ($s4 && $s > 0) {
            $p4 = ($s4 / $s) * 100;//四星评论占比
            $this->assign("p4", $p4);
        }
        if ($s5 && $s > 0) {
            $p5 = ($s5 / $s) * 100;//五星评论占比
            $this->assign("p5", $p5);
        }
        $c3 = db("store_goods_cate")->field("id,cate_title,pid")->where(["id" => $one['cate_id']])->find();//产品所属分类
        $c2 = db("store_goods_cate")->field("id,cate_title,pid")->where(["id" => $c3['pid']])->find();//二级分类
        $c1 = db("store_goods_cate")->field("id,cate_title,pid")->where(["id" => $c2['pid']])->find();//一级分类
        $favorite = db("store_goods")->field("id,goods_title,goods_logo,star,package_sale")->where(["cate_id" => $c3['id']])->select();
        foreach ($favorite as $k1 => $v1) {
            $sp = db("store_goods_list")->where(["goods_id" => $v1['id']])->order("selling_price", "asc")->find();
            $favorite[$k1]['selling'] = $sp['selling_price'];
        }
        return $this->fetch("", [
            "one" => $one,
            "spec" => $spec,
            "co" => $co,
            "comment" => $comment,
            "count" => $count,
            "c1" => $c1,
            "c2" => $c2,
            "c3" => $c3,
            "favorite" => $favorite
        ]);
    }

    /** 产品列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function goods_list()
    {

        $p = input("param.");
        $goods = db("store_goods")->field("id,goods_title,goods_logo,package_sale,abbreviation")->where(["is_deleted" => 0]);
        if (isset($p['query'])) {//关键字查询
            $goods->where("goods_title", "like", "%" . $p["query"] . "%");
        }
        if (isset($p['sid'])) {//三级分类获取产品
            $c1 = db("store_goods_cate")->field("id,cate_title,pid")->find($p['sid']);
            $c2 = db("store_goods_cate")->field("id,cate_title,pid")->find($c1['pid']);
            $c3 = db("store_goods_cate")->field("id,cate_title,pid")->find($c2['pid']);
            $this->assign(["c1" => $c1, "c2" => $c2, "c3" => $c3]);
            $goods->where("cate_id", $p["sid"]);
        }
        if (isset($p['iid'])) {//推荐管理
            $goods->where("is_intro", 2);
        }
        if (isset($p['l1'])) {
            $goods->where("is_intro", 2);
        }
        if (isset($p['l3'])) {
            $goods->order("package_sale", "desc");
        }
        if (isset($p['all'])) {
            $cate = db("store_goods_cate")->where(["is_deleted" => 0, "pid" => $p['all']])->column("id");
            $cates = db("store_goods_cate")->where(["is_deleted" => 0])->where("pid", "in", $cate)->column("id");
            $goods->where("cate_id", "in", $cates);
        }

        if (isset($p['bid'])) {
            $goods->where("brand_id", $p["bid"]);
            $cc = db("store_goods_brand")->where("id", $p['bid'])->value("cid");
            $brand = db("store_goods_brand")->where("cid", $cc)->select();
            foreach ($brand as $k => $v) {
                $count = db("store_goods")->where("brand_id", $v['id'])->count();
                $brand[$k]['count'] = $count;
            }
            $this->assign("brand", $brand);
        }
        if (isset($p['intro'])) {
            $cate1 = db("store_goods_cate")->where(["is_sale" => 2])->select();
            $cates1 = db("store_goods_cate")->where(["is_sale" => 2])->column("id");
            foreach ($cate1 as $k => $v) {
                $count = db("store_goods")->where("cate_id", $v['id'])->count();
                $cate1[$k]['count'] = $count;
            }
            $goods->where("cate_id", "in", $cates1);
            $this->assign("cate", $cate1);
        }
        if (isset($p['ccid'])) {//二级分类
            $cate = db("store_goods_cate")->where("pid", $p['ccid'])->select();
            $cates = db("store_goods_cate")->where("pid", $p['ccid'])->column("id");
            foreach ($cate as $k => $v) {
                $count = db("store_goods")->where("cate_id", $v['id'])->count();
                $cate[$k]['count'] = $count;
            }
            $goods->where("cate_id", "in", $cates);
            $this->assign("cate", $cate);
        }
//        switch ($p['sel']) {
//            case 1://最新
//                $goods->order("create_at", "desc");
//                break;
//            case 2://价格
//                $goods->order("create", "desc");
//                break;
//            case 3:
//                break;
//            case 4:
//                break;
//            default:
//
//        }
        $dat = $goods->paginate(10, false, ["query" => request()->param()]);
        return $this->fetch("goods_list", ["goods" => $dat]);
    }


    /**
     * 添加收藏记录
     */
    public function favorite_do()
    {
        if (request()->isPost()) {
            $p = input("param.");
            $user = session("member");
            if (empty($user)) {
                echo json_encode(["code" => 4, "msg" => "请先登录"]);
                die;
            }
            $uid = $user['id'];
            $count = db("store_favorite")->where(["gid" => $p['gid'], "uid" => $uid])->count();
            if ($count >= 1) {
                echo json_encode(["code" => 3, "msg" => "您已添加进入收藏夹"]);
                die;
            }
            $da = [
                "gid" => $p['gid'],
                "uid" => session("member.id")
            ];
            $b = db("store_favorite")->insertGetId($da);
            if ($b) {
                $info = [
                    "code" => 1,
                    "msg" => "添加收藏夹成功",

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

    /**
     *
     */
    public function zan()
    {
        if (request()->isPost()) {
            $p = input("param.");
            $user = session("member");
            $good = db("store_comment")->where(["id" => $p['id']])->value("gid");
            $da = [
                "uid" => $user['id'],
                "gid" => $good,
                "cid" => $p['id'],
            ];
            $bb = db("store_comment_zan")->insertGetId($da);
            if ($bb) {
                $info = [
                    "code" => 1,
                    "msg" => "您喜欢他",
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