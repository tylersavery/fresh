<?php
namespace blog\Model;

class Comment extends \Activerecord\Model {
	
	static $table_name  = 'comments';
	static $primary_key = 'id';
	
}