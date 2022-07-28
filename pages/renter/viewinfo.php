<section>
       <!-- /.modal-dialog -->
    <div class="modal fade" id="edit_<?php echo htmlentities($result->vehicleid);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="width:70%;">
            <div class="modal-content"  >
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Vehicle Information</h4>
              </div>

              <div class="modal-body" > 
            <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
              <div class="box-body" id="load_data">


                <div style="display:grid">
                <img style="width: 100%; height:600px;" src="../owner/vehicle_images/<?php echo htmlentities($result->vehicleimage);?>">
                  <div class="vehicleinfo" style="display:50%;"> 

                <div class="vehicle-info" style="
                margin:20px;
                background-color: #f2f0f0;
                padding:20px;
                border-radius:10px;
                box-shadow:1px 1px 10px";>
                <div class="form-group">
                <i class="fa fa-cab" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Vehicle Model:</label>
                  <h5> <?php echo htmlentities($result->model);?> </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-cab" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Vehicle Brand:</label>
                  <h5> <?php echo htmlentities($result->brand);?> </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-cubes" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Capacity:</label>
                  <h5> <?php echo htmlentities($result->capacity);?> Seater </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-ticket" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Rate:</label>
                  <h5>  Php <?php echo htmlentities(number_format((float)$result->rate, 2, '.', ','));?>/Day  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-ticket" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Penalty Rate:</label>
                  <h5>  Php <?php echo htmlentities(number_format((float)$result->penaltyrate, 2, '.', ','));?>/Hour  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-user-plus" style="color:#32a85f; font-size:24px;" ></i>
                  <label for="exampleInputEmail1">Vehicle Owner:</label>
                  <h5> <?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-address-book" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Vehicle Owner Address:</label>
                  <h5>  <?php echo htmlentities($result->address);?>  </h5> 
                </div>
                
               <?php 
               $sql1="SELECT AVG(rating) as avg_rating FROM feedback WHERE vehicleid = $result->vehicleid";
               $query1=$dbh->prepare($sql1);
               $query1->execute();
               $results1=$query1->fetchALL(PDO::FETCH_OBJ);
               
               
                 foreach ($results1 as $result1) 
                 {
                 
               
               ?>
                <?php if (htmlentities($result1->avg_rating) >= 1  && htmlentities($result1->avg_rating) < 2 ) { ?>

                <div class="form-group">
                  <label for="exampleInputEmail1">Rating:</label>
                  <h5> <?php echo htmlentities(round($result1->avg_rating, 1));?> 
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         </h5> 
                </div>

                <?php } else if (htmlentities($result1->avg_rating) >= 2 && htmlentities($result1->avg_rating) < 3 )  {?>

                  <div class="form-group">
                  <label for="exampleInputEmail1">Rating:</label>
                  <h5> <?php echo htmlentities(round($result1->avg_rating, 1));?> 
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         </h5> 
                </div>
                
                <?php } else if (htmlentities($result1->avg_rating) >= 3 && htmlentities($result1->avg_rating) < 4 )  {?>
                
                  <div class="form-group">
                  <label for="exampleInputEmail1">Rating:</label>
                  <h5> <?php echo htmlentities(round($result1->avg_rating, 1));?> 
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         </h5> 
                </div>
                
                <?php } else if (htmlentities($result1->avg_rating) >= 4 && htmlentities($result1->avg_rating) < 5 ) {?>

                  <div class="form-group">
                  <label for="exampleInputEmail1">Rating:</label>
                  <h5> <?php echo htmlentities(round($result1->avg_rating, 1));?> 
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         </h5> 
                </div>

                <?php } else if (htmlentities($result1->avg_rating) >= 5) {?>

                  <div class="form-group">
                  <label for="exampleInputEmail1">Rating:</label>
                  <h5> <?php echo htmlentities(round($result1->avg_rating, 1));?> 
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         </h5> 
                </div>

                <?php } } 
     ?>
             
                  
              
                  </div>
                  </div>
                </div>
          </div>
          
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <a href="booking.php?vehicleid=<?php echo htmlentities($result->vehicleid)?>&ownerid=<?php echo htmlentities($result->userid)?>&rate=<?php echo htmlentities($result->rate)?>"><button type="submit" class="btn btn-primary">Book</button></a>
              </div>
              <div class="feedbacklink" align="Center">
              <a href="viewvehiclefeedbacks.php?vehicleid=<?php echo htmlentities($result->vehicleid)?>">View Feedbacks</a>
              </div>
            </div>
          </div>
          <!-- /.modal-dialog -->
    </section>