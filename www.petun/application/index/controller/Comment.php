<?php

namespace app\index\controller;

use think\Controller;

/**
 * 评论
 * Class Comment
 * @package app\index\controller
 */
class Comment extends Controller
{
    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $p = input("param.");
        $goods = db("store_goods")->field("id,goods_title,goods_logo")->find($p['gid']);
        return $this->fetch("", ["goods" => $goods, "gid" => $p['gid'], "ol_id" => $p['ol_id']]);
    }

    /**
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function comment_do()
    {
        if (request()->isPost()) {
            $user = session("member");
            $p = input("param.");
            if (empty($user)) {
                echo json_encode(["code" => 3, "msg" => "请先登录"]);
                die;
            }
            $da = [
                "content" => $p['text'],
                "gid" => $p['gid'],
                "pic" => $p['img'],
                "star" => $p['star'],
                "mid" => $user['id'],
                "ol_id" => $p['ol_id']
            ];
            $bb = db("store_comment")->insertGetId($da);
            if ($bb) {
                $info = [
                    "code" => 1,
                    "msg" => "评论产品成功",
                    "url" => "/order_list"
                ];
                db("store_order_list")->update(["id" => $p['ol_id'], "is_comment" => 2]);
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
    public function upload()
    {
        $file = request()->file('file'); // file是上传按钮名t\
        if ($file) {
            $info = $file->move("./uploads");
            $sname = $info->getSaveName();

            echo json_encode(array('code' => 200, 'src' => request()->domain() . "/uploads/" . $sname));
            exit;
        } else {
            echo json_encode(array('code' => 402, 'msg' => $file->getError()));
            exit;
        }

    }
}