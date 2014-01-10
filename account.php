<?php
 
class Account
{

  private static $errors = array (
     -1 => "Something went wrong",
      0 => "",
     11 => "This field is required",
     12 => "This field must be max 10 digit positive integer",
     21 => "Customer name is required",
     22 => "Customer first (max 30 char) and last (max 40 char) name not valid",
     23 => "Customer first name must be min 1 and max 30 characters ",
     24 => "Customer last name must be min 1 and max 40 characters ",
     25 => "Customer first (max 30 char) and last (max 40 char) name too long",
     26 => "More than 2 words inserted",
     31 => "Customer gender is required",
     41 => "Customer SSN is required",
  	 42 => "Invalid format, 123456-7890",
  	 51 => "Account number must be chosen",
  	 61 => "Balance is required",
  	 62 => "Balance must be a positive number, max 2 digits after dot",
  	 71 => "Additional info is required",
  	 72 => "Additional info is too long, max 300 signs",
  );


  private $customerNumber;
  private $name;
  private $ssn;
  private $gender;
  private $accountNumber;
  private $balance;
  private $type;
  private $info;
  private $id;
  
  function __construct($uusiCustomerNo = "", $uusiName = "", $uusiSsn = "", $uusiGender = "", 
  $uusiAccountNumber = "", $uusiBalance= "", $uusiType= "", $uusiInfo= "", $uusiId=0) {
     $this->id = $uusiId;
  	 $this->customerNumber = trim($uusiCustomerNo);
     $this->setName($uusiName);
     $this->ssn = trim($uusiSsn);
     $this->gender = trim($uusiGender);
     $this->accountNumber = trim($uusiAccountNumber);
     $this->setBalance($uusiBalance);
     $this->type = trim($uusiType);
     $this->setInfo($uusiInfo);
  }
  
// id:lle metodit
 public function setId($uusiId) {
     $this->id = $uusiId;	
  }
  
  public function getId() {
     return $this->id;
  }
  //Customer Number, must be max 10 digit positive integer
  public function setCustomerNumber($uusiCustomerNo) {
     $this->customerNumber = trim($uusiCustomerNo);	
  }
  
  public function getCustomerNumber() {
     return $this->customerNumber;
  }
  
  public function checkCustomerAccountNumber ($checkedField = "", $empty = false, $min = 1) {
 
     if ($empty == true && strlen($checkedField) == 0)
          return 0;  
     if ($empty == false && strlen($checkedField) == 0)
          return 11;

     // If the field is not an positive integer
     if (!(preg_match('/^[0-9]{1,10}$/', $checkedField) && $checkedField > 0))
     		return 12;            
  return 0;
  }
  //Customer Name, max length 30 for the first name, max 40 chars for the last name
  public function setName($uusiName) {

  	$Name = trim($uusiName);
  	$Name = preg_replace('/ +/', ' ', $Name);
  	$Name = mb_convert_case($Name, MB_CASE_LOWER, "UTF-8");
  	$Name = mb_convert_case($Name ,MB_CASE_TITLE, "UTF-8");
  	$this->name = $Name;
  }
  public function getName() {
  	return $this->name;
  } 
  public function checkName ($empty = false, $min = 1) {
  	if ($empty == true && strlen($this->name) == 0)
  		return 0;
  	if ($empty == false && strlen($this->name) == 0)
  		return 21;
    if (!preg_match('/^[a-zäöA-ZÄÖ -]{1,30}[ ]{1}[a-zäöA-ZÄÖ -]{1,40}+$/', $this->name))
    	return 22;
    /*if (preg_match('/^[a-zäöA-ZÄÖ -]+$/', $this->name)){
  	$Words = explode(" ", $this->name);
  	$FirstName = $Words[0];
  	$LastName = $Words[1];
  	$ExtraName = $Words[2];
  	if(strlen($ExtraName) > 0)
  		return 26;
  	if (strlen($LastName) > 40 && strlen($FirstName) > 30)
  	    return 25;
  	if (strlen($FirstName) < $min || strlen($FirstName) > 30)
  		return 23;
  	if (strlen($LastName) < $min || strlen($LastName) > 40)
  		return 24;
    }*/
    
  	return 0;
  }

// Customer SSN, 11 digit long,  XXXXXX-XXXX, leading and trailing spaces not allowed

 public function setSsn($uusiSsn) {
 	$Ssn = trim($uusiSsn);
  	$this->ssn = $Ssn;
  }  
  public function getSsn() {
  	return $this->ssn;
  }
  public function checkSsn($empty = false) {
  	if($empty == true && strlen($this->ssn) == 0)
  	return 0;
  	if($empty == false && strlen($this->ssn) == 0)
  	return 41;
  	if(!preg_match('/^\d{6}+\-\d{4}$/', $this->ssn))
  	return 42;

  	return 0;
  }
  //Gender
  public function setGender($uusiGender) {
     $this->gender = $uusiGender;	
  }
  public function getGender() {
     return $this->gender;
  }
  public function checkGender($male_status='unchecked', $female_status='unchecked') {
  	if ($male_status == 'checked' || $female_status == 'checked')
  		return 0;
  	if ($male_status == 'unchecked' && $female_status == 'unchecked')
  		return 31;
    return 0;
  }
  
//Account Number, must be max 10 digit positive integer, repeats Customer number rule
  public function setAccountNumber($uusiAccountNo) {
     $this->accountNumber = trim($uusiAccountNo);	
  }
  
  public function getAccountNumber() {
     return $this->accountNumber;
  }
  
  //account type, 1 2 or 3 from select item
  public function setType($uusiType) {
  	$this->type = $uusiType;
  }
  
  
  
  public function getType() {
  	return $this->type;
  }
  
  
  public function checkTypeAccount() {
  	if($this->type == 0)
  	return 51;
  	
  	return 0;
  }
//Balance, 00.00 format  
  public function setBalance($uusiBalance) {
  	$Digits = trim($uusiBalance);
  	if(!$Digits == "")	{
  	$Digits = str_replace('.', ',', $Digits);
  	$Digits = explode(",", $Digits);
  	if(sizeof($Digits)>1)
  	{
  		if(strlen($Digits[1]) == 1)
  			$Digits[1] = $Digits[1] . "0";
  	}
  	if(sizeof($Digits) == 1)
  		$Digits[1] = "00";
  	$Digits= implode(",", $Digits);
  	}
  	$this->balance = $Digits;
  }
  public function getBalance() {
  	return $this->balance;
  }
  public function checkBalance ($empty = false) {
  	if ($empty == true && strlen($this->balance) == 0)
  		return 0;
  	if ($empty == false && strlen($this->balance) == 0)
  		return 61;
  	if(!preg_match('/^\d{1,}\.?,?\d{0,2}$/', $this->balance))
  		return 62;
  	return 0;
  }

 public function setInfo($uusiInfo) {
  	$Info = trim($uusiInfo);
  	$Info = strtoupper($Info);
  	$this->info = $Info;
  }
  
  
  public function getInfo() {
  	return $this->info;
  }
  
  
  public function checkInfo ($empty = true, $max = 300) {
  	if ($empty == true && strlen($this->info) == 0)
  		return 0;
  	if ($empty == false && strlen($this->info) == 0)
  		return 71;
	if ($empty == true && strlen($this->info) > $max)
  		return 72; 
  	return 0;
  }
  
  public static function showMistake($mistake) {
     if (isset(self::$errors[$mistake]))
          return self::$errors[$mistake];

     return self::$errors[-1];
  }
}
?>