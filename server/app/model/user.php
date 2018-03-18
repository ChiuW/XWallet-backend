<?php

namespace Dolphin\Tan\Model;

class User extends Base
{
    /**
    * 构造函数
    *
    * @param int $id 用户编号
    *
    * @return array
    **/
    public function user($id = 0)
    {
        $user = $this->db->get('user', ['uuid', 'nickname', 'telephone', 'register_time'], ['id[=]' => $id]);

        return $user;
    }
}

