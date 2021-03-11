<?php

include 'config.php';

class ClubForce{

    function processStudentsGrades($data){

        $utils_class = new Utils();
        foreach ($data as $value) {

            if(!isset($value['name']) || !isset($value['grade']) || ($value['grade']<MIN_GRADE || $value['grade'] > MAX_GRADE)){
                return false;
            }
            $gradePass=false;
            if($value['grade']>=MINIMUM_GRADE_TO_PASS){
                $gradePass=true;
            }
            $roundedValue=$value['grade'];
            $nextFiveMultiple=$utils_class->roundUp($roundedValue);
            if($nextFiveMultiple-$roundedValue<MIN_DIFF_TO_ROUND){
                $roundedValue=$nextFiveMultiple;
            }else{
                /* Ternary operator because if roundedvalue is less than MIN_DIFF_TO_ROUND can produce a -0, 
                but is mathematical equal to 0 https://math.stackexchange.com/questions/667577/does-negative-zero-exist/667594  */

                $roundedValue=$roundedValue<MIN_DIFF_TO_ROUND ? 0 : round(($roundedValue-MULTIPLE_ROUND/2)/MULTIPLE_ROUND)*MULTIPLE_ROUND; //Round to previous multiple
            }
            $result[] = array('name' => $value['name'], 'grade' => $roundedValue, 'pass' =>$gradePass);
        }

        return $result;
    }
}

class Utils{
    function roundUp($n,$x=MULTIPLE_ROUND) {
        return (round($n)%$x === 0) ? round($n) : round(($n+$x/2)/$x)*$x;
    }
}
?>