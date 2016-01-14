<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/14
 * Time: 16:24
 */

class ApiTestServices extends CComponent{
    public function sayHi(){
        return 'hi';
    }

    /**
     * 获取方法解释说明
     * @param string $module
     * @param string $fc
     * @return string 返回方法解释说明
     */
    public function getDocumentInfo($module,$fc){
        $func  = new ReflectionMethod($module,$fc);
        $tmp   = $func->getDocComment();
        return $tmp;
    }
}