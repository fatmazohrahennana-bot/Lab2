<? php
 $result = "";
 $tableHtml = "";

 if ( $_SERVER [’ REQUEST_METHOD ’] == ’POST ’) {
 $courses = $_POST [’course ’] ?? [];
 $credits = $_POST [’credits ’] ?? [];
 $grades = $_POST [’grade ’] ?? [];
 $totalPoints = 0;
 $totalCredits = 0;

 $tableHtml = "<table >";
 $tableHtml .= "<tr >
 <th > Course </th > <th > Credits </th >
 <th >Grade </th > <th > Grade Points </th >
 </tr >";
 for ( $i = 0; $i < count ( $courses ) ; $i ++) {
 $course = htmlspecialchars ( $courses [ $i ]) ;
 $cr = floatval ( $credits [ $i ]) ;
 $g = floatval ( $grades [ $i ]) ;
 if ( $cr <= 0) continue ;
 $pts = $cr * $g ;
 $totalPoints += $pts ;
 $totalCredits += $cr ;
 $tableHtml .= "<tr 
 <td > $course </td > <td >$cr </td >
 <td >$g </td > <td >$pts </td >
 </tr >";
 }
 $tableHtml .= " </table >";

 if ( $totalCredits > 0) {
 $gpa = $totalPoints / $totalCredits ;
 if ( $gpa >= 3.7) {
 $interpretation = " Distinction ";
 } elseif ( $gpa >= 3.0) {
 $interpretation = " Merit ";
 } elseif ( $gpa >= 2.0) {
 $interpretation = " Pass ";
 } else {
 $interpretation = " Fail ";
 }
 $result = " Your GPA is " . number_format ( $gpa , 2)
 . " ( $interpretation ).";
 } else {
 $result = "No valid courses entered .";
 }
 }
 ? >

