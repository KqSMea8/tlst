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

namespace app\index\controller;

use think\Controller;

/**
 * 应用入口控制器
 * @author Anyon <zoujingli@qq.com>
 */
class Index extends Controller
{
    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $cate = db("store_goods_cate")->where("is_deleted", 0)->select();//所有分类
        $g = db("store_goods_cate")->where(["is_deleted" => 0, "pid" => 0])->select();//所有顶级分类
        $video = db("store_video")->field("id,title,pic")->where("is_top", 2)->select();//q宠小课堂
        $intro = db("store_goods")->where(["is_deleted" => 0, "is_intro" => 2])->select();//推荐产品
        $brand = db("store_goods_brand")->where(["is_deleted" => 0, "is_intro" => 2])->select();//推荐品牌
        $hot = db("store_goods")->where(["is_deleted" => 0])->order("package_sale", "desc")->limit(7)->select();//热销产品
        $banner = db("store_banner")->where(["is_deleted" => 0])->select();
        foreach ($g as $k => $v) {
            $c1 = db("store_goods_cate")->where(["is_deleted" => 0, "pid" => $v['id']])->column("id");//一级分类
            $c2 = db("store_goods_cate")->where(["is_deleted" => 0])->where("pid", "in", $c1)->column("id");//二级分类
            $go = db("store_goods")->field("id,goods_title,goods_logo,abbreviation")->where("cate_id", "in", $c2)->limit(7)->select();
            $g[$k]['list'] = $go;
        }
        $id = db("store_goods_cate")->where("cate_title", "药学")->value("id");
        $pid = db("store_goods_cate")->where("pid", $id)->column("id");
        $pharmacy = db("store_goods_cate")->where("pid", "in", $pid)->limit(8)->select();
        return $this->fetch("", [
                "banner" => $banner,
                "cate" => $cate,
                "video" => $video,
                "g" => $g,
                "pharmacy" => $pharmacy,
                "intro" => $intro,
                "brand" => $brand,
                "hot" => $hot
            ]
        );
    }

    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function get_first()
    {
        if (request()->isPost()) {
            $p = input("param.");
            $g = db("store_goods_cate")->where(["is_deleted" => 0, "pid" => 0])->select();//所有顶级分类
            echo json_encode($g);
            die;
        }

    }

    /**
     *
     */
    public function cate_get()
    {
        if (request()->isPost()) {
            $p = input("param.");
            $cate = db("store_goods_cate")->field("id,cate_title,cate_img")->where("pid", $p['id'])->select();
            foreach ($cate as $k => $v) {
                $cate2 = db("store_goods_cate")->field("id,cate_title")->where("pid", $v['id'])->select();
                $cate[$k]['list'] = $cate2;
            }
            echo json_encode($cate);
            die;
        }
    }

    /**
     *
     */
    public function cate_get2()
    {
        if (request()->isPost()) {
            $p = input("param.");
            $cate = db("store_goods_cate")->field("id,cate_title,cate_img")->where("pid", $p['id'])->select();//二级分类
            $brand = db("store_goods_brand")->field("id,brand_title,brand_cover,brand_logo")->where("cid", $p['id'])->limit(6)->select();
            $s4 = "";
            if (empty($brand)) {
                $s4 = "无";
            } else {
                foreach ($brand as $k2 => $v2) {
                    $s4 .= '    <li data-position="1" data-promo-creative="blue-buffalo">
		    <a class="cw-card" href="/goods_list3/' . $v2["id"] . '">
		        <img alt="Blue Buffalo" src="' . $v2["brand_cover"] . '">
		    </a>
		</li>    ';
                }
            }
            $s2 = "";
            foreach ($cate as $k => $v) {
                $cate2 = db("store_goods_cate")->field("id,cate_title")->where("pid", $v['id'])->limit(7)->select();//三级级分类

                $cate[$k]['list'] = $cate2;
                $s1 = "";
                foreach ($cate2 as $k1 => $v1) {
                    $s1 .= '<li><a href="/goods_list2/' . $v1['id'] . '" data-hierarchy="Dog-Food-Dry-Food">' . $v1["cate_title"] . '</a></li>';
                }

                $s2 .= '<div class="pet-drop-main"><h2><a href="/goods_list/' . $v['id'] . '" data-hierarchy="Cat-Food">' . $v["cate_title"] . '</a></h2><ul>' . $s1 . '</ul></div>';

            }
            $s3 = '<div class=" pet-drop-category pet-drop-category__dog" style="display: block;"><div class="pet-drop-category__left"><div class="pet-drop-top">' . $s2 . '</div><aside class="pet-drop-brands">
				<h2><font >热门品牌</font><a href="#"><span class="view-all" data-hierarchy="Dog-popular-brands-shop-all">选购所有</span></a></h2>
				
        <div class="cms-include brand-logos" data-cms-uid="nav-mm-pet-20-288">
                           
<ul class="brand-tiles" data-promo-name="dog-popular-brands-brand">
		' . $s4 . '
	</ul>         
        </div>
</aside></div><div class="pet-drop-category__right"><div class="cms-include " data-cms-uid="nav-mm-pet-10-288"><link href="//cms-www.chewy.com/contentAsset/raw-data/216fdd71-df22-47de-b322-be6828938ea3/fileAsset/c4f26b12-0236-46ac-bcfe-1b1cbcc66cd0/src/css/components/banner.css" rel="stylesheet" type="text/css"><style>	@media (max-width: 969px) {.nav-mm-pet-10-288.promo-banner .spot-vert-banner__item--mobile {background-image: url(//cms-www.chewy.com/contentAsset/raw-data/ab5e191b-6d0b-4e5e-a87f-36381b422ef1/tabletBanner/896b707b-97ee-4970-b29e-73c4601ff69e) !important; background-position:center !important;}}@media (min-width: 970px) {.nav-mm-pet-10-288.promo-banner .spot-vert-banner__item {background-image: url(//cms-www.chewy.com/contentAsset/raw-data/ab5e191b-6d0b-4e5e-a87f-36381b422ef1/desktopBanner/896b707b-97ee-4970-b29e-73c4601ff69e) !important; background-position:center !important;}}</style><ul class="nav-mm-pet-10-288 promo-banner spot-vert-banner js-nav-banner" data-position="" data-promo-creative="dog-halloween-2018" data-event-name="homepage-dog-flyout-promo" data-promo-id=""><li class="spot-vert-banner__item"><a href="/b/halloween-shop-2026"></a></li><li class="spot-vert-banner__item--mobile"><a href="/b/halloween-shop-2026"></a></li></ul> </div></div></div>';
            echo $s3;
            die;
        }
    }

    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function brand_get()
    {
        if (request()->isPost()) {
            $p = input("param.");
            $brand = db("store_goods_brand")->where("initials", $p['initials'])->select();
            $s1 = "";
            foreach ($brand as $k => $v) {
                $s1 .= '  <li><a href="/goods_list3/' . $v['id'] . '" data-hierarchy="A-A-Pet-Hub">' . $v['brand_title'] . '</a></li>';
            }
            $s2 = '<div class="brand-list">
                                        <div class="brand-list-item" id="brands-' . $p['initials'] . '">
                                            <h3 class="brand-list-letter"><span>' . $p['initials'] . '</span></h3>

                                            <ul>
                                                ' . $s1 . '
                                            </ul>                                    
                                        </div>
                                    </div>';
            echo $s2;

        }
    }

    public function video()
    {
        $p = input("param.");
        $video = db("store_video")->field("id,url,title,pic")->find($p['vid']);
        return $this->fetch("", ["video" => $video]);
    }
}
 