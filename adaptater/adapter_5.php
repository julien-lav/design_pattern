<?php 

interface IAdapterClient
{
	public function getList();
}

class AdapterClientCsv implements IAdapterClient
{
	private $_fichier = null;

	public function __construct($p_fichier)
	{
		$this->_fichier = $p_fichier;
	}

	public function getList()
	{
		$handle = fopen($this->_fichier, "r");
		/*//*/
		return $list;
	}
}

class AdaptaterClientMySQL implements IAdapterClient
{
    public function getList()
    {
        $oBdd = new SQL();
        $oBdd->query('SELECT * FROM client');
        /*//*/
        return $list;
    }
}

class Client
{
	private $_adapter;

	public function setAdapter(IAdapterClient $p_adapter)
	{
		$this->_adapter = $p_adapter;
	}
	public function getList()
	{
		/*//*/
		return $this->_adapter.getList();
	}
}

/* Index.php */

$oClient = new Client();
$oAdapterClient = new AdapterClientCsv('liste_clients.csv');

$oClient->setAdapter($oAdapterClient);

echo $oClient->getList();