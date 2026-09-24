<?php
class GETDATA
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }

    public function getusercount()
    {
       try
       {
   
           $stmt = $this->db->prepare("SELECT count(username) as user_count FROM mhc_users");
		   $stmt->execute();
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['user_count']; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

 public function getuserlogs()
    {
       try
       {
   
           $stmt = $this->db->prepare("SELECT count(logs_id) as user_logs FROM user_logs");
		   $stmt->execute();
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['user_logs']; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	public function getuserhits()
    {
       try
       {
   
          // $stmt = $this->db->prepare("SELECT count(*) as user_hist FROM visitor_logs");
		 $stmt = $this->db->prepare("select count (*) as user_hist from ( select  user_ip_address FROM visitor_logs  group by user_ip_address)a");
		 
		   $stmt->execute();
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['user_hist']; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	public function getuserhits_perDay()
    {
       try
       {
			
          // $stmt = $this->db->prepare("SELECT count (distinct user_ip_address) as user_hist FROM visitor_logs where date (created) = '".date("Y-m-d")."'");
		    $stmt = $this->db->prepare("SELECT count(*) as user_hist from (select  user_ip_address FROM visitor_logs where date (created) = '".date("Y-m-d")."' group by user_ip_address)a");
		   $stmt->execute();
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['user_hist']; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	public function getjudcount()
    {
       try
       {
			$cur_date=date("Y-m-d");
           $stmt = $this->db->prepare("SELECT count(*) as jud_count FROM judges where j_page='PJ' and j_display='Y' and j_ret>='$cur_date' ");
		   $stmt->execute();
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['jud_count']; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	public function getCauseListhits_perDay()
    {
       try
       {
   
          // $stmt = $this->db->prepare("SELECT count (distinct user_ip_address) as user_hist FROM visitor_logs where date (created) = '".date("Y-m-d")."' and page_url ilike '%/cause_list%'");
		   $stmt = $this->db->prepare(" SELECT count(*) as user_hist from ( select user_ip_address FROM visitor_logs where date (created) = '".date("Y-m-d")."' and page_url in ('https://hcmadras.tn.gov.in/cause_list_mhc.php','https://hcmadras.tn.gov.in/cause_list_mdu.php') group by user_ip_address)a");
		   $stmt->execute();
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['user_hist']; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	public function getJudgmentshits_perDay()
    {
       try
       {
   
           //$stmt = $this->db->prepare("SELECT count (distinct user_ip_address) as user_hist FROM visitor_logs where date (created) = '".date("Y-m-d")."' and page_url ilike '%/cause_judment%'");
		   $stmt = $this->db->prepare(" SELECT count(*) as user_hist from ( select user_ip_address FROM visitor_logs where date (created) = '".date("Y-m-d")."' and page_url in ('https://hcmadras.tn.gov.in/cause_judment_mas.php','https://hcmadras.tn.gov.in/cause_judment_mdu.php') group by user_ip_address)a");
		   $stmt->execute();
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['user_hist']; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	public function getCaseStatushits_perDay()
    {
       try
       {
   
           //$stmt = $this->db->prepare("SELECT count (distinct user_ip_address) as user_hist FROM visitor_logs where date (created) = '".date("Y-m-d")."' and page_url ilike '%/case_status%'");
		    $stmt = $this->db->prepare(" SELECT count(*) as user_hist from ( select user_ip_address FROM visitor_logs where date (created) = '".date("Y-m-d")."' and page_url in ('https://hcmadras.tn.gov.in/case_status_mas.php','https://hcmadras.tn.gov.in/case_status_mdu.php') group by user_ip_address)a");
		   $stmt->execute();
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['user_hist']; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	public function getPageHits_perDay()
    {
       try
       {
   
           //$stmt = $this->db->prepare("SELECT count (distinct user_ip_address) as user_hist FROM visitor_logs where date (created) = '".date("Y-m-d")."' and page_url ilike '%/case_status%'");
		    $stmt = $this->db->prepare("SELECT page_url,count(user_ip_address) as user_hist from ( select page_url,user_ip_address FROM visitor_logs where date (created) = '".date("Y-m-d")."' and page_url in ('https://hcmadras.tn.gov.in/cause_list_mhc.php','https://hcmadras.tn.gov.in/cause_list_mdu.php','https://hcmadras.tn.gov.in/cause_judment_mas.php','https://hcmadras.tn.gov.in/cause_judment_mdu.php','https://hcmadras.tn.gov.in/case_status_mas.php','https://hcmadras.tn.gov.in/case_status_mdu.php') group by user_ip_address,page_url)a group by page_url");
		   $stmt->execute();
		  while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
		  {
			  $row1[$row['page_url']]=$row['user_hist'];
		  }
			
           return $row1; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
}
?>
