<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostControllered extends Controller
{
    //

    public function postRequest (Request $request)
    {
        $first_number = $request->input('x');
        $second_number = $request->input('y');
        $string = $request->input('operation_type');
        $op = "Operation";

        $string = str_replace('.','',$string);
        $string = str_replace(',','',$string);
        $string = str_replace('!','',$string);
        $string = str_replace(';','',$string);
        $string = str_replace(':','',$string);
        $string = str_replace('"','',$string);
        $string = str_replace('\'','',$string);
        
        $arr = explode(' ',$string);
        
        $num_arr = array(); $num_index = array();
        $operator = '';
        $f_word_index = 0; $word_index = 0;
        
        for ($i=0; $i < count($arr); $i++) { 
            if (is_numeric($arr[$i])) {
                 array_push($num_arr,$arr[$i]);
                 array_push($num_index,$i);

                 if(array_key_exists(0, $num_index) && (strtolower($arr[$i-1])=='-') && is_numeric($arr[$i-2])){ //special case of dash (-)
                    $operator = '-';
                    $word_index = $i;
                }
            }
            if (strtolower($arr[$i] == 'from')){
                $f_word_index = $i;
            }
        
            if(strtolower($arr[$i])=='multiply'||strtolower($arr[$i])=='multiplication'||strtolower($arr[$i])=='times'||strtolower($arr[$i])=='x'||strtolower($arr[$i])=='*'||strtolower($arr[$i])=='exponentially'||strtolower($arr[$i])=='accumulate' ||strtolower($arr[$i])=='proliferate'||strtolower($arr[$i])=='mount'||strtolower($arr[$i])=='expand'||strtolower($arr[$i])=='spread'||strtolower($arr[$i])=='mushroom'||strtolower($arr[$i])=='snowball'||strtolower($arr[$i])=='numerous'||strtolower($arr[$i])=='burgeon'||strtolower($arr[$i])=='wax') {
                $operator = '*';
                $word_index = $i;
            }
            else if(strtolower($arr[$i])=='addition'||strtolower($arr[$i])=='add'||strtolower($arr[$i])=='plus'||strtolower($arr[$i])=='sum'||strtolower($arr[$i])=='all'||strtolower($arr[$i])=='altogether'||strtolower($arr[$i])=='many'&&strtolower($arr[$i-1])=='how'||strtolower($arr[$i])=='total'||strtolower($arr[$i])=='together'||strtolower($arr[$i])=='more'&&strtolower($arr[$i+1])=='than'||strtolower($arr[$i])=='increase'||strtolower($arr[$i])=='increased'||strtolower($arr[$i])=='count'||strtolower($arr[$i])=='figure'&&strtolower($arr[$i+1])=='up'||strtolower($arr[$i])=='compute'||strtolower($arr[$i])=='calculate'||strtolower($arr[$i])=='enumerate'||strtolower($arr[$i])=='reckon'||strtolower($arr[$i])=='tally'||strtolower($arr[$i])=='+'){ 
                $operator = '+';
                $word_index = $i;
            }
        //    else if(strtolower($arr[$i])=='subtract'||strtolower($arr[$i])=='minus' ||strtolower($arr[$i])=='difference'||strtolower($arr[$i])=='left'||strtolower($arr[$i])=='subtraction'||strtolower($arr[$i])=='remove'||strtolower($arr[$i])=='reduce'||strtolower($arr[$i])=='deduce'||strtolower($arr[$i])=='decrease'||strtolower($arr[$i])=='diminute'||strtolower($arr[$i])=='diminish'||strtolower($arr[$i])=='take'||strtolower($arr[$i])=='deduct'||strtolower($arr[$i])=='debit' ||strtolower($arr[$i])=='abstract'||strtolower($arr[$i])=='discount'||strtolower($arr[$i])=='withdraw'||strtolower($arr[$i])=='dock' ||strtolower($arr[$i])=='off') {
        //         $operator = '-';
        //         $word_index = $i;
        //     }
            else if (in_array(strtolower($arr[$i]), ['subtract','minus','difference','left','subtraction','remove','reduce','deduce','decrease','diminute','diminish','take','deduct','debit','abstract','discount','withdraw','dock','off'], true ) ) {
                {
                    $operator = '-';
                    $word_index = $i;
                }
            }
        }
 
        //case 1: from 1 subtract 2: f>>1>>2 => 1-2 ~ (first number is first operand)
        //case 2: subtract 1 from 2: 1>>f>>2 => 2-1 ~ (second number is first operand)
        if(count($num_arr)>0){
            if($f_word_index == ($num_index[0]-1)){
                $second_number = array_pop($num_arr);
                $first_number = array_pop($num_arr); 
            }else{
                $first_number = array_pop($num_arr); 
                $second_number = array_pop($num_arr);
            }
            
          }
        $result = '';

        if (is_numeric($first_number) && is_numeric($second_number)) {
            switch ($operator) {
            case "+":
                $result = $first_number + $second_number;
                $op = "Addition";
                break;
            case "-":
                $result = $first_number - $second_number;
                $op = "Subtraction";
                break;
            case "*":
                $result = $first_number * $second_number;
                $op = "Multiplication";
                break;
            default:
                $result = "Error! Unkown operation";
                $op = "Operation not found";
            }

            return response()->json([
                    'slackUsername' => "rux1212",
                    'operation_type' => $op,
                    'Result' => $result
                ]);
        }
    }

}



