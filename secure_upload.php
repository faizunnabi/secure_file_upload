<?php
class SecureUpload{

    protected $destination_path = "resume/";
    protected $allowed_ext=["pdf","doc","docx","rtf","txt"];
    protected $allowed_size = 2048*1024;

    function check_mime($file){
        $extension=pathinfo($file["images"]["name"], PATHINFO_EXTENSION);
        $extension=strtolower($extension);
        
        return in_array($extension,$this->allowed_ext);
    }

    function check_size($file){
        if($file['images']['size'] > $this->allowed_size){
            return false;
        }
        return true;
    }
    function secure_upload($file){
       if($this->check_mime($file) && $this->check_size($file)){
                $fname=time().".".pathinfo($file["images"]["name"], PATHINFO_EXTENSION);
                $success=move_uploaded_file($file["images"]["tmp_name"],$this->destination_path.$fname);
                if($success){
                    return true;
                }
                return "Error in file uploading";
             }
    }

}
?>