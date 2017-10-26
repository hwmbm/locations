<?php
/**
 * Created by PhpStorm.
 * User: BM
 * Date: 2017/10/17
 * Time: 9:20
 */
//引用变量

/*
2-1. 什么是引用变量? 在PHP当中,用什么符号定义引用变量?

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
 * 2-2.每次循环后$value的结果
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
 * 2-3.字符串有哪些定义方法?都有什么区别
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


/**
 * 2-7
 *
 *function &mgfunc(){
 *  static $b=10;
 * return $b;
 * }
 *
 * $a=mgfunc();--->10
 * $a=&mgfunc();
 * $a=100;;
 * echo mgfunc();----->100
 */

/**引用外部文件
 *
 * include/require语句包含并运行指定文件
 * 如果给出路劲名称按照路劲来找，否则从include_path中查找
 * 如果include_path中也没有,则从调用脚本文件所在的目录和当前工作目录下寻找
 *
 * 当一个文件被包含时，其中所包含的代码继承了include所在行的变量范围
 *
 * 加载过程中未找到文件则include结构会发出一条警告（E_WARNING）,脚本会继续运行；
 * require错误：会发出一个致命错误,在出错时产生E_COMPILE_ERROR级别的错误.将导致脚本中止
 * require（include）/require_one(include_once)唯一区别是会检查该文件是否被包含，如果是则不会再次包含
 *
 *
 * 系统内置函数：
 * 时间日期函数：
 *  date.strtotime().mktime().time().microtime().date_default_timezone_set()
 *
 * ip处理函数
 *  ip2long().long2ip()
 *
 * 打印处理
 *  print().printf().print_r().echo.sprintf().var_dump().var_export()
 *
 * 序列化和反序列化函数
 * serialize().unserialize()
 *
 * 字符串处理函数
 *  implode（）.explode().join().strrev().trim().rtrim().ltrim().strstr().number_format()...
 *
        addcslashes — 以 C 语言风格使用反斜线转义字符串中的字符
        addslashes — 使用反斜线引用字符串
        bin2hex — 函数把包含数据的二进制字符串转换为十六进制值
        chop — rtrim 的别名
        chr — 返回指定的字符
        chunk_split — 将字符串分割成小块
        convert_cyr_string — 将字符由一种 Cyrillic 字符转换成另一种
        convert_uudecode — 解码一个 uuencode 编码的字符串
        convert_uuencode — 使用 uuencode 编码一个字符串
        count_chars — 返回字符串所用字符的信息
        crc32 — 计算一个字符串的 crc32 多项式
        crypt — 单向字符串散列
        echo — 输出一个或多个字符串
        explode — 使用一个字符串分割另一个字符串
        fprintf — 将格式化后的字符串写入到流
        get_html_translation_table — 返回使用 htmlspecialchars 和 htmlentities 后的转换表
        hebrev — 将逻辑顺序希伯来文（logical-Hebrew）转换为视觉顺序希伯来文（visual-Hebrew）
        hebrevc — 将逻辑顺序希伯来文（logical-Hebrew）转换为视觉顺序希伯来文（visual-Hebrew），并且转换换行符
        hex2bin — 转换十六进制字符串为二进制字符串
        html_entity_decode — Convert all HTML entities to their applicable characters
        htmlentities — 将字符转换为 HTML 转义字符
        htmlspecialchars_decode — 将特殊的 HTML 实体转换回普通字符
        htmlspecialchars — 将特殊字符转换为 HTML 实体
        implode — 将一个一维数组的值转化为字符串
        join — 别名 implode
        lcfirst — 使一个字符串的第一个字符小写
        levenshtein — 计算两个字符串之间的编辑距离
        localeconv — Get numeric formatting information
        ltrim — 删除字符串开头的空白字符（或其他字符）
        md5_file — 计算指定文件的 MD5 散列值
        md5 — 计算字符串的 MD5 散列值
        metaphone — Calculate the metaphone key of a string
        money_format — 将数字格式化成货币字符串
        nl_langinfo — Query language and locale information
        nl2br — 在字符串所有新行之前插入 HTML 换行标记
        number_format — 以千位分隔符方式格式化一个数字
        ord — 返回字符的 ASCII 码值
        parse_str — 将字符串解析成多个变量
        print — 输出字符串
        printf — 输出格式化字符串
        quoted_printable_decode — 将 quoted-printable 字符串转换为 8-bit 字符串
        quoted_printable_encode — 将 8-bit 字符串转换成 quoted-printable 字符串
        quotemeta — 转义元字符集
        rtrim — 删除字符串末端的空白字符（或者其他字符）
        setlocale — 设置地区信息
        sha1_file — 计算文件的 sha1 散列值
        sha1 — 计算字符串的 sha1 散列值
        similar_text — 计算两个字符串的相似度
        soundex — Calculate the soundex key of a string
        sprintf — Return a formatted string
        sscanf — 根据指定格式解析输入的字符
        str_getcsv — 解析 CSV 字符串为一个数组
        str_ireplace — str_replace 的忽略大小写版本
        str_pad — 使用另一个字符串填充字符串为指定长度
        str_repeat — 重复一个字符串
        str_replace — 子字符串替换
        str_rot13 — 对字符串执行 ROT13 转换
        str_shuffle — 随机打乱一个字符串
        str_split — 将字符串转换为数组
        str_word_count — 返回字符串中单词的使用情况
        strcasecmp — 二进制安全比较字符串（不区分大小写）
        strchr — 别名 strstr
        strcmp — 二进制安全字符串比较
        strcoll — 基于区域设置的字符串比较
        strcspn — 获取不匹配遮罩的起始子字符串的长度
        strip_tags — 从字符串中去除 HTML 和 PHP 标记
        stripcslashes — 反引用一个使用 addcslashes 转义的字符串
        stripos — 查找字符串首次出现的位置（不区分大小写）
        stripslashes — 反引用一个引用字符串
        stristr — strstr 函数的忽略大小写版本
        strlen — 获取字符串长度
        strnatcasecmp — 使用“自然顺序”算法比较字符串（不区分大小写）
        strnatcmp — 使用自然排序算法比较字符串
        strncasecmp — 二进制安全比较字符串开头的若干个字符（不区分大小写）
        strncmp — 二进制安全比较字符串开头的若干个字符
        strpbrk — 在字符串中查找一组字符的任何一个字符
        strpos — 查找字符串首次出现的位置
        strrchr — 查找指定字符在字符串中的最后一次出现
        strrev — 反转字符串
        strripos — 计算指定字符串在目标字符串中最后一次出现的位置（不区分大小写）
        strrpos — 计算指定字符串在目标字符串中最后一次出现的位置
        strspn — 计算字符串中全部字符都存在于指定字符集合中的第一段子串的长度。
        strstr — 查找字符串的首次出现
        strtok — 标记分割字符串
        strtolower — 将字符串转化为小写
        strtoupper — 将字符串转化为大写
        strtr — 转换指定字符
        substr_compare — 二进制安全比较字符串（从偏移位置比较指定长度）
        substr_count — 计算字串出现的次数
        substr_replace — 替换字符串的子串
        substr — 返回字符串的子串
        trim — 去除字符串首尾处的空白字符（或者其他字符）
        ucfirst — 将字符串的首字母转换为大写
        ucwords — 将字符串中每个单词的首字母转换为大写
        vfprintf — 将格式化字符串写入流
        vprintf — 输出格式化字符串
        vsprintf — 返回格式化字符串
        wordwrap — 打断字符串为指定数量的字串
 *
 * 数组处理函数
 * array_keys().array_values().array_diff().array_intersect().
 * array_merge().array_shift().array_unshift().array_pop().array_push().sort()...
 *
        array_change_key_case — 将数组中的所有键名修改为全大写或小写
        array_chunk — 将一个数组分割成多个
        array_column — 返回数组中指定的一列
        array_combine — 创建一个数组，用一个数组的值作为其键名，另一个数组的值作为其值
        array_count_values — 统计数组中所有的值
        array_diff_assoc — 带索引检查计算数组的差集
        array_diff_key — 使用键名比较计算数组的差集
        array_diff_uassoc — 用用户提供的回调函数做索引检查来计算数组的差集
        array_diff_ukey — 用回调函数对键名比较计算数组的差集
        array_diff — 计算数组的差集
        array_fill_keys — 使用指定的键和值填充数组
        array_fill — 用给定的值填充数组
        array_filter — 用回调函数过滤数组中的单元
        array_flip — 交换数组中的键和值
        array_intersect_assoc — 带索引检查计算数组的交集
        array_intersect_key — 使用键名比较计算数组的交集
        array_intersect_uassoc — 带索引检查计算数组的交集，用回调函数比较索引
        array_intersect_ukey — 用回调函数比较键名来计算数组的交集
        array_intersect — 计算数组的交集
        array_key_exists — 检查数组里是否有指定的键名或索引
        array_keys — 返回数组中部分的或所有的键名
        array_map — 为数组的每个元素应用回调函数
        array_merge_recursive — 递归地合并一个或多个数组
        array_merge — 合并一个或多个数组
        array_multisort — 对多个数组或多维数组进行排序
        array_pad — 以指定长度将一个值填充进数组
        array_pop — 弹出数组最后一个单元（出栈）
        array_product — 计算数组中所有值的乘积
        array_push — 将一个或多个单元压入数组的末尾（入栈）
        array_rand — 从数组中随机取出一个或多个单元
        array_reduce — 用回调函数迭代地将数组简化为单一的值
        array_replace_recursive — 使用传递的数组递归替换第一个数组的元素
        array_replace — 使用传递的数组替换第一个数组的元素
        array_reverse — 返回单元顺序相反的数组
        array_search — 在数组中搜索给定的值，如果成功则返回首个相应的键名
        array_shift — 将数组开头的单元移出数组
        array_slice — 从数组中取出一段
        array_splice — 去掉数组中的某一部分并用其它值取代
        array_sum — 对数组中所有值求和
        array_udiff_assoc — 带索引检查计算数组的差集，用回调函数比较数据
        array_udiff_uassoc — 带索引检查计算数组的差集，用回调函数比较数据和索引
        array_udiff — 用回调函数比较数据来计算数组的差集
        array_uintersect_assoc — 带索引检查计算数组的交集，用回调函数比较数据
        array_uintersect_uassoc — 带索引检查计算数组的交集，用单独的回调函数比较数据和索引
        array_uintersect — 计算数组的交集，用回调函数比较数据
        array_unique — 移除数组中重复的值
        array_unshift — 在数组开头插入一个或多个单元
        array_values — 返回数组中所有的值
        array_walk_recursive — 对数组中的每个成员递归地应用用户函数
        array_walk — 使用用户自定义函数对数组中的每个元素做回调处理
        array — 新建一个数组
        arsort — 对数组进行逆向排序并保持索引关系
        asort — 对数组进行排序并保持索引关系
        compact — 建立一个数组，包括变量名和它们的值
        count — 计算数组中的单元数目，或对象中的属性个数
        current — 返回数组中的当前单元
        each — 返回数组中当前的键／值对并将数组指针向前移动一步
        end — 将数组的内部指针指向最后一个单元
        extract — 从数组中将变量导入到当前的符号表
        in_array — 检查数组中是否存在某个值
        key_exists — 别名 array_key_exists
        key — 从关联数组中取得键名
        krsort — 对数组按照键名逆向排序
        ksort — 对数组按照键名排序
        list — 把数组中的值赋给一组变量
        natcasesort — 用“自然排序”算法对数组进行不区分大小写字母的排序
        natsort — 用“自然排序”算法对数组排序
        next — 将数组中的内部指针向前移动一位
        pos — current 的别名
        prev — 将数组的内部指针倒回一位
        range — 根据范围创建数组，包含指定的元素
        reset — 将数组的内部指针指向第一个单元
        rsort — 对数组逆向排序
        shuffle — 打乱数组
        sizeof — count 的别名
        sort — 对数组排序
        uasort — 使用用户自定义的比较函数对数组中的值进行排序并保持索引关联
        uksort — 使用用户自定义的比较函数对数组中的键名进行排序
        usort — 使用用户自定义的比较函数对数组中的值进行排序
 *
 */

