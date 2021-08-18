<div class="container">
<div class="row">
<?
echo '<h1>Hello '.$user['login'].'! --- <a href="index.php?exit=1">exit</a></h1>';
echo "<a href='index.php?sql=1'>get sql</a><br><br>";
?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<td>id</td>
			<td>login</td>
			<td>pass</td>
			<td>email</td>
			<td>bday</td>
		<tr>
	</thead>
	<tbody>
		<tr><td><b>current::</b></td></tr>
		<tr>
			<? foreach($user as $val): ?>
				<td><?=$val?></td>
			<? endforeach; ?>
		</tr>
		<tr><td><b>all users::</b></td></tr>
		
		<? foreach($this->get_all_users() as $val): ?>
			<tr>
			<? foreach($val as $txt): ?>
				<td><?=$txt?></td>
			<? endforeach; ?>
			</tr>
		<? endforeach; ?>
		
	</tbody>
</table>
</div>
</div>