<?php


class Db
{
    private static $conn = null;
    private static $connect_error = '';
    private static $connect_errno = 0;
    private static $instance = null;
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

    private static function connect($config = [])
    {
        if (empty($config)) {
            $config = include_once('./db.config.php');
        }

        self::$config = array_merge(self::$config, $config);

        $conn = mysqli_connect(self::$config['host'], self::$config['username'], self::$config['password'], self::$config['dbname']);
        if ($conn) {
            self::$conn = $conn;
            self::query('set charset ' . self::$config['charset']);
        } else {
            self::$connect_errno = mysqli_connect_errno();
            self::$connect_error = mysqli_connect_error();
            return self::$connect_error;
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
        if (self::$connect_error) {
            die('Connect Failed: ' . self::$connect_error);
        }

        return self::$instance;
    }

    public static function query($sql)
    {
        return self::fetchAssoc(mysqli_query(self::$conn, $sql));

    }

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

    public static function getConfig()
    {
        return self::$config;
    }

    public static function getError()
    {
        return self::$connect_error;
    }

    public static function getErrno()
    {
        return self::$connect_errno;
    }

}