/*
 *
    $var1 = 5;
    $var2 = 10;

    function foo(&$my_var)
    {
        global $var1;
        $var1 += 2;
        $var2 = 4;
        $my_var += 3;
        return $var2;
    }

    $my_var = 5;
    echo foo($my_var). "\n";--->4
    echo $my_var. "\n";-------->8
    echo $var1;---------------->7
    echo $var2;---------------->10
    $bar = 'foo';
    $my_var = 10;
    echo $bar($my_var). "\n";------->4

 */

/**2-8
 * 至少写出一种验证139开头的11位手机号码的正则表达式
 */

/*
 * 正则表达式的作用：分割.查找.匹配.替换
 * 分隔符：正斜线/.hash符号#以及取反符号～
 *
 */


/**2-9 文件
 * 不断在文件hello.txt头部写入一行“Hello World”字符串，要求代码完整
$file = './hello.txt';

$handle = fopen($file, 'r');

$content = fread($handle, filesize($file));

$content = 'Hello World'. $content;

fclose($handle);

$handle = fopen($file, 'w');

fwrite($handle, $content);

fclose($handle);
 *
 *
 * 通过PHP函数的方式对目录进行遍历,写出程序
 *
        function loopDir($dir)
        {
            $handle = opendir($dir);

            while(false!==($file = readdir($handle)))
            {
                if ($file != '.' && $file != '..')
                {
                    echo $file. "\n";
                    if (filetype($dir. '/'. $file) == 'dir')
                    {
                     loopDir($dir. '/'. $file);
                    }
                }
            }
        }
 */

