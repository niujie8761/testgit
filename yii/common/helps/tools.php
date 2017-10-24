<?php
/**
 * tools.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/7/10 20:03 created
 */

namespace common\helps;

class tools{

    /**
     * @param $str
     * @param string $in_charset
     * @param string $out_charset
     * @return array|string
     *
     */
    public static function array_iconv($str, $in_charset = 'utf-8', $out_charset = 'gbk')
    {
        if(is_array($str)) {
            foreach($str as $key => $value) {
                $str[$key] = self::array_iconv($value, $in_charset, $out_charset);
            }
            return $str;
        }else if(is_string($str)) {
            return iconv($in_charset, $out_charset, $str);
        }else {
            return $str;
        }
    }
    /**
     * 将分类按照等级处理
     *
     * @param array $categories
     * @param int $parent_id
     * @param int $level
     * @param int $inchildren
     * @return array
     */
    public static function tree_categories($categories, $parent_id = 0, $level = 1, $inchildren = 1, $parent_key='parent_id', $id_key='id'){
        if (empty($categories)) {
            return array();
        }
        $return_data = array();
        foreach ($categories as $key => $category){
            if ($category[$parent_key] == $parent_id) {
                $category['level_depth'] = $level;
                unset($categories[$key]);
                $children = self::tree_categories($categories, $category[$id_key], $level+1, $inchildren, $parent_key, $id_key);
                if ( !empty($children) ) {
                    if ($inchildren == 0) {
                        $return_data[] = $category;
                        $return_data = array_merge($return_data,$children);
                    }else {
                        $category['children'] = $children;
                        $return_data[] = $category;
                    }
                }else {
                    $return_data[] = $category;
                }
            }
        }
        return $return_data;
    }





















}