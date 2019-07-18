<!--Create Account Form-->
<div class="createaccountform">
    <form action="createAccount.php" method="post" onsubmit="checkForm(this);">
        <input pattern="[A-Za-z]{1,}" title="First name must only contain letters." value="<?php
        if (isset($_POST['firstname'])) {
            echo htmlentities($_POST['firstname']);
        }
        ?>" type="text" id="firstname" name="firstname" maxlength="32" class="form-control input-sm chat-input fieldinput" placeholder="First name" required><br>
        <input pattern="[A-Za-z]{1,}" title="Last name must only contain letters." value="<?php
        if (isset($_POST['lastname'])) {
            echo htmlentities($_POST['lastname']);
        }
        ?>" type="text" id="lastname" name="lastname" maxlength="32" class="form-control input-sm chat-input fieldinput" placeholder="Last name" required><br>
        <input value="<?php
        if (isset($_POST['email'])) {
            echo htmlentities($_POST['email']);
        }
        ?>" type="email" id="email" name="email" maxlength="32" class="form-control input-sm chat-input fieldinput" placeholder="Email address" required><br>
        <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Password must be at least 6 characters long. It must contain at least an uppercase and lowercase letter and a number." type="password" id="password" name="password" maxlength="32" class="form-control input-sm chat-input fieldinput" placeholder="Password" required><br>
        <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Password must be at least 6 characters long. It must contain at least an uppercase and lowercase letter and a number." type="password" id="confirmpassword" name="confirmpassword" maxlength="32" class="form-control input-sm chat-input fieldinput" placeholder="Confirm password" required><br>
        <h4 style="line-height: 0px;">Birthdate</h4><br>
        <div class="bdatefield">
            <select id="birthmonth" name="birthmonth" class="form-control input-sm chat-input bdateinput" required>
                <option value="" hidden>Month</option>
                <option value="01" <?php if (isset($_POST['birthmonth']) && $_POST['birthmonth'] == "01") echo "selected"; ?>>January</option>
                <option value="02" <?php if (isset($_POST['birthmonth']) && $_POST['birthmonth'] == "02") echo "selected"; ?>>February</option>
                <option value="03" <?php if (isset($_POST['birthmonth']) && $_POST['birthmonth'] == "03") echo "selected"; ?>>March</option>
                <option value="04" <?php if (isset($_POST['birthmonth']) && $_POST['birthmonth'] == "04") echo "selected"; ?>>April</option>
                <option value="05" <?php if (isset($_POST['birthmonth']) && $_POST['birthmonth'] == "05") echo "selected"; ?>>May</option>
                <option value="06" <?php if (isset($_POST['birthmonth']) && $_POST['birthmonth'] == "06") echo "selected"; ?>>June</option>
                <option value="07" <?php if (isset($_POST['birthmonth']) && $_POST['birthmonth'] == "07") echo "selected"; ?>>July</option>
                <option value="08" <?php if (isset($_POST['birthmonth']) && $_POST['birthmonth'] == "08") echo "selected"; ?>>August</option>
                <option value="09" <?php if (isset($_POST['birthmonth']) && $_POST['birthmonth'] == "09") echo "selected"; ?>>September</option>
                <option value="10" <?php if (isset($_POST['birthmonth']) && $_POST['birthmonth'] == "10") echo "selected"; ?>>October</option>
                <option value="11" <?php if (isset($_POST['birthmonth']) && $_POST['birthmonth'] == "11") echo "selected"; ?>>November</option>
                <option value="12" <?php if (isset($_POST['birthmonth']) && $_POST['birthmonth'] == "12") echo "selected"; ?>>December</option>
            </select>
        </div>
        <div class="bdatefield"><input value="<?php
            if (isset($_POST['birthday'])) {
                echo htmlentities($_POST['birthday']);
            }
            ?>" type="number" min="1" max="31" name="birthday" id="birthday" class="form-control input-sm chat-input fieldinput bdateinput" placeholder="Day" required></div>
        <div class="bdatefield"><input value="<?php
            if (isset($_POST['birthyear'])) {
                echo htmlentities($_POST['birthyear']);
            } else {
                echo htmlentities(2000);
            }
            ?>" type="number" min="1900" max="9999" maxlength="4" name="birthyear" id="birthyear" class="form-control input-sm chat-input fieldinput bdateinput" placeholder="Year" required></div><br><br>
        <h4 style="line-height: 0px;">Gender</h4><br>
        <label><input <?php if (isset($_POST['gender']) && $_POST['gender'] == "male") echo "checked"; ?> type="radio" name="gender" value="male" required>&nbsp&nbsp Male &nbsp&nbsp</label>
        <label><input <?php if (isset($_POST['gender']) && $_POST['gender'] == "female") echo "checked"; ?> type="radio" name="gender" value="female" required>&nbsp&nbsp Female</label><br><br>
        <input type="text" id="address" name="address" maxlength="32" class="form-control input-sm chat-input fieldinput" placeholder="Address" required><br>
        <div class="wrapper">
            <span class="group-btn">
                <input type="submit" class="btn createaccount" value="Create Account">
            </span>
        </div>
    </form>
</div>
<!--Create Account Form-->

<!--Retain Values-->
<script type="text/javascript">
//    document.getElementById('birthmonth').value = "<?php
                                       if (isset($_POST['birthmonth'])) {
                                           echo htmlentities($_POST['birthmonth']);
                                       }
            ?>";
//    document.getElementById('birthday').value = "<?php
                                       if (isset($_POST['birthday'])) {
                                           echo htmlentities($_POST['birthday']);
                                       }
            ?>";
//    document.getElementById('birthyear').value = "<?php
                                       if (isset($_POST['birthyear'])) {
                                           echo htmlentities($_POST['birthyear']);
                                       }
            ?>";
    document.getElementById('address').value = "<?php
                                       if (isset($_POST['address'])) {
                                           echo htmlentities($_POST['address']);
                                       }
            ?>";
</script>