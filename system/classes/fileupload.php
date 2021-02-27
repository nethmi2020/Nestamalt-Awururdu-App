<?php   

require_once DOC_ROOT.'vendor/autoload.php';


class Fileupload
{

	function checkType($name, $type){

        echo "fuck";
    //$extension = strtolower(substr($name, strpos($name, '.') + 1)); //get the extension
    $extension = pathinfo($name, PATHINFO_EXTENSION); //better way to get extension
    if (!empty($name)) {
        if (($extension == 'pdf' || $extension == 'PDF')) {
            return true;
        } else{
          //  echo 'That is not a jpg or png';
            return false;
        }
    }
}

function checkTypeImages($name, $type){
    //$extension = strtolower(substr($name, strpos($name, '.') + 1)); //get the extension
    $extension = pathinfo($name, PATHINFO_EXTENSION); //better way to get extension
    if (!empty($name)) {
        if (($extension == 'jpg' || $extension == 'jpeg'|| $extension == 'png'|| $extension == 'gif')) {
            return true;
        } else{
          //  echo 'That is not a jpg or png';
            return false;
        }
    }
}

function checkSize($size, $max_size){
    if($size <= $max_size){
        return true;
    } else{
       // echo 'File is too large. Max size in 30KB.';
        return false;
    }
}
function fileExists($name){
    $filename = rand(1000,9999).md5($name).rand(1000, 9999);
    echo $filename;
    return false;
}
function save_file($tmp_name, $name, $location){      
 
        
        // $rand = rand(10000, 99999);
        // $name = $rand . '.' . pathinfo($name, PATHINFO_EXTENSION); //create new name


         $name_arr = explode('.', $name);
         $ext = end($name_arr);
         unset($name_arr[count($name_arr)-1]);
         $new_name = implode('_', $name_arr).'_'.time().'.'.$ext;

    
    if (move_uploaded_file($tmp_name, $location . $new_name)) {

    	return $new_name;
        echo 'Successfullly uploaded! ';        
    } else {
        echo 'ERROR!';
    }
}


}



  ?>