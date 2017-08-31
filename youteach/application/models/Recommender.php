<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Recommender extends CI_Model
{
    public function getRecommendations($itemID){
        $userID = $this->session->userdata("id");
        $itemId = array();
        $result = $this->db->query("SELECT DISTINCT r.course_id, r2.rating - r.rating as rating_difference
                                    FROM user_rating r , user_rating r2 WHERE r.user_id=$userID AND
                                    r2.course_id=$itemID AND
                                    r2.user_id=$userID")->result();
        foreach($result as $row){
            $other_itemID = $row->course_id;
                //echo $other_itemID."<br>";
                $rating_difference = $row->rating_difference;
                $sql = "SELECT item_id1 FROM dev WHERE item_id1=$itemID AND item_id2=$other_itemID";
                $temp = $this->db->query($sql);
                if($temp->num_rows()>0)
                {
                   $sql = "UPDATE dev SET count=count+1,sum=sum+$rating_difference WHERE item_id1=$itemID AND item_id2=$other_itemID";
                   
                   $temp1 = $this->db->query($sql);
                   if($itemID != $other_itemID)
                   {
                       $sql = "UPDATE dev SET count = count+1, sum=sum-$rating_difference WHERE item_id1=$itemID"
                           . " AND item_id2=$other_itemID";
                       $temp2 = $this->db->query($sql);
                   }        
                }
                else
                {
                    
                    //$sql = "INSERT INTO dev VALUES($itemID,$other_itemID,1,$rating_difference)";
                    $this->db->insert("dev",array(
                        "item_id1"=>$itemID,
                        "item_id2"=>$other_itemID,
                        "count" => 1,
                        "sum" =>$rating_difference
                    ));
                    if($itemID != $other_itemID)
                    {
                        //$sql = "INSERT INTO dev VALUES($other_itemID,$itemID,1,-$rating_difference)";
                        $this->db->insert("dev",array(
                        "item_id1"=>$other_itemID,
                        "item_id2"=>$itemID,
                        "count" => -1,
                        "sum" =>-$rating_difference
                    ));
                        //mysqli_query($conn , $sql);
                    }   
                }
        }
        
        $sql2 = "SELECT d.item_id1 as 'item',
                    sum(d.sum + d.count * r.rating)/sum(d.count) as 'avgrat'
                    FROM user_rating r, dev d WHERE r.user_id=$userID AND d.item_id1 NOT IN
                    (SELECT course_id FROM user_rating WHERE user_id=$userID AND d.item_id2=r.course_id)
                    GROUP BY d.item_id1 ORDER BY avgrat DESC LIMIT 5";
                    
                    $result = $this->db->query($sql2)->result();
                    
                    foreach($result as $row)
                    {
                        echo $row->item." | ".$row->avgrat."<br>";
                    } 
             
            $sql = "SELECT item_id2, sum/count as average FROM dev WHERE (sum/count) > 0 AND item_id1 = $itemID LIMIT 10"; 
            $result = $this->db->query($sql)->result();

          
            return $result;
    }
}