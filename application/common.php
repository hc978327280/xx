<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 性别
 */
function sex($sex){
    return $sex?'男':'女';
}
/**
 * 审核状态
 */
function audit($audit){
    switch($audit){
        case 0:
        $audit='未通过';
        break;
        case 1:
        $audit='审核中';
        break;
        case 2:
        $audit='通过';
        break;
        }
        return $audit;
}