<?php

class Lang_Ctrl{
    private static $instant = null;

    private $current_Dict_name = "VI_EN",
            $Dict = array();

    public $is_multi_language = true;


    public static function Instant(){
        if(empty(self::$instant)){
            self::$instant = new Lang_Ctrl();
        }
        return self::$instant;
    }

    function __construct(){
        if(empty(self::$instant)){
            self::$instant = $this;
        }
    }

    public function Trans($text = ""){
        if(!$this->is_multi_language)
            return $text;
        if(count($this->Dict) <= 0)
            $this->ChangeDict($this->current_Dict_name);
        foreach($this->Dict as $key=>$value){
            if($text === $key){
                return $value;
            }
        }
        return $text;
    }

    public function ChangeDict($name){
        $this->current_Dict_name = $name;
        $myfile = fopen("Language/".$name.".txt", "r") or die("Unable to open file!");

        $content = "";
        // Output one line until end-of-file
        while(!feof($myfile)) {
            $content .= fgets($myfile);
        }
        fclose($myfile);

        $this->Dict = json_decode($content);
    }

}

?>