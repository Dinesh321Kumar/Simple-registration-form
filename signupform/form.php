<?php
include('connection.php');

$flag = false;
$allerr = "";
$nameerr = "";
$matcherr = "";
$emailerr = "";
$pattrenerr  = "";
$passerr = "";
$sameerr = "";
$cpasserr = "";
$ccpasserr = "";
$moberr = "";
$indianerr = "";
$validate = "";


if (isset($_POST['click'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $mobile = $_POST['mobile'];




    // check username field and regex manually
    if (!empty($_POST['username'])) {

        $match = preg_match("/[A-Za-z]{3,20}/", $username);

        if ($match) {

            $flag = true;
        } else {

            $matcherr = "<p class='text-danger'><b>Name should be minimum 3 and max 20 alphabets required</b></p>";
        }
    } else {

        $nameerr = "<p class='text-danger'><b>please fill the username field</b></p>";
    }


    //check email an regex
    if (!empty($_POST['email'])) {

        $pattren = preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email);

        if ($pattren) {

            $flag = true;
        } else {

            $pattrenerr = "<p class='text-danger'><b>Please enter the valid email address</b></p>";
        }
    } else {

        $emailerr = "<p class='text-danger'><b>Please fill the email address</b></p>";
    }



    //check password and regex manually
    if (!empty($_POST['password'])) {

        $same = preg_match("/[a-zA-Z0-9]{5,15}/", $password);
        if ($same) {

            $flag = true;
        } else {

            $sameerr = "<p class='text-danger'><b>Password length shuld be min 5 and max 15 alphabets or integor </b></p>";
        }
    } else {

        $passerr = "<p class='text-danger'><b>Please fill the paasword field</b></p>";
    }



    //check confirm paasword field 

    if (!empty($_POST['cpassword'])) {

        if ($_POST['cpassword'] === $_POST['password']) {

            $flag = true;
        } else {

            $cpasserr = "<p class='text-danger'><b>Please Re-enter the  same paasword</b></p>";
        }
    } else {

        $ccpasserr = "<p class='text-danger'><b>Please Retype  paasword</b></p>";
    }



    //check phone number according to 10 digits indian format
    if (!empty($_POST['mobile'])) {

        $indian = preg_match("/[1-9]{9}[0-9]{1}/", $mobile);
        if ($indian) {

            $flag = true;
        } else {

            $indianerr = "<p class='text-danger'><b>Please enter 10 digits phone number</b></p>";
        }
    } else {

        $moberr = "<p class='text-danger'><b>Please fill the phone number field</b></p>";
    }




    //insert and check unique email and password
    if ($flag==true) {

        //check email or phone exist or not in database sql
        $sql = "SELECT* FROM `employes` WHERE `email`='$email' OR `phone`='$mobile'";
        $data = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($data);
        if ($rows > 0) {

            $validate= "<p class='text-danger'><b>Email or Phone number is already exist,try another</b></p>";
        } else {

            //save data if not exist email or phonenumber sql
            $insert = "INSERT INTO `employes`(`name`,`email`,`password`,`phone`) VALUES('$username','$email','$password','$mobile')";
            $result = mysqli_query($conn, $insert);

            if ($result) {

                header('location:form.php');
            } else {

                echo "please check the all fields";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container col-md-4">

        <h2 class="text-center mb-5">Registration form</h2>
        <div class="text-center">
            <?php echo $validate;?>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group mb-3">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" name="username" placeholder=" Enter your name">
                <?php echo $nameerr; ?>
                <?php echo $matcherr; ?>
            </div>


            <div class="form-group mb-3 ">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" name="email" placeholder=" Enter your email address">
                <?php echo $emailerr; ?>
                <?php echo $pattrenerr; ?>
            </div>


            <div class="form-group mb-3">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder=" Enter your password">
                <?php echo $sameerr; ?>
                <?php echo $passerr; ?>
            </div>


            <div class="form-group mb-3">
                <label for="exampleInputPassword1"> Confirm Password</label>
                <input type="password" class="form-control" name="cpassword" placeholder=" Re-enter your password">
                <?php echo $cpasserr; ?>
                <?php echo $ccpasserr; ?>
            </div>


            <div class="form-group mb-3">
                <label for="exampleInputPassword1">Phone number</label>
                <input type="text" class="form-control" name="mobile" placeholder="Enter your mobile number">

                <?php echo $indianerr; ?>
                <?php echo $moberr; ?>
            </div>

            <input type="submit" class="btn btn-primary" name="click" value="submit">
            <p>already have an account ?<a href="login.php">Login</a>
            </p>
        </form>
    </div>
</body>

</html>