<?php
include_once("Init.php");

$errors = array();
// Show code error (if any)
// ini_set('display_errors',1);
// error_reporting(E_ALL);

if(isset($_POST["addPhoto"]) && isset($_FILES['image'])){
      $name = $DB->Security( $_POST["photo_name"]);
      $allTags = $DB->Security($conn, $_POST["photo_tag"]);
      $description = $DB->Security($conn, $_POST["photo_description"]);

      // Get current user id 
      $getUserNameQuery = "SELECT user_id from users WHERE user_name = '".$_SESSION['username']."'";
      //$result = mysqli_query($conn,  $getUserNameQuery);
      $row =$DB->fetch_assoc($result);
      $user_id = $row["user_id"];

      // File handling and insert photo in to db
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
        array_push($errors, "Extension not allowed");
      } else if ($file_size > 2097152) {
        array_push($errors, "File size must be lower than 2MB");
      } else {
         /*Dear teacher: If you want to test our submission, you may want to change the "/var/www/html" part 
         in the $path variable to something suitable. For example, you will need to change it 
         to C:/xampp/htdocs if you test our submission using xmapp on windows.
         */
         $path = "/var/www/html/Web-assignment/image/";
         $localPath = $path.$file_name;
         if (is_dir($path)) {
            @mkdir($path, 0777, true);
         }
         move_uploaded_file($file_tmp, $localPath);
         $locaPathinDB = "/Web-assignment/image/".$file_name;
         $insertPhotoQuery = "INSERT INTO photos(photo_title, photo_description, user_id, photo_dir) VALUES('$name', '$description', '$user_id', '$locaPathinDB')";  
            if ($DB->query( $insertPhotoQuery)) {     
               $photo_id = $DB->insert_id();        
            } else {
               // currently empty, for error diagnostic only
            }
      }

      // Tag handling
      $tagArray = explode(", ", $allTags);
      $allTagid = array();
      // check if the tag already exists
      foreach($tagArray as $aTag) {
         $checkTagQuery = "SELECT * FROM tags WHERE tag_name ='".$aTag."' LIMIT 1";
         
         $tag = $DB->fetch_assoc($checkTagQuery);
         if ($tag == null) {
            $insertTagQuery = "INSERT INTO tags(tag_name) VALUES ('".$aTag."')";
            $DB->query($insertTagQuery);
            // get the last id inserted
            $tag_id = $DB->insert_id();  
            array_push($allTagid, $tag_id);
         } else {
            // if found, get it's id
            $tag_id = $tag['tag_id'];
            array_push($allTagid, $tag_id);
         }
      }
   
      $query_values = array();
      $insertTagPhotoQuery = "INSERT INTO tag_photo(photo_id, tag_id) VALUES ";
      foreach ($allTagid as $aTagid) {
         array_push($query_values, "('".$photo_id."', '".$aTagid."')");
      }
      $valuesPart = implode(",", $query_values);
      $insertTagPhotoQuery .= $valuesPart;
      $DB->query( $insertTagPhotoQuery);
   }
?>