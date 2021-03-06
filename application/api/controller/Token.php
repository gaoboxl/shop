<?php
namespace app\api\controller;

use think\Controller;
use think\Request;

class Token extends Controller
{
    protected $appid="wxb53e3c92090a1c71";
    protected $secret = '510f0d3a55e6311d53188451c378f776';
  
    //获取token
    public function getToken()
    {
          
             /**
             * 3.小程序调用server获取token接口, 传入code, rawData, signature, encryptData.
             */
            $code = input("code", '', 'htmlspecialchars_decode');
            $rawData = input("rawData", '', 'htmlspecialchars_decode');
            $signature = input("signature", '', 'htmlspecialchars_decode');
            $encryptedData = input("encryptedData", '', 'htmlspecialchars_decode');
            $iv = input("iv", '', 'htmlspecialchars_decode');

            /**
             * 4.server调用微信提供的jsoncode2session接口获取openid, session_key, 调用失败应给予客户端反馈
             * , 微信侧返回错误则可判断为恶意请求, 可以不返回. 微信文档链接
             * 这是一个 HTTP 接口，开发者服务器使用登录凭证 code 获取 session_key 和 openid。其中 session_key 是对用户数据进行加密签名的密钥。
             * 为了自身应用安全，session_key 不应该在网络上传输。
             * 接口地址："https://api.weixin.qq.com/sns/jscode2session?appid=APPID&secret=SECRET&js_code=JSCODE&grant_type=authorization_code"
             */
            $params = [
                'appid' => $this->appid,
                'secret' => $this->secret,
                'js_code' => $code,
                'grant_type' =>'authorization_code'
            ];
      
            
      
            $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$this->appid.'&secret='.$this->secret.'&js_code='.$code.'&grant_type=authorization_code';
            //echo $url;die;
      
            $res = makeRequest($url, $params);

            if ($res['code'] !== 200 || !isset($res['result']) || !isset($res['result'])) {
                return json('请求token无效');
            }
            $reqData = json_decode($res['result'], true);
            if (!isset($reqData['session_key'])) {
                return json('请求token失败');
            }
            $sessionKey = $reqData['session_key'];

            /**
             * 5.server计算signature, 并与小程序传入的signature比较, 校验signature的合法性, 不匹配则返回signature不匹配的错误. 不匹配的场景可判断为恶意请求, 可以不返回.
             * 通过调用接口（如 wx.getUserInfo）获取敏感数据时，接口会同时返回 rawData、signature，其中 signature = sha1( rawData + session_key )
             * 将 signature、rawData、以及用户登录态发送给开发者服务器，开发者在数据库中找到该用户对应的 session-key
             * ，使用相同的算法计算出签名 signature2 ，比对 signature 与 signature2 即可校验数据的可信度。
             */
            $signature2 = sha1($rawData . $sessionKey);
            if ($signature2 !== $signature) return '签名不匹配';

            /**
             * 6.使用第4步返回的session_key解密encryptData, 将解得的信息与rawData中信息进行比较, 需要完全匹配,
             * 解得的信息中也包括openid, 也需要与第4步返回的openid匹配. 解密失败或不匹配应该返回客户相应错误.
             * （使用官方提供的方法即可）
             */
             vendor("Wxtoken.wxBizDataCrypt");  //加载解密文件，在官方有下载
      
            $pc = new \WXBizDataCrypt($this->appid, $sessionKey);
            $errCode = $pc->decryptData($encryptedData, $iv, $data );

            if ($errCode !== 0) {
                return json('encrypt数据不匹配');
            }

        /**
         * 7.生成第三方3rd_session，用于第三方服务器和小程序之间做登录态校验。为了保证安全性，3rd_session应该满足：
         * a.长度足够长。建议有2^128种组合，即长度为16B
         * b.避免使用srand（当前时间）然后rand()的方法，而是采用操作系统提供的真正随机数机制，比如Linux下面读取/dev/urandom设备
         * c.设置一定有效时间，对于过期的3rd_session视为不合法
         * 以 $session3rd 为key，sessionKey+openId为value，写入memcached
         */
        $data = json_decode($data, true);
        $session3rd = randomFromDev(16);
        $data['session3rd'] = $session3rd;
        cache($session3rd, $data['openId'] . $sessionKey);

        return json($data);


    }

   
}