/*
 * fopen()用来打开一个文件，打开时需要指定打开模式
 *  打开模式:
       r/r+:r只读方式打开,并将文件指针指向开头.
            r+读写方式打开,并将文件指针指向开头.
        w/w+:w只写方式打开,将文件大小清为0,清空文件,并将文件指针指向开头.文件不存在会创建
             w+:读写方式打开,将文件大小清为0,清空文件,并将文件指针指向开头.文件不存在会创建
        a/a+:追加写入/读写方式,指针指向末尾,文件不存在将创建
        x/x+:创建并写入/读写方式打开,指针指向开头,文件存在包warning错误,fopen返回false,文件不存在才创建
        b:二进制文件
        t:

写入函数:
    fwrite()
    fputs()
读取函数
    fread()
    fgets() 获取一行
    fgetc() 获取一个字符
关闭文件函数
    fclose()

不需要fopen打开的函数()
    file_get_contents()
    file_put_contents()
其他读取函数
    file()将文件读取到数组中
    readfile() 将文件读取出来并输出到缓冲区
访问远程文件
    开启allow_url_fopen,HTTP协议连接只能使用只读,FTP协议可以使用只读或者只写

目录操作函数
    名称:basename().dirname().pathinfo()
    目录读取:opendir().readdir().closedir().rewinddir()
    目录删除:rmdir()
    目录创建:mkdir()
文件大小:filesize()
磁盘空间:disk_free_space().disk_total_space()
文件拷贝:copy()
删除文件:unlink()
文件类型:filetype()
重命名:rename()
文件截取:file_exists().is_readable().is_writable().is_executable().filectime().fileatime().filemtime()
文件锁:flock()
文件指针:ftell().fseek().rewind()
*/

    /**文件相关
     *
    basename — 返回路径中的文件名部分
    chgrp — 改变文件所属的组
    chmod — 改变文件模式
    chown — 改变文件的所有者
    clearstatcache — 清除文件状态缓存
    copy — 拷贝文件
    delete — 参见 unlink 或 unset
    dirname — 返回路径中的目录部分
    disk_free_space — 返回目录中的可用空间
    disk_total_space — 返回一个目录的磁盘总大小
    diskfreespace — disk_free_space 的别名
    fclose — 关闭一个已打开的文件指针
    feof — 测试文件指针是否到了文件结束的位置
    fflush — 将缓冲内容输出到文件
    fgetc — 从文件指针中读取字符
    fgetcsv — 从文件指针中读入一行并解析 CSV 字段
    fgets — 从文件指针中读取一行
    fgetss — 从文件指针中读取一行并过滤掉 HTML 标记
    file_exists — 检查文件或目录是否存在
    file_get_contents — 将整个文件读入一个字符串
    file_put_contents — 将一个字符串写入文件
    file — 把整个文件读入一个数组中
    fileatime — 取得文件的上次访问时间
    filectime — 取得文件的 inode 修改时间
    filegroup — 取得文件的组
    fileinode — 取得文件的 inode
    filemtime — 取得文件修改时间
    fileowner — 取得文件的所有者
    fileperms — 取得文件的权限
    filesize — 取得文件大小
    filetype — 取得文件类型
    flock — 轻便的咨询文件锁定
    fnmatch — 用模式匹配文件名
    fopen — 打开文件或者 URL
    fpassthru — 输出文件指针处的所有剩余数据
    fputcsv — 将行格式化为 CSV 并写入文件指针
    fputs — fwrite 的别名
    fread — 读取文件（可安全用于二进制文件）
    fscanf — 从文件中格式化输入
    fseek — 在文件指针中定位
    fstat — 通过已打开的文件指针取得文件信息
    ftell — 返回文件指针读/写的位置
    ftruncate — 将文件截断到给定的长度
    fwrite — 写入文件（可安全用于二进制文件）
    glob — 寻找与模式匹配的文件路径
    is_dir — 判断给定文件名是否是一个目录
    is_executable — 判断给定文件名是否可执行
    is_file — 判断给定文件名是否为一个正常的文件
    is_link — 判断给定文件名是否为一个符号连接
    is_readable — 判断给定文件名是否可读
    is_uploaded_file — 判断文件是否是通过 HTTP POST 上传的
    is_writable — 判断给定的文件名是否可写
    is_writeable — is_writable 的别名
    lchgrp — 修改符号链接的所有组
    lchown — 修改符号链接的所有者
    link — 建立一个硬连接
    linkinfo — 获取一个连接的信息
    lstat — 给出一个文件或符号连接的信息
    mkdir — 新建目录
    move_uploaded_file — 将上传的文件移动到新位置
    parse_ini_file — 解析一个配置文件
    parse_ini_string — 解析配置字符串
    pathinfo — 返回文件路径的信息
    pclose — 关闭进程文件指针
    popen — 打开进程文件指针
    readfile — 输出文件
    readlink — 返回符号连接指向的目标
    realpath_cache_get — 获取真实目录缓存的详情
    realpath_cache_size — 获取真实路径缓冲区的大小
    realpath — 返回规范化的绝对路径名
    rename — 重命名一个文件或目录
    rewind — 倒回文件指针的位置
    rmdir — 删除目录
    set_file_buffer — stream_set_write_buffer 的别名
    stat — 给出文件的信息
    symlink — 建立符号连接
    tempnam — 建立一个具有唯一文件名的文件
    tmpfile — 建立一个临时文件
    touch — 设定文件的访问和修改时间
    umask — 改变当前的 umask
    unlink — 删除文件
     */

