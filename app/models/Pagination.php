<?php 

namespace App\Models;

use App\Core\App;


class Pagination
{
	public $limit = 1;
	public $total;
	public $date;

	public function __construct($date)
	{
		$this->date = $date;

		$this->total = $this->paginationColumnCount($date);
	}

	public function paginationColumnCount($date)
	{
		return App::get('database')->countReservation('reservation', $date)->fetchColumn();
	}	

	public function minPagination()
	{
		return min($this->countPage(), filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
	        'options' => array(
	            'default'   => 1,
	            'min_range' => 1,
	        ),
	    )));
	}	

	public function filterResult()
	{
		if(isset($_GET['search'])) {
			if($_GET['search'] == "tommorow") {
				$date = date("Ymd", strtotime(date("Ymd"). " + 1 days"));
			}
		}

		if(isset($_GET['search_submit'])) {
			$searchDate = str_replace('-', '', $_GET['search_date']);

			$date = $searchDate;
		}

		return;
	}	

	public function paginate()
	{
		$offset = ($this->minPagination() - 1)  * $this->limit;

		return App::get('database')->paginate($this->limit, $offset, $this->date);
	}	

	public function countPage()
	{
		$total = $this->paginationColumnCount($this->date);

		if($total != 0) {
			$pages = ceil($total / $this->limit);
		} else {
			$pages = 1;
		}
		/*if($total != 0) {
			$pages = ceil($total / $limit);
		} else {
			$pages = 1;
		}*/

		return $pages;
	}	

	public function nextPage($page, $pages)
	{
		$nextlink = ($page < $pages) ? '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a></li>' : '<li class="page-item"><span class="page-link" disabled>&rsaquo;</span></li>';
		echo $nextlink;	
	}	

	public function previousPage($page)
	{
		$prevLink = ($page > 1) ? '<li class="page-item"><a href="?page=' . ($page - 1) . '" title="Previous page" class="page-link">&lsaquo;</a></li>' : '<li class="page-item"><span class="page-link disabled">&lsaquo;</span></li>';
		echo $prevLink;
	}	

	public function pageList($pages)
	{
		for($i = 1; $i <= $pages; $i++) {
	    	if(isset($_GET['page']) && $_GET['page'] == $i) {
	    		echo '<li class="page-item active"><a href="?page='.$i.'" class="page-link">'.$i.'</a></li>';
	    	} else {
	    		echo '<li class="page-item"><a href="?page='.$i.'" class="page-link">'.$i.'</a></li>';
	    	}
	    }

	    return $this;
	}

	public function showPaginate()
	{
		$pages = $this->countPage();

		$page = $this->minPagination();

		$this->previousPage($page);

		$this->pageList($pages);

		$this->nextPage($page, $pages);

		return $this;
	}	

	public function searchNotMatch()
	{
		if($this->total <= 0) {
			return true;
		}
		return false;
	}

	public function hideOnSearch()
	{
		if(isset($_GET['search']) || isset($_GET['search_submit']) || isset($_GET['search_name'])) {
			return true;
		}
		return false;
	}	
}