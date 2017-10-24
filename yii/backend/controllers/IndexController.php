<?php
/**
 * IndexController.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/7/8 7:33 created
 */


namespace backend\controllers;


use backend\models\City;
use backend\models\StatMonth;
use backend\models\StatWeek;
use backend\models\StatDay;
use yii;
use common\helps\tools;
use backend\controllers\BaseController;


class IndexController   extends BaseController
{

    public $layout = false;
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * @return string
     */
    public function actionHeader()
    {
        $sql = "select * from keeper_city";
        $cityList = city::findBysql($sql)->asArray()->all();
        $loginUser = $this->loginUser;
        $userCity = $loginUser['kam_role']['city'];
        $userCityName = array();
        foreach($cityList as $key => $value) {
             if(in_array($value['city'], $userCity)) {
                $userCityName[] = tools::array_iconv($value['city_name'], 'gb2312', 'utf-8');
            }
        }
        $loginUser['kam_nickname'] = tools::array_iconv($loginUser['kam_nickname'], 'gb2312', 'utf-8');
        $data['city'] = $userCityName;
        return $this->render('header', [
            'data' => $data,
            'loginUser' => $loginUser
        ]);
    }

    /**
     * 左侧菜单
     *
     * @return string
     */
    public function actionMenus()
    {
        //配置菜单参数
        $params = Yii::$app->params['params'];
        Yii::$app->redis->set('menus', serialize($params));
        $params = Yii::$app->redis->get('menus');
        $paramsArray = unserialize($params);
        $paramsArray = tools::tree_categories($paramsArray, 0, 1, 0, 'kamu_parent_id', 'kamu_id');
        //用户的权限
        $loginMenuList = $this->loginUser['kam_role']['menu'];
        $menus = [];
        foreach($paramsArray as $key => $value) {
            if(in_array($value['kamu_id'], $loginMenuList) && $value['kamu_as_menu'] == 1) {
                $menus[] = $value;
            }
        }
        return $this->render('menus', [
            'menus' => $menus
        ]);
    }

    /**
     * @return string
     */
    public function actionMain()
    {
        $sql = "select * from keeper_city where is_open = 1";
        $cityInfo = city::findBySql($sql)->asArray()->all();
        $city = tools::array_iconv($cityInfo, 'GB2312', 'UTF-8');
        $cityPinYin = array();
        $cityStr = "";
        foreach($city as $key => $value) {
            $cityPinYin[] = $value['city'];
            $cityStr.= $cityStr=="" ? $value['city'] : ",".$value['city'];
        }

        //站内通知，2周以内
        $time = time()-14*86400;
        $sql = "select * from keeper_news where type = 4 and add_time >=".$time;
        $date = date("Y-m-d");
        $month = date("Y-m");
        $month_start = strtotime($month.'-01');
        $month_day_num = date("t", $month_start);
        $month_end = $month_start + $month_day_num*86400;
        $last_month = date("Y-m", $month_start-86400);
        $city = $this->loginUser['kam_city'];
        //月统计
        $sql = "select * from keeper_stat_month where ksm_city= '".$city ."' and ksm_month between '".$last_month."' and '".$month."' order by ksm_month desc";
        $month_info = StatMonth::findBySql($sql)->asArray()->all();

        $data_by_month = array();
        foreach($month_info as $key => $value) {
            $data_by_month[$value['ksm_month']][$value['ksm_city']] = $value;
        }

        $last_week = date("Y-m-d", time()-date("w")*3600*24);
        $week = date("Y-m-d", time()+(7-date("w"))*3600*24);
        //周统计
        $sql = "select * from keeper_stat_week where ksw_city ='".$city."' and ksw_week between '".$last_week."' and '".$week."' order by ksw_week desc";
        $week_info = StatWeek::findBySql($sql)->asArray()->all();
        $data_by_week = array();
        foreach($week_info as $key => $value) {
            $data_by_week[$value['ksw_week']][$value['ksw_city']] = $value;
        }
        //最近30天数据显示
        $sql = "select * from keeper_stat_day where ksd_city='".$city."' order by ksd_day asc limit 30";
        $dayInfo = StatDay::findBySql($sql)->asArray()->all();
        $xDay = "";//日期
        $cpNum = "";//新增报备数
        $actNum = "";//活跃经纪人数目
        $runNum = "";//执行项目数
        foreach($dayInfo as $key=>$value) {
            $xDay.= $xDay == "" ? "'".$value['ksd_day']."'" : ",'".$value['ksd_day']."'";
            $cpNum.= $cpNum == "" ? $value['cp_add_num'] : ",".$value['cp_add_num'];
            $actNum.= $actNum == "" ? $value['agent_act_num'] : ",".$value['agent_act_num'];
            $runNum.= $runNum == "" ? $value['loupan_run_num'] : ",".$value['loupan_run_num'];
        }
        //分站对比
        $sql = "select * from keeper_stat_month where ksm_month=".$last_month." order by cp_add_num desc limit 5";
        $top5Info = StatMonth::findBySql($sql)->asArray()->all();

        $sql = "select sum(cp_add_num) sum1 ,sum(agent_act_num) sum2, sum(loupan_run_num) sum3 from keeper_stat_month where ksm_month=".$last_month." and ksm_city in('".$cityStr."')";
        $actInfo = StatMonth::findBySql($sql)->asArray()->all();

        $cpNumPercent = array();//五站新增报备数占比
        $otherCpPerc = 0;

        $actNumPercent = array();//五站活跃经纪人占比
        $otherActPerc = 0;

        $runNumPercent = array();//五站执行项目数占比
        $otherRunPerc = 0;
        foreach($top5Info as $key => $value) {
            $cpNumPercent[$key]['city'] = $city[$value['ksm_city']]['city_name'];
            $cpNumPercent[$key]['per'] = $value['cp_add_num']/$actInfo['sum1'];
            $otherCpPerc += $value['cp_add_num']/$actInfo['sum1'];

            $actNumPercent[$key]['city'] = $city[$value['ksm_city']]['city_name'];
            $actNumPercent[$key]['per'] = $value['agent_act_num']/$actInfo['sum2'];
            $otherActPerc += $value['agent_act_num']/$actInfo['sum2'];

            $runNumPercent[$key]['city'] = $city[$value['ksm_city']]['city_name'];
            $runNumPercent[$key]['per'] = $value['loupan_run_num']/$actInfo['sum3'];
            $otherRunPerc += $value['loupan_run_num']/$actInfo['sum3'];
        }
        return $this->render('main', array(
            'data_by_month' => $data_by_month,
            'month' => $month,
            'last_month' => $last_month,
            'data_by_week' => $data_by_week,
            'week' => $week,
            'last_week' => $last_week,
            'xDay' => $xDay,
            'cpNum' => $cpNum,
            'actNum' => $actNum,
            'runNum' => $runNum,
            'cpNumPercent' => $cpNumPercent,
            'actNumPercent' => $actNumPercent,
            'runNumPercent' => $runNumPercent,
            'otherCpPerc' => $otherCpPerc,
            'otherActPerc' => $otherActPerc,
            'otherRunPerc' => $otherRunPerc,
        ));
    }
}