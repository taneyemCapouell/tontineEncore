<?php
    if(isset($_SESSION['message']) && isset($_SESSION['status']) && !empty($_SESSION['message'])
     && !empty($_SESSION['status'])){
      ?>
      <?php if($_SESSION['status']=='info'){ ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['message'];?></strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="fa fa-times"></span>
            </button>
        </div>
       <?php } ?>
      <?php if($_SESSION['status']=='success'){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['message'];?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="fa fa-times"></span>
            </button>
        </div>
       <?php } ?>
      <?php if($_SESSION['status']=='warning'){ ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['message'];?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="fa fa-times"></span>
            </button>
        </div>
       <?php } ?>
      <?php if($_SESSION['status']=='danger'){ ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['message'];?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="fa fa-times"></span>
            </button>
        </div>
       <?php } ?>
      <?php  

      $_SESSION['message'] = "";
      $_SESSION['status'] = "";
    }
?>
