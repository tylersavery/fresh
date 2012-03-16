<?php
namespace Blog\Controller;

class CommentManager extends \Base\Controller\Scaffold {

	public function controller() {
		
		$this->define_model('Blog\Model\Comment');
		$this->generate();
		
	}
	
}