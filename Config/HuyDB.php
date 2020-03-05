<?php

// Lớp database
class HuyDB
{
	// Các biến thông tin kết nối
	private $hostname = 'localhost',
			$username = 'root',
			$password = '',
			$dbname = 'web';

	// Biến lưu trữ kết nối
	private static $cn = NULL;

	private static $instant = null;

	public function __construct(){
		
		if(empty(self::$instant)){
			self::$instant = $this;
		}
		$this->connect();
	}

	public static function Instant(){
		if(empty(self::$instant)){
			self::$instant = new HuyDB();
		}
	
		return self::$instant;
	}

	// Hàm kết nối
	function connect()
	{
		if(empty(self::$cn))
			self::$cn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);
	}

	// Hàm ngắt kết nối
	function close()
	{
	    if (self::$cn)
	    {
	        mysqli_close(self::$cn);
	    }
	}

	// Hàm truy vấn
	public function query($sql = null) 
	{		
	    if (self::$cn)
	    {
			return mysqli_query(self::$cn, $sql);
	    }
	}

	// Hàm đếm số hàng
	public function num_rows($sql = null) 
	{
		if (self::$cn)
		{
			$query = mysqli_query(self::$cn, $sql);
			if ($query)
			{
				$row = mysqli_num_rows($query);
				return $row;
			}	
		}		
	}

	// Hàm lấy dữ liệu
	public function fetch_assoc($sql = null, $type = 0)
	{
		if (self::$cn)
		{
			$query = mysqli_query(self::$cn, $sql);
			if ($query)
			{
				if ($type == 0)
				{
					// Lấy nhiều dữ liệu gán vào mảng
					$data = array();
					while ($row = mysqli_fetch_assoc($query))
					{
						$data[] = $row;
					}
					return $data;
				}
				else if ($type == 1)
				{
					// Lấy một hàng dữ liệu gán vào biến
					$data = mysqli_fetch_assoc($query);
					return $data;
				}
			}		
		}
	}

	public function Security($sql = null){
		return mysqli_real_escape_string(self::$cn,$sql);
	}

	// Hàm lấy ID cao nhất
	public function insert_id()
	{
		if (self::$cn)
		{
			$count = mysqli_insert_id(self::$cn);
			if ($count == '0')
			{
				$count = '1';
			}
			else
			{
				$count = $count;
			}
			return $count;
		}
	}

	// Hàm charset cho database
	public function set_char($uni)
	{
		if (self::$cn)
		{
			mysqli_set_charset(self::$cn, $uni);
		}
	}
}

?>