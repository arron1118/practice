<?php


class Db
{
    private static $conn = null;    // 数据库连接资源
    private static $error = '';     // 错误信息
    private static $errno = 0;      // 错误号
    private static $instance = null;    // Db实例

    /**
     * 数据库配置信息
     * @var string[]
     */
    private static $config = [
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'dbname' => 'practice',
        'port' => '3306',
        'charset' => 'utf8',
        'prefix' => ''
    ];

    /**
     * protected 禁止外部 new 实例化
     * Db constructor.
     */
    protected function __construct(){}

    /**
     * 连接数据库
     * @param array $config
     * @return string
     */
    private static function connect($config = [])
    {
        if (empty($config)) {
            $config = include_once('./db.config.php');
        }

        self::$config = array_merge(self::$config, $config);

        $conn = mysqli_connect(self::$config['host'], self::$config['username'], self::$config['password'], self::$config['dbname']);
        if ($conn) {
            self::$conn = $conn;
            self::query('SET charset ' . self::$config['charset']);
        } else {
            self::$errno = mysqli_connect_errno();
            self::$error = mysqli_connect_error();
            return self::$error;
        }
    }

    /**
     * 获取Db实例
     * @param array $config
     * @return Db|string|null
     */
    public static function getInstance($config = [])
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        self::connect($config);
        if (self::$error) {
            die('Connect Failed: ' . self::$error);
        }

        return self::$instance;
    }

    /**
     * @param $sql
     * @return bool|mysqli_result
     */
    public static function query($sql)
    {
        $res = mysqli_query(self::$conn, $sql);

        if (!$res) {
            self::$error = mysqli_error(self::$conn);
            self::$errno = mysqli_errno(self::$conn);
        }

        return $res;
    }

    /**
     * @param array $data
     * @return array
     */
    private static function fetchAssoc($data = [])
    {
        $res = [];
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $res[] = $row;
            }
        }

        return $res;
    }

    /**
     * 获取所有表信息
     * @return array
     */
    public static function getTables()
    {
        $dbname = self::$config['dbname'];
        $sql = <<<SQL
SELECT table_name, table_rows, engine, table_type, table_collation, create_time, update_time,
CONCAT(ROUND((data_length + index_length) / 1024 / 1024, 2), 'MB') data_size, table_comment
FROM
    information_schema.tables
WHERE table_schema = "$dbname"
SQL;
echo $sql;
        return self::fetchAssoc(self::query($sql));
    }

    /**
     * 获取表的列
     * @param $tbName
     * @return array
     */
    public static function getColumns($tbName)
    {
        $dbname = self::$config['dbname'];
        $sql = <<<SQL
SELECT column_name, column_type, column_key, column_comment FROM information_schema.columns WHERE table_schema = "$dbname" AND table_name = "$tbName"
SQL;
        
        return self::fetchAssoc(self::query($sql));
    }

    /**
     * 修改表名
     * @param $oldName
     * @param $newName
     * @return bool|mysqli_result
     */
    public static function renameTable($oldName, $newName)
    {
        $sql = 'ALTER TABLE ' . $oldName . ' RENAME TO ' . $newName;
        return self::query($sql);
    }

    public static function getConfig()
    {
        return self::$config;
    }

    /**
     * 获取错误信息
     * @return string
     */
    public static function getError()
    {
        return self::$error;
    }

    /**
     * 获取错误号
     * @return int
     */
    public static function getErrno()
    {
        return self::$errno;
    }

}