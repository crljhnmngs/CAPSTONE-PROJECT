

<section>
       <!-- 
         /.modal-dialog -->
      
    <div class="modal fade" id="edit_<?php echo htmlentities($result->bookingid);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="width:70%;">
            <div class="modal-content" >
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reserved Vehicle Information</h4>
              </div>

              <div class="modal-body" > 
            <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
           
              <div class="box-body" id="load_data">


                <div style="display:grid">
                <img style="width: 100%;" src="../owner/vehicle_images/<?php echo htmlentities($result->vehicleimage);?>">
               <div class="vehicleinfo" style="display:50%;margin-left:20px"> 
               <div class="vehicle-info" style="
                margin:20px;
                background-color: #f2f0f0;
                padding:20px;
                border-radius:10px;
                box-shadow:1px 1px 10px";>
               <div class="form-group">
               <i class="fa fa-cab" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Vehicle Model:</label>
                  <h5><?php echo htmlentities($result->model);?></h5>
                </div>
                <div class="form-group">
                <i class="fa fa-cab" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Vehicle Brand:</label>
                 <h5> <?php echo htmlentities($result->brand);?> </h5>
                </div>
                <div class="form-group">
                <i class="fa fa-cubes" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Capacity:</label>
                   <h5><?php echo htmlentities($result->capacity);?></h5>
                </div>
                <div class="form-group">
                <i class="fa fa-ticket" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Rate:</label>
                  <h5> Php <?php echo htmlentities(number_format((float)$result->rate, 2, '.', ','));?>/Day</h5>
                </div>
                <div class="form-group">
                <i class="fa fa-ticket" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Penalty Rate:</label>
                  <h5> Php <?php echo htmlentities(number_format((float)$result->penaltyrate, 2, '.', ','));?>/Hour</h5>
                </div>
                <div class="form-group">
                <i class="fa fa-money" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Total Payment:</label>
                  <h5> Php <?php echo htmlentities(number_format((float)$result->total, 2, '.', ','));?></h5>
                </div>
             </div>
             <div class="vehicle-info" style="
                margin:20px;
                background-color: #f2f0f0;
                padding:20px;
                border-radius:10px;
                box-shadow:1px 1px 10px";>
             <h4> <strong>Vehicle Owner Contacts:</strong>  </h4>
                <div class="form-group">
                <i class="fa fa-user-plus" style="color:#32a85f; font-size:24px;" ></i>
                  <label for="exampleInputEmail1">Phone No.</label>
                  <h5>  <?php echo htmlentities($result->contactno);?>  </h5> 
                </div>  
              

                <div class="form-group">
                <i class="fa fa-user-plus" style="color:#32a85f; font-size:24px;" ></i>
                  <label for="exampleInputEmail1">Vehicle Owner:</label>
                  <h5> <?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-user-plus" style="color:#32a85f; font-size:24px;" ></i>
                  <label for="exampleInputEmail1">Vehicle Owner Address:</label>
                  <h5>  <?php echo htmlentities($result->address);?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-user-circle-o" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Email:</label>
                  <h5>  <?php echo htmlentities($result->email);?>  </h5> 
                </div>     
                   <input name="bookingid" type="hidden" value="<?php echo htmlentities($result->bookingid);?>">
            </div>




            <div class="vehicle-info" style="
                margin:20px;
                background-color: #f2f0f0;
                padding:20px;
                border-radius:10px;
                box-shadow:1px 1px 10px";>

                <div class="form-group">
                <i class="fa fa-address-book" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Booking Date:</label>
                  <h5>  <?php echo htmlentities(date("F d, Y", strtotime($result->bookingdate)));?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-address-book" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Return Date:</label>
                  <h5>  <?php echo htmlentities(date("F d, Y", strtotime($result->returndate)));?>  </h5> 
                </div>
                <?php if(htmlentities($result->penalty) != null) { ?>
                <div class="form-group">
                <i class="fa fa-remove" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Penalty:</label>
                  <h5>  Php <?php echo htmlentities(number_format((float)$result->penalty, 2, '.', ','));?> </h5> 
                </div>
                 <?php } else { ?>
                  <div class="form-group">
                  <i class="fa fa-times-rectangle" style="color:#487399; font-size:24px;" ></i>
                  <label for="exampleInputEmail1">Penalty:</label>
                  <h5>  N/A </h5> 
                </div>
                  <?php } ?>
                <div class="form-group">
                <i class="fa fa-thumb-tack" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Pick up time:</label>
                  <h5>  <?php echo htmlentities(date("g:i a", strtotime($result->pickuptime)));?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-tags" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Purpose:</label>
                  <h5>  <?php echo htmlentities($result->purpose);?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-users" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Manpower:</label>
                  <?php if(htmlentities($result->manpower) != null) { ?>
                  <h5>  <?php echo htmlentities($result->manpower);?>  </h5> 
                  <?php } else {  ?>
                  <h5>  N/A  </h5> 
                  <?php } ?>
                </div>
              </div>
                  </div>
                </div>
          </div>
              </div>
              
              <div class="modal-footer">
                <button type="button" style="margin-right:10px;" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <a href="chat.php" ><button type="button" class="btn btn-warning pull-left"  >Contact Owner</button></a>
                
                <?php if(htmlentities($result->bookingstatus)  != 'TO_CONFIRM') {?>
                  <a href="report.php?bookingid=<?php echo htmlentities($result->bookingid)?>&ownerid=<?php echo htmlentities($result->userid)?>&complainee=<?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?>"><button type="submit" name="sumbit"  class="btn btn-primary">Report</button></a>
                  <a href="feedback.php?bookingid=<?php echo htmlentities($result->bookingid)?>&vehicleid=<?php echo htmlentities($result->vehicleid)?>&renterid=<?php echo htmlentities($result->renterid)?>&ownerid=<?php echo htmlentities($result->userid)?>"><button type="submit" name="sumbit"  class="btn btn-primary" onclick="return confirm('Returned?')">Return</button></a>
                
                <?php } else { ?>
                  <h4> Pending </h4> 
                  <?php } ?>
              </div>
            </div>
            
          </div>
          <!-- /.modal-dialog -->
     
    </section>