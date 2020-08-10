<?php
// 一键呼叫接口
class VoiceCall
{
    // 网站的appkey
    private $appkey = "951572a068e3668984e78329963e854e";
    // appkey 对应的秘钥
    private $secret = "IDKUwL";
    // 基础地址
    public $apiurl = "http://api-voicecall.mixcom.cn:21588";

    /**
     * 设置appkey
     * @param appkey
     */
    public function setAppkey($appkey)
    {
        $this->appkey = $appkey;
    }

    /**
     * 设置秘钥
     * @param secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * 点击呼叫
     *
     * @param array $params
     * @return string
     */
    public function dial($params = array())
    {
        $url = $this->apiurl . "/voice/dial";
        $def = array(
            'callerNbr' => '', # 主叫
            'calleeNbr' => '', # 被叫
            'maxduration' => 0, # 最大通话时长， 单位分钟, 0表示不限制
        );
        $params = array_merge($def, $params);
        $json = $this->post($url, $params);
        return $json;
    }

    /**
     * 获取通话记录
     *
     * @param array $params
     * @return string
     */
    public function cdr($params = array())
    {
        $url = $this->apiurl . "/cdr/lists";
        $def = array(
            'page' => 1,
            'pagenum' => 20,
        );
        $params = array_merge($def, $params);
        $json = $this->post($url, $params);
        return $json;
    }

    /**
     * 获取详细账单数据
     *
     * @param array $params
     * @return string
     */
    public function billing($params = array())
    {
        $url = $this->apiurl . "/billing/lists";
        $def = array(
            'page' => 1,
            'pagenum' => 20,
        );
        $params = array_merge($def, $params);
        $json = $this->post($url, $params);
        return $json;
    }

    /**
     * 获取日结报表数据
     *
     * @param array $params
     * @return string
     */
    public function day($params = array())
    {
        $url = $this->apiurl . "/report/day";
        $def = array(
            'page' => 1,
            'pagenum' => 20,
        );
        $params = array_merge($def, $params);
        $json = $this->post($url, $params);
        return $json;
    }

    /**
     * 获取月结数据报表
     * @param array $params
     * @return string
     */
    public function month($params = array())
    {
        $url = $this->apiurl . "/report/month";
        $def = array(
            'year' => '',
        );
        $params = array_merge($def, $params);
        $json = $this->post($url, $params);
        return $json;
    }

    /**
     * 获取当前应用对应的账户的余额
     * @return string
     */
    public function balance()
    {
        $url = $this->apiurl . "/balance/get";
        $json = $this->post($url, []);
        return $json;
    }

    /**
     * 查询充值扣款记录
     * @return string
     */
    public function recharge($params = array())
    {
        $url = $this->apiurl . "/recharge/lists";
        $def = array(
            'page' => 1,
            'pagenum' => 20,
        );
        $params = array_merge($def, $params);
        $json = $this->post($url, $params);
        return $json;
    }

    private function post($url, $params = array())
    {
        $params['time'] = time();
        $params['appkey'] = $this->appkey;
        $params['sign'] = $this->getSign($params);

        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, $url); //抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1); //post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $data = curl_exec($ch); //运行curl
        curl_close($ch);
        return $data;
    }

    private function getSign($params)
    {
        // key转换为小写
        $params = array_change_key_case($params, CASE_LOWER);
        // 排除不需要加密的参数
        foreach ($params as $key => $val) {
            if ($key == 'c' || $key == 'a' || $key == 'sign') {
                // 从数组中移除
                unset($params[$key]);
            }
            if ($val === '') {
                // 空值从数组中移除
                unset($params[$key]);
            }
        }
        // 对key进行排序, 按名称升序
        ksort($params);
        // 将数据连接，进行加密
        $data = '';
        foreach ($params as $key => $val) {
            $data .= $val;
        }
        $data .= $this->secret;
        $sign = strtolower(sha1($data . sha1($this->secret)));
        return $sign;
    }
}
