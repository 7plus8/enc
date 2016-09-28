<?php
class Post_model extends Model
{
	private	$_data;

	public function __construct()
	{
		parent::__construct();
	}

	public function articles()
	{
		$query = $this->db->get('articles');
		return $query->results();
	}

	public function get_articles_highlights($slug = FALSE)
	{
		if ($slug === FALSE)
		{
			$query = $this->db->get('articles', array('LEFT(title, 27) as title', 'LEFT(text, 120) AS text','slug', 'posted'), 'ORDER BY id DESC LIMIT 6');
			return $query->results();
		}

		$query = $this->db->get_where('articles', array('slug', '=', $slug));
		return $query->first();
	}

	public function get_articles($slug = FALSE)
	{
		if ($slug === FALSE)
		{
			$per_page = 6;
			/*$this->db->get('articles');
			$record_count = $this->db->count();
			$per_page = 6;
			$pages =ceil($record_count/$per_page);

			if (Post::$page !== null && is_numeric(Post::$page))
			{
				$page = Post::$page;
			}
			else
			{
				$page = 1;
			}
			if($page <= 0)
			{*/
				$start = 0;
			/*}
			else
				$start = $page * $per_page - $per_page;*/

			$query = $this->db->get('articles', array('id', 'title', 'LEFT(text, 200) AS text','slug', 'posted'), 'ORDER BY id DESC LIMIT ' . $start . ',' . $per_page);
			return $query->results();
		}

		$query = $this->db->get_where('articles', array('slug', '=', $slug));
		return $query->first();
	}

	public static function comment_count($id = null)
	{
		parent::$_db->get_where('comments', array('post_id', '=', $id));
		$count = parent::$_db->count();
		if($count === 0)
		{
			$res = "Leave a comment";
		}
		elseif($count === 1)
		{
			$res = $count . " Comment";
		}
		else
		{
			$res = $count . " Comments";
		}

		return $res;
	}

	public function get_comments($slug = FALSE)
	{
		if ($slug === FALSE)
		{
			$query = $this->db->get('comments');
			return $query->results();
		}

		$query = $this->db->get_where('comments', array('post_id', '=', $slug));
		return $query->first();
	}

	public function set_article($fields)
	{
		if(!$this->db->insert('articles', $fields)){
			throw new Exception ('There was a problem creating an account.');
		}
	}

	public function add_comment($fields)
	{
		if(!$this->db->insert('comments', $fields)){
			echo "<pre>";
			print_r($fields);
			throw new Exception ('There was a problem adding a comment');
		}
	}
}