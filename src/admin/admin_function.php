<?php
class adjust_digit{
    public function single($event){
        for($i=1;$i<=9;$i++){
            if($event=='0'.$i){
                //引数が0付きの二桁の場合一桁に直して返す
              return $i;  
            }
        }
        return $event;
    }
    public function double($event){
        for($i=1;$i<=9;$i++){
            if($event==$i){
                return '0'.$i;
            }
        }
        return $event;
    }
}
$adjust=new adjust_digit;
?>