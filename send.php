<?php
include 'vendor/autoload.php';
	
include 'core/config.inc';

include 'core/mycore.inc';
include 'tpl/header.inc';
$members = get_members();

if(isset($_POST['submit']) ) 
{
  $result = PDOWrapper::instance()->insert( $pre . 'inbox', array(
    'sender' => $_SESSION['uid'],
    'receiver' => $_POST['send_to'],
	'message' => $_POST['message'],
    'sent' => 0,
	'status' => 2
  );
  if($result) {
	$person = getPerson($_POST['send_to']);
	echo 'Your message has been sent to ' . $person['firstname'] . ' ' . $person['lastname'] . ':<pre>' . $_POST['message'] . '</pre>';
   } else {
	echo 'Problem sending message';
  }
}
?>

   <form action="" method="post">
      <table>
		<tr>
			<td>To:</td>
			<td>
				<select name="send_to">
			  <?php 
				foreach($members as $member)  {
					echo '<option value="' . $member['uid'] . '">' .$member['firstname'] . ' ' . $member['lastname'].'</option>';
				}
				?>
			</select>
		</td>
		</tr>
	  <tr>
		<td> Message:</td>
		<td><textarea name="message" cols="10" rows="20"><?php echo ($_POST['message']) ? $_POST['message'] : ''; ?> </textarea></td></tr>
		<tr><td colspan="2"><input type="submit" name="submit" value="Send"></td></tr>
		</table>
   </form>
<?php 
include 'tpl/footer.inc';
?>
