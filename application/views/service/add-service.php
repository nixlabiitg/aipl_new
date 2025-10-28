<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        <form class="kt-form" method="post" action="<?php echo site_url('product/addNewService/'); ?>" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                <h4>Add Service</h4>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="" selected disabled>Select a category</option>
                                <?php foreach ($CATEGORY as $category) { ?>
                                    <option value="<?= $category->category_id; ?>"><?= $category->category_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Organization Name</label>
                            <input type="text" class="form-control" placeholder="Enter organization name" name="organization" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" class="form-control" pattern="[0-9]{10}" minlength="10" maxlength="10" placeholder="Phone no" name="phone" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Whatsapp Number</label>
                            <input type="text" class="form-control" pattern="[0-9]{10}" minlength="10" maxlength="10" placeholder="Whatsapp no" name="whatsapp" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email Id</label>
                            <input type="email" class="form-control" placeholder="Email" name="email">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Website Link</label>
                            <input type="text" class="form-control" placeholder="https://website.com" name="website">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Available Areas</label>
                            <textarea type="text" rows="1" placeholder="Available in" class="form-control" name="locations" required></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Year of Experience</label>
                            <input type="number" class="form-control" placeholder="Experience" name="experience" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Service Images</label>
                            <input type="file" class="form-control" name="serviceimg[]" accept="image/*"
                            multiple="multiple" required>
                            <span class="text-warning"><small>Note : max. image upload 5</small></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Expertise In</label>
                            <textarea type="text" class="form-control" rows="1" placeholder="Expertise" name="expertise" required></textarea>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="card p-3">
                            <h3>Full Address</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Country</label>
                                        <select name="country" class="form-control" id="country" required>
                                            <option selected disabled>Select an option</option>
                                            <?php foreach($country as $c){ ?>
                                                <option value="<?= $c->iso2?>" <?= ($c->name=="India"?"selected":"") ?>><?= $c->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">State</label>
                                        <select name="state" class="form-control" id="state" required>
                                            <option selected disabled>Select an option</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">City</label>
                                        <select name="city" class="form-control" id="city" required>
                                            <option selected disabled>Select an option</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Pin Code</label>
                                        <input type="text" class="form-control" pattern="[0-9]{6}" minlength="6" maxlength="6" placeholder="Pin Code" name="pin" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Full Address</label>
                                        <textarea type="text" class="form-control" placeholder="Address" name="address" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-2">
                        <div class="form-group">
                            <label for="">About</label>
                            <textarea name="description" class="form-control" id="" rows="6" placeholder="About your service" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="reset" class="btn btn-warning text-light">Reset</button>
                            <button type="submit" name="addService" onclick="add_service()" class="btn btn-primary">Add Service</button>
                        </div>
                    </div>
                </div>
        </form>

        <!--end::Form-->
    </div>
</div>

<!--end::Portlet-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function()
    {
        $iso2 = $("#country").val();

        $.ajax({
            type: 'POST',
            dataType : 'text',
            data: 'iso=' + $iso2,
            url: '<?php echo site_url('product/getStates'); ?>',

            success: function(response) {
                if (response != 0) {
                    $('#state').html(response);
                }

            }
        });
    })
    $('#country').on('change', function(){
        $iso2 = $("#country").val();

        $.ajax({
            type: 'POST',
            dataType : 'text',
            data: 'iso=' + $iso2,
            url: '<?php echo site_url('product/getStates'); ?>',

            success: function(response) {
                if (response != 0) {
                    $('#state').html(response);
                }

            }
        });
    })
</script>
<script>
    $('#state').on('change', function(){
        $iso2 = $("#state").val();

        $.ajax({
            type: 'POST',
            dataType : 'text',
            data: 'iso=' + $iso2,
            url: '<?php echo site_url('product/getCity'); ?>',

            success: function(response) {
                if (response != 0) {
                    $('#city').html(response);
                }

            }
        });
    })
</script>

<script>
    function add_service() {
        $("#addproduct").submit();
    }
</script>