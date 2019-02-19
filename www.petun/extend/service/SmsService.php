<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace service;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use think\Db;
/**
 * Description of SmsService
 *
 * @author Hugo
 */
class SmsService {

    //put your code here
    public function send_sms($phone) {

// Download：https://github.com/aliyun/openapi-sdk-php-client
// Usage：https://github.com/aliyun/openapi-sdk-php-client/blob/master/README-CN.md

       /* AlibabaCloud::accessKeyClient('LTAIhXdOsZeC6kqk', 'wfDB74q5LnEQzB6KhlrKZLoWnMwELA')
                ->regionId('cn-chengdu') // replace regionId as you need
                ->asGlobalClient();
                */
        AlibabaCloud::accessKeyClient('LTAIIaRAPZeAzh79', 'gzDURLug2SQvSnEXox9qvizG8dS5VY')
                ->regionId('cn-chengdu') // replace regionId as you need
                ->asGlobalClient();
        
        try {
            $code = mt_rand(100000, 999999);
            $result = AlibabaCloud::rpcRequest()
                    ->product('Dysmsapi')
                    // ->scheme('https') // https | http
                    ->version('2017-05-25')
                    ->action('SendSms')
                    ->method('POST')
                    ->options([
                        'query' => [
                            'RegionId' => 'cn-chengdu',
                            'PhoneNumbers' => $phone,
                            'SignName' => '宠你在线',
                            //'TemplateCode' => 'SMS_97130053',
                            'TemplateCode' => 'SMS_157284122',
                            'TemplateParam' => '{"code":"' . $code . '"}',
                        ],
                    ])
                    ->request();
            $send_result = $result->toArray(); //var_dump($send_result);
            if($send_result['Code'] == 'OK'){
                $data = [
                    'phone' => $phone,
                    'code' => $code,
                    'create_time' => date('Y-m-d H:i:s'),
                    'create_time_point' => time()
                ];
                return Db::name('phone_code')->insert($data);
            }
            return false;
        } catch (ClientException $e) {
            return false;
        } catch (ServerException $e) {
            return false;
        }
    }

}
