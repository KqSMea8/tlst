<?php

// +----------------------------------------------------------------------
// | Think.Admin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/Think.Admin
// +----------------------------------------------------------------------

namespace app\index\controller;

use Endroid\QrCode\QrCode;
use service\WechatService;
use service\HttpService;
use think\Controller;
use WeChat\Pay;

/**
 * 微信功能demo
 * Class Demo
 * @package app\store\controller\wechat
 */
class Payment extends Controller
{
    public $app_id = "wxd9ed9e01caf7fd8c";//微信支付app_id
    public $app_secret = "40dbace8efbeb53d2930556875086302";//
    public $mch_id = "1521532871";//微信商户号
    public $key = "4c9d0f13203df4bdff410f8beef9abf4";//支付密钥

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $p = input("param.");
        $order = db("store_order")->find($p['oid']);
        $goods = db("store_order_list")
            ->alias("ol")
            ->field("ol.*,sg.goods_title,sg.goods_logo")
            ->join("store_goods sg", "sg.id=ol.gid")
            ->where("ol.order_id", $order['id'])
            ->select();
        $src = create_sqc($p['oid']);

        return $this->fetch("", ["src" => $src, "order" => $order, "goods" => $goods]);
    }

    /**
     * 微信扫码支付模式一二维码显示
     * @return \think\Response
     * @throws \Endroid\QrCode\Exceptions\ImageFunctionFailedException
     * @throws \Endroid\QrCode\Exceptions\ImageFunctionUnknownException
     * @throws \Endroid\QrCode\Exceptions\ImageTypeInvalidException
     */
    public function scanOneQrc()
    {
        $wechat = new Pay(config('wechat.'));
        $result = $wechat->createParamsForRuleQrc('8888888');
        return $this->createQrc($result);
    }

    /**
     * 微信扫码支付模式一通知处理
     * @return string
     * @throws \WeChat\Exceptions\InvalidResponseException
     */
    public function scanOneNotify()
    {
        $wechat = new Pay(config('wechat.'));
        $notify = $wechat->getNotify();
        p('======= 来自扫码支付1的数据 ======');
        p($notify);
        // 产品ID @todo 你的业务，并实现下面的统一下单操作
        $product_id = $notify['product_id'];
        // 微信统一下单处理
        $options = [
            'body' => '测试商品，产品ID：' . $product_id,
            'out_trade_no' => time(),
            'total_fee' => '1',
            'trade_type' => 'NATIVE',
            'notify_url' => url('@wx-demo-notify', '', true, true),
            'spbill_create_ip' => request()->ip(),
        ];
        $order = $wechat->createOrder($options);
        p('======= 来自扫码支付1统一下单结果 ======');
        p($order);
        // 回复XML文本
        $result = [
            'return_code' => 'SUCCESS',
            'return_msg' => '处理成功',
            'appid' => $notify['appid'],
            'mch_id' => $notify['mch_id'],
            'nonce_str' => \WeChat\Contracts\Tools::createNoncestr(),
            'prepay_id' => $order['prepay_id'],
            'result_code' => 'SUCCESS',
        ];
        $result['sign'] = $wechat->getPaySign($result);
        p('======= 来自扫码支付1返回的结果 ======');
        p($result);
        return \WeChat\Contracts\Tools::arr2xml($result);
    }

    public function check_status()
    {
        if (request()->isPost()) {
            $p = input("param.");
            $ord = db("store_order")->where(["id" => $p['oid'], "pay_status" => 2])->find();
            if ($ord) {
                return json(["code" => 1, "msg" => "订单支付成功", "url" => "/order_list"]);
            } else {
                return json(["code" => 2]);
            }
        }
    }

    /**
     * 扫码支付模式二测试二维码
     * @return \think\Response
     * @throws \Endroid\QrCode\Exceptions\ImageFunctionFailedException
     * @throws \Endroid\QrCode\Exceptions\ImageFunctionUnknownException
     * @throws \Endroid\QrCode\Exceptions\ImageTypeInvalidException
     * @throws \WeChat\Exceptions\InvalidResponseException
     */
    public function scanQrc()
    {
        $wechat = new Pay(config('wechat.'));
        $order = db("store_order")->find($_GET['oid']);
        $options = [
            'body' => '宠物商城',
            'out_trade_no' => $order['order_no'],
            'total_fee' => $order['pay_price'] * 100,
            'trade_type' => 'NATIVE',
            'notify_url' => request()->domain() . "/return.php",
            'spbill_create_ip' => request()->ip(),
        ];
        // 生成预支付码
        $result = $wechat->createOrder($options);
        return $this->createQrc($result['code_url']);
    }

    public function h5_pay()
    {
        $p = input("param.");
        $oid = $p['oid'];
        $ord = db("store_order")->find($oid);
        $notify_url = request()->domain() . "/return.php"; //回调地址
        $subject = "宠物商城"; //商品描述
        $total_amount = $ord['pay_price'] * 100; //金额
        $additional = ""; ////附加数据
        $order_id = $ord['order_no']; ////订单号
        $nonce_str = MD5($order_id);//随机字符串
        $spbill_create_ip = request()->ip(); //终端ip
        //以上参数接收不必纠结，按照正常接收就行，相信大家都看得懂

        //$spbill_create_ip = '118.144.37.98'; //终端ip测试
        $trade_type = 'MWEB';//交易类型 具体看API 里面有详细介绍
        $scene_info = '{"h5_info":{"type":"Wap","wap_url":"' . request()->domain() . '","wap_name":"宠物商城"}}'; //场景信息
        //对参数按照key=value的格式，并按照参数名ASCII字典序排序生成字符串
        $signA = "appid=$this->app_id&body=$subject&mch_id=$this->mch_id&nonce_str=$nonce_str&notify_url=$notify_url&out_trade_no=$order_id&scene_info=$scene_info&spbill_create_ip=$spbill_create_ip&total_fee=$total_amount&trade_type=$trade_type";
        $strSignTmp = $signA . "&key=" . $this->key; //拼接字符串
        $sign = strtoupper(MD5($strSignTmp)); // MD5 后转换成大写
        $post_data = "<xml><appid>$this->app_id</appid><body>$subject</body><mch_id>$this->mch_id</mch_id><nonce_str>$nonce_str</nonce_str><notify_url>$notify_url</notify_url><out_trade_no>$order_id</out_trade_no><scene_info>$scene_info</scene_info><spbill_create_ip>$spbill_create_ip</spbill_create_ip><total_fee>$total_amount</total_fee><trade_type>$trade_type</trade_type><sign>$sign</sign></xml>";//拼接成XML 格式
        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";//微信传参地址
        $dataxml = HttpService::post($url, $post_data); //后台POST微信传参地址  同时取得微信返回的参数，http_post方法请看下文

        $objectxml = (array)simplexml_load_string($dataxml, 'SimpleXMLElement', LIBXML_NOCDATA); //将微信返回的XML
        // 转换成数组
        $info = [];
        switch ($objectxml['return_code']) {
            case 'SUCCESS':
                switch ($objectxml['result_code']) {
                    case 'SUCCESS':
                        $info = ["code" => 1, "msg" => "发起支付成功", "url" => $objectxml['mweb_url']];
                        break;
                    case 'FAIL':
                        $info = ["code" => 2, "msg" => $objectxml['err_code_des']];
                        break;
                    default:
                }
                break;
            case 'FAIL':
                $info = ["code" => 3, "msg" => $objectxml['return_msg']];
                break;
            default:
        }
        return json($info);
    }

    /**
     * 支付通知接收处理
     * @return string
     * @throws \WeChat\Exceptions\InvalidResponseException
     */
    public function notify()
    {
        $testxml = file_get_contents("php://input");

        $jsonxml = json_encode(simplexml_load_string($testxml, 'SimpleXMLElement', LIBXML_NOCDATA));

        $result = json_decode($jsonxml, true);//转成数组，
        file_put_contents("01.txt", $jsonxml);
        if ($result) {
            //如果成功返回了
            $out_trade_no = $result['out_trade_no'];
            $ord = db("store_order")->where(["order_no" => $out_trade_no])->find();
            if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS') {
                $bl = db("store_order")->where(["order_no" => $out_trade_no])->update(["pay_status" => 2]);
              
            }
            echo "SUCCESS";
        }
    }

    /**
     * 公众号JSAPI支付二维码
     * @return \think\Response
     * @throws \Endroid\QrCode\Exceptions\ImageFunctionFailedException
     * @throws \Endroid\QrCode\Exceptions\ImageFunctionUnknownException
     * @throws \Endroid\QrCode\Exceptions\ImageTypeInvalidException
     */
    public function jsapiQrc()
    {
        $url = url('@wx-demo-jsapi', '', true, true);
        return $this->createQrc($url);
    }


    /**
     *
     *
     * /**
     * 显示二维码
     * @param string $url
     * @return \think\Response
     * @throws \Endroid\QrCode\Exceptions\ImageFunctionFailedException
     * @throws \Endroid\QrCode\Exceptions\ImageFunctionUnknownException
     * @throws \Endroid\QrCode\Exceptions\ImageTypeInvalidException
     */
    protected function createQrc($url)
    {
        $qrCode = new QrCode();
        $qrCode->setText($url)->setSize(300)->setPadding(20)->setImageType(QrCode::IMAGE_TYPE_PNG);
        //dump($qrCode->get());die;
        return \think\facade\Response::header('Content-Type', 'image/png')->data($qrCode->get());
    }

}