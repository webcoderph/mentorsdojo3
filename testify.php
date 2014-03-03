<?php
include 'vendor/autoload.php';
	
include 'core/config.inc';

include 'core/mycore.inc';
include 'tpl/header.inc';
$mentors = get_mentors();

if(isset($_POST['submit']) ) 
{
  PDOWrapper::instance()->insert( $pre . 'testimonials', array(
    'testifier_id' => $_SESSION['uid'],
    'mentor_id' => $_POST['person'],
	'testimonial' => $_POST['testimony'],
    'created' => date('Y-m-d H:i:s'),
	'modified' => null
  );
  $name = getPerson($_POST['person']);
  echo 'Testimonial created for ' . $name['firstname'] .' ' . $name['lastname'] . '! <br>';
  echo '<pre>' . $_POST['testimony'] . '</pre>';
}
?>

   <form action="" method="post">
      <table>
		<tr>
			<td>To:</td>
			<td>
				<select name="person">
			  <?php 
				foreach($mentors as $mentor)  {
					echo '<option value="' . $mentor['uid'] . '">' .$mentor['firstname'] . ' ' . $mentor['lastname'].'</option>';
				}
				?>
			</select>
		</td>
		</tr>
	  <tr>
		<td> Testimonial:</td>
		<td><textarea name="testimony" cols="10" rows="20"><?php echo ($_POST['testimony']) ? $_POST['testimony'] : ''; ?> </textarea></td></tr>
		<tr><td colspan="2"><input type="submit" name="submit" value="Testify"></td></tr>
		</table>
   </form>
<?php 
include 'tpl/footer.inc';
?>
