<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://cdn.staticfile.org/jquery/2.2.4/jquery.min.js"></script>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Date and Time</title>
    </head>
    <body>
        <?php include "../includes/__header.php" ?>
        
        <div class="container mb-3 cursorPosition">
            <h1>Text Effect</h1>
            
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                <div class="input-group flex-nowrap w-50">
                    <span class="input-group-text" id="addon-wrapping">@</span>
                    <input type="text" class="form-control" placeholder="Type" aria-label="Text" aria-describedby="addon-wrapping">
                </div>
            </form>
        </div>
        <?php include "../includes/__footer.php" ?>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script type="text/javascript" src="../includes/_commentTyping.js"></script>
        <script src="../includes/_mouseEffect.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>