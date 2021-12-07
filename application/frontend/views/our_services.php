<?php 
					    if(!empty($writing_consultancy_page_detl)){
					        //echo '<pre>';print_r($writing_consultancy_page_detl); exit;
					        foreach($writing_consultancy_page_detl as $wcpd){
					        ?>
					        <li><a href="<?php echo base_url();?>cms/writing_consultancy/<?php echo $wcpd->slug; ?>"><i class="fa fa-angle-double-right"></i><?php echo $wcpd->title; ?></a></li>
					        <?php
					        }
					    }?>
					    
					    <?php 
					    if(!empty($book_publication_page_detl)){
					        foreach($book_publication_page_detl as $bppd){
					        ?>
					        <li><a href="<?php echo base_url();?>cms/book_publication/<?php echo $bppd->slug; ?>"><i class="fa fa-angle-double-right"></i><?php echo $bppd->title; ?> </a></li>
					        <?php
					        }
					    }?>