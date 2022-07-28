


<section>
       <!-- /.modal-dialog -->
    <div class="modal fade" id="edit_<?php echo htmlentities($result->bookingid);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="width: 70%;">
            <div class="modal-content">
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
                  <div class="vehicleinfo" style="display:50%; "> 

                  <div class="vehicle-info" style="
                margin:20px;
                background-color: #f2f0f0;
                padding:20px;
                border-radius:10px;
                box-shadow:1px 1px 10px;
               ">
                    
                  <div class="form-group" style="font-size:20px">
                  <i class="fa fa-cab" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Vehicle Name:</label>
                  <h5> <?php echo htmlentities($result->vehiclename);?> </h5> 
                </div>
               
                <div class="form-group" style="font-size:20px" >
                <i class="fa fa-user-plus" style="color:#32a85f; font-size:24px;" ></i>
                  <label for="exampleInputEmail1">Renter:</label>
                  <h5> <?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?> </h5> 
                </div>
                <div class="form-group" style="font-size:20px ">
                <i class="fa fa-address-book" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Renter Address:</label>
                  <h5> <?php echo htmlentities($result->address);?> </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-sticky-note-o" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1" style="font-size:20px">Booking Date:</label>
                  <h5> <?php echo htmlentities(date("F d, Y", strtotime($result->bookingdate)));?> </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-refresh" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1" style="font-size:20px;">Return Date:</label>
                  <h5>  <?php echo htmlentities(date("F d, Y", strtotime($result->returndate)));?>  </h5> 
                </div>
                </div>
                <div class="vehicle-info" style="
                margin:20px;
                background-color: #f2f0f0;
                padding:20px;
                border-radius:10px;
                box-shadow:1px 1px 10px";>
                <div class="form-group">
                <i class="fa fa-thumb-tack" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1" style="font-size:20px">Pick up time:</label>
                  <h5> <?php echo htmlentities(date("g:i a", strtotime($result->pickuptime)));?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-tags" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1" style="font-size:20px">Purpose:</label>
                  <h5>  <?php echo htmlentities($result->purpose);?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-users" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1" style="font-size:20px">Manpower:</label>
                  <h5>  <?php echo htmlentities($result->manpower);?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-ticket" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1" style="font-size:20px">Penalty Rate:</label>
                  <h5>  Php <?php echo htmlentities(number_format((float)$result->penaltyrate, 2, '.', ','));?>/Hour  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-ticket" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1" style="font-size:20px">Rate:</label>
                  <h5>  Php <?php echo htmlentities(number_format((float)$result->rate, 2, '.', ','));?>/Day  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-money" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1" style="font-size:20px">Total Payment:</label>
                  <h5>  Php <?php echo htmlentities(number_format((float)$result->total, 2, '.', ','));?>  </h5> 
                </div>
                <?php if(htmlentities($result->penalty) != null) { ?>
                <div class=" form-group" >
                <i class="fa fa-remove" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1" style="font-size:20px">Penalty:</label>
                  <h5>  Php <?php echo htmlentities(number_format((float)$result->penalty, 2, '.', ','));?>  </h5> 
                </div>
                 <?php } else { ?>
                  <div class="form-group">
                  <i class="fa fa-times-rectangle" style="color:#487399; font-size:24px;" ></i>
                  <label for="exampleInputEmail1" style="font-size:20px">Penalty:</label>
                  <h5>  N/A </h5> 
                </div>
                  <?php } ?>
                  
                <h4> <strong>Client Contacts:</strong>  </h4>
                <div class="form-group">
                <i class="fa fa-mobile-phone" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Phone No.</label>
                  <h5>  <?php echo htmlentities($result->contactno);?>  </h5> 
                </div>  
                <div class="form-group">
                <i class="fa fa-user-circle-o" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1" style="font-size:20px">Email:</label>
                  <h5>  <?php echo htmlentities($result->email);?>  </h5> 
                </div>  
                 </div>
                  </div>
                </div>
          </div>
              <div class="modal-footer">
               
                <?php if (htmlentities($result->bookingstatus) == 'TO_CONFIRM') {?>
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                 
                <a href="confirmreturn.php?bookingid=<?php echo htmlentities($result->bookingid)?>&vehicleid=<?php echo htmlentities($result->vehicleid)?>&renterid=<?php echo htmlentities($result->renterid)?>"><button type="submit" class="btn btn-primary" onclick="return confirm('Returned?')">Confirm</button></a>
                <?php } else {?>
                  <a href="report.php?bookingid=<?php echo htmlentities($result->bookingid)?>&renterid=<?php echo htmlentities($result->renterid)?>&complainee=<?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?>"><button type="submit" name="sumbit"  class="btn btn-primary">Report</button></a>
                 <!-- <a href="return.php?bookingid=<?php echo htmlentities($result->bookingid)?>&renterid=<?php echo htmlentities($result->renterid)?>&vehicleid=<?php echo htmlentities($result->vehicleid)?>"><button type="submit" name="sumbit"  class="btn btn-primary" onclick="return confirm('Returned?')">Returned</button></a> -->
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                  <a href="chat.php" ><button type="button" class="btn btn-warning pull-left" style="margin-left:10px;"  >Contact Client</button></a>
                  <?php } ?>
              </div>
            </div>
          </div>
          <!-- /.modal-dialog -->
    </section>