<?php

class Comments {
   private $id;
   private $writer;
   private $comments;
   private $survey;

   public function __construct($writer, $survey){
     $this->id = null;
     $this->writer = $writer;
     $this->survey = $survey;
     $this->comments = array();
   }

   public function setId($id){
     $this->id = $id;
   }

   public function getId($id) {
     return $this->id;
   }

   public function getWriter($writer) {
     return $this->writer;
   }

   public function getSurvey($survey){
     return $this->survey;
   }

   public function getComment($comments){
     return $this->comments;
   }

   public function setComment($comments){
     $this->comments = $comments;
   }

   public function addComment($comment){
     $this->comments[] = $comment;
   }
}


 ?>
