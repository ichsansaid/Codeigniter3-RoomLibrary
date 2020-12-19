<?php

class DataRoom
{
	private $parent;
	private $list_room_replace = [];
	private $list_room_declare = [];
	private $list_room_will_replace = [];
	private $currentRoom;
	private $data = [];
	private $CI;


	public function __construct($will_replace, $ci, $data)
	{
		$this->list_room_will_replace = $will_replace;
		$this->CI = $ci;
		$this->data = $data;
	}

	public function extend($url)
	{
		$this->parent = $url;
		foreach ($this->list_room_will_replace as $key => $value) {
			$this->list_room_replace[$key] = $value;
		}
		$obj = new DataRoom($this->list_room_replace, $this->CI, $this->data);
		$this->CI->load->view($url, ['room' => $obj]);
	}

	public function

	declare($room)
	{
		if (isset($this->list_room_will_replace[$room])) {
			echo $this->list_room_will_replace[$room];
			unset($this->list_room_will_replace[$room]);
		};
	}

	public function open($room)
	{
		if ($this->currentRoom != NULL) {
			show_error("You must close the room before open the room again");
		} else {
			$this->currentRoom = $room;
			if (!isset($this->list_room_replace[$room])) {
				ob_start();
			}
		}
	}

	public function close()
	{
		if ($this->currentRoom == NULL) {
			show_error("You currently not open in any Room");
		} else {
			if (!isset($this->list_room_replace[$this->currentRoom])) {
				$html = ob_get_clean();
				$this->list_room_replace[$this->currentRoom] = $html;
			}
			$this->currentRoom = NULL;
		}
	}

	public function include($view, $data = null)
	{
		$room = new DataRoom([], $this->CI, $data);
		$r = $this->CI->load->view($view, ['room' => $room]);
	}

	public function data($key)
	{
		return $this->data[$key];
	}

	public function alldata($params = NULL, $type = NULL)
	{
		if ($type == NULL) {
			$type = 'only';
			if ($params == NULL) {
				$params = $this->data;
			}
		}
		if ($params == NULL) {
			$params = [];
		}
		$ret = [];
		$dict_params = [];
		foreach ($params as $key => $value) {
			$dict_params[$value] = 0;
		}
		if ($type == 'except') {
			foreach ($this->data as $key => $value) {
				if (!isset($dict_params[$key])) {
					$ret[$key] = $value;
				}
			}
			return $ret;
		} else {
			foreach ($this->data as $key => $value) {
				if (isset($dict_params[$key])) {
					$ret[$key]  = $value;
				}
			}
			return $ret;
		}
	}
}

class Room
{
	private $CI;
	public function __construct()
	{
		$this->CI = &get_instance();
	}

	public function load($view, $data = null)
	{
		if ($data == null) $data = [];
		$room = new DataRoom([], $this->CI, $data);
		$this->CI->load->view($view, ['room' => $room]);
	}
}
