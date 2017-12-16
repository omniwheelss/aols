<?php
	$filen = explode('?',basename($url));
	$arg = explode('&',$_SERVER['QUERY_STRING']);

	foreach($arg as $key => $arg_val){
		global $final_url;
		if(!eregi('Page',$arg_val)){
			$final_url[] = $arg_val."&";
		}
	}
	$final_url1 = join('',$final_url);
	$q1 = "$filen[0]?".$final_url1."Page=";
	$q2 = "";
?>


<?php
	
class PS_Pagination {
	var $php_self;
	var $rows_per_Page	= 10; //Number of records to display per Page
	var $total_rows		= 0; //Total number of rows returned by the query
	var $links_per_Page	= 5; //Number of links to display per Page
	var $append			= ""; //Paremeters to append to pagination links
	var $sql			= "";
	var $debug 			= false;
	var $conn			= false;
	var $Page			= 1;
	var $max_Pages		= 0;
	var $offset			= 0;
	
	 
	function PS_Pagination($connection, $sql, $rows_per_Page = 10, $links_per_Page = 5, $append = "") {
		global $q1,$q2;
		$this->conn = $connection;
		$this->sql = $sql;
		$this->rows_per_Page = (int)$rows_per_Page;
		if(intval($links_per_Page) > 0) {
			$this->links_per_Page = (int)$links_per_Page;
		}
		else {
			$this->links_per_Page = 5; 
		}
		$this->append = $append;
		$this->php_self = htmlspecialchars($_SERVER['PHP_SELF']);
		if(isset($_GET['Page'])) {
			$this->Page = intval($_GET['Page']);
		}
	}
	
	function paginate() {
		global $q1,$q2;
		//Check for valid mysql connection
		if(!$this->conn || !is_resource($this->conn)) {
			if($this->debug) echo "MySQL connection missing<br />";
			return false;
		}
		
		//Find total number of rows
		$all_rs = @mysql_query($this->sql);
		if(!$all_rs) {
			if($this->debug) echo "SQL query failed. Check your query.<br /><br />Error Returned: ".mysql_error();
			return false;
		}
		$this->total_rows = mysql_num_rows($all_rs);
		@mysql_close($all_rs);
		
		//Max number of Pages
		$this->max_Pages = ceil($this->total_rows/$this->rows_per_Page);
		if($this->links_per_Page > $this->max_Pages) {
			$this->links_per_Page = $this->max_Pages;
		}
		
		//Check the Page value just in case someone is trying to input an aribitrary value
		if($this->Page > $this->max_Pages || $this->Page <= 0) {
			$this->Page = 1;
		}
		
		//Calculate Offset
		$this->offset = $this->rows_per_Page * ($this->Page-1);
		
		//Fetch the required result set
		$rs = @mysql_query($this->sql." LIMIT {$this->offset}, {$this->rows_per_Page}");
		if(!$rs) {
			if($this->debug) echo "Pagination query failed. Check your query.<br /><br />Error Returned: ".mysql_error();
			return false;
		}
		return $rs;
	}
	
	function renderFirst($tag="<span class=\"textcon\">First</span>") {
		global $q1,$q2;
		if($this->Page == 1) {
			return $tag;
		}
		else {
			//return "<a href=\"".$this->php_self."?Page=1&".$this->append."\" class=\"textcon\"><span class\"textcon\">".$tag."</span></a>";
			return "<a href=\"".$q1."1".$this->append."".$q2."\" class=\"textcon\"><span class\"textcon\">".$tag."</span></a>";
		}
	}
	
	function renderLast($tag="<span class=\"textcon\">Last</span>") {
		global $q1,$q2;
		if($this->Page == $this->max_Pages) {
			return $tag;
		}
		else {
			//return "<a href=\"".$this->php_self."?Page=".$this->max_Pages."&".$this->append."\" class=\"textcon\">".$tag."</a>";
			return "<a href=\"".$q1."".$this->max_Pages."".$this->append."".$q2."\" class=\"textcon\">".$tag."</a>";
		}
	}
	
	function renderNext($tag="<span class=\"textcon\">&gt;&gt;</span>") {
		global $q1,$q2;
		if($this->Page < $this->max_Pages) {
			//return "<a href=\"".$this->php_self."?Page=".($this->Page+1)."&".$this->append."\" class=\"textcon\">".$tag."</a>";
			return "<a href=\"".$q1."".($this->Page+1)."".$this->append."".$q2."\" class=\"textcon\">".$tag."</a>";
		}
		else {
			return $tag;
		}
	}
	
	function renderPrev($tag="<span class=\"textcon\">&lt;&lt;</span>") {
		global $q1,$q2;
		if($this->Page > 1) {
			//return "<a href=\"".$this->php_self."?Page=".($this->Page-1)."&".$this->append."\" class=\"textcon\">".$tag."</a>";
			return "<a href=\"".$q1."".($this->Page-1)."".$this->append."".$q2."\" class=\"textcon\">".$tag."</a>";
		}
		else {
			return $tag;
		}
	}
	
	function renderNav() {
		global $q1,$q2;
		$batch = ceil($this->Page/$this->links_per_Page);
        $end = $batch * $this->links_per_Page;
		if($end == $this->Page) {
        	//$end = $end + $this->links_per_Page - 1;
        	//$end = $end + ceil($this->links_per_Page/2);
        }
		if($end > $this->max_Pages) {
        	$end = $this->max_Pages;
        }
        $start = $end - $this->links_per_Page + 1;			
		$links = '';

		for( $i=$start ; $i <= $end ; $i++) {
			if($i == $this->Page) {
				$links .= "<span class=\"nav_list1\">$i</span> ";
			}
			else {
				//$links .= "<a href=\"$this->php_self?Page=".$i."&".$this->append."\" class=\"nav_list\">".$i."</span></a> ";
				$links .= "<a href=\"".$q1."".$i."".$this->append."".$q2."\" class=\"nav_list\">".$i."</span></a> ";
			}
		}
		
		return $links;
	}
	
	function renderFullNav() {
		return $this->renderFirst().'&nbsp;'.$this->renderPrev().'&nbsp;'.$this->renderNav().'&nbsp;'.$this->renderNext().'&nbsp;'.$this->renderLast();	
	}
	
	function setDebug($debug) {
		$this->debug = $debug;
	}
}
?>
