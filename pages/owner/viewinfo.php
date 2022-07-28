<section>
       <!-- /.modal-dialog -->
    <div class="modal fade" id="edit_<?php echo htmlentities($result->bookingid);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="width:70%;">
            <div class="modal-content"  >
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Booking Information</h4>
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
                  <label for="exampleInputEmail1">Vehicle Name:</label>
                  <h5> <?php echo htmlentities($result->vehiclename);?> </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-user-plus" style="color:#32a85f; font-size:24px;" ></i>
                  <label for="exampleInputEmail1">Renter:</label>
                  <h5> <?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?> </h5> 
                 
                 
                </div>
                <div class="form-group">
                <i class="fa fa-address-book" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Renter Address:</label>
                  <h5> <?php echo htmlentities($result->address);?> </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-sticky-note-o" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Booking Date:</label>
                  <h5> <?php echo htmlentities(date("F d, Y", strtotime($result->bookingdate)));?> </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-refresh" style="color:#32a85f; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Return Date:</label>
                  <h5>  <?php echo htmlentities(date("F d, Y", strtotime($result->returndate)));?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-thumb-tack" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Pick up time:</label>
                  <h5> <?php echo htmlentities(date("g:i a", strtotime($result->pickuptime)));?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-tags" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Purpose:</label>
                  <h5>  <?php echo htmlentities($result->purpose);?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-users" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Manpower:</label>
                  <h5>  <?php echo htmlentities($result->manpower);?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-ticket" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Rate:</label>
                  <h5>  Php <?php echo htmlentities(number_format((float)$result->rate, 2, '.', ','));?>  </h5> 
                </div>
                <div class="form-group">
                <i class="fa fa-money" style="color:#487399; font-size:24px;"></i>
                  <label for="exampleInputEmail1">Total Payment:</label>
                  <h5>  Php <?php echo htmlentities(number_format((float)$result->total, 2, '.', ','));?>  </h5> 
                </div>
                </div>
                  </div>
                </div>
          </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>
                <a href="declinerental.php?bookingid=<?php echo htmlentities($result->bookingid)?>&vehicleid=<?php echo htmlentities($result->vehicleid)?>&renterid=<?php echo htmlentities($result->userid)?>&model=<?php echo htmlentities($result->model)?>" onclick="return confirm('Decline?')"><button type="submit" class="btn btn-danger">Decline</button></a>
                <?php 

                $sql1= "SELECT * FROM booking 
                INNER JOIN vehicle ON booking.vehicleid = vehicle.vehicleid
                WHERE vehicle.userid = $id AND (booking.bookingstatus =  'RESERVED' OR booking.bookingstatus =  'TO_CONFIRM')  AND vehicle.vehicleid = $vehicleid
                AND (booking.bookingdate BETWEEN '".$bookingdate."' AND '".$returndate."' OR booking.returndate BETWEEN '".$bookingdate."' AND '".$returndate."') ";
                $query1=$dbh->prepare($sql1);
                $query1->execute();
                $results=$query1->fetchALL(PDO::FETCH_OBJ);
                if ($query1->rowCount()>0)
                {
                ?>
                <a style="text-decoration:none;color:red"> Schedule Conflict  </a>
                <?php } else {?>
                <a href="confirmrental.php?bookingid=<?php echo htmlentities($result->bookingid)?>&vehicleid=<?php echo htmlentities($result->vehicleid)?>&renterid=<?php echo htmlentities($result->userid)?>&model=<?php echo htmlentities($result->model)?>" onclick="return confirm('Confirm?')"><button type="submit" class="btn btn-primary">Accept</button></a>
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- /.modal-dialog -->
    </section>