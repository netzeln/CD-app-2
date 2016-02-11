<?php
    class CD
    {
        private $title;
        private $artist;
        private $cover_art;

        function __construct($album_name, $band_name, $image_path)
        {
            $this->title = $album_name;
            $this->artist = $band_name;
            $this->cover_art = $image_path;
        }

        function setTitle($new_title)
        {
            $this->title = $new_title;
        }

        function getTitle()
        {
            return $this->title;
        }

        function setArtist($new_artist)
        {
            $this->artist = $new_artist;
        }

        function getArtist()
        {
            return $this->artist;
        }

        function setCoverArt($new_cover_art)
        {
            $this->cover_art = $new_cover_art;
        }

        function getCoverArt()
        {
            return $this->cover_art;
        }

        function saveCD()
        {
            array_push($_SESSION['list_of_CDs'], $this);
        }

        static function getAll()
        {
            return $_SESSION['list_of_CDs'];
        }

        static function deleteAll()
        {
            $_SESSION['list_of_CDs']= array();
        }

    }
?>
