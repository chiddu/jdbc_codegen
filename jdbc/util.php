<?php
define('NORMAL' , 0x01);
define('TWIT' , 0x02);
define('LINKEDIN' , 0x04);
define('FB' , 0x08);

function hashFn($input)
{
	$input =trim($input, "/ ");
	return md5($input);
}


/* Make 
rootFolder.model */
function makeDirs($rootFolder)
{

system("mkdir -p ".$rootFolder."/basedao"."\n");
system("mkdir -p ".$rootFolder."/dao"."\n");
system("mkdir -p ".$rootFolder."/basemodel"."\n");
system("mkdir -p ".$rootFolder."/model"."\n");

}




function md5plus($email)
	{
	   $string='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	   $out = md5($string.$email);
	   $out = $out.md5($email);
	   $out = md5($out);
	   for($i=0;$i<strlen($email);$i++)
	   {
		  $out .= md5($out);
	   }
	   $out = md5($out).strlen($email).md5($out);
	   $out = md5($out);
	   return $out;
	}
function curPageURL(){
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function ts2date($dt)
{
	$lst = explode(" ", $dt);
	$list1 = explode("-", $lst[0]);
	$list2 = explode(":", $lst[1]);

	$lst2  = array_merge($list1,$list2);

	$final = implode("",$lst2);
	return $final;
}


function fb_clock(&$inarray, $tag)
{
    if(!($inarray))
    {
       $inarray = array();
    }
    $inarray[] = array($tag => date('H:i:s.u'));
}


function my_array_merge($arr1,$arr2)
{
   if($arr2)
   {
      if($arr1)
      {
         return array_merge($arr1,$arr2);
      }
      else
      {
         return $arr2;
      }
   }
   else
      return $arr1; /* Doesn't matter eeryting is null */
}

function my_array_merge2($arr1,$arr2)
{
   if($arr2)
   {
      if($arr1)
      {
				$newarr = $arr1;
				foreach($arr2 as $a_key => $a_value)
				{
					if($newarr[$a_key])
					{
						continue;
					}
					$newarr[$a_key] = $a_value;
				}
				return $newarr;
      }
      else
      {
         return $arr2;
      }
   }
   else
      return $arr1; /* Doesn't matter eeryting is null */
}



function getMemcached($key)
{
	$memport  = getDefaultValue(sfConfig::get('app_memcached_port'),'127.0.0.1:11211');
	$mems = explode(":",$memport);
	$memcache_obj = new MemCache();
	$memcache_obj->connect($mems[0], $mems[1]);

	if($memcache_obj)
	{
		$retArray = $memcache_obj->get($key);
		if($retArray !== FALSE)
		{
			return $retArray;
		}
	}
	return null;
}

function setMemcached($key,$value, $expire = 0)
{
	$memport  = getDefaultValue(sfConfig::get('app_memcached_port'),'127.0.0.1:11211');
	$mems = explode(":",$memport);
	$memcache_obj = new MemCache();
	$memcache_obj->connect($mems[0], $mems[1]);

	if($memcache_obj)
	{
		if($expire)
		{
			$memcache_obj->set($key,$value, 0, $expire);
		}
		else
			$memcache_obj->set($key,$value);

	}
}


function deleteMemcached($key)
{
	$memport  = getDefaultValue(sfConfig::get('app_memcached_port'),'127.0.0.1:11211');
	$mems = explode(":",$memport);
	$memcache_obj = new MemCache();
	$memcache_obj->connect($mems[0], $mems[1]);

	if($memcache_obj)
	{
		$memcache_obj->delete($key);
	}
}




function d2($data, $debug=true)
{
if($debug)
{
	echo "<pre>";
	print_r($data);
	echo "\r\n";
	echo "</pre>";
}

}

function d3($data)
{
print_r($data);
echo "\r\n";
exit;

}
function d4($data)
{
print_r($data);
echo "\r\n";

}

function d1($data)
{
echo "<pre/>";
print_r($data);
echo "\r\n";
exit;

}

function compare2($lhs,$rhs,$param)
{
	if(!$rhs[$param])
	{
		if($lhs[$param])
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	if(!$lhs[$param])
	{
		return -1;
	}

	if($lhs[$param] > $rhs[$param])
	{
		return 1;
	}
	if($lhs[$param] < $rhs[$param])
	{
		return -1;
	}
	return 0;
}

function date2time($currTime)
{
	$ans =  ($currTime['tm_year'] + 1900);
	$mn = $currTime['tm_mon']+1;
	if($mn < 10)
	{
		$mn = "0".$mn;
	}
	$dy = $currTime['tm_mday'];
	if($dy < 10)
	{
		$dy = "0$dy";
	}
	$ans .= "-".$mn."-".$dy." 00:00:00";
	return $ans;
}

function date2ts($currTime)
{
	$ans =  ($currTime['tm_year'] + 1900);
	$mn = $currTime['tm_mon']+1;
	if($mn < 10)
	{
		$mn = "0".$mn;
	}
	$dy = $currTime['tm_mday'];
	if($dy < 10)
	{
		$dy = "0$dy";
	}
	$ans .= $mn.$dy."000000";
	return $ans;
}


function date2stamp($currTime)
{
	$ans =  ($currTime['tm_year'] + 1900);
	$mn = $currTime['tm_mon']+1;
	$dy = $currTime['tm_mday'];
	$tst = mktime(0,0,0,$mn,$dy,$ans);
	return $tst;
}

function str2date($currTime)
{
	$yr = substr($currTime,0,4);
	$mn = substr($currTime,4,2);
	$dt = substr($currTime,6,2);

	$hr = substr($currTime,8,2);
	$min = substr($currTime,10,2);
	$sec = substr($currTime,12,2);
	return $yr."-".$mn."-".$dt." ".$hr.":".$min.":".$sec;
}

function getshortdesc($instr, $ind = 100,$sep = ' ')
{
	$instr = trim($instr);
   $len = strlen($instr);
   if($len < $ind)
   {
      $ind = $len;
   }
   while ($instr[$ind] && $instr[$ind] != $sep)
   {
   $ind--;
   }

   while($instr[$ind] && ($instr[$ind] == $sep))
   {
   $ind--;
   }

   $outstr = substr($instr,0,$ind+1);
   return $outstr;// ."...";

}


function buildGroupMatch(&$inlist,$resIds, $resArray)
{
	foreach($resIds as $res_id)
	{
			if($inList[$res_id])
			{
				continue;
			}
			$num_matches = $resArray[$res_id]['group_matches'];
			if(! $num_matches)
			{
				$num_matches = count( $resArray[$res_id]['group_ids'] );
			}

			if($num_matches == 1)
			{
				$inlist[$res_id] = $num_matches. " group match";
			}
			else if($num_matches)
			{
				$inlist[$res_id] = $num_matches. " group matches";
			}
	}
}
function buildScoreArray(&$inlist,$resIds, $filler)
{
	foreach($resIds as $res_id)
	{
			$inlist[$res_id] = $filler;
	}
}
function merge_search($arr1,$arr2)
{
   if($arr2)
   {
      if($arr1)
      {
				$newarr = $arr1;
				foreach($arr2 as $a_key => $a_value)
				{
					if($newarr[$a_key])
					{
						if($newarr[$a_key]['lucene_score'] < $newarr[$a_key]['lucene_score'])
						{
							$newarr[$a_key]['lucene_score'] =  $newarr[$a_key]['lucene_score'];
						}
						if($newarr[$a_key]['updated_at'] < $newarr[$a_key]['updated_at'])
						{
							$newarr[$a_key]['updated_at'] =  $newarr[$a_key]['updated_at'];
						}
						continue;
					}
					$newarr[$a_key] = $a_value;
				}
				return $newarr;
      }
      else
      {
         return $arr2;
      }
   }
   else
      return $arr1; /* Doesn't matter the other arrayy  is null */
}


function getDefaultValue($param,$defaultVal)
{
	if($param) 
	{
		return $param;
	}
	return $defaultVal;
}


function getDayStartTime($days)
{
    $abscurrTime = time();
    $day = 24*60*60*1; // for convenience sake
    $startday  = $abscurrTime  - $days * $day;
		$currTime = localtime($abscurrTime +$day,true);
		return  date2time($currTime);
}

function interPose($array1, $array2)
{
	$ct1 = count($array1);
	$ct2 = count($array2);

	$masterIds = array();

	$newarray = array();

	$i = 0;
	$j = 0;

	while( ($i <  $ct1) || ($j < $ct2))
	{
		if($i < $ct1)
		{
			$item1 = $array1[$i];
			if(! $masterIds[$item1])
			{
				$newarray[] = $item1;
				$masterIds[$item1] = 1;
			}
			$i++;
		}
		if($j < $ct2)
		{
			$item2 = $array2[$j];
			if(! $masterIds[$item2])
			{
				$newarray[] = $item2;
				$masterIds[$item2] = 1;
			}
			$j++;
		}
	}
	return $newarray;
}

function getLatestKeys($array1,$upd_time)
{
	$inArray = array();
	$outArray = array();
	foreach($array1 as $id => $inarr)
	{
		if($inarr['updated_at'] > $upd_time)
		{
			$inArray[$id] = $inarr['updated_at'];
		}
		else
		{
			$outArray[$id] = $inarr['updated_at'];
		}
	}
	return array('in' => $inArray, 'out' => $outArray);
}

function getAbsentKeys($array1, $keylist)
{
	$absKeys = array(); 
	foreach($array1 as $id => $inarr)
	{
		if(! $keylist[$id])
		{
			$absKeys[] = $id;
		}
	}
	return $absKeys;
}

function getshortgroupname($grp, $ind, $sep = ' ')
{

   $len = strlen($grp);
   if($len < $ind)
   {
       $outstr = $grp;
   }else{
	    $count=substr_count($grp,$sep);
	   if($count>0)
	 {
	   while ($grp[$ind] && $grp[$ind] != $sep)
	   {
	   $ind--;
	   }
	   while($grp[$ind] && ($grp[$ind] == $sep))
	   {
	   $ind--;
	   }
		}
	   $outstr = substr($grp,0,$ind+1)."...";
   }
   return $outstr;

}


function addUserCookie($response,$user)
{
	$cookData = $user->getId().":".time();

	$c = new Criteria();
	$c->add( UserCookiePeer::USER_ID,$user->getId());
	$uc = UserCookiePeer::doSelectOne($c);
	if(! $uc)
	{
		$uc = new UserCookie();
		$uc->setUserId($user->getId());
	}
	$uc->setCookie($cookData);
	$uc->save();
	$cid  = $uc->getId();
	$cookData = $cid.":".$cookData;
	$cookData = encrypt0($cookData);
  $response->setCookie('currentuser', $cookData, time() + 60*60*24*7);
}

function loginUserThroughCookie($request,$user)
{
 $cookData = $request->getCookie('currentuser');
 if($cookData)
 {
	$cookData = decrypt0($cookData);
	$cookData = explode(":", $cookData);
	$cookieId = $cookData[0];
	$userId = $cookData[1];
	$cookie = UserCookiePeer::retrieveByPk($cookieId);
	if($cookie && $userId && ($userId == $cookie->getUserId()))
	{
		$user_info =  UserPeer::retrieveByPk($userId);
		if($user_info)
		{
			$user->signIn($user_info);
		}
	}
 }
}

function implode_array($inArr, $inkeys)
{
	$ia = "";
	foreach($inkeys as $k )
	{
		$v = $inArr[$k];
		if($ia)
		{
			$ia = $ia."&";
		}
		$ia = $ia.$k."=".$v;
	}
	return $ia;
}

function explode_array($inArr)
{
	$arrayelem = explode("&", $inArr);
	$myarr = array();
	foreach($arrayelem as $conj)
	{
		$kv = explode("=", $conj);
		$myarr[$kv[0]] = $kv[1];
	}
	return $myarr;
}

function updateRes($tbName,$primId, $dupIds, $debug = 0)
{
	updatePrimary($tbName,"resource_id",$primId,$dupIds, $debug);
}

function updateResIgnore($tbName,$primId, $dupIds, $debug = 0, $connection = 0)
{
	updateIgnore($tbName,"resource_id",$primId,$dupIds, $debug, $connection );
}


function updateIgnore($tbName,$fldname,$primId,$dupIds, $debug = 0, $connection = 0)
{
	if((!$dupIds) || (count($dupIds) == 0))
	{
		return;
	}
	$query = "update ignore ".$tbName." set ".$fldname." = ".$primId." where ".
		$fldname." in (" . implode(",", $dupIds)." ) ";
	if($debug)
	{
		echo $query."\n";
	}
	execQuery($query,$connection);
}
function updatePrimary($tbName,$fldname,$primId,$dupIds, $debug = 0)
{
	if((!$dupIds) || (count($dupIds) == 0))
	{
		return;
	}
	$query = "update ".$tbName." set ".$fldname." = ".$primId." where ".
		$fldname." in (" . implode(",", $dupIds)." ) ";
	if($debug)
	{
		echo $query."\n";
	}
	execQuery($query);
}


function updateColumn($tbName,$fldname,$fldvalue, $critName,$dupIds)
{
	if((!$dupIds) || (count($dupIds) == 0))
	{
		return;
	}
	$query = "update ".$tbName." set ".$fldname." = ".$fldvalue." where ".
		$critName." in (" . implode(",", $dupIds)." ) ";
	execQuery($query);
}

function execQuery($query, $connection = 0 )
{
	if(! $connection)
	{
		$connection = Propel::getConnection();
	}
	$statement = $connection->prepare($query);
	$statement->execute();
}



function execQuery2($query, $connection)
{
	if(! $connection)
	{
		$connection = Propel::getConnection();
	}
	$connection->exec($query);
}
function deleteRecords($tbName,$fldname,$dupIds, $debug = 0,$connection = 0)
{
	if((!$dupIds) || (count($dupIds) == 0))
	{
		return;
	}

	$query = "delete from  ".$tbName." where ".$fldname." in (" . implode(",", $dupIds)." ) ";
	if($debug)
	{
		echo $query."\n";
	}
	execQuery($query,$connection);
}


function array_append(&$parent, $array2)
{
	foreach($array2 as $elem)
	{
		$parent[] = $elem;
	}
}



function clearOpinionCache($sess_id)
{
   $sf_root_cache_dir = sfConfig::get('sf_root_cache_dir');
   $cache_dir1 = $sf_root_cache_dir.'/fb/*/template/*/all/mygroofer/opinions/page/*/sess_id/'. $sess_id;

   sfToolkit::clearGlob($cache_dir1);
}



function clearToppicksCache($sess_id)
{
   $sf_root_cache_dir = sfConfig::get('sf_root_cache_dir');
   $cache_dir1 = $sf_root_cache_dir.'/fb/*/template/*/all/mygroofer/toppicks/page/*/sess_id/'. $sess_id;

   sfToolkit::clearGlob($cache_dir1);
}

function clearNewsCache($sess_id)
{
   $sf_root_cache_dir = sfConfig::get('sf_root_cache_dir');
   $cache_dir1 = $sf_root_cache_dir.'/fb/*/template/*/all/mygroofer/news/page/*/sess_id/'. $sess_id;

   sfToolkit::clearGlob($cache_dir1);
}

function clearUserCache($sess_id,$context)
{
	$cacheManager = $context->getViewCacheManager();
  $cacheManager->remove('@mygroofer2?action=news&sess_id='.$sess_id);
}


function removeAllFrontCaches($ccam, &$userTags,$userid )
{
	removeFrontCaches($ccam, $userTags, $userid,'news');
	removeFrontCaches($ccam, $userTags, $userid,'blogs');
	removeFrontCaches($ccam, $userTags, $userid,'toppicks');
}


function removeFrontCaches($ccam, &$userTags, $userid,$pname)
{
	$sorts = array("rating", "latest");


	if($pname != 'toppicks')
	{
		foreach($sorts as $singSort)
		{
			$ckey  = "u_".$userid."_".$pname."__" .$singSort;
			deleteMemcached($ckey);
		}
		foreach($userTags as $singTag)
		{
			foreach($sorts as $singSort)
			{
				$ckey  = "u_".$userid."_".$pname."_".$singTag."_" .$singSort;
				deleteMemcached($ckey);
			}
		}

	}
	else
	{
		$singSort  = "";
		$ckey  = "u_".$userid."_".$pname."__" .$singSort;
		deleteMemcached($ckey);
		foreach($userTags as $singTag)
		{
			$ckey  = "u_".$userid."_".$pname."_".$singTag."_" .$singSort;
			deleteMemcached($ckey);
		}
	}
}

function removeAllGroupCaches($ccam, $opval)
{
	removeGroupCaches($ccam, $opval,'news');
	removeGroupCaches($ccam, $opval,'blogs');
	removeGroupCaches($ccam, $opval,'toppicks');
	removeGroupCaches($ccam, $opval,'topPicks');
}

function removeGroupCaches($ccam, $gid,$pname)
{
	$sorts = array("rating", "latest", "");

	foreach($sorts as $singSort)
	{
		$ckey  = "g_".$gid."_".$pname."__".$singSort;
		deleteMemcached($ckey);
	}
}

function checkCacheForViews(&$viewArray,$prefix)
{
	foreach($viewArray as $res_id => $allArr)
	{
		$key = $prefix."_".$res_id;
		$memv = getMemcached($key);
		if($memv)
		{
			$viewArray[$res_id]['views'] = $memv;
		}
	}
}

function incrMemcached($key)
{
	$memport  = getDefaultValue(sfConfig::get('app_memcached_port'),'127.0.0.1:11211');
	$servers = array($memport);
	$mm_opt['servers'] = $servers;
	$memcache_obj = new MemCachedClient($mm_opt);

	if($memcache_obj)
	{
		$retArray = $memcache_obj->get($key);
		if($retArray)
		{
			$retArray = $retArray+1;
		}
		else
		{
			$retArray =1;
		}
	}
	setMemcached($key,$retArray);
}


function setMeta($response , $title, $keywords, $description)
{
	$response->setTitle($title);	
	$response->addMeta('keywords', $keywords);	
	$response->addMeta('description', $description);	
}
function get_home($url)
{
	$pos1 = stripos($url,"//");
	$pos2 = stripos($url,"/",$pos1+2);
	$substr = substr($url,0,$pos2);
	return $substr;
}

function my_split($range)
{
	$dok = explode(",",$range);
	$retarr = array();
	foreach($dok as $kara)
	{
		if(strstr( $kara,"-"))
		{
			$tuk = explode("-",$kara);
			if(count($tuk) == 2)
			{
				$small = min($tuk[0], $tuk[1]);
				$big = max($tuk[0], $tuk[1]);
				for($i = $small; $i <= $big; $i++)
				{
					$retarr[] = $i;
				}
			}
		}
		else
		{
			$retarr[] = $kara;
		}
	}
	return $retarr;
}


function indexSingleGroup($group, $index)
{
	$doc = new Zend_Search_Lucene_Document();

	$field = Zend_Search_Lucene_Field::Text('tags', $group->getKeywords());
	$field->boost = 5;
	$doc->addField($field);

	$field = Zend_Search_Lucene_Field::Text('name', $group->getName());
	$field->boost = 10;
	$doc->addField($field);

	$field = Zend_Search_Lucene_Field::Text('summary', $group->getSummary());
	$field->boost = 3;
	$doc->addField($field);

	$field = Zend_Search_Lucene_Field::Text('description', $group->getDescription());
	$field->boost = 2;
	$doc->addField($field);

	$field = Zend_Search_Lucene_Field::Keyword('location', $group->getLocation())  ;
	$field->boost = 5;
	$doc->addField($field);

	$field = Zend_Search_Lucene_Field::Keyword('country', $group->getCountry())  ;
	$field->boost = 5;
	$doc->addField($field);

	$doc->addField(Zend_Search_Lucene_Field::Keyword('id', $group->getId())  );
	$doc->addField(Zend_Search_Lucene_Field::Keyword('is_private', $group->getIsPrivate())  );
	$doc->addField(Zend_Search_Lucene_Field::Keyword('open_access', $group->getOpenAccess())  );

	$index->addDocument($doc);
}

function startImport($url,$execstr, $wdir)
{
	$fullurl = $url."?exec=1&wdir=".$wdir."&cmd=".urlencode($execstr);	
	$retList = file_get_contents($fullurl);
}

function createDatesArray($days) 
{
	 //CLEAR OUTPUT FOR USE
	 $output = array();

		//SET CURRENT DATE
	 $month = date("m");
	 $day = date("d");
	 $year = date("Y");

		//LOOP THROUGH DAYS
	 for($i=1; $i<=$days; $i++){
				$output[] = date('1',mktime(0,0,0,$month,($day-$i),$year));
	 }

	 //RETURN DATE ARRAY
	 return $output;

}

function startsWith($haystack,$needle,$case=true) 
{
	if($case){return (strcmp(substr($haystack, 0, strlen($needle)),$needle)===0);}
			return (strcasecmp(substr($haystack, 0, strlen($needle)),$needle)===0);
}

function addPrivates(&$resourceIds, &$gids,&$ratingsAndViews)
{
	$pvtArrays = UserCommentGroupPeer::getPvtComments(
	$resourceIds, $gids);
	foreach($pvtArrays as $rid => $cnt)
	{
		if($cnt)
		{
			if($ratingsAndViews[$rid]['comments'])
			{
			$ratingsAndViews[$rid]['comments']
				= $cnt + $ratingsAndViews[$rid]['comments'];
			}
			else
			{
				$ratingsAndViews[$rid]['comments']= $cnt  ;
			}
		}
		
	}
}


function doMojo($instr)
{
	$instr = trim($instr);
	$larra = explode(" ", $instr);
	$tot = count($larra);
	/* 6+ elements are there */
	$retarr = array();
	if($tot <= 6)
	{
		$batata = implode(" ", $larra);
		$retarr[] = $batata;
	}
	else
	{
		for($i = 0; $i <= $tot - 6 ;$i++)
		{
			$elem1 = array_slice($larra,$i,6);	
			$retarr[] = implode(" ",$elem1)   ;
		}
	}
	return $retarr;
}
function doMojo1($instr, $id)
{
	$instr = trim($instr);
	$larra = explode(" ", $instr);
	$tot = count($larra);
	/* 6+ elements are there */
	$retarr = array();
	if($tot <= 6)
	{
		$batata = implode(" ", $larra);
		$retarr[$batata] = $id;
	}
	else
	{
		for($i = 0; $i <= $tot - 6 ;$i++)
		{
			$elem1 = array_slice($larra,$i,6);	
			$retarr[implode(" ",$elem1)]   = $id;
		}
	}
	return $retarr;
}

function execQuery3($query, $connection)
{
	if(! $connection)
	{
		$connection = Propel::getConnection();
	}
	$statement = $connection->prepare($query);
	$statement->execute();
	$rows = array();
	while($row = $statement->fetch()) 
	{
		$eachr = array();
		foreach ($row as $key => $data)
		{
			if(is_int($key))
			{
					continue;
			}
			$eachr[$key] = $data;	
		}
		$rows[] = $eachr;
	}
	return $rows;
}

/* This takes in a prepared statement */
function execQuery4($statement)
{
	$statement->execute();
	$rows = array();
	while($row = $statement->fetch()) 
	{
		$eachr = array();
		foreach ($row as $key => $data)
		{
			if(is_int($key))
			{
				continue;
			}
			$eachr[$key] = $data;	
		}
		$rows[] = $eachr;
	}
return $rows;
}


function isAUrl($str)
{
	if(startsWith($str,"http:",false) ||
		startsWith($str,"https:",false))
		{
			return true;
		}
		return false;
}


	


 function array2json($arr) 
 {
    if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
    $parts = array();
    $is_list = false;

    //Find out if the given array is a numerical array
    $keys = array_keys($arr);
    $max_length = count($arr)-1;
    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
        $is_list = true;
        for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position
            if($i != $keys[$i]) { //A key fails at position check.
                $is_list = false; //It is an associative array.
                break;
            }
        }
    }

    foreach($arr as $key=>$value) {
        if(is_array($value)) { //Custom handling for arrays
            if($is_list) $parts[] = array2json($value); /* :RECURSION: */
            else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */
        } else {
            $str = '';
            if(!$is_list) $str = '"' . $key . '":';

            //Custom handling for multiple data types
            if(is_numeric($value)) $str .= $value; //Numbers
            elseif($value === false) $str .= 'false'; //The booleans
            elseif($value === true) $str .= 'true';
            else $str .= '"' . addslashes($value) . '"'; //All other things
            // :TODO: Is there any more datatype we should be in the lookout for? (Object?)

            $parts[] = $str;
        }
    }
    $json = implode(',',$parts);
    
    if($is_list) return '[' . $json . ']';//Return numerical JSON
    return '{' . $json . '}';//Return associative JSON
}

