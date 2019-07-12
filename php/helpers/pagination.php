<?php
class pagination {
	private $total_page;
	private $per_page;
	private $curr_page;

	public function __construct($total_page,$per_page,$curr_page){
		$this->total_page = $total_page;
		$this->per_page = $per_page;
		$this->curr_page = $curr_page;
	}
	public function hasPrev(){
		if($this->curr_page > 1){
			return true;
		}else{
			return false;
		}
	}
	public function hasNext(){
		if($this->curr_page < $this->getNumPages()){
			return true;
		}else{
			return false;
		}
	}
	public function offset(){
		return ($this->curr_page - 1) * $this->per_page;
	}
	public function limit(){
		return $this->per_page;
	}
	public function getNumPages(){
		$numPages = ceil($this->total_page / $this->per_page);
		return $numPages;
	}
	public function render($template, $pagination, $paginate = [ 'page_ctrl' => '', 'page_dir'=>'', 'page_var' => '']){
		require_once "$template";
	}
	// public function getLinkHtml($baseUrl, $page_redir, $pageVar){
	// 	$html = "";
    //     $html .="		<ul class=\"pagination pagination-sm \">";
                               
	// 	if($this->hasPrev()){
	// 		$html .="	<li>";
	// 		$html .="		<a href=\"".$baseUrl."dashboard/".$page_redir."?".$pageVar."=".($this->curr_page - 1)."\" aria-label=\"Previous\">";
    //         $html .="			<i class=\"fa fa-angle-left\"></i>";
    //         $html .="		</a>";
    //         $html .="	</li>";
	// 	}

	// 	for ($i=1; $i <= $this->getNumPages(); $i++) { 
	// 		// if($i != $this->curr_page){
	// 			$html .= "<li><a href=\"".$baseUrl."dashboard/".$page_redir."?".$pageVar."=".$i."\">$i</a></li>";
	// 		// }
	// 	}

	// 	if($this->hasNext()){
	// 		$html .="	<li>";
	// 		$html .="		<a href=\"".$baseUrl."dashboard/".$page_redir."?".$pageVar."=".($this->curr_page + 1)."\" aria-label=\"Next\">";
    //         $html .="			<i class=\"fa fa-angle-right\"></i>";
    //         $html .="		</a>";
    //         $html .="	</li>";
	// 	}		
    //     $html .="    </ul>";
    //     return $html;
	// }
}
?>