/**2-10 会话控制
 *简述cookie和session的区别以及各自的工作机制,存储位置等,简述cookie的优缺点
 *
 * Session信息的存储方式,如何进行遍历
 */

/*
 * cookie是只读的.不要了,只能让它过期,不会占用服务器资源
 * session信息储存在服务器
 * session_start() $_SESSION=[]赋值为空和session_destroy()删除整个session文件,保存在cookie中的键名PHPSESSID
 *
 * php.ini中
 * session.auto_start
 * session.cookie_domain
 * session.cookie__lifetime
 * session.cookie__path
 * session.name
 * session.save_path
 * session.use_cookies
 * session.use_trans_sid
 *
 *session的垃圾回收机制
 * session.gc_probability =1
 * session.ge_divisor=100    每100次的session_start就会清理1次文件，并且这个文件满足当前时间-最后修改时间>1440
 * session.gc_maxlifetime =1440 最大生命周期
 *
 * session.save_handler
 * session 安全,但是占用服务器资源,如果有多台服务器,session不共享.要用到redis
 *
 * 传递SessionID
 * session是基于cookie,sessionid储存在cookie,禁用了cookie,
 * session_name()和session_id()
 * <a href="1.php?<?php echo session_name().'='.session_id();?>"></a>
 * <a href="1.php?<?php echo SID;?>"></a> SID cookie开启SID为空,cookie禁用了SID就等于session_name().'='.session_id()
 *
 * SESSION存储
 * session_set_save_handler() 存储到mysql redis memcache
 */

