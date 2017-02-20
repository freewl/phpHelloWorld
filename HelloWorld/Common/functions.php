<?php
/**
 * Created by IntelliJ IDEA.
 * User: want
 * Date: 2017/2/19
 * Time: 23:37
 */

 function test(){
     echo "test";
 }

function C($name=null, $value=null,$default=null) {
    static $_config = array();
    // （出现在函数内部的基本类型的的静态变量初始化语句只有在第一次调用才执行）
    // 静态变量是只存在于函数作用域的变量，不过，在函数执行完成后，这种变量的值不会丢失，也就是说，在下一次调用这个函数时，变量仍然会记得原来的值。
    // 注：局部静态变量占用内存时间较长，并且可读性差，因此，除非必要，尽量避免使用局部静态变量。

    // 无参数时获取所有
    if (empty($name)) {
        return $_config;
    }
    // 优先执行设置获取或赋值
    if (is_string($name)) {
        if (!strpos($name, '.')) {
            $name = strtoupper($name);
            if (is_null($value))
                return isset($_config[$name]) ? $_config[$name] : $default;
            $_config[$name] = $value;
            return null;
        }
        // 二维数组设置和获取支持
        $name = explode('.', $name);
        $name[0]   =  strtoupper($name[0]);
        if (is_null($value))
            return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : $default;
        $_config[$name[0]][$name[1]] = $value;
        return null;
    }


    // 批量设置
    if (is_array($name)){
        $_config = array_merge($_config, array_change_key_case($name,CASE_UPPER));
        return null;
    }
    return null; // 避免非法参数
}