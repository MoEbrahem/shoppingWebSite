<?php
include 'sdb.php';
?>
<!DOCTYPE html>
<html lang="en">
<style>
        *{
    margin: 0;
    padding: 0;
}

.search{
    text-align: center;
    text-transform: capitalize;
}

.pack{
    /* 
    /*
    border: solid 0.5em black; */ 
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    margin-top: 5em; 
    width: 30rem;
    display: block;
    margin: auto;
    margin-top: 1em;
    border-radius:5em ;
    background-color: rgba(255, 255, 255, 0.6   );
    
   
    text-align: center;
}
body{
    background-image: url("search.jpg");
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>search engine</title>
</head>
<body>
<h1 class="search"> Search page</h1>
<div class="sr">
<?php
    if(isset($_POST['ss'])){
        $search= mysqli_real_escape_string($conn1,$_POST['search']);
        $sql="SELECT * FROM store WHERE name LIKE '%$search%' OR loc LIKE '%$search%' ;";
        $result=mysqli_query($conn1,$sql);
        $qr=mysqli_num_rows($result);
         echo "<h2  class='search'> there are ".$qr." results</h2>";

        if($qr>0){
            while($row=mysqli_fetch_assoc($result)){
                echo "<div class='pack' ><div>
                <h3>Name of item:(".$row['name'].")</h3>
                <h3>exists in brunches:".$row['loc']."</h3>
                </div></div>";

            }

        }
        else{ echo '<p class="pack">There are no results matching your search...</p>';}

    }
?>
</div>
</body>
</html>