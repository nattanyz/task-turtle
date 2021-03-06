<?php
    require 'checkLoginStatus.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle | Task Creation </title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(document).ready(function() {
                if (!checkDateInput()) {
                    $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" });
                }
                $("#category").change(function(){
                    $("#category_hidden").val($("#category").find(":selected").text());
                });
                $("#back").click(function(e) {
                    e.preventDefault();
                    <?php
                        if (isset($userinfo['admin_name'])) {
                            echo "window.location.replace('adminLoggedInHomepage.html')\n";
                        } else {
                            echo "window.location.replace('loggedInHomepage.html')\n";
                        }
                    ?>
                });
            });
            function checkDateInput() {
                var input = document.createElement('input');
                input.setAttribute('type','date');

                var randomValue = 'random-value-here';
                input.setAttribute('value', randomValue);

                return (input.value !== randomValue);
            }
            function validateForm() {
                $submitForm = true;
                $('.mandatory').each(function() {
                    if(!$(this).val()){
                        alert("Please fill out all the mandatory fields.");
                        $submitForm = false;
                        return false;
                    }
                });
                return $submitForm;
            }
        </script>
    </head>
    <body>
        
        <?php

            if (!isset($userinfo['admin_name'])) {
                include 'template.php';
            }
        ?>
    	<h1> Welcome to Task Turtle </h1>

        <h3>Create A New Task</h3>

		<form id="taskForm" action="handleTaskCreation.php" method="post" onsubmit="return validateForm()">
            <table>
                <?php
                    if (isset($userinfo['admin_name'])) {
                        echo "
                            <tr>
                                <td>Creator's Username</td>
                                <td>: <input class='mandatory' type='text' name='creator' size='40' /></td>
                            </tr>
                        ";
                    }
                ?>
                <tr>
                    <td>Title</td>
                    <td>: <input class="mandatory" type="text" name="title" size="40"/></td>
                </tr>
                <tr>
                    <td>Description (Optional)</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td colspan="2"><textarea form="taskForm" name="description" rows="4" cols="50" maxlength="1024"></textarea></td>
                </tr>
                <tr>
                    <td>Task Date</td>
                    <td>: <input id="datepicker" class="mandatory" type="date" name="task_date" size="40" placeholder="YYYY-MM-DD"/></td>
                </tr>
                <tr>
                    <td>Start Time</td>
                    <td>: <input class="mandatory" type="time" name="start_time" size="40" placeholder="HH:MM"/></td>
                </tr>
                <tr>
                    <td>End Time</td>
                    <td>: <input class="mandatory" type="time" name="end_time" size="40" placeholder="HH:MM"/></td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>: <input class="mandatory" type="text" name="location" size="40"/></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>:
                        <select id="category" class="mandatory" style="width:170px">
                            <option value="">Choose a category</option>
                            <option value="1">Mounting & Installation</option>
                            <option value="2">Moving & Packing</option>
                            <option value="3">Furniture Assembly</option>
                            <option value="4">Home Improvement</option>
                            <option value="5">General Handyman</option>
                            <option value="6">Heavy Lifting</option>
                            <option value="7">Others</option>
                        </select>
                        <input id="category_hidden" type="hidden" name="category" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <td>&nbsp;</td>
                        <td align="right"><button id="back">Back</button><input type="submit" name="create_task" value="Confirm"/></td>
                    </td>
                </tr>
            </table>
        </form>
	</body>
</html>
