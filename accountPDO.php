<?php

require_once "account.php";

class accountPDO
{

	private $db;
	private $lkm;


	function __construct($dsn = "mysql:host=localhost;dbname=a1103474", $user="root", $password="salainen")
	{
// Ota yhteys kantaan
		$this->db = new PDO($dsn, $user, $password);

// Virheiden jäljitys kehitysaikana
  		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// Tulosrivien määrä
		$lkm = 0;
    }
    
    function getLkm() {
    	return $this->lkm;
    }

    public function allAccounts()
    {
        $sql = "SELECT id, customerNumber, name, ssn, gender, accountNumber, balance, accountType, additionalInfo FROM account" ;

// Valmistellaan lause, prepare on PDO-luokan metodeja
        if (! $stmt = $this->db->prepare($sql))
			throw new PDOException("prepare", 2);

// Ajetaan lauseke
        if (!$stmt->execute())
      		throw new PDOException("execute", 3);
      		
// Käsittellään hakulausekkeen tulos
        $tulos = array();
        
// Pyydetään haun tuloksista kukin rivi kerrallaan
        while ($row = $stmt->fetchObject()) {
        	// Tehdään tietokannasta haetusta rivistä leffa-luokan olio
        	$account = new Account();
			
        	$account->setId($row->id);
        	$account->setCustomerNumber($row->customerNumber);
        	$account->setName(utf8_encode($row->name));
        	$account->setSsn($row->ssn);
        	$account->setGender($row->gender);
        	$account->setAccountNumber($row->accountNumber);
        	$account->setBalance($row->balance);
        	$account->setType($row->accountType);
        	$account->setInfo(utf8_encode($row->additionalInfo));
        	// Laitetaan olio tulos taulukkoon (olio-taulukkoon)
        	$tulos[] = $account;	
        }

		$this->lkm = $stmt->rowCount();
		
		return $tulos;
    }
public function deleteAccount($id)
{
	$sql = "DELETE FROM account WHERE id='" . $id . "'";
	
	// Valmistellaan lause, prepare on PDO-luokan metodeja
		 $stmt = $this->db->prepare($sql);
        $stmt->execute();
}
	
 public function findAccounts($searchSigns)
    {
        $sql = "SELECT id, customerNumber, name, ssn, gender, accountNumber, balance, accountType, additionalInfo FROM account WHERE accountNumber LIKE '%" . $searchSigns . "%'" ;

// Valmistellaan lause, prepare on PDO-luokan metodeja
        if (! $stmt = $this->db->prepare($sql))
			throw new PDOException("prepare", 2);
// Ajetaan lauseke
        if (!$stmt->execute())
      		throw new PDOException("execute", 3);
      		
// Käsittellään hakulausekkeen tulos
        $tulos = array();
        
// Pyydetään haun tuloksista kukin rivi kerrallaan
        while ($row = $stmt->fetchObject()) {
        	// Tehdään tietokannasta haetusta rivistä leffa-luokan olio
        	$account = new Account();
			
        	$account->setId($row->id);
        	$account->setCustomerNumber($row->customerNumber);
        	$account->setName(utf8_encode($row->name));
        	$account->setSsn($row->ssn);
        	$account->setGender($row->gender);
        	$account->setAccountNumber($row->accountNumber);
        	$account->setBalance($row->balance);
        	$account->setType($row->accountType);
        	$account->setInfo(utf8_encode($row->additionalInfo));
        	// Laitetaan olio tulos taulukkoon (olio-taulukkoon)
        	$tulos[] = $account;	
        }

		$this->lkm = $stmt->rowCount();
		
		return $tulos;
    }

    function addAccount($account) {
    	$sql = "insert into account (customerNumber, name, ssn, gender, accountNumber, balance, accountType, additionalInfo) values (:customerNumber, :name, :ssn, :gender, :accountNumber, :balance, :type, :info)";
    		
    	//  Valmistellaan SQL-lause
    	$stmt = $this->db->prepare($sql);
    		
    	// Parametrien sidonta
    	$stmt->bindValue(":customerNumber", $account->getCustomerNumber());
    	$stmt->bindValue(":name", utf8_decode($account->getName()));
    	$stmt->bindValue(":ssn", $account->getSsn());
    	$stmt->bindValue(":gender", $account->getGender());
    	$stmt->bindValue(":accountNumber", $account->getAccountNumber());
    	$stmt->bindValue(":balance", $account->getBalance());
    	$stmt->bindValue(":type", $account->getType());
    	$stmt->bindValue(":info", utf8_decode($account->getInfo()));
    	
    	// Suoritetaan SQL-lause (insert)
    	 if (!$stmt->execute())
    	throw new PDOException("execute", 3);  
    	
    	$this->lkm = $stmt->rowCount();
    }
}
?>
