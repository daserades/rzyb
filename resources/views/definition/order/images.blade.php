<?php 
					$dosyaSayisi = 1;
					if(file_exists('storage/uploads/'.$order->order_no)){
					$klasor = opendir( 'storage/uploads/'.$order->order_no);
					    while (false !== ($girdi = readdir($klasor))) {
					        if ($girdi != "." && $girdi != "..") {
					        	$ext = pathinfo($girdi);
					        	$uzanti= $ext['extension'];
					     ?>
					<img src="{{ Storage::url('uploads/'.$order->order_no.'/'.$order->order_no.'-'.$dosyaSayisi.'.'.$uzanti) }}" width="1200" height="800" />	
					           <?php
					           $dosyaSayisi++;
					        }
					    }
					    closedir($klasor);
					}
					?>