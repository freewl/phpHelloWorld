<?php
/**
 * Created by IntelliJ IDEA.
 * User: want
 * Date: 2017/2/19
 * Time: 23:14
 */
class World{
    static public function start(){
        //注册autoload方法
        spl_autoload_register('World::autoload');

        //读取应用模式
        if(is_file(COMMON_PATH.'mode.php')){
            $mode   =   include COMMON_PATH.'mode.php';

            // 加载核心文件
            foreach ($mode['common'] as $file){
                if(is_file($file)) {
                    include $file;
                }
            }

            // 加载应用模式配置文件
            foreach ($mode['config'] as $file){
                if(is_file($file)) {
                    C(include $file);
                }
            }
        }

        // 实例化日志类
        $logHandler = new CLogFileHandler(ROOT_PATH . "/Log/" . date('Y-m-d') . '.log');
        Log::Init($logHandler);

        App::run();
    }

    static public function autoload($class){
        //加载应用程序
        $appSubPathList = array("Demo");
        foreach($appSubPathList as $key => $value){
            $filename = APP_PATH . $value ."/". $class . EXT;
            if(is_file($filename)) {
                include $filename;
            }
        }

        //加载类库
        $libSubPathList = array("Class",'Data');
        foreach($libSubPathList as $key => $value){
            $filename = LIB_PATH . $value ."/". $class . EXT;
            if(is_file($filename)) {
                include $filename;
            }
        }
    }
}