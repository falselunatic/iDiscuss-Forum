<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <style>
            *body{
                overflow: auto; !important
            }
            #ques{
                min-height=433px;
            }
            .bg{
                background: url(img/forums-bg.jpg);
                background-size: cover;
                background-position: center;
               
            }
            .user{
        font-weight: bold;
        margin-bottom: 0px !important;
    }
            
        </style>
    <title>idiscuss - coding forums</title>
</head>

<body class="bg"> 
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>

    <?php
    $id= $_GET['catid'];
    $sql="SELECT * FROM `categories` WHERE category_id=$id";
    $result=mysqli_query($conn,$sql);
    
    while($row=mysqli_fetch_assoc($result)){
        $catname= $row['category_name'];
        $catdesc= $row['category_description'];
    }
    ?>
    <?php
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // insert into thread db
        $th_title=$_POST['title'];
        $th_desc=$_POST['desc'];
        $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        $ShowAlert= TRUE;
        if($ShowAlert){
            echo '
            <div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your thread has been added, please wait for community to respond!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
            ';
        }
    }
    ?>
    <!-- category container starts here -->
    <div class="container my-3">
    <div class="jumbotron">
  <h1 class="display-4">Welcome to <?php echo $catname; ?> forums!</h1>
  <p class="lead"><?php echo $catdesc; ?></p>
  <hr class="my-4">
  <p>This is a peer to peer forum.
     No Spam / Advertising / Self-promote in the forums.
     Do not post copyright-infringing material.
     Do not post “offensive” posts, links or images. 
     Do not cross post questions. 
     Do not PM users asking for help.
     Remain respectful of other members at all times.
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>
    </div>
    <div class="container">
    <form action= "<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
  <div class="form-group">
      <h1 class="py-2">Start a discussion</h1>
    <label for="emailhelp">Problem title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailhelp">
    <small id="emailhelp" class="form-text text-muted">Keep your title short & crisp as possible</small>
  </div>
  <div class="form-group my-3">
    <label for="exampleFormControlTextarea1">Elaborate your problem</label>
    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary my-3">Submit</button>
</form>
    </div>
    <div class="container">
    <div class="spinner-grow text-primary" role="status">
  <span class="sr-only"></span>
</div>
<div class="spinner-grow text-primary" role="status">
  <span class="sr-only"></span>
</div>
<div class="spinner-grow text-primary" role="status">
  <span class="sr-only"></span>
</div>
<div class="spinner-grow text-danger" role="status">
  <span class="sr-only"></span>
</div>
<div class="spinner-grow text-primary" role="status">
  <span class="sr-only"></span>
</div>
<div class="spinner-grow text-info" role="status">
  <span class="sr-only"></span>
</div>
<div class="spinner-grow text-light" role="status">
  <span class="sr-only"></span>
</div>
<div class="spinner-grow text-dark" role="status">
  <span class="sr-only"></span>
</div>
        <h1 class="py-2" id="ques">Browse questions</h1>
        <?php
    $id= $_GET['catid'];
    $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id;";
    $result=mysqli_query($conn,$sql);
    $noresult=true;
    while($row=mysqli_fetch_assoc($result)){
        $noresult=false;
         $id= $row['thread_id'];
        $title= $row['thread_title'];
        $desc= $row['thread_desc'];
        $thread_time= $row['timestamp'];
     echo

    '<div class="d-flex my-3">
         <div class="flex-shrink-0">
         <img src="img/userdefault.jpg" width="44px" alt="...">
         </div>
    <div class="flex-grow-1 ms-3">
    <p class="user">Anonymous User at ' . $thread_time . ' </p>
         <h6 class="mt-0"><a class="text-dark text-decoration-none" href="thread.php?threadid=' . $id . '">' . $title . '</h6></a>
          ' . $desc . '
          
    </div>
    </div>';
    }
    if($noresult){ 
    echo '
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <button class="btn btn-warning" type="button" disabled>
  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
  <span class="sr-only"></span>
</button>
<button class="btn btn-warning" type="button" disabled>
  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
  No Threads Found!
</button>
<hr>
<div class="alert alert-warning" role="alert">
<a href="#" class="alert-link"></a>Be the first person to ask a  question!
</div>
  </div>
</div>
    ';
    }
    ?> 


    
    <!-- <div class="d-flex my-3">
         <div class="flex-shrink-0">
         <img src="img/userdefault.jpg" width="44px" alt="...">
         </div>
    <div class="flex-grow-1 ms-3">
         <h6>unable to install pyaudio error in windows</h6>
          This is some content from a media component. You can replace this with any content and adjust it as needed.
    </div>
    </div> -->


    </div>
    <?php include 'partials/_footer.php'; ?>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>