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
    // �������ں����ڲ��Ļ������͵ĵľ�̬������ʼ�����ֻ���ڵ�һ�ε��ò�ִ�У�
    // ��̬������ֻ�����ں���������ı������������ں���ִ����ɺ����ֱ�����ֵ���ᶪʧ��Ҳ����˵������һ�ε����������ʱ��������Ȼ��ǵ�ԭ����ֵ��
    // ע���ֲ���̬����ռ���ڴ�ʱ��ϳ������ҿɶ��Բ��ˣ����Ǳ�Ҫ����������ʹ�þֲ���̬������

    // �޲���ʱ��ȡ����
    if (empty($name)) {
        return $_config;
    }
    // ����ִ�����û�ȡ��ֵ
    if (is_string($name)) {
        if (!strpos($name, '.')) {
            $name = strtoupper($name);
            if (is_null($value))
                return isset($_config[$name]) ? $_config[$name] : $default;
            $_config[$name] = $value;
            return null;
        }
        // ��ά�������úͻ�ȡ֧��
        $name = explode('.', $name);
        $name[0]   =  strtoupper($name[0]);
        if (is_null($value))
            return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : $default;
        $_config[$name[0]][$name[1]] = $value;
        return null;
    }


    // ��������
    if (is_array($name)){
        $_config = array_merge($_config, array_change_key_case($name,CASE_UPPER));
        return null;
    }
    return null; // ����Ƿ�����
}