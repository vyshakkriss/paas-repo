<?php

/**
 * Models
 */
class Models extends Database
{
	
	
	public function showAll($data='')
	{
		$q = "select * from ".$this->table;
		$res = $this->query($q);
		if(property_exists($this, 'afterSelect'))
		{
			//echo "hi";
			//show($res);
			foreach ($this->afterSelect as $function) {
				// code...
				$res = $this->$function($res);
			}
		}
		return $res;
		
	}

	public function insert($data)
	{
		//Check for the alloweded Colmuns

		if(!empty($this->allowedCols))
		{
			foreach ($data as $key => $value) {
				// code...
				if(!in_array($key, $this->allowedCols))
				{
					unset($data[$key]);
				}
			}
		}
		
		
		$query = "insert into ".$this->table;
		$cols = array_keys($data);
		$query .="(".implode(',', $cols).") values(:".implode(',:', $cols).")";
		
		$res = $this->query($query,$data);
		
	}

	public function update($data,$col)
	{
		//show($data);
		$colValue = array_values($col);
		
		$col = array_keys($col);
	
		$col=implode('',$col);
	
		$data[$col]=$colValue[0];
		
		$query = "update ";
		$query.=$this->table;
		$query.=" set ";
		$keys = array_keys($data);
		foreach ($keys as $key) {
			$query.=$key . "=:" . $key . " ,";
		}
		$query= trim($query, ",");
		$query.=" where ". $col ."=:" . $col;
		
		$res = $this->query($query,$data);
		
		//echo $query;
		//show($data); 
	}
	public function delete($data)
	{
		
		$col = array_keys($data)[0];

		$query = "delete from ".$this->table;
		$query .=" where ".$col." =:".$col;
		
		$this->query($query,$data);
	}
	public function where($data,$order = '',$condition = [])
	{
		//$query = "Select * from table where cols = :col limit 1";
		$query = "select * from ". $this->table . " where ";
		
		$col = array_keys($data);
		
		if(empty($condition))
		{
			//$col = array_keys($data);
			$query.=$col[0] . "=:" . $col[0];
		}
		else
		{
			
			for ($i=0; $i <= count($condition); $i++) 
			{ 
					$query.=$col[$i]."=:".$col[$i];
					if($i<count($condition))
					{
						$query.=" ".$condition[$i]. " ";
					}
			}
		}
		if(!empty($order))
		{
			$query.=" order by ". $order." DESC";
		}
		//	echo $query;

		$res = $this->query($query,$data);

		if($res)
		{
			//Running afterSelect function
			if(property_exists($this, 'afterSelect'))
			{
				foreach ($this->afterSelect as $function) {
					// code...
					$res = $this->$function($res);
				}
			}
			return $res;
		}
		
		return false;
	}

}