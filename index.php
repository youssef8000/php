<?php  
$host="localhost";
$user="root";
$pass='';
$dbname="sng";
//connect to database
$connect=mysqli_connect($host,$user,$pass,$dbname);

//Insert
   if(isset($_POST['btnSend'])){
       $course=$_POST['courseName'];
       $cost=$_POST['courseCost'];
       $insert="INSERT INTO `courses` VALUES (null,'$course',$cost)";  
        $i=mysqli_query($connect,$insert);
   }

//Select
   $select="SELECT * FROM `courses`";
 $s=mysqli_query($connect,$select);

 //delete
  if(isset($_GET['delete'])){
      $id =$_GET['delete'];
      $delete="DELETE FROM `courses` WHERE id=$id";
      $d=mysqli_query($connect,$delete);
      header("location:index.php");
  }

  //update
 $name='';
 $cost='';
 $updatee=false;
 if(isset($_GET['edit'])){
    $updatee=true;
      $id =$_GET['edit'];
      $select="SELECT * FROM `courses` WHERE id=$id";
     $su=mysqli_query($connect,$select);
     $datau=mysqli_fetch_assoc($su);
     $name=$datau['name'];
     $cost=$datau['cost'];
      if(isset($_POST['btnUpdate'])){
        $course=$_POST['courseName'];
        $cost=$_POST['courseCost'];
        $update="UPDATE `courses` SET `name`='$course' , cost=$cost     WHERE id =$id";
        $u=mysqli_query($connect,$update);
       header("location:index.php");
      }
     
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Document</title>
    <style> 
    body{
        background: black;
        color:white;
    }
</style>
</head>
<body>
    <div class="container col-md-6">
        <div class="card text-white bg-dark">
            <div class="card-body ">
                <form method="POST">
                    <div class="form-group">
                        <label for="">Course Name</label>
                        <input type="text" value="<?php echo $name ?>" name="courseName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Course Cost</label>
                        <input type="text" value="<?php echo $cost ?>" name="courseCost" class="form-control">
                    </div> 
                    <?php if($updatee){ ?>
                    <button name="btnUpdate" class="btn btn-info">Update Data</button>
                    <?php }else{ ?>
                    <button name="btnSend" class="btn btn-primary">Send Data</button>
                    <?php }?>
                </form>
            </div>
        </div>
    </div>
    <div class="container col-md-6 mt-4">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <table class="table table-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Cost</th>
                 </tr>
                 <?php foreach($s as $data) { ?>
                 <tr>
                      <td><?php echo $data['id'] ?></td>
                      <td><?php echo $data['name'] ?></td>
                      <td><?php echo $data['cost'] ?></td>
                      <td><a onclick="return confirm('Are you sure?')" href="index.php?delete=<?php echo $data['id'] ?>" class="btn btn-outline-danger">Delete  </a></td> 
                      <td><a href="index.php?edit=<?php echo $data['id'] ?>" class="btn btn-outline-primary">Edit  </a></td>   

                 </tr>
                 <?php } ?>

                </table>
            </div>
        </div>
    </div>
</body>
</html>