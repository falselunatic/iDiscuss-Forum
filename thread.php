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
    #bg {
        background: url(img/forums-bg.jpg);
        background-size: cover;
        background-position: center;
    }

    .jumbotron {
        background-color: #cee0fb;
        color: #3a3939;
        padding: 40px 40px 40px 40px;
        border-radius: 30px 30px;
    }

    .display-4 {
        color: #a57b00;
        font-style: bold;
    }

    .lead {
        color: #725f25;
        font-style: italic;
        padding: 50px 50px;
    }
    .user{
        font-weight: bold;
        margin-bottom: 0px !important;
    }
    </style>
    <title>idiscuss - coding forums</title>
</head>

<body id="bg">
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>

    <?php
    $id= $_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE thread_id=$id";
    $result=mysqli_query($conn,$sql);
    
    while($row=mysqli_fetch_assoc($result)){
        $title= $row['thread_title'];
        $desc= $row['thread_desc'];
    }
    ?>
    <?php
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // insert into comment db
        $comment=$_POST['comment'];
        $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '0', current_timestamp());";
        $result=mysqli_query($conn,$sql);
        $ShowAlert= TRUE;
        if($ShowAlert){
            echo '
            <div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your comment has been added!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
            ';
        }
    }
    ?>
    <!-- category container starts here -->
    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4 text-center"><?php echo $title; ?></h1>
            <p class="lead my-4 text-center"><?php echo $desc; ?></p>
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
            <p><b><em>Posted by: ishu</em></b></p>
            </p>
        </div>
    </div>
    <div class="container">
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <div class="form-group">
                <h1 class="py-2">Post a comment</h1>
            </div>
            <div class="form-group my-3">
                <label for="exampleFormControlTextarea1">Type your comment</label>
                <textarea class="form-control my-2" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-info my-3">Post comment</button>
        </form>
    </div>
    <div class="container">
    <div class="spinner-grow" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
        <h1 class="py-2" id="ques">Discussions</h1>

        <?php
    $id= $_GET['threadid'];
    $sql="SELECT * FROM `comments` WHERE thread_id=$id;";
    $result=mysqli_query($conn,$sql);
    $noresult=true;
    while($row=mysqli_fetch_assoc($result)){
        $noresult=false;
         $id= $row['comment_id'];
        $content= $row['comment_content'];
        $comment_time= $row['comment_time'];
     echo

    '<div class="d-flex my-3">
         <div class="flex-shrink-0">
         <img src="img/userdefault.jpg" width="44px" alt="...">
         </div>
    <div class="flex-grow-1 ms-3">
    <p class="user">Anonymous User at ' . $comment_time . ' </p>
          ' . $content . '
          
    </div>
    </div>';
    }
    if($noresult){
    echo '
<div class="jumbotron jumbotron-fluid">
<button class="btn btn-warning" type="button" disabled>
<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
<span class="visually-hidden">Loading...</span>
</button>
<button class="btn btn-warning" type="button" disabled>
<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
No comments found!
</button>
<hr>
<div class="alert alert-warning" role="alert">
<a href="#" class="alert-link"></a>Be the first person to comment!
</div>
  </div>
</div>
    ';
    }
    ?>



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