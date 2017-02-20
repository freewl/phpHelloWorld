<?php
/**
 * Created by IntelliJ IDEA.
 * User: want
 * Date: 2017/2/19
 * Time: 23:14
 */
class World{
    static public function start(){
        //ע��autoload����
        spl_autoload_register('World::autoload');

        //��ȡӦ��ģʽ
        if(is_file(COMMON_PATH.'mode.php')){
            $mode   =   include COMMON_PATH.'mode.php';

            // ���غ����ļ�
            foreach ($mode['common'] as $file){
                if(is_file($file)) {
                    include $file;
                }
            }

            // ����Ӧ��ģʽ�����ļ�
            foreach ($mode['config'] as $file){
                if(is_file($file)) {
                    C(include $file);
                }
            }
        }

        // ʵ������־��
        $logHandler = new CLogFileHandler(ROOT_PATH . "/Log/" . date('Y-m-d') . '.log');
        Log::Init($logHandler);

        App::run();
    }

    static public function autoload($class){
        //����Ӧ�ó���
        $appSubPathList = array("Demo");
        foreach($appSubPathList as $key => $value){
            $filename = APP_PATH . $value ."/". $class . EXT;
            if(is_file($filename)) {
                include $filename;
            }
        }

        //�������
        $libSubPathList = array("Class",'Data');
        foreach($libSubPathList as $key => $value){
            $filename = LIB_PATH . $value ."/". $class . EXT;
            if(is_file($filename)) {
                include $filename;
            }
        }
    }
}