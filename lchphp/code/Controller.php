<?php
namespace lchphp\code;

class Controller {

	private $modules 		= '';
	private $modulesPath 	= '';
	public  $layouts		= '';

    static private $smarty;
    function __construct(){
		$this->modules = C('activeModules')==null?'':C('activeModules');
		$this->modulesPath = empty($this->modules)?'/views':'/modules/' . $this->modules . '/views';
        if (empty(self::$smarty)) {
            include (BASEDIR.'/smarty/Smarty.php');
            self::$smarty = new \Smarty();
            self::$smarty -> caching = false;//是否使用缓存
            $runtime = BASEDIR.'/runtime';
            self::$smarty -> template_dir = BASEDIR.'/app' . $this->modulesPath;//设置模板目录
            self::$smarty -> compile_dir = $runtime.'/templates_c';//设置编译目录
            self::$smarty -> cache_dir = $runtime.'/smarty_cache';//缓存文件夹
            //修改左右边界符号
            self::$smarty -> left_delimiter="{";
            self::$smarty -> right_delimiter="}";
            return self::$smarty;
        } else {
            return self::$smarty;
        }
    }
//    protected $__name;

    function display($template = null, $cache_id = null, $compile_id = null, $parent = null){
		$this->assign(array('this'=>$this));
        $SUFFIX= C('tmpl_template_suffix');
        $template.='.'.$SUFFIX;
		if(empty($this->layouts)) {
			self::$smarty->display($template, $cache_id, $compile_id, $parent);
		}else{
			$this->assign('NACHO_CONTENT_FOR_LAYOUT',$template);
			self::$smarty->display('layouts/'.$this->layouts.'.'.$SUFFIX, $cache_id, $compile_id, $parent);
		}
    }
    function assign($tpl_var, $value = null, $nocache = false){
        self::$smarty->assign($tpl_var, $value, $nocache);
    }
//    function __call($n,$a){
//        if( $n=='_call_' ){
//            $n = $a[0];
//            $this->__name = $n;
//            $this->$n();
//        }
//    }
	function createUrl($path='',$pram=array()){
		return createUrl($path,$pram);
	}

}