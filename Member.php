<?php

/**
 * 实例说明[魔术方法的使用]：
 * public __call(string $name, array $arguments) : mixed
 * public static __callStatic(string $name, array $arguments) : mixed
 * __call() 在对象中调用一个不可访问方法时被调用
 * __callStatic() 在静态上下文中调用一个不可访问方法时被调用
 * $name 参数是要调用的方法名称，$arguments 参数是一个枚举数组，包含着要传递给方法 $name 的参数
 */

/**
 * Class Member
 */
class Member
{
    /**
     * 创建受保护静态属性:数组
     * @var array
     */
    protected static $memberData = [];

    /**
     * 获取调用当前方法的类名
     * 即:当前方法静态绑定的类名: 如 User
     * @var null
     */
    protected static $feature = null;

    /**
     * 当调用的静态方法不存在或权限不足时，会自动调用__callStatic方法
     * @param $func
     * @param $arguments
     * @return mixed|string
     */
    public static function __callStatic($func, $arguments)
    {
        /**
         * explode():用'_'字符串分割为数组
         * list():将数组元素转为对应的独立变量:$type, $name
         */
        list($type, $name) = explode('_', $func);

        /**
         * 如何$type字符串不在数组'set'和'get'中任何一个
         * 或者$name为空的话,则调用的静态方法名称不正确,直接返回'空';
         */
        if (!in_array($type, array('set', 'get')) || $name == '') {
            return '';
        }

        self::$feature = get_called_class();

        switch ($type) {
            /**
             * 如果$type = 'set',则是给属性$memberData赋值
             */
            case 'set':
                self::$memberData[self::$feature][$name] = implode(' | ', $arguments);
                break;

            /**
             * 如果$type = 'get',则是获取属性$memberData的值
             */
            case 'get':
                return isset(self::$memberData[self::$feature][$name]) ? self::$memberData[self::$feature][$name] : '';
                break;

            default:
                break;
        }
    }

    /**
     * 输出数据
     */
    public static function show()
    {
        if (self::$memberData[self::$feature]) {
            foreach (self::$memberData[self::$feature] as $key => $member) {
                echo $key . '：' . $member . '<br />';
            }
        }
    }
}

/**
 * Class User
 * @method static set_name(string $string, string $string1)
 * @method static get_name(string $string)
 */
class User extends Member
{
}

/**
 * Class Profession
 * @method static set_name(string $string)
 */
class Profession extends Member
{
    /**
     * 定义公共静态方法:show(),用来输出数据
     */
    public static function show()
    {
        /**
         * 如果self::$memberData[self::$feature]属性存在
         */
        if (self::$memberData[self::$feature]) {
            foreach (self::$memberData[self::$feature] as $key => $member) {
                echo $key . '：' . $member . "\n\r<br />";
            }
        }
    }

    /**
     * @param $name
     * @return array|string
     */
    public function test($name)
    {
        return '' ?: [];
    }
}

/**
 * 静态调用set_name(),set_age()
 * 当前类User和父类中都没有set_name静态方法,于是自动触发父类__callStatic()方法
 * 父类Member中的__callStatic($func,$arguments)是系统魔术方法
 * 在__callStatic方法中,方法名set_name转换为变量$type和$name
 * 并根据$type,完成属性的动态赋值或读取操作
 * set_name(),set_age()分别完成了对$memberData[$feature]属性的动态赋值操作
 */
User::set_name('ThinkPHP', 'php');
User::set_age(10);
User::show();

/**
 * 静态调用set_profession(),set_price()
 * 当前类User和父类中都没有set_name静态方法,于是自动触发父类__callStatic()方法
 * 父类Member中的__callStatic($func,$arguments)是系统魔术方法
 * 在__callStatic方法中,方法名set_name转换为变量$type和$name
 * 并根据$type,完成属性的动态赋值或读取操作
 * set_name(),set_age()分别完成了对$memberData[$feature]属性的动态赋值操作
 */
Profession::set_lession('模型');
Profession::set_teacher('理达课堂');
Profession::show();

Member::set_name('Arron');
Member::show();

