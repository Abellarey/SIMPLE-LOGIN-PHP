<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
    body{
     background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)),url('home.jpg');
     background-size: cover;
     background-position: center;
    }
    .sign{
    max-width: 320px;
    display: flex;
    align-items: center;
    justify-items: center;
    margin: auto;
    padding-top: 150px;
    
}
    .container{
     padding: 50px;   
     box-shadow: 2px 2px 20px rgb(66, 62, 62);
     backdrop-filter: blur(8px);
     min-height: 300px;
     border: 2px solid rgb(112, 106, 106);
}
    .myh1{
    text-align: center;
    font-weight: 500;
    color: white;
}
input{
    padding: 90px;
}
.col-group{
   margin-bottom: 15px;
}

    </style>
</head>

<body>
      <div class="sign">
     <div class="container">
    <?php    
     if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["uname"];
    $password = $_POST["pword"];
    $hash = password_hash($password,PASSWORD_DEFAULT);
    $errors = array();

    if(empty($username) OR empty($password)){
      array_push($errors,"All fields are required");
    }
    if(strlen($password) < 8){
      array_push($errors,"Pasword Atleast 8 Characters");
    }

    require_once("connection.php");
    $sql = "SELECT * FROM users WHERE user = '$username'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
      array_push($errors,"username already taken"); 
    }
    if(count($errors)>0){
        foreach($errors as $error){
        echo "<div class='alert alert-danger'>$error</div>";
    }
  }
  else{
    $sql = "INSERT INTO users (user,password) VALUES ('$username','$hash')";
    mysqli_query($conn,$sql);
    echo "<div class='alert alert-success'>You are registered Successfully</div>";
  }
 }

?>
        <form action="signin.php"method="post">
            <h1 class="myh1">LOG IN</h1>
            <div class="col-group">
                <input type="text"name="uname"class="form-control"placeholder="uname">
            </div>
            <div class="col-group">
                <input type="password"name="pword"class="form-control"placeholder="password">
            </div>
            <div class="col-group">
                <input type="submit"name="login"class="btn btn-primary">
            </div>
        </form>
     </div> 
</div> 
</body>
</html>