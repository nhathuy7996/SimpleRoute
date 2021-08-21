<?php

// Lớp database
class HuyDB
{
	// Các biến thông tin kết nối
	private $hostname = 'localhost',
			$username = 'root',
			$password = '',
			$dbname = 'bloghuynn';

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
		return self::$cn;
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
	    
		return mysqli_query($this->connect(), $sql);
	    
	}

	// Hàm đếm số hàng
	public function num_rows($sql = null) 
	{
		
		$query = mysqli_query($this->connect(), $sql);
		if ($query)
		{
			$row = mysqli_num_rows($query);
			return $row;
		}	
			
	}
	public function fetch_secu($sql,$types = null,$params = null, $getmulti = true) {

		$stmt = $this->connect()->prepare($sql);
		$stmt->bind_param($types, ...$params);
	
		if(!$stmt->execute()) return false;
		$res = $stmt->get_result();
	
		if ($getmulti == 0)
		{
			// Lấy nhiều dữ liệu gán vào mảng
			$data = array();
			while ($row = $res->fetch_object())
			{
				$data[] = $row;
			}
			
		}
		else 
		{
			// Lấy một hàng dữ liệu gán vào biến
			$data = $res->fetch_object();

		}
			
		return $data;
	}

	public function fetch_obj($sql = null, $type = 0)
	{
		
		$query = mysqli_query($this->connect(), $sql);
		if ($query)
		{
			if ($type == 0)
			{
				// Lấy nhiều dữ liệu gán vào mảng
				$data = array();
				while ($obj= mysqli_fetch_object($query))
				{
					$data[] = $obj;
				}
				return $data;
			}
			else if ($type == 1)
			{
				// Lấy một hàng dữ liệu gán vào biến
				$data = mysqli_fetch_object($query);
				return $data;
			}
		}		
		
	}
	// Hàm lấy dữ liệu
	public function fetch_assoc($sql = null, $type = 0)
	{
		
		$query = mysqli_query($this->connect(), $sql);
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

	public function Security($sql = null){
		return mysqli_real_escape_string(self::$cn,$sql);
	}

	// Hàm lấy ID cao nhất
	public function insert_id()
	{
		
		$count = mysqli_insert_id($this->connect());
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

	// Hàm charset cho database
	public function set_char($uni)
	{
		
		mysqli_set_charset($this->connect(), $uni);
		
	}
}

?>