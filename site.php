<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <p1> *, /, +, -, ), (. </p1>
    <hr>
    <form action="site.php" method="post">
      <input type="text" name="problem">
      <br>
    </form>
    <hr>
        Answer: <?php
        $problem = $_POST["problem"];
        $args_arr = array();
        $sign_arr = array();
        $buff_arr = array();
//fill arrays from str
      function fill($problem){
        $GLOBALS['args_arr'] = array();
        $GLOBALS['sign_arr'] = array();
        if($problem != null)
        for($i = 0; $i < strlen($problem); $i++){
          $buff_arr = get_next_number($problem, $i);
          $i = $buff_arr[1];
          if($buff_arr[0] != "")
            array_push($GLOBALS['args_arr'] , $buff_arr[0]);
          else
            array_push($GLOBALS['sign_arr'], $problem[$i]);
        }
      }
      //returns next numerical value in array
            function get_next_number($str, $i){
              $num = "";

              for( ; $i < strlen($str); $i++){
                if($str[$i] == " "||$str[$i] == "("||$str[$i] == ")")
                  continue;
                if(is_numeric($str[$i]) || $str[$i] =="."){
                  $num = $num . $str[$i];
                  continue;
                } else
                  if($num != "")
                  $i--;
                  break;
              }
              return array($num, $i);
            }
            //returns next numerical value in array
                  function get_prev_number($str, $i){
                    $num = "";

                    for( ; $i >= 0; $i--){
                      if($str[$i] == " ")
                        continue;
                      if(is_numeric($str[$i]) || $str[$i] =="."){
                        $num = $str[$i].$num  ;
                        continue;
                      } else
                        if($num != "")
                        $i++;
                        break;
                    }
                    return array($num, $i);
                  }
//solve binary expression
      function answer($num1, $num2, $sign){
        $a = 0;
        switch ($sign) {
        case "^":
          $a = pow($num1, $num2);
          break;
        case "+":
          $a = $num1 + $num2;
          break;
        case "-":
          $a = $num1 - $num2;
          break;
        case "*":
          $a = $num1 * $num2;
          break;
        case "/":
          $a = $num1 / $num2;
          break;
        default:
          break;
        }
        return $a;
      }
//calculate args and signs arrays
      function calculate(){
        $args_arr = $GLOBALS['args_arr'];
        $sign_arr = $GLOBALS['sign_arr'];
        $priority = array();
        for($i = 0; $i<count($sign_arr); $i++){
          if ($sign_arr[$i] == "*" || $sign_arr[$i] == "/" || $sign_arr[$i] == "^")
            array_unshift($priority, $i);
          else
            array_push($priority, $i);
        }
        $i = 0;
        for(; $i<count($sign_arr); $i++){
          $args_arr[$priority[$i]] =
           answer($args_arr[$priority[$i]],
            $args_arr[$priority[$i]+1]
            , $sign_arr[$priority[$i]]);
          $args_arr[$priority[$i]+1] = $args_arr[$priority[$i]];
        }
        return $args_arr[$priority[$i-1]];
      }
//sort and solve "()"
      function sortz($str){

        $start = strpos($str, "(");
        $end = strpos($str, ")");
        if($start!=false || $end!=false){
          $sub = substr($str, $start+1, $end-$start-1);
          $sub = sortz($sub);
          fill($sub);
          $buff = calculate();
          $str = str_replace("(".$sub.")", $buff, $str);
        }
        $pow = strpos($str, "^");
        if ($pow != false){
          $next = get_next_number($str, $pow+1);
          $prev = get_prev_number($str, $pow-1);
          $sub = $prev[0]."^".$next[0];
          fill($sub);
          $buff = calculate();
          $str = str_replace($sub, $buff,  $str);
          }
        return $str;
      }
    echo $problem." = ";
    //fill all numbers and signs
    $problem = sortz($problem);

    fill($problem);
    //calculate

    echo calculate($args_arr, $sign_arr);
       ?>

  </body>
</html>