/**2-11对象
 *
 * 请写出PHP类权限控制修饰符
 * public.protect.private
 * protect:不能在类外部使用
 * private:不能被继承.不能在类外部使用
 */

/*面向对象特性:封装.继承.多态
 *php的继承是单一继承
 *
 * 抽象类:用abstract.方法定义抽象类.类必须定义成抽象类
 * 接口:interface
 *
 * 魔术方法:
 * __construct()(构造函数).__destruct()(析构函数).__call().__callStatic().__get().__set().__isset().
 * __unset().__sleep().__wakeup().__toString().__clone()
 *
 * 常见设计模式:工厂模式.单例模式.注册树模式.适配器模式.观察者模式和策略模式
 */

/**2-12网络协议
 *HTTP/1.1中,状态码200 301 304 403 404 500的含义
 * 一二三四五原则: 一. 消息系列	二. 成功系列   三. 重定向系列	四. 请求错误系列	五. 服务器端错误系列
 * 200是请求成功，
 * 302:临时转移成功，请求的内容已转移到新位置
 * 401代表未授权。
 * 403:禁止访问
 * 404是文件未找到，
 * 500:服务器内部错误
 * 502是服务器内部错误。
 *
 * 我们常见的HTTP协议.TCP协议分别位于OSI网络模型的第几层?
 *第七和第四 应用层和传输层
 */

