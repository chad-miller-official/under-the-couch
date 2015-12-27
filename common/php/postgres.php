<?
	class DBConnection
	{
		private $connection;
		private $dbtype;
		private $result_set_array = array();
		private $closed = false;

		public function __construct($dbtype)
		{
			$this->dbtype = $dbtype;

			switch($dbtype)
			{
				case SQL_TYPE_MYSQL:
					$this->connection = mysqli_connect(SQL_MYSQL_HOST, SQL_MYSQL_USER, SQL_MYSQL_PASS, SQL_MYSQL_DB);
					break;
				case SQL_TYPE_POSTGRESQL:
					$connection_str = ' host='     . SQL_POSTGRESQL_HOST .
					                  ' port='     . SQL_POSTGRESQL_PORT .
								      ' dbname='   . SQL_POSTGRESQL_DB .
									  ' user='     . SQL_POSTGRESQL_USER .
									  ' password=' . SQL_POSTGRESQL_PASS;

					$this->connection = pg_connect($connection_str);
					break;
			}
		}

		public function __destruct()
		{
			$this->close();
		}

		public function prepare_and_execute($query, $name, $args=array())
		{
			switch($this->dbtype)
			{
				case SQL_TYPE_MYSQL:
					$result = mysqli_prepare($this->connection, $query);
					mysqli_execute($result);
					break;
				case SQL_TYPE_POSTGRESQL:
					$result = pg_prepare($this->connection, $name, $query);
					$result = pg_execute($this->connection, $name, $args);
					break;
			}

			$this->result_set_array[$name] = $result;
			return $result;
		}

		public function fetch_array($name)
		{
			switch($this->dbtype)
			{
				case SQL_TYPE_MYSQL:
					return mysqli_fetch_array($this->result_set_array[$name]);
				case SQL_TYPE_POSTGRESQL:
					return pg_fetch_array($this->result_set_array[$name]);
			}
		}

		public function fetch_row($name)
		{
			switch($this->dbtype)
			{
				case SQL_TYPE_MYSQL:
					return mysqli_fetch_row($this->result_set_array[$name]);
				case SQL_TYPE_POSTGRESQL:
					return pg_fetch_row($this->result_set_array[$name]);
			}
		}

		public function fetch_all($name)
		{
			switch($this->dbtype)
			{
				case SQL_TYPE_MYSQL:
					return mysqli_fetch_all($this->result_set_array[$name]);
				case SQL_TYPE_POSTGRESQL:
					return pg_fetch_all($this->result_set_array[$name]);
			}
		}

		public function free_result($name)
		{
			if(!isset($this->result_set_array[$name]))
				return;

			switch($this->dbtype)
			{
				case SQL_TYPE_MYSQL:
					$free_result = mysqli_free_result($this->result_set_array[$name]);
				case SQL_TYPE_POSTGRESQL:
					$free_result = pg_free_result($this->result_set_array[$name]);
			}

			unset($this->result_set_array[$name]);
			return $free_result;
		}

		public function close()
		{
			if($this->closed)
				return;

			$this->closed = true;

			foreach($this->result_set_array as $name => $result_set)
				$this->free_result($name);

			switch($this->dbtype)
			{
				case SQL_TYPE_MYSQL:
					return mysqli_close($this->connection);
				case SQL_TYPE_POSTGRESQL:
					return pg_close($this->connection);
			}
		}
	}
?>
