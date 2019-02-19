<?php

namespace app\index\model;

use think\Db;
use think\Model;

class Member extends Model {

    protected $table = "store_member";

    public function addOne($params) {
        $data = [
            'phone' => $params['phone'],
            'nickname' => $params['nickname']
        ];
        if (!$this->checkPhoneCode($params))
            return -2;
        return $this->insert($data);
    }

    public function checkPhoneCode($params) {
        $phone_code = Db::name('phone_code')->where(['phone' => $params['phone'], 'state' => 1])->order('id DESC')->find();
        if ($phone_code['code'] != $params['phone_code']) {
            return false;
        } else {
            Db::name('phone_code')->where(['id' => $phone_code['id']])->update(['state' => -1]);
        }
        return true;
    }

    

}