/*
 * HTTP协议常见状态码:
 * 200:请求成功，
 * 204:无内容。服务器成功处理，但未返回内容。
 * 206:服务器已经成功处理了部分 GET 请求
 * 301:永久移动。请求的资源已被永久的移动到新URI，返回信息会包括新的URI，浏览器会自动定向到新URI
 * 302:临时移动。与301类似。但资源只是临时被移动。客户端应继续使用原有URI
 * 303:查看其它地址。
 * 304:未修改。所请求的资源未修改，服务器返回此状态码时，不会返回任何资源。
 * 307:临时重定向
 * 400:客户端请求的语法错误，服务器无法理解
 * 401:请求要求用户的身份认证
 * 403:服务器理解请求客户端的请求，但是拒绝执行此请求
 * 404:服务器无法根据客户端的请求找到资源（网页）。
 * 500:服务器内部错误，无法完成请求
 * 503:由于超载或系统维护，服务器暂时的无法处理客户端的请求。延时的长度可包含在服务器的Retry-After头信息中
 *
 * OSI七层模型
 *  物理层:建立.维护.断开物理连接
 *  数据链路层:建立逻辑连接.进行硬件地址寻址.差错校验等功能
 *  网络层:进行逻辑地址寻址.实现不同网络之间的路劲选择
 *  传输层:定义传输数据的协议端口号.以及流控和差错校验.
 *          协议有:TCP UDP .数据包一旦离开网卡即进入网络传输层
 *  会话层:建立.管理.终止会话
 *  表示层:数据的表示.安全.压缩
 *  应用层:网络服务与最终用户的一个接口
 *          协议有:HTTP FTP TFTP SMTP SNMP DNS TELNET HTTPS POP3 DHCP
 *
 * HTTP协议的工作特点和工作原理
 *工作特点:基于B/S模式  通信开销小.简单快速.传输成本低  使用灵活.可使用超文本传输协议  节省传输时间  无状态
 *工作原理:客户端发送请求给服务器,创建一个TCP连接,指定端口号,默认80,连接到服务器,服务器监听浏览器请求,一旦
 *          监听到客户端请求,分析请求类型后,服务器会向客户端返回状态信息和数据内容
 *
 * HTTP协议常见请求/响应头
 *      Content_Type.Accept.Origin.Cookie.Cache_Contro,User-Agent,Referrer,X-Forwarder-For,
 *      Access-Control-Allow-Origin.Last-Modified
 *
 * HTTP协议的请求方法
 *  GET.POST.HEAD.OPTIONS.PUT.DELETE.TRACE
 *
 * HTTPS的工作原理
 *  HTTPS是一种基于SSL/TLS的HTTP协议.所有的HTTP数据都是在SSL/TLS协议封装之上传输的
 *  HTTPS协议在HTTP协议的基础上,添加了SSL/TLS握手以及数据加密传输,也属于应用层协议
 *
 * 常见的网络协议含义以及端口
 *  FTP.文件传输协议 21
 * Telnet.远程登录的端口,可以提供一种基于dos模式下的通信服务 23
 * SMTP.简单邮件通信协议   25
 * POP3.接受邮件 110
 * HTTP.超文本传输协议 80
 * DNS 用于域名,解析服务 53
 */

