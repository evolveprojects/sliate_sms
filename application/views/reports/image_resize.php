<?php

$this->load->helper('directory');
//$imagepath = $_GET['image'];
//$myHeight = 100;
//$myWidth = 100;
//
//if(file_exists($imagepath)){
//	$size = getimagesize($imagepath);
//	$source_x = $size[0];
//	$source_y = $size[1];
//	$source_id = imagecreatefromjpeg($imagepath);
//	$target_id = imagecreatetruecolor($myWidth, $myHeight);
//	$target_pic = imagecopyresampled($target_id, $source_id, 0, 0, 0, 0, $myWidth, $myHeight, $source_x, $source_y);
//	imagejpeg($target_id);
//}
//
////lets assume that this file is named "thumbnail.php"
////in another file, <img src="thumbnail.php?image=myimage.jpg" alt="thumbnail" />


//--------------------------- new code ---------------
        $i = 1;
        $percent = 0.5; // percentage of resize
        
        // Content type
       // header('Content-type: image/jpeg');
        
        //$path = base_url('uploads/studentprofile');
        
        $map = directory_map('./uploads/studentprofile/');
        
      //  $files = array_diff(scandir($path), array('.', '..'));
        
        foreach($map as $img) {
            // Get new dimensions
            $size = getimagesize('./uploads/studentprofile/'.$img);
            list($width, $height) = getimagesize('./uploads/studentprofile/'.$img);
            $new_width = $width * $percent;
            $new_height = $height * $percent;
            
            switch ($size['mime']) { 
                case "image/gif": 
                    header ('Content-Type: image/gif');
                    // Resample
                    $image_p = imagecreatetruecolor($new_width, $new_height);
                    $image = imagecreatefromgif('./uploads/studentprofile/'.$img);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                    $name = $img;
                    // Output
                    imagegif($image_p, "./uploads/resized_images/" . $name, 50); 
                    // Free up memory
                    imagedestroy($image_p);
                    break; 
                
                case "image/jpeg": 
                case "image/jpg":
                    header ('Content-Type: image/jpeg');
                    // Resample
                    $image_p = imagecreatetruecolor($new_width, $new_height);
                    $image = imagecreatefromjpeg('./uploads/studentprofile/'.$img);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                    $name = $img;
                    // Output
                    imagejpeg($image_p, "./uploads/resized_images/" . $name, 50);
                    // Free up memory
                    imagedestroy($image_p);
                    break; 
                
                case "image/png": 
                    header ('Content-Type: image/png');
                    // Resample
                    $image_p = imagecreatetruecolor($new_width, $new_height);
                    $image = imagecreatefrompng('./uploads/studentprofile/'.$img);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                    $name = $img;
                    // Output
                    imagepng($image_p, "./uploads/resized_images/" . $name, 5);
                    // Free up memory
                    imagedestroy($image_p);
                    break; 
                
                
//                case "image/bmp":
//                //case "image/x-ms-bmp": 
//                    header ('Content-Type: image/bmp');
//                    // Resample
//                    $image_p = imagecreatetruecolor($new_width, $new_height);
//                    $image = imagecreatefrombmp('./uploads/studentprofile/'.$img);
//                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
//
//                    $name = $i.".bmp";
//                    // Output
//                    imagebmp($image_p, "./uploads/resized_images/" . $name, 50);
//                    // Free up memory
//                    imagedestroy($image_p);
//                    break; 
            }

//            // Resample
//            $image_p = imagecreatetruecolor($new_width, $new_height);
//            $image = imagecreatefromjpeg('./uploads/studentprofile/'.$img);
//            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
//
//            $name = $i.".jpg";
//            // Output
//            imagejpeg($image_p, "./uploads/resized_images/" . $name, 50);

//            // Free up memory
//            imagedestroy($image_p);
            
            $i++;
        }
        return $i;
           
?>
