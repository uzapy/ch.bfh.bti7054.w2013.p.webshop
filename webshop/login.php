<script type="text/javascript">
function form_validation () {
	alert('test');
}
</script>

<form action="javascript: form_validation();" method="POST" name="login">
Name: <input name="name" type="text" /><br>
Passwort: <input name="pwd" type="password" /><br><br> 
<input type="submit" value="Login" />
</form>