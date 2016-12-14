<?php
namespace lchphp\code;
class Object{

    /*
    public function __get($name)              // 这里$name是属性名
    {
        $getter = 'get' . $name;              // getter函数的函数名
        if (method_exists($this, $getter)) {
            return $this->$getter();          // 调用了getter函数
        } elseif (method_exists($this, 'set' . $name)) {
            throw new \Exception('Getting write-only property: '
                . get_class($this) . '::' . $name);
        } else {
            throw new \Exception('Getting unknown property: '
                . get_class($this) . '::' . $name);
        }
    }

    // $name是属性名，$value是拟写入的属性值
    public function __set($name, $value)
    {
        $setter = 'set' . $name;             // setter函数的函数名
        if (method_exists($this, $setter)) {
            $this->$setter($value);          // 调用setter函数
        } elseif (method_exists($this, 'get' . $name)) {
            throw new \Exception('Setting read-only property: ' .
                get_class($this) . '::' . $name);
        } else {
            throw new \Exception('Setting unknown property: '
                . get_class($this) . '::' . $name);
        }
    }
    */


}