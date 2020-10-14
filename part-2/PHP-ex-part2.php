<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
                background-image: url("30563443.jpg");
                background-repeat: no-repeat;
                background-size: 100%;
            }

            h1{
                display: flex;
                justify-content: center;
                margin-top: 150px;
            }

            .income{
               display: flex;
               justify-content: center;
               margin-top: 50px;
               font-size: 30px;
            }
            .input{
                font-size: 20px;
                width: 60%;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            .button{
                background-color: grey;
                border-radius: 4px;
                color: black;
                cursor: pointer;
                font-size: 18px;
            }
            .error{
                color: red;
            }
            table {
                width: 80%;
                margin-left: 10%;
                font-size: 20px;
            }

            tr{
                background-color: grey;
            }

            th {
                background-color: aliceblue;
            }
        </style>
        <title>Income Tax Calculator</title>
    </head>
    <body>
        <?php
            $salary = $type = $allowance = "";
            $salaryErr = $typeErr = $allowanceErr = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["salary"])) {
                    $salaryErr = "Salary is required";
                } else {
                    $salary = test_input($_POST["salary"]);
                    if(!is_numeric($salary)){
                        $salaryErr = "Please enter a number";
                    }
                }
                if (empty($_POST["type"])) {
                    $typeErr = "Type is required";
                } else {
                    $type = test_input($_POST["type"]);
                }
                if (empty($_POST["allowance"])) {
                    $allowanceErr = "Tax Free Allowance is required";
                } else {
                    $allowance = test_input($_POST["allowance"]);
                    if(!is_numeric($allowance)){
                        $allowanceErr = "Please enter a number";
                    }
                }

                $salarytax = $salaryssf = $totalsalary = $allowanceperyear = $salaryperyear = 0;
                if (isset($type) && $type=="Yearly"){
                    $salaryperyear = $salary;
                    $allowanceperyear = $allowance;
                    if ($salaryperyear < 10000){
                        $totalsalary = $salaryperyear + $allowanceperyear;
                    }
                    elseif($salaryperyear > 10000 && $salaryperyear < 25000){
                        $salarytax = $salaryperyear * (11 / 100);
                        $salaryssf = $salaryperyear * (4 / 100);
                        $totalsalary = ($salaryperyear - ($salarytax + $salaryssf)) + $allowanceperyear;
                    }
                    elseif($salaryperyear > 25000 && $salaryperyear < 50000){
                        $salarytax = $salaryperyear * (30 / 100);
                        $salaryssf = $salaryperyear * (4 / 100);
                        $totalsalary = ($salaryperyear - ($salarytax + $salaryssf)) + $allowanceperyear;
                    }
                    else{
                        $salarytax = $salaryperyear * (45 / 100);
                        $salaryssf = $salaryperyear * (4 / 100);
                        $totalsalary = ($salaryperyear - ($salarytax + $salaryssf)) + $allowanceperyear;
                    }
                }
                elseif(isset($type) && $type=="Monthly"){
                    $salaryperyear = $salary * 12;
                    $allowanceperyear = $allowance * 12;
                    if ($salaryperyear < 10000){
                        $totalsalary = $salaryperyear + $allowanceperyear;
                    }
                    elseif($salaryperyear > 10000 && $salaryperyear < 25000){
                        $salarytax = $salaryperyear * (11 / 100);
                        $salaryssf = $salaryperyear * (4 / 100);
                        $totalsalary = ($salaryperyear - ($salarytax + $salaryssf)) + $allowanceperyear;
                    }
                    elseif($salaryperyear > 25000 && $salaryperyear < 50000){
                        $salarytax = $salaryperyear * (30 / 100);
                        $salaryssf = $salaryperyear * (4 / 100);
                        $totalsalary = ($salaryperyear - ($salarytax + $salaryssf)) + $allowanceperyear;
                    }
                    else{
                        $salarytax = $salaryperyear * (45 / 100);
                        $salaryssf = $salaryperyear * (4 / 100);
                        $totalsalary = ($salaryperyear - ($salarytax + $salaryssf)) + $allowanceperyear;
                    }
                }
                $salarymonthly = $salarytaxmonthly = $salaryssfmonthly= $totalsalarymonthly  = 0;
                $salarymonthly = $salaryperyear / 12;
                $salarytaxmonthly = $salarytax / 12;
                $salaryssfmonthly = $salaryssf / 12;
                $totalsalarymonthly = $totalsalary / 12;


            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
        
        <h1> Please enter your salary information</h1>
    
        <div class="income">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Salary in USD:<br>
            <input class="input" type = "text" name = "salary" value = "<?php echo $salary ?>">
            <span class="error">* <?php echo $salaryErr;?></span>
            </label>
<br><br>
            <input type="checkbox" name="type" <?php if (isset($type) && $type=="Monthly") echo "checked";?>
            value="Monthly">Monthly
            <input type="checkbox" name="type" <?php if (isset($type) && $type=="Yearly") echo "checked";?>
            value="Yearly">Yearly
            <br><br>
            <label>Tax Free Allowance in USD: <br>
            <input class = "input" type = "text" name ="allowance" value = "<?php echo $allowance ?>">
            <span class="error">* <?php echo $allowanceErr;?></span>
            </label>
            <br><br>
            <input class ="button" type="submit" name="submit" value="Submit">
        </form>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($salaryErr == "" && $typeErr == "" && $allowanceErr == ""){
            echo "<table>
            <tr>
                <th>Income with Taxes</th>
                <th>Monthly</th>
                <th>Yearly</th>
            </tr>
            <tr>
                <td>Total Salary</td>
                <td>$salarymonthly$</td>
                <td>$salaryperyear$</td>
            </tr>
            <tr>
                <td>Tax Amount</td>
                <td>$salarytaxmonthly$</td>
                <td>$salarytax$</td>
            </tr>
            <tr>
                <td>Social Security Fee</td>
                <td>$salaryssfmonthly$</td>
                <td>$salaryssf$</td>
            </tr>
            <tr>
                <td>Salary After Tax</td>
                <td>$totalsalarymonthly$</td>
                <td>$totalsalary$</td>
            </tr>
            </table>";
            }
        }
        ?>

    </body>
</html> 
