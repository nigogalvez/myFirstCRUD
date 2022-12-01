<?php 

include 'db.php';

$obj = new Model();

if(isset($_POST['submit'])) {
    $obj->insertRecord($_POST);
}

if(isset($_POST['update'])) {
    $obj->updateRecord($_POST);
}

if(isset($_GET['deleteid'])) {
    $delid = $_GET['deleteid'];
    $obj->deleteRecord($delid);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Renigo's Phonebook</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
    <br>
    <h2 class ="text-center">PHONEBOOK</h2><br>
    <div class="container"> 
        <?php
        if(isset($_GET['editid'])) {
            $editid = $_GET['editid'];
            $myrecord = $obj->displayRecordById($editid);
        ?>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="firstname" value="<?php echo $myrecord['firstname']; ?>" placeholder="Enter your first name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lastname" value="<?php echo $myrecord['lastname']; ?>" placeholder="Enter your last name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="number" value="<?php echo $myrecord['number']; ?>" placeholder="Enter your mobile number" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <input type="hidden" name="hid" value="<?php echo $myrecord['id']; ?>">
                    <input type="submit" name="update" value="Update">
                </div>
            </form>
        <?php
        } else {
        ?>
        <form action="index.php" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstname" placeholder="Enter your first name" class="form-control">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" placeholder="Enter your last name" class="form-control">
            </div>
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" name="number" placeholder="Enter your mobile number" class="form-control">
            </div>
            <br>
            <div class="form-group">
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>
        <?php } ?>
        <br>
        <h4 class="text-center">Records</h4>
        <table class="table table-bordered">
            <tr class="text-center">
                <th>First Name</th>
                <th>Last Name</th>
                <th>Number</th>
                <th>Action</th>
            </tr>
            <?php
            $data = $obj->displayRecord();
            foreach ($data as $value) {
            ?>
            <tr class="text-center">
                <td><?php echo $value['firstname']; ?></td>
                <td><?php echo $value['lastname']; ?></td>
                <td><?php echo $value['number']; ?></td>
                <td>
                    <a href="index.php?editid=<?php echo $value['id']; ?>">Edit</a>
                    <a href="index.php?deleteid=<?php echo $value['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php    
            }
            ?>
        </table>
    </div>
    </body>
</html>