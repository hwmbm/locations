<?php
/**
 * Created by PhpStorm.
 * User: BM
 * Date: 2017/10/17
 * Time: 9:20
 */
//引用变量

/*
1. 什么是引用变量? 在PHP当中,用什么符号定义引用变量?

在PHP中引用意味着用不同的名字访问同一个变量内容. 定义方式 使用&符号
*/

//定义一个变量
$a = range(0, 3);
var_dump(memory_get_usage());echo "</ br>";
//xdebug_debug_zval('a');

//定义变量b ,将变量a的值赋值给b;
// php中有COW机制 COPY ON WRITE  此时$b和$a指向同一个内存
$b=$a;
//$b=&$a;
//var_dump(memory_get_usage());

//对a进行修改
$a=range(0,3);
//var_dump(memory_get_usage());
echo '-----------------------------------------------------------'.'/n';

//对于对象,是引用传递.
/*
 * 2.每次循环后$value的结果
 */
$data = ['a','b','c'];
///$data = array('a','b','c');
foreach ($data as $key =>$value) {
    $value=&$data[$key];
}

/*
 *
第一次循环
$key 0
$value a
val &data a b c

第二次循环
$key 0
$value a
val &data b
key 1
val &data b b c

第三次循环
$key 0
$value a
val  b
key 1
val &data c
key 2
val val &data c
*/

/*
 * 3.字符串有哪些定义方法?都有什么区别
 *
 * 单引号:
 * 单引号不能解析变量
 * 单引号不能解析转义字符,只能解析单引号和反斜线本身
 * 变量和变量.变量和字符串.字符串和字符串之间可以用.连接
 *
 *  双引号
 * 双引号可以解析变量,变量可以使用特殊字符和{}包含
 * 双引号可以解析所有转义字符
 * 也可以使用.来连接
 *
 * 单引号效率高于双引号
 *
 * Heredoc 类似双引号
 * Newdoc   类似单引号
 *都是用于处理文本
 *
 * Heredoc         //Newdoc
 * $str = <<<EoT  //<<<'EoT'
 * 内容
 * EoT
 */


/*
 * 数据类型 8大数据类型
 * 分为三大类型 (标量.复合.特殊)
 * 标量: 浮点 整形 字符串 布尔
 * 复合: 数组和对象
 * 特殊: null和resources资源
 *
 * 浮点类型不能用于比较中,转成二进制时有损耗
 *
 * 布尔类型FALSE 的七种情况: 0 0.0 '' '0' false array()  null
 *
 * 数组类型
 *      超全局数组有:$GLOBALS,$_GET,$_POST,$_REQUEST,$_SESSION,$_COOKIE,$_SERVER,$_FILES,$ENV
 * $GLOBALS包含后面六种
 * $_REQUEST包含$_GET $_POST $COOKIE 尽量少用,安全性偏低
 * $_SERVER:
 *      $_SERVER['SERVER_ADDR'] 服务器端的ip地址
 *      $_SERVER['SERVER_NAME'] 服务器名字
 *      $_SERVER['REQUEST_TIME'] 服务器请求开始时的时间
 *            http://www.imooc.com/index.php/use/reg?status = ghost
 *      $_SERVER['QUERY_STRING'] 获取URL中?后面的数据  就是 status = ghost
 *      $_SERVER['HTTP_REFERER'] 获取上级请求页面 直接通过网站访问就为空
 *      $_SERVER['HTTP_USER_AGENT'] 返回头信息的USER AGENT信息 可以获取浏览器很多相关的参数
 *      $_SERVER['REMOTE_ADDR'] 客户端的ip地址
 *      $_SERVER["REQUEST_URI"]   获取 http://localhost 后面的值，包括/
 *           http://www.imooc.com/index.php/use/reg?status = ghost
 *      $_SERVER['PATH_INFO']  :指 use/reg
 *
 * NULL 直接赋值为NULL ,未定义的变量,unset销毁的变量
 *
 * 常量 :一经定义,不能被修改,不能被删除,定义方式有: const,define
 * const更快 ,是语言结构,可以用于定义类常量
 * define是函数,不能用于类常量的定义
 *
 * 预定义常量
 *      __FILE__,返回文件的路径名和名称
 *      __LINE__,所在行的行号
 *      __DIR__,所在目录
 *      __FUNCTION__,所在的函数
 *      __CLASS__,类名
 *      __TRAIT__,
 *      __METHOD__,类名和方法名
 *      __NAMESPACE__:命名空间
 */