// <ul><li>Add</li>
// <li>Plus</li>
// <li>More</li>
// <li>Total</li>
// <li>Increase</li>
// <li>Together / Altogether</li>
// <li>Combined</li>
// <li>Sum</li>
// <li>Grow</li></ul>


// <ul><li>Subtract</li>
// <li>Minus</li>
// <li>Take away</li>
// <li>Less / Fewer than</li>
// <li>Difference</li>
// <li>Decrease</li>
// <li>How many are left / remain?</li>






















// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class PostController extends Controller
// {

//     public function postRequest (Request $request)
//     {
//         $first_number = $request->input('x');
//         $second_number = $request->input('y');
//         $string = $request->input('operation_type');
//         $op = "Operation";
//         $arr = sanitizeStr($string);
        
//         $num_arr = array(); $num_index = array();
//         $operator = '';
//         $f_word_index = 0; $word_index = 0;
               
//         loopOpType($arr, $word_index, $f_word_index, $operator, $num_arr);
//         checkOp($arr, $f_word_index, $first_number, $second_number, $num_arr, $num_index);
//         checkDirection($num_arr, $f_word_index, $num_index, $first_number, $second_number);
        
//         $result = '';

//         if (is_numeric($first_number) && is_numeric($second_number)) {
//             switch ($operator) {
//             case "+":
//                 $result = $first_number + $second_number;
//                 $op = "addition";
//                 break;
//             case "-":
//                 $result = $first_number - $second_number;
//                 $op = "subtraction";
//                 break;
//             case "*":
//                 $result = $first_number * $second_number;
//                 $op = "multiplication";
//                 break;
//             default:
//                 $result = "Error! Unkown operation";
//                 $op = "Operation not found";
//             }

//             return response()->json([
//                     'slackUsername' => "ruxy1212",
//                     'result' => $result,
//                     'operation_type' => $op
//                 ]);
//         }


//         function sanitizeStr($string){
//             $string = str_replace('.',"",$string);
//             $string = str_replace(',',"",$string);
//             $string = str_replace('!',"",$string);
//             $string = str_replace(';',"",$string);
//             $string = str_replace(':',"",$string);
//             $string = str_replace('"',"",$string);
//             $string = str_replace("'","",$string);
            
//             $arrA = explode(' ',$string);
//             $arr = array_map('strtolower', $arrA);
//             return $arr;
//         }

