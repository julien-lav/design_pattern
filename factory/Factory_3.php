<?php


class FabriqueBase 
{
	public static function get ($baseNom)
	{
		switch ($baseNom)
		{
			case 'mysql':
				return (new MySQL());
				break; 
			case 'postgre':
				return (new PostGreSQL());
				break; 
			case 'marvin':
				return (new Oracle());
				break; 
		}
	}
}

$base = FabriqueBase::get('mysql');
$base->executer($request);