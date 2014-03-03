<?php
include 'vendor/autoload.php';
    
include 'core/config.inc';

include 'core/mycore.inc';
include 'tpl/header.inc';
?>

       <form action="register.php" method="post" id="register_form">

                <p class="validate_msg">Please fix the errors below!</p>
                <fieldset>
                <img style="float:left" src="1.png" alt="1" title="Step 1" />
                <p> <label for="firstname">First Name:</label> <input name="firstname" type="text" size="30" class="alphanumeric" required /> <span class="val_firstname"></span> </p>
                <p> <label for="lastname">Last Name:</label>  <input name="lastname" type="text" size="30" class="alphanumeric" required />  <span class="val_lastname"></span> </p>
                </fieldset>
                <fieldset>
                <img style="float:left" src="2.png" alt="2" title="Details" />
                <p> <label for="email">Email:</label> <input name="email" type="text" class="email"  required /> <span class="val_address"></span> </p>
                <p> <label for="city">Contact No:</label>  <input name="contact" type="text" required /> <span class="val_city"></span> </p>
                </fieldset>
                <fieldset>

                <img style="float:left" src="3.png" alt="3" title="Step 3" />
                <p> <label for="state">Interested In</label>  <input name="interests" size="50" class="letterswithbasicpunc" type="text" required /> <span class="val_interests"></span> </p>
                <p> <label for="zip">About Me:</label> <input name="zip" type="text" size="50" required /><br>
                <texetarea name="about">
                    
                </texetarea> <span class="val_about"></span> </p>
                </fieldset>
                <input type="submit" name="submit" value="Register">
        </form>

<?php 
include 'tpl/footer.inc';
?>

