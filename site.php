<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="site.php" method="post">
      <input type="text" name="problem">
      <br>
    </form>
    Answer: <?php
              $problem = $_POST["problem"];
              echo $problem." = ";
              $num1 = ""; $op1 = "";
              $num2 = ""; $op2 = "";
              $num3 = ""; $op3 = "";
              $num4 = "11";
              if($problem != null)
          for($i = 0; $i < strlen($problem); $i++){
                if($problem[$i] == " ")
                  continue;
                if ($op1 == "")
                if(is_numeric($problem[$i])){
                  $num1 = $num1 . $problem[$i];
                  continue;
                } else {
                  $op1 = $problem[$i];
                  continue;
                }
                if ($op2 == "")
                if(is_numeric($problem[$i]) ){
                  $num2 .= $problem[$i];
                  continue;
                } else {
                  $op2 = $problem[$i];
                  continue;
                }
                if ($op3 == "")
                if(is_numeric($problem[$i])){
                  $num3 .= $problem[$i];
                  continue;
                } else {
                  $op3 = $problem[$i];
                  continue;
                }
                if(is_numeric($problem[$i])){
                  $num4 .= $problem[$i];
                  continue;
                } else {
                  echo "ERROR";
                  break;
                }
              }
              $num1 = intval($num1);
              $num2 = intval($num2);
              $num3 = intval($num3);
              $num4 = intval($num4);
            switch ($op1) {
              case "+":
                $num2 = $num1 + $num2;
                break;
              case "-":
                $num2 = $num1 - $num2;
                break;
              case "*":
                $num2 = $num1 * $num2;
                break;
              case "/":
                $num2 = $num1 / $num2;
                break;
              default:
                $num2 = $num1;
                break;
            }
            switch ($op2) {
              case "+":
                $num3 = $num2 + $num3;
                break;
              case "-":
                $num3 = $num2 - $num3;
                break;
                case "*":
                  $num3 = $num2 * $num3;
                  break;
                case "/":
                  $num3 = $num2 / $num3;
                  break;
              default:
                $num3 = $num2;
                break;
            }
            switch ($op3) {
              case "+":
                $num4 = $num3 + $num4;
                break;
              case "-":
                $num4 = $num3 - $num4;
                break;
                case "*":
                  $num4 = $num3 * $num4;
                  break;
                case "/":
                  $num4 = $num3 / $num4;
                  break;
              default:
                $num4 = $num3;
                break;
            }
            echo $num4;
       ?>

  </body>
</html>