function boolprint($flag, $msg)
{
	if($flag)
	{
	  return true;
	}else
		return false;
}

function getToday()
{
    $abscurrTime = time();
    $day = 24*60*60*1; // for convenience sake

		$currTime = localtime($abscurrTime +$day,true);
		return   date2ts($currTime);
}

function seeIfPub(&$pvts, &$list)
{
	if($list['public'])
		return true;
	$pvtlist = $list['private'];
	foreach($pvts as $pvt)
	{
		if($pvtlist[$pvt])
			return true;
	}
	return false;
}

function getSData($days, 
$action , $keyword,
$tomcat_url,
&$tarray,
$lucene_root, $webReq, &$logArray)
{

	if($action == 'news')
	{
		$le_num = '-1';
	}
	else if( $action == 'blogs')
	{
		$le_num = '-2';
	}
	$options = array(
    'searchPublic' => 'true',
    'searchRest' => 'false',
    'searchComment' => 'false',
    'searchFeed' => 'true'
  );
	if($le_num)
	{
		$options['type'] = $le_num;
	}

	$keyword = trim($keyword);
	$action = trim($action);
	$key = $action."_".$keyword;
	$traka = getMemcached($action."_".$keyword);
	if($traka)
	{
		return $traka;
	}

	$tempRs  = fbSearch::searchLastNDays($days,
	$tomcat_url, $tarray, $lucene_root,
		$keyword,$options);

	$logArray[] = '{sfAction} search url '.  $tempRs['url'] ;
	$tempRs = $tempRs['resource_ids'];

	$rids = array_keys( $tempRs);

	if($rids)
	{
		ResourceMapPeer::getSources($rids, $tempRs);
		/* Cache these for 15 minutes */
		setMemcached($key, $tempRs, 15*60);
		setMemcached($key."_count", count($tempRs), 15*60);
	}
	else
	{
		setMemcached($key."_count", "0", 15*60);
	}
	return $tempRs;
}



