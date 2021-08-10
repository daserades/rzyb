<?php 
					$dosyaSayisi = 1;
					if(file_exists('storage/uploads/'.$desen->id)){
					$klasor = opendir( 'storage/uploads/'.$desen->id);
					    while (false !== ($girdi = readdir($klasor))) {
					        if ($girdi != "." && $girdi != "..") {
					        	$ext = pathinfo($girdi);
					        	$uzanti= $ext['extension'];
					     ?>
					<img src="{{ Storage::url('uploads/'.$desen->id.'/'.$desen->id.'-'.$dosyaSayisi.'.'.$uzanti) }}" width="1400" height="900" a/>	
					           <?php
					           $dosyaSayisi++;
					        }
					    }
					    closedir($klasor);
					}
					?>