<?php
    class CD
    {
        private $artist_name;
        private $album_name;
        private $image;

        function __construct($artist, $album, $cover)
        {
            $this->artist_name = $artist;
            $this->album_name = $album;
            $this->image = $cover;
        }

        function setArtist($new_name)
        {
            $this->artist_name = $new_name;
        }

        function getArtist()
        {
            return $this->artist_name;
        }

        function setAlbum($new_album)
        {
            $this->album_name = $new_album;
        }

        function getAlbum()
        {
            return $this->album_name;
        }

        function setImage($new_image)
        {
            $this->image = $new_image;
        }

        function getImage()
        {
            return $this->image;
        }

        function save()
        {
            array_push($_SESSION['list_of_cds'], $this);
        }

        static function getAll()
        {
            return $_SESSION['list_of_cds'];
        }

        static function deleteAll()
        {
            $_SESSION['list_of_cds']  = array();
        }
    }
?>