function setCounter( $user, &$counter,&$recordsInPage)
{
	if($user->getAttribute('count_inc')==1){
	 $counter = $user->getAttribute('counter');
	 if($recordsInPage < $counter)
	 {
			$recordsInPage = $counter;
	 }
	 $user->getAttributeHolder()->remove('count_inc');
	}
 }


function safeJSON_chars($data) {

  $aux = str_split($data);

  foreach($aux as $a) {

      $a1 = urlencode($a);

      $aa = explode("%", $a1);

      foreach($aa as $v) {

          if($v!="") {

              if(hexdec($v)>127) {

              $data = str_replace($a,"&#".hexdec($v).";",$data);

              }

          }

      }

  }
  return $data;

}

function my_json_decode($input)
{
	return  json_decode(safeJSON_chars($input));
}

function createNewRecord(&$newrecord, &$records,$grpnames,$ctrl)
{
    foreach($records as $key => $record)
		{
			if($grpnames)
			{
				$record['groups'] = $grpnames[$record['id']];
			}
      $record['creator_img'] = getUserImage($record['creatorid'],'50');
      if($record['type'] == 3)
      {
        $recMsg = "Saved search";
        $img = "/images/search_img.gif";
      }else if($record['type'] == 2)
      {
        $recMsg = "Saved Folder :".$record['num_objects']." objects";
        $img = "/images/".$folderObj['img'];
      }else if($record['type'] == 4){
        if($record['url'])
        {
          $recMsg = "Message with shared link";
        }
        else
        {
          $recMsg = "Message";
        }
        $img = "/images/".$messageObj['img'];
      }
      $record['comments'] = json_decode($record['comments']);
      if($record['comments'])
			{
				$record['comments']->profile_url = 
					$ctrl->genUrl('@userprofile?uid='.grEncrypt($record['comments']->userid));
				$record['com_user'] = getUserImage($record['comments']->userid,'34');
      }
			$creatorid = $record['creatorid'];
			$uu = $ctrl->genUrl('@userprofile?uid='. grEncrypt($creatorid)); 

			$record['profile_url'] = $uu;
      if($recMsg){
      $record['recMsg'] = $recMsg;
      $record['rec_img'] = $img;
      }else{
      $record['recMsg'] = ' ';
      $record['rec_img'] = ' ';
      }
      $newrecord[$key] = $record;    
    }
}

