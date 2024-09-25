<?php
class Article {
    private $title;
    private $summary;
    private $cat_name;

    public function __construct($title, $summary, $cat_name) {
        $this->title = $title;
        $this->summary = $summary;
        $this->cat_name = $cat_name;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getSummary() {
        return $this->summary;
    }

    public function getCatName() {
        return $this->cat_name;
    }
}
?>
