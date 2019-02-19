<?php

namespace app\index\controller;

use think\Controller;

/**
 * 最喜欢
 * Class Favorite
 * @package app\index\controller
 */
class Favorite extends Controller
{
    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $user = session("member");
        $favorite = db("store_favorite")
            ->alias("sf")
            ->field("sf.*,sg.goods_title,sg.goods_logo")
            ->join("store_goods sg", "sg.id=sf.gid")
            ->where("sf.uid", $user['id'])
            ->select();
        foreach ($favorite as $k => $v) {
            $spec = db("store_goods_list")->where(["goods_id" => $v['gid'], "status" => 1])->select();
            $favorite[$k]['spec'] = $spec;

        }
        return $this->fetch("", ["favorite" => $favorite]);
    }

    /**
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del_favorite()
    {
        if (request()->isPost()){
            $p=input("param.");
            $bb=db("store_favorite")->delete($p['id']);
            if ($bb){
               $info=[
                   "code"=>1,
                   "msg"=>"收藏记录删除成功",
               ];
            }else{
                $info=[
                    "code"=>2,
                    "msg"=>"系统故障",
                ];
            }
            echo json_encode($info);die;
        }
    }
}