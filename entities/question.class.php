<?php
require_once("config/db.class.php");



class Questions{
    public  $questionID ; 
    public  $question; 
    public	$answer1; 
    public	$answer2; 
    public	$answer3; 
    public	$answer4; 
    public	$correctAnswer;	
    public	$categoryID;	

    public function __construct($ques, $ans1, $ans2, $ans3, $ans4,$correct ,$cateID)
    {
        $this->question = $ques;
        $this->answer1 = $ans1;
        $this->answer2 = $ans2;
        $this->answer3 = $ans3;
        $this->answer4 = $ans4;
        $this->correctAnswer = $correct;
        $this->categoryID = $cateID;
    }
    public static function List_Question()
    {
        $db = new Db();
        $sql = "SELECT * FROM Questions";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public function save()
    {
        $db = new Db();
        $sql = "INSERT INTO questions(Question, Answer1, Answer2, Answer3, Answer4, CorrectAnswer, CategoryID) VALUES 
        ('$this->question','$this->answer1','$this->answer2','$this->answer3','$this->answer4','$this->correctAnswer',$this->categoryID)";
        $result = $db->query_execute($sql);
        return $result;
    }
    public static function Get_Question_by_ID($id)
    {
        $db = new Db();
        $sql = "SELECT * FROM Questions where QuestionID = $id";
        $result = $db->select_to_array($sql);
        return $result;
    }
    public static function update($id, $Question,$Answer1, $Answer2,$Answer3, $Answer4 ,$CorrectAnswer, $CategoryID)
    {
        $db = new Db();
        $sql = "UPDATE `questions` SET `Question`='$Question',`Answer1`='$Answer1',`Answer2`='$Answer2',`Answer3`='$Answer3',`Answer4`='$Answer4',`CorrectAnswer`='$CorrectAnswer',`CategoryID`='$CategoryID' WHERE QuestionID = $id";
        $result = $db->query_execute($sql);
        return $result;
    }
    public static function delete($id )
    {
        $db = new Db();
        $sql = "DELETE FROM Questions WHERE QuestionID  = $id;";

        $result = $db->query_execute($sql);
        return $result;
    }
   
   
}