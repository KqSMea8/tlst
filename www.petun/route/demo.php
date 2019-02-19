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

use think\facade\Route;

Route::get("/register", "index/Mlogin/register");//注册页面
Route::get("/login", "index/Mlogin/index");//登陆页面
Route::get("/goods_list/[:ccid]", "index/Goods/goods_list");//顶级分类
Route::get("/all_list/[:all]", "index/Goods/goods_list");//顶级分类
Route::get("/goods_detail/:gid", "index/Goods/detail");//产品详情
Route::get("/order/:cid", "index/Order/index");//订单
Route::get("/add_cart", "index/Cart/add_cart");//
Route::get("/address_list", "index/Address/address_list");//地址列表
Route::get("/order_list", "index/Order/order_list");//订单列表
Route::get("/user", "index/Member/index");//会员首页
Route::get("/favorite", "index/Favorite/index");//收藏夹
Route::get("/goods_list2/[:sid]", "index/Goods/goods_list");//二级分类
Route::get("/goods_list3/[:bid]", "index/Goods/goods_list");//品牌
Route::get("/introduce/:l1", "index/Goods/goods_list");//推荐产品
Route::get("/introduce_brand/:l2", "index/Goods/goods_list");//推荐品牌
Route::get("/hot_goods/:l3", "index/Goods/goods_list");//热销产品
Route::get("/favorite", "index/Member/favorite");//收藏夹
Route::get("/mem_order", "index/Member/mem_order");//收藏夹
Route::get("/comment/:gid/:ol_id", "index/Comment/index");//评论
Route::get("/edit_address", "index/Address/edit_address");//评论
Route::get("/edit_address2/:aid", "index/Address/edit_address");//评论
//Route::get("/encyclopedias","index/Encyclopedias/index");//宠物百科
//Route::get("/encyclopedias2/[:key]","index/Encyclopedias/index");//宠物百科
Route::get("/en_detail/:eid", "index/Encyclopedias/detail");//宠物百科文章详情
Route::get("/intro/:iid", "index/Goods/goods_list");//评论
Route::get("/video/:vid", "index/Index/video");//评论
Route::get("/brand", "index/Brand/index");//评论
Route::get("/sel_brand/:slid", "index/Brand/index");//评论
Route::get("/sale/:intro", "index/Goods/goods_list");//评论
/******************************************************************/
Route::post("/add_order", "index/Order/add_order");//订单列表
Route::post("/get_first", "index/Index/get_first");//获取顶级分类
Route::post("/cate_get", "index/Index/cate_get2");//二级分类
Route::post("/register_do", "index/Mlogin/register_do");//注册逻辑
Route::post("/log_go", "index/Mlogin/log_go");//登录注册
Route::post("/brand_get", "index/Index/brand_get");//获取品牌
Route::post("/goods_do", "index/Cart/goods_do");//添加购物车
Route::post("/favorite_do", "index/Goods/favorite_do");//添加收藏夹
Route::post("/up_num", "index/Cart/up_num");//更新订单数目
Route::post("/order_do", "index/Order/order_do");//添加订单
Route::post("/add_address", "index/Address/add_address");//添加地址
Route::post("/del_favorite", "index/Favorite/del_favorite");//添加地址
Route::post("/comment_do", "index/Comment/comment_do");//添加地址
Route::post("/order_del", "index/Order/order_del");//添加地址
Route::post("/zan", "index/Goods/zan");//添加地址
Route::post("/cart_del", "index/Cart/cart_del");//添加地址
Route::get("/list_search", "index/Goods/goods_list");
Route::post("/log_out", "index/Mlogin/log_out");
Route::post("/return.php", "index/Payment/notify");
// 不执行下面的路由
return [

];

/*  测试环境禁止操作路由绑定 */
Route::post('admin/user/pass', function () {
    return json(['code' => 0, 'msg' => '测试环境禁修改用户密码！']);
});
Route::post('admin/index/pass', function () {
    return json(['code' => 0, 'msg' => '测试环境禁修改用户密码！']);
});
Route::post('admin/config/index', function () {
    return json(['code' => 0, 'msg' => '测试环境禁修改系统配置操作！']);
});
Route::post('admin/config/file', function () {
    return json(['code' => 0, 'msg' => '测试环境禁修改文件配置操作！']);
});
Route::post('admin/menu/index', function () {
    return json(['code' => 0, 'msg' => '测试环境禁排序菜单操作！']);
});
Route::post('admin/menu/add', function () {
    return json(['code' => 0, 'msg' => '测试环境禁添加菜单操作！']);
});
Route::post('admin/menu/edit', function () {
    return json(['code' => 0, 'msg' => '测试环境禁编辑菜单操作！']);
});
Route::post('admin/menu/forbid', function () {
    return json(['code' => 0, 'msg' => '测试环境禁止禁用菜单操作！']);
});
Route::post('admin/menu/del', function () {
    return json(['code' => 0, 'msg' => '测试环境禁止删除菜单操作！']);
});
Route::post('wechat/config/index', function () {
    return json(['code' => 0, 'msg' => '测试环境禁止修改微信配置操作！']);
});
Route::post('admin/node/save', function () {
    return json(['code' => 0, 'msg' => '测试环境禁止修改节点数据操作！']);
});
Route::post('wechat/menu/edit', function () {
    return json(['code' => 0, 'msg' => '测试环境禁止修改微信菜单操作！']);
});
Route::get('wechat/menu/cancel', function () {
    return json(['code' => 0, 'msg' => '测试环境禁止删除微信菜单操作！']);
});
