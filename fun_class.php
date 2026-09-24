<?php
class GETDETAILS
{
    private $db;
 
    function __construct($HCMAS_DB)
    {
      $this->db = $HCMAS_DB;
    }

    public function getcasetype($case_type)
    {
       try
       {
   
           $stmt = $this->db->prepare("SELECT type_name FROM case_type_t WHERE case_type=:case_type");
		   $stmt->execute(array(':case_type'=>$case_type));
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['type_name']; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }


	
	  public function getadvmob($adv_code)
    {
		
       try
       {
		   
 		  
		   $stmt = $this->db->prepare("SELECT adv_mobile FROM advocate_t WHERE adv_code=:adv_code");
		   $stmt->execute(array(':adv_code'=>$adv_code));		
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['adv_mobile']; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 public function getAdvCd($bar_no)
    {
		
       try
       {
		   
 		  
		   $stmt = $this->db->prepare("SELECT adv_code FROM advocate_t WHERE adv_reg=:bar_no");
		   $stmt->execute(array(':bar_no'=>$bar_no));		
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['adv_code']; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	 public function GetJudgeName($jud_code)
    {
		
       try
       {
		   
 		  
		   $stmt = $this->db->prepare("SELECT judge_name FROM judge_name_t WHERE judge_code=:jud_code");
		   $stmt->execute(array(':jud_code'=>$jud_code));		
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['judge_name']; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	public function getjud($bench_id)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =$this->db->prepare("SELECT * FROM judge_t WHERE court_no=:bench_id ORDER BY judge_priority");
          $stmt->execute(array(':bench_id'=>$bench_id));
		  $short_judge_name='';
          while($rowjudcd=$stmt->fetch())
					{
					$judge_code=$rowjudcd['judge_code'];
					$stmt1=$this->db->prepare("SELECT * FROM judge_name_t WHERE judge_code =:judge_code");
					$stmt1->execute(array(':judge_code'=>$judge_code));
					$jud_name=$stmt1->fetch();
					if($jud_name['desg_code']!=3)
					{
					$short_judge_name .=trim($jud_name['short_judge_name']).',';
					}
					else 
					{
						
						$short_judge_name .=trim($jud_name['short_judge_name']).',';
					}
					
					}
		$jud_short_name=rtrim($short_judge_name,',');
		return $jud_short_name; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		
	  public function getcourthall($causelist_type,$causelist_dt,$bench_id)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt = $this->db->prepare("SELECT room_no FROM causelist_title WHERE causelist_id=:causelist_type AND causelist_date=:causelist_dt AND bench_id=:bench_id");
		   $stmt->execute(array(':causelist_type'=>$causelist_type,':causelist_dt'=>$causelist_dt,':bench_id'=>$bench_id));		
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
           return $row['room_no']; 
		
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	 public function getsection($causelist_type)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt = $this->db->prepare("SELECT cause_list_type FROM cause_list_period WHERE cause_list_type_id=:causelist_type");
		   $stmt->execute(array(':causelist_type'=>$causelist_type));		
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
           $section=rtrim($row['cause_list_type']); 
           return $section; 
		
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	 public function GetExtraPetParty($cino)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt = $this->db->prepare("(SELECT name FROM civ_address_t WHERE cino=:cino and type='1' ORDER BY party_no) UNION (SELECT name FROM civ_address_t_a WHERE cino=:cino and type='1' ORDER BY party_no)");
		   $stmt->execute(array(':cino'=>$cino));
			$extra_pet_party='';
		   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		   {
			   
           $extra_pet_party .=rtrim($row['name']).'</br>'; 
		   }
           return $extra_pet_party; 
		
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	 public function GetExtraResParty($cino)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt = $this->db->prepare("(SELECT name FROM civ_address_t WHERE cino=:cino and type='2' ORDER BY party_no) UNION (SELECT name FROM civ_address_t_a WHERE cino=:cino and type='2' ORDER BY party_no)");
		   $stmt->execute(array(':cino'=>$cino));
			$extra_res_party='';
		   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		   {
			   
           $extra_res_party .=rtrim($row['name']).'</br>'; 
		   }
           return $extra_res_party; 
		
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	 public function GetExtraPetAdv($cino)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt = $this->db->prepare("SELECT adv_name FROM extra_adv_t WHERE cino=:cino and type='1' ORDER BY srno");
		   $stmt->execute(array(':cino'=>$cino));
			$extra_pet_adv='';
		   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		   {
			   
           $extra_pet_adv .=rtrim($row['adv_name']).'</br>'; 
		   }
           return $extra_pet_adv; 
		
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	 public function GetExtraResAdv($cino)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt = $this->db->prepare("SELECT adv_name FROM extra_adv_t WHERE cino=:cino and type='2' ORDER BY srno");
		   $stmt->execute(array(':cino'=>$cino));
			$extra_res_party='';
		   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		   {
			   
           $extra_res_party .=rtrim($row['adv_name']).'</br>'; 
		   }
           return $extra_res_party; 
		
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	 public function getpurpose($purpose_cd)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt = $this->db->prepare("SELECT purpose_name FROM purpose_t WHERE purpose_code =:purpose_cd");
		   $stmt->execute(array(':purpose_cd'=>$purpose_cd));
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
		    $purpose_name=rtrim($row['purpose_name']); 
		   
           return $purpose_name; 
		
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	public function GetADType($adjcode)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt = $this->db->prepare("SELECT adjname FROM adjcode_t  where adjcode =:adjcode");
		   $stmt->execute(array(':adjcode'=>$adjcode));
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
		    $ad_type=rtrim($row['adjname']); 
		   
           return $ad_type; 
		
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	public function GetDisType($dispcode)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt = $this->db->prepare("SELECT disp_name FROM disp_type_t  where disp_type=:dispcode");
		   $stmt->execute(array(':dispcode'=>$dispcode));
		   $row=$stmt->fetch(PDO::FETCH_ASSOC);
		    $disp_type=rtrim($row['disp_name']); 
		   
           return $disp_type; 
		
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
}
?>