/**2-13
 * 您是否使用过版本控制软件?如果有您用的版本控制软件的名字是什么?
 *
 *
 */

/*
 * 版本控制软件
 *   集中式 CVS SVN
 *   分布式 Git
 *
 * PHP运行原理
 *  CGI协议 FastCGI
 *
 * PHP常见配置选项
 *      register_globals.allow_url_fopen.allow_url_include.
 *      date.timezone.display_errors.error_reporting.safe_mode.upload_max_filesize.
 *      max_file_uploads.post_max_size
 */

/**3-1
 * 下列不属于JavaScript语法关键/保留字的是(var.$.function.while)
 *
 * javascript中为id是test的元素设置样式为good
 *      document.getElementById('test').calssName='good';
 *
 * 要求使用jQuery时间写在页面元素加载完成之后,动态绑定click事件到btnOk元素
 *      $(function(){$(".btnOk").click(function(){})})
 */

/*数据类型
 *  字符串.数字.布尔.数组.对象.null.undefined
 *   变量均为对象
 * 函数
 *      无默认值
 *      函数内部声明的变量(使用 var)是局部变量
 *      在函数外声明的变量是全局变量,所有脚本和函数都能访问它
 * javascript内置对象
 *      window对象:window.navigator.screen.history.location
 *      dom对象:document.element.attr.event
 *
 */

/**3-2
 * AJAX技术利用了什么协议?简述AJAX的工作机制.
 *
 *
 * 要求写出jQuery中.可以处理AJAX的几种方法.
 */

/*
 *ajax操作
 * 常用方法 $(ele).load(),$.ajax(),$.get(),$.post(),$.getJSON(),$.getScript()
 */

/**4-1
 * 写出尽可能多的linux命令
 * 如何实行每天0点重启服务器
 *      crontab -e
 *      00***   reboot
 */

/*linux常用命令
 * 定时任务
 *  crontab -e创建定时任务
 *  *****(分时日月周) 命令
 * at
 *    at 2:00 tomorrow
 *      at>/home/hwm/do_job
 *      at>ctrl+D
 *
 */