function encode($userid)
{
	if($confirmation  && (trim($confirmation) != ''))
		return 1; // for now.
	return 0;
}

function checkCode($confirmation, $userid)
{
	if($confirmation  && (trim($confirmation) != ''))
	{
		return 1; // for now.
	}
	return 0;
}

function isBlockedEmailId($email)
{
	//email-ids (i.e.) that are blocked by groofer e.g. gmail.com, yahoo.com etc.
	$array = array("gmail.com", "yahoo.com", "msn.com", "hotmail.com", "att.net", "comcast.net", "sbcglobal.net","yahoo.co.uk");

	foreach ($array as $i => $value) 
	{
	    if(strnatcasecmp($value, $email) == 0)
		{
			return 1;
		}
	}

	return 0;
}

function getProfileUrls($uids, $ctrl)
{
	$rArr = array();
	foreach($uids as $uid)
	{
		$uu = $ctrl->genUrl('@userprofile?uid='. grEncrypt($uid)); 
		$rArr[$uid] = $uu;
	}
	return $rArr;
}

function expandUsers($users, &$usersemails,$suffix)
{
	if($users)
	{
		$usersemail = explode(',',$users);
		foreach($usersemail as $email)
		{
			$users2 = explode(';',$email);
			foreach($users2 as $email2)
			{
				$email_suf = explode('@',$email2);
				if(trim($email_suf[1]) ==$suffix)
				{
					$temp1 = trim($email2);
					if($temp1)
					{
						$usersemails[] = $temp1;
					}
				}
			}
		}
	}
}

function split_comma($args)
{
	$darra = array(";","\n"," ");
	foreach($darra as $sing)
	{
		$args = str_replace($sing, ",", $args);
	}
	return explode("," ,$args);
}


function disp_return($input)
{
	$repl = str_replace(",","\n",$input);
	return $repl;
}
