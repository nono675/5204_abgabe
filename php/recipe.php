

<?php 





$res=$dbInst->readMethod();
foreach( $res as $datensatz ) { ?>
          <div id="recipe" class="contenteditable">
          <img src="<?php echo $datensatz['image']?>" alt="">
          <h2><?php echo $datensatz['title'] ?></h2>
          <p><?php echo $datensatz['beschreib'] ?></p>
          <div class="icon-container">
            <a class="btn-custom" href="features/events/update.php?task=edit&id=<?php echo $datensatz['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
            <a class="btn-default" href="features/events/delete.php?task=delete&id=<?php  echo $datensatz['id'] ?>"><i class="fa-solid fa-trash"></i></a>
          </div>
          </div>
      <?php } ?>