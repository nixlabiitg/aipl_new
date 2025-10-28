<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
      <!-- begin:: Content Head -->
      <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">New Notification</h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="#" class="btn kt-subheader__btn-daterange" id="" data-toggle="kt-tooltip" title=""
                    data-placement="left">
                    <span class="kt-subheader__btn-daterange-title"
                        id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                    <span class="kt-subheader__btn-daterange-date"
                        id="kt_dashboard_daterangepicker_date"><?php echo date('d M Y') ?></span>
                    <i class="flaticon2-calendar-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
       
        <!-- <form method="post" autocomplete="off" action="<?php echo site_url('notifications/insertNotification'); ?>"> -->
            <div class="row">
                <div class="col-xl-4">
                    <label for="notification">Notification (*)</label>
                    <input type="text" name="notification" class="form-control" placeholder="Notification" id="notification" required>
                </div>
                <div class="col-sm-4 mt-4">
                    <label>Notification for</label>
                                    <select id = "added_for"  class='form-control' name="added_for">
                                    <option value="0" selected>All</option>
                                    <?php foreach($utype as $ut) {?>
                                    <option value="<?=$ut['id']?>"><?=$ut['type']?></option>
                                    <?php } ?>
                                    </select>
                        </div>

                <div class="col-lg-4 mt-4">
                    <label for="show_until">Show Until (*)</label>
                    <input type="date" min="<?php echo date('Y-m-d'); ?>" name="show_until" class="form-control" id="show_until" required>
                </div>
                <div class="col-lg-4 mt-5">
                    <button style="float: right;" type="submit" class="btn btn-success mt-2" name="addNotification" onclick="add_notification();">Add Notification</button>
                </div>
            </div><br />
            <!-- <div class="row">
                <div class="col-xl-12">
                    <button style="float: right;" type="submit" class="btn btn-success" name="addNotification">Add Notification</button>
                </div>
            </div> -->
        <!-- </form> -->
    </div>
</div>

<script>
    add_notification=function()
    {
        if($("#notification").val().trim()==""||$("#show_until").val()=="" ||$("#added_for").val()=="")
        {
            alert("Incomlete entry");
            return;
        }

        var d={
            "notification":$("#notification").val().trim(),
            "until":$("#show_until").val().trim(),
            "for":$("#added_for").val().trim()
        }
        $.ajax({
            url:"<?=base_url('notifications/addnotification')?>",
            type:"POST",
            dataType:"TEXT",
            data:d,
            success:function(data)
            {
              
                alert("Notification added succesfully");
                window.location.reload();
            },
            error:function(data)
            {
                alert(data);
            }
        })
    }
</script>