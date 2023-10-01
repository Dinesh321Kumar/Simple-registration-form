<?php 
include_once('connection.php');

if(isset($_POST['click'])){
    
    $email=$_POST['email'];
    $password=$_POST['password'];


    //login with same email or phone number with paasword
    $sql="SELECT `email`='$email' OR `phone`='$mobile' WHERE `password`='$password'";
    $data=mysqli_query($conn,$sql);
    $rows=mysqli_num_rows($data);
    if($rows){
        
        echo "login successfull";
    }else{

        echo "incorrect email or password";
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
        <h2 class="mt-4 mb-3">Login form</h2>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email or phone number</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp"
                    placeholder="Enter email">

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>

            <input type="submit" class="btn btn-primary" name="click" value="submit">
        </form>
    </div>
</body>

</html>
