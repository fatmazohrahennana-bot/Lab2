<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$name = $_POST["name"];
$courses = $_POST["course"];
$grades = $_POST["grade"];

$total = 0;
$count = count($grades);

for ($i=0; $i<$count; $i++) {
$total += $grades[$i];
}

$average = $total / $count;

if ($average >= 85) {
$class = "alert-success";
$message = "Excellent";
}
elseif ($average >= 70) {
$class = "alert-info";
$message = "Good";
}
elseif ($average >= 50) {
$class = "alert-warning";
$message = "Pass";
}
else {
$class = "alert-danger";
$message = "Fail";
}

echo "<div class='alert $class'>";
echo "<h4>Student: $name</h4>";
echo "<p>Average: $average</p>";
echo "<p>Result: $message</p>";
echo "</div>";

echo "<table class='table table-bordered'>";
echo "<tr><th>Course</th><th>Grade</th></tr>";

for ($i=0; $i<$count; $i++) {
echo "<tr><td>".$courses[$i]."</td><td>".$grades[$i]."</td></tr>";
}

echo "</table>";

exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Student Grade System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<body class="container mt-5">

<h2 class="mb-4">Student Grade Calculator</h2>

<div id="result"></div>

<form id="gradeForm">

<div class="mb-3">
<label class="form-label">Student Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div id="courses">

<div class="row mb-2 courseRow">

<div class="col">
<input type="text" name="course[]" class="form-control" placeholder="Course" required>
</div>

<div class="col">
<input type="number" name="grade[]" class="form-control" placeholder="Grade" min="0" max="100" required>
</div>

<div class="col">
<button type="button" class="btn btn-danger remove">Remove</button>
</div>

</div>

</div>

<button type="button" id="addCourse" class="btn btn-secondary mb-3">
Add Course
</button>

<br>

<button type="submit" class="btn btn-primary">
Calculate Result
</button>

<button type="reset" class="btn btn-warning">
Reset
</button>

</form>

<script>

$(document).ready(function(){

$("#addCourse").click(function(){

$("#courses").append(`
<div class="row mb-2 courseRow">

<div class="col">
<input type="text" name="course[]" class="form-control" placeholder="Course" required>
</div>

<div class="col">
<input type="number" name="grade[]" class="form-control" placeholder="Grade" min="0" max="100" required>
</div>

<div class="col">
<button type="button" class="btn btn-danger remove">Remove</button>
</div>

</div>
`);

});

$(document).on("click",".remove",function(){
$(this).closest(".courseRow").remove();
});

$("#gradeForm").submit(function(e){

e.preventDefault();

$.ajax({
url: "index.php",
method: "POST",
data: $(this).serialize(),
success: function(response){
$("#result").html(response);
}
});

});

});

</script>

</body>
</html>
