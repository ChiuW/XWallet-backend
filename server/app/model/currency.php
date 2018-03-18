<?php

namespace Dolphin\Tan\Model;

class Currency extends Base
{
    /**
    * 构造函数
    *
    * @param int $id 用户编号
    *
    * @return array
    **/
    public function supportCurrency()
    {
        $currency = $this->db->select('currency', ['name', 'symbol', 'node'], ['enable' => '1']);
        return $currency;
    }
}