<?php

class Connection
{
	var $Host;
	var $Login;
	var $Pass;
	var $Database;
	var $Link;

	public function __construct ($Host, $Login, $Pass, $Database)
	{
		$this->Host = $Host;
		$this->Login = $Login;
		$this->Pass = $Pass;
		$this->Database = $Database;
		$this->Link = null;
	}
	
	public function Connect()
	{
		$this->Link = new mysqli($this->Host, $this->Login, $this->Pass);

		if ($this->Link != null && $this->Database != '')
		{
			mysqli_select_db($this->Link, $this->Database);
			return true;
		}

		return false;
	}

	public function Disconnect()
	{
		if ($this->Link != null)
		{
			$this->Link->close();
			$this->Link = null;
		}
	}

	public function ExecuteDataset($Query)
	{
		$Output = Array();

		if ($this->Link != null)
		{
			$Result = $this->Link->query($Query);

			if ($Result != null)
			{
				while ($Row = mysqli_fetch_object($Result))
				{
					$Output[] = $Row;
				}
			}
		}

		return $Output;
	}

	public function ExecuteMultiQuery($Query)
	{
		$Result = null;

		if ($this->Link != null)
		{
			$Result = $this->Link->multi_query($Query);
		}

		return $Result;
	}

	public function GetLastInsertID()
	{
		if ($this->Link != null)
		{
			return $this->Link->$insert_id;
		}
	}
}

?>
