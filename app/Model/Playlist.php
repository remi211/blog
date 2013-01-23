<?php

class Playlist extends AppModel {
        public $name = 'Playlist';
		
		var $display_field = 'title';
		
		 var $hasAndBelongsToMany = array(
				'Video' =>            array(
					'className'              => 'Video',
					'joinTable'              => 'playlists_videos',
					'foreignKey'             => 'playlist_id',
					'associationForeignKey'  => 'video_id'								
				)
		 );
		
		public $validate = array(
			'title' => array(
				'rule' => 'notEmpty'
			),
			'body' => array(
				'rule' => 'notEmpty'
			),
			'status' => array(
				'rule' => array('boolean'),
			)
		);
		
		
		/*
		function beforeSave(){
			$this->data['Event']['start'] = $this->_getDate('Event', 'start');

			return true;
		}
		*/
		
}

?>