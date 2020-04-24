<?php

namespace app\helpers;

class Pagination
{	
	
	CONST FIRST_PAGE = 1;
	
	protected $offset = 0;
	
	protected $curPage = 1;
	
	protected $totalRecords = 0;
	
	protected $itemsPerPage = 6;
	
	function __construct($page = 1, $itemsPerPage = 0) {
		$this->curPage = $page;
		$this->offset = ($this->curPage - 1) * $itemsPerPage;
		$this->itemsPerPage = $itemsPerPage;
	}
	
	public function getOffset(){
		return $this->offset;
	}
	
	public function getCurrentPage(){
		return $this->curPage;
	}
	
	public function getNextPage(){
		return $this->curPage + 1;
	}
	
	public function getPreviousPage(){
		return $this->curPage - 1;
	}
	
	public function getLastPage(){
		return ceil($this->totalRecords/$this->itemsPerPage);
	}
	
	public function getItemsPerPage(){
		return $this->itemsPerPage;
	}
	
	public function setTotalRecords($totalRecords = 0){
		$this->totalRecords = $totalRecords;
	}
	
}