/*
 * 用PHP写出显示客户端IP与服务器IP的代码
         * __FILE__表示什么意思? 返回文件所在的路径和文件名
 */


/*  2-4
 * foo()和@foo()之间的区别
 *
 * 错误控制符@  当将@放置在一个PHP表达式之前,该表达式可能产生的任务错误信息都被忽略掉!
 *
 * 运算符优先级
 *      递增/递减>!>算数运算符>大小比较>(不)相等比较>引用>位运算符(^)>位运算符(|)>逻辑与>逻辑或>三目>赋值
 * >and>xor>or
 * 括号可以增加代码可读性,推荐使用
 *
 * 比较运算符
 * == 和 ===区别 == 值 ===值和类型
 *
 * 递增/递减运算符不影响布尔值 就是 true++还是true false--还是false
 * 递减NULL值没有效果
 * 递增NULL值为1
 *
 *
 * 逻辑运算符
 *  短路作用 || &&
 *  ||和&&与or和and的优先级不同
 * 如  $a = false ||true; -->$a=true;
 *      $b = false or true;-->$b=false 整体为true
 */


/*写出下列程序中的输出结果
         * $a = 0;
         * $b = 0;
         * if($a = 3>0||$b = 3>0){
         *      $a++;
         *      $b++;
         *       echo $a."\n";
         *      echo $b."\n";
         * }
 *  $a = true $b=1
 *  输出1 1
 */


/*  2-5
 *  请列出3种PHP数组循环操作的语法,并注明各种循环的区别
 *
 */

/*
 * PHP的遍历数组的三种方式及各自的区别
 *  使用for循环 while do while
 *  使用foreach循环
 *  使用 while,list(),each()组合循环
 *
 * for循环只能遍历索引数组,foreach可以遍历索引和关联数组,联合使用list(),each()和while循环
 * 同样可以遍历索引和关联数组
 *
 * while.list(),each() 组合不会reset() 就是不会重置数组指针
 * foreach遍历会对数组进行reset()操作
 *
 * if(){}elseif{}可能性大的放在前面
 * switch(整形,浮点类型或者字符串)case...switch后面的控制表达式的数据类型只能是整形,浮点类型或者字符串
 * 如果循环中有switch,switch中使用了continue2 或者continue3  2和3表示跳出几层
 *
 * switch..case会生成跳转表,直接跳转到对应case 对于if..elseif多  可以使用switch效率高
 *
 */

/*
 * PHP中如何优化多个if..elseif语句的情况?
 * 1,可能性大的条件放在前面,
 * 2,如果判断的内容是比较复杂且是整形,浮点类型或者字符串,可以使用switch..case
 */



/**2-6
 * 写出如下程序的输出结果：
 * <?php
 *
 * $count = 5;
 * function get_count()
 * {
 *     static $count;
 *     return $count++;
 * }
 * echo $count;--->5
 * ++$count;---->6
 *
 * echo get_count();---->NULL  null不会被输出
 * echo get_count();---->1
 * 输出 51
 *
 * ?>
 *
 */

/*
 *  变量的作用域
 *      变量的作用域也称变量的范围,变量的范围即它定义的上下文背景(也是它的生效范围).
 * 大部分的PHP变量只有一个单独的范围.这个单独的范围跨度同样包含了include和require引入的文件.
 *
 * $str = '123';-----全局变量
 * function mgfunc(){
 * 若要使用外部str    global $str; 或者$GLOBALS['str'];
 *      echo $str;----->局部变量
 * }
 *
 * 静态变量:静态变量仅在局部函数域中存在,但当程序执行离开此
 * 作用域时,其值并不会消失.
 *
 * static关键字
 * 1.仅初始化一次
 * 2.初始化时需要赋值
 * 3.每次执行函数该值都会保留
 * 4.static修饰的变量是局部的,仅在函数内部有效
 * 5.可以记录函数的调用次数,从而可以在某些条件下终止递归
 *
 * 值传递 默认情况下函数参数通过值传递,如果希望允许函数修改他的值,
 * 必须通过引用传递参数.(参数前用个&)------>
 * $a =1;
 * function  add(&$a){}
 *
 *
 */