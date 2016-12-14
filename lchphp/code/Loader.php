<?php
namespace lchphp\code;
class Loader{
    static function  autoload($class)
    {
        $arr = explode('\\',$class);
        if($arr[0] == 'app' or $arr[0] == 'lchphp') {

            $file = BASEDIR . '/' . str_replace('\\', '/', $class) . '.php';
            if (file_exists($file)) {
                require $file;
            } else {
                $c = explode('\\', $class);
                $controller = array_pop($c);
				trigger_error('The class is not fund: ' . $controller,E_USER_ERROR);
            }
        }
    }

}