//         function loopOpType($arr, $word_index, $f_word_index, $operator, $num_arr ){
//             for ($i=0; $i < count($arr); $i++) { 
//                 if (is_numeric($arr[$i])) {
//                      array_push($num_arr,$arr[$i]);
//                      array_push($num_index,$i);
//                     if(array_key_exists(1, $num_index) && ($arr[$i-1]=='-') && is_numeric($arr[$i-2])){ //special case of dash (-)
//                         $operator = '-';
//                         $word_index = $i;
//                     }
//                     if(array_key_exists(1, $num_index) && ($arr[$i-1]=='x') && is_numeric($arr[$i-2])){ //special case of times (x)
//                         $operator = '*';
//                         $word_index = $i;
//                     }
//                 }
//                 if ($arr[$i] == 'from'){
//                     $f_word_index = $i;
//                 }
    
//                 if (in_array($arr[$i], ['multiply','multiplication','product','times','*','exponentially','accumulate','proliferate','mount','expand','spread','mushroom','snowball','numerous','burgeon','wax'], true ) ) {
//                     $operator = '*';
//                     $word_index = $i;
//                 }
//                 else if (in_array($arr[$i], ['add','plus','more','increase','combined','grow','addition','sum','all','altogether','total','together','increase','increased','count','compute','calculate','enumerate','reckon','tally','+'], true ) || $arr[$i]=='many'&&$arr[$i-1]=='how' || $arr[$i]=='figure'&&$arr[$i-1]=='up'||$arr[$i]=='more'&&$arr[$i-1]=='than') {
//                     $operator = '+';
//                     $word_index = $i;
//                 }
//                 else if (in_array($arr[$i], ['subtract','minus','difference','left','subtraction','remove','reduce','deduce','decrease','diminute','diminish','take','deduct','debit','abstract','discount','withdraw','dock','off','comot'], true ) || $arr[$i]=='than'&&$arr[$i-1]=='less' || $arr[$i]=='than'&&$arr[$i-1]=='fewer'||$arr[$i]=='away'&&$arr[$i-1]=='take') {
//                     $operator = '-';
//                     $word_index = $i;
//                 }
//             }
//         }

//         function checkOp($arr, $f_word_index, $first_number, $second_number, $num_arr, $num_index){
//             if((in_array("first", $arr) || in_array("x", $arr)) || (in_array("second", $arr) || in_array("y", $arr))){
//                 ( in_array("first", $arr) ? $first_index = array_search('first', $arr) : $first_index = 9999999 );
//                 ( in_array("x", $arr) ? $x_index = array_search('x', $arr) : $x_index = 9999999 );
//                 ( in_array("second", $arr) ? $second_index = array_search('second', $arr) : $second_index = 9999999 );
//                 ( in_array("y", $arr) ? $y_index = array_search('y', $arr) : $y_index = 9999999 );
                
//                 if((($first_index < $f_word_index) && ($f_word_index < $second_index))  || (($x_index < $f_word_index) && ($f_word_index < $y_index)) && (count($num_arr)==0)){ //x from y
//                     $temp_number = $first_number;
//                     $first_number = $second_number; 
//                     $second_number = $temp_number;
//                 }
//                 if(count($num_arr) == 1){
//                     if($first_index != 9999999 || $x_index != 9999999){
//                         $second_number = array_pop($num_arr); 
//                     }else if ($second_index != 9999999 || $y_index != 9999999){
//                         if(($f_word_index > $num_index[0]) && ($second_index > $f_word_index)){ //num<f<second
//                             $temp_number = $first_number; 
//                             $first_number = array_pop($num_arr); 
//                             $second_number = $temp_number;
//                         }
//                     }
//                 }
//             }
//         }
//         //case 1: from 1 subtract 2: f>>1>>2 => 1-2 ~ (first number is first operand)
//         //case 2: subtract 1 from 2: 1>>f>>2 => 2-1 ~ (second number is first operand)
//         function checkDirection($num_arr, $f_word_index, $num_index, $first_number, $second_number){
//             if(count($num_arr)>1){
//                 if($f_word_index == ($num_index[0]-1)){
//                     $second_number = array_pop($num_arr);
//                     $first_number = array_pop($num_arr); 
//                 }else{
//                     $first_number = array_pop($num_arr); 
//                     $second_number = array_pop($num_arr);
//                 }          
//               }
//         }
//     }
// }