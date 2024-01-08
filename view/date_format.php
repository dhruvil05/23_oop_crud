<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Date and Time</title>
    </head>
    <body>
        <?php include "../includes/__header.php" ?>
        <?php
            include "../class/datetime.php";

            $currentDate = date('d M, Y');

            $date = new dateFormat($currentDate);

/*************************************** Exception and getPrivious()  *************************************************/

            // function getData(){
            //     try{
            //         throw new InvalidArgumentException("exception found!", 404);
            //     }catch (Exception $e) {
            //         throw new Exception("sended exception", 911, $e);
            //     }
            // }

            // try {
            //     getData();
            // } catch (Exception $e) {
                
            //     do {
            //         printf("%s:%d %s (%d) [%s]\n", 
            //                $e->getFile(), 
            //                $e->getLine(), 
            //                $e->getMessage(), 
            //                $e->getCode(), 
            //                get_class($e));
            //       } while($e = $e->getPrevious());
            // }

/********************************************************* File Upload  *************************************************/

            // if(isset($_FILES['file'])) {
            //     $filename = "file Name : ". $_FILES['file']['name'].'<br>';
            //     $filetype = "file Type : ". $_FILES['file']['type'].'<br>';
            //     $filesize = "file Size (bytes) : ". $_FILES['file']['size'].'<br>';
            //     $file_tmp_name = "file tmp_name : ". $_FILES['file']['tmp_name'].'<br>';
            //     $file_error = "file error : ". $_FILES['file']['error'].'<br>';
            //     $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION)).'<br>';
            //     $temp = explode(".", $_FILES["file"]["name"]);
            //     $newfilename = round(microtime(true)) . '.' . end($temp);

            //     echo $filename, $filetype, $filesize, $file_tmp_name, $file_error, $imageFileType,  $newfilename;

            //     $target_path = "../uploads/".$newfilename;

                // if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {  
                //     echo "File uploaded successfully!";  
                // } else{  
                //     echo "Sorry, file not uploaded, please try again!";  
                // }  

            // }

/************************************************** File Read/Write  *************************************************/

            // $myfile = fopen('../test3.txt', 'r+')or die('Unable to open!');
            // $txt = "next line\n";
            // fwrite($myfile, $txt);
            // $txt = "next line\n";
            // fwrite($myfile, $txt);
            // fclose($myfile);

/********************************************************* Array reduce function  *************************************************/

            // $carts = [
            //     ['item' => 'A', 'qty' => 2, 'price' => 10],
            //     ['item' => 'B', 'qty' => 3, 'price' => 20],
            //     ['item' => 'C', 'qty' => 5, 'price' => 30]
            // ];
            
            
            // $total = array_reduce(
            //     $carts,
            //     function ($prev, $item) {
            //         return $prev + $item['qty'] * $item['price'];
            //     }, 0
            // );
            
            // echo $total;

            

        ?>

        <h1>Date and Time</h1>
        
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <label for="file"> Upload </label>    
            <input type="file" name="file" id="file">
            <button type="submit">Submit</button>
        </form>
        <?php include "../includes/__footer.php" ?>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>