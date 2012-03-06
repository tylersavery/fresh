<?php
/**
 * PHPSense Pagination Class
 *
 * PHP tutorials and scripts
 *
 * @package		PHPSense
 * @author		Jatinder Singh Thind
 * @copyright	Copyright (c) 2006, Jatinder Singh Thind
 * @link		http://www.phpsense.com
 */

// ------------------------------------------------------------------------
namespace Pigeon\Library;

  class Pagination {

    public $page      = 1; // Current Page
    public $perPage   = 10; // Items on each page, defaulted to 10
    public $showFirstAndLast = false; // if you would like the first and last page options.
    public $length    = 0;
    public $pages     = 0;
    public $start     = 0;
    public $class     = 'btn';
    public $implodeBy = '';
    public $link      = '';
    
    public function __construct($length, $perPage = 10) {

		// Assign the items per page variable
		if (! empty($perPage))
		    $this->perPage = $perPage;

		// Assign the page variable
		if (! empty($_GET['page'])) {
			$this->page = $_GET['page']; // using the get method
		} else {
			$this->page = 1; // if we don't have a page number then assume we are on the first page
		}

		$this->length = $length;
		$this->pages = ceil($this->length / $this->perPage);
		$this->start = ceil(($this->page - 1) * $this->perPage);

		return true;
    }
    
    function generate() {

		// Initiate the links array
		$plinks = array();
		$links = array();
		$slinks = array();

		// Concatenate the get variables to add to the page numbering string
		if (count($_GET)) {
			$queryURL = '';
			foreach ($_GET as $key => $value) {
				if ($key != 'page' && $key != 'p') {
					$queryURL .= '&'.$key.'='.$value;
				}
			}
		}

		// If we have more then one pages
		if (($this->pages) > 1) {
			// Assign the 'previous page' link into the array if we are not on the first page
			if ($this->page != 1) {
				if ($this->showFirstAndLast) {
					$plinks[] = ' <a class="'.$this->class.'" href="'.$this->link.'?page=1'.$queryURL.'">&laquo;&laquo; First </a> ';
				}
				$plinks[] = ' <a class="'.$this->class.'" href="'.$this->link.'?page='.($this->page - 1).$queryURL.'">&laquo; Prev</a> ';
			}
			// Assign all the page numbers & links to the array
			for ($j = 1; $j < ($this->pages + 1); $j++) {
				if ($this->page == $j) {
					$links[] = ' <a class="'.$this->class.' btn-primary">'.$j.'</a> '; // If we are on the same page as the current item
				} else {
					$links[] = ' <a class="'.$this->class.'" href="'.$this->link.'?page='.$j.$queryURL.'">'.$j.'</a> '; // add the link to the array
				}
			}
			// Assign the 'next page' if we are not on the last page
			if ($this->page < $this->pages) {
				$slinks[] = ' <a class="'.$this->class.'" href="'.$this->link.'?page='.($this->page + 1).$queryURL.'"> Next &raquo; </a> ';
				if ($this->showFirstAndLast) {
					$slinks[] = ' <a class="'.$this->class.'" href="'.$this->link.'?page='.($this->pages).$queryURL.'"> Last &raquo;&raquo; </a> ';
				}
			}
			return implode(' ', $plinks).implode($this->implodeBy, $links).implode(' ', $slinks);
		}
		return;
	}
}