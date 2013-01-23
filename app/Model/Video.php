<?php

class Video extends AppModel {
        public $name = 'Video';
		/*
		public $hasMany = array(			
			'posts_video'=> array(
				'className' => 'posts_video',
				'foreignKey' => 'post_id'
			) ,
			'playlists_videos'=> array(
				'className' => 'playlists_videos',
				'foreignKey' => 'playlist_id'
			) ,
		);
		*/
		/*
		var $hasAndBelongsToMany = array(
				'Playlist' =>            array(
					'className'              => 'Playlist',
					'joinTable'              => 'playlists_videos',
					'foreignKey'             => 'playlist_id',
					'associationForeignKey'  => 'video_id'									
				)
		 );
		*/
}

?>