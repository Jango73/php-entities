<?php

class Strings
{
	var $Data;
	var $Lang;

	public function __construct($Lang)
	{
		$this->Lang = $Lang;

		$this->Data = Array(
			"en" => Array(
				"HOME" => "Home"
			),
			"fr" => Array(
				"HOME" => "Accueil"
			)
		);
	}

	public function SetData($NewData)
	{
		$this->Data = $NewData;
	}

	public function GetString($Code)
	{
		if (isset($this->Data[$this->Lang]))
		{
			if (isset($this->Data[$this->Lang][$Code]))
			{
				return $this->Data[$this->Lang][$Code];
			}
		}

		return $Code;
	}
}

?>
