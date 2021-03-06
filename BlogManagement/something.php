<!DOCTYPE html>
<html>
<head>
	<title>Something</title>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$("#form2").hide();
  $("#hide").click(function(){
    $("#form2").show();
    $("#form1").hide();
  });
  $("#show").click(function(){
    $("#form1").show();
    $("#form2").hide();
  });
	});
</script>
</body>
<button type="submit" name="add" id="hide">Add</button>
<form action='something.php' id ='form1'>
	<label>User1<input type="text" name="uname"></label>
	<label>Pass1<input type="text" name="password"></label>
</form>
<form action='something.php' id ='form2'>
	<label>User2<input type="text" name="uname"></label>
	<label>Pass2<input type="text" name="password"></label>
	
<button type="submit" name="add" id ="show">Cancel</button>
</form>
</html>