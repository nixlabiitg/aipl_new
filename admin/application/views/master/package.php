<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">PACKAGE</h3>
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

        <!-- <h5>PACKAGE</h5>
        <hr> -->

        <?php $this->load->view('messages'); ?>
        <div class="row">

            <div class="col-lg-12 mt-3">
                <label for="">Package Name</label>
                <input type="text" class="form-control" id="packagename">

            </div>
            <div class="col-lg-3 mt-3">
                <label for="">Package Amount (&#8377;)</label>
                <input type="number" class="form-control" id="p_amount">

            </div>
            <div class="col-lg-3 mt-3">
                <label for="">Digital Wallet (&#8377;)</label>
                <input type="number" class="form-control" id="dwallet">

            </div>
            <div class="col-lg-3 mt-3">
                <label for="">Shopping Coupon Amount (&#8377;)</label>
                <input type="number" class="form-control" id="quopon">

            </div>
            <div class="col-lg-3 mt-3">
                <label for="">No of coupons (nos)</label>
                <input type="number" class="form-control" id="noquopon">

            </div>
            <div class="col-lg-3 mt-3">
                <label for="">Magic Shopping Point</label>
                <input type="number" class="form-control" id="magicpoint">

            </div>
            <div class="col-lg-3 mt-3">
                <label for="">Gift Product (&#8377;)</label>
                <input type="number" class="form-control" id="giftamt">

            </div>
            <div class="col-lg-3 mt-3">
                <label for="">Direct IPP Sponsor Amount (&#8377;)</label>
                <input type="number" class="form-control" id="sponsoramt">

            </div>

            <div hidden class="col-lg-3 mt-3">
                <label for="">Registration Point</label>
                <input type="number" class="form-control" id="regpoint">

            </div>
            <div hidden class="col-lg-3 mt-3">
                <label for="">Refer Point</label>
                <input type="number" class="form-control" id="refpoint">

            </div>
            <div class="col-lg-3 mt-3">
                <label for="">Direct Points Bonus (point)</label>
                <input type="number" class="form-control" id="directpoint">
            </div>

            <div class="col-lg-3 mt-3">
                <label for="">Sales Points Bonus (point)</label>
                <input type="number" class="form-control" id="salesPoint">
            </div>
        </div>


        <fieldset class="form-group border p-3 mt-3">

            <legend class="w-auto px-2 text-left">SPECIAL GENERATION INCOME (Magic IPP)</legend>
            <div class="row">
                <div class="col-lg-3 mt-2">
                    <label for="">Level 1 ( &#8377; )</label>
                    <input type="number" class="form-control" id="level1">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Level 2 ( &#8377; )</label>
                    <input type="number" class="form-control" id="level2">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 3 ( &#8377; )</label>
                    <input type="number" class="form-control" id="level3">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 4 ( &#8377; )</label>
                    <input type="number" class="form-control" id="level4">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 5 ( &#8377; )</label>
                    <input type="number" class="form-control" id="level5">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 6 ( &#8377; )</label>
                    <input type="number" class="form-control" id="level6">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 7 ( &#8377; )</label>
                    <input type="number" class="form-control" id="level7">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 8 ( &#8377; )</label>
                    <input type="number" class="form-control" id="level8">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 9 ( &#8377; )</label>
                    <input type="number" class="form-control" id="level9">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 10 ( &#8377; )</label>
                    <input type="number" class="form-control" id="level10">
                </div>


            </div>


        </fieldset>

        <fieldset class="form-group border p-3 mt-3">

            <legend class="w-auto px-2 text-left">LEVEL UPGRADE INCENTIVE</legend>
            <div class="row">
                <div class="col-lg-3 mt-2">
                    <label for="">Level 1 ( &#8377; )</label>
                    <input type="number" class="form-control" id="inclevel1">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Level 2 ( &#8377; )</label>
                    <input type="number" class="form-control" id="inclevel2">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 3 ( &#8377; )</label>
                    <input type="number" class="form-control" id="inclevel3">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 4 ( &#8377; )</label>
                    <input type="number" class="form-control" id="inclevel4">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 5 ( &#8377; )</label>
                    <input type="number" class="form-control" id="inclevel5">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 6 ( &#8377; )</label>
                    <input type="number" class="form-control" id="inclevel6">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 7 ( &#8377; )</label>
                    <input type="number" class="form-control" id="inclevel7">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 8 ( &#8377; )</label>
                    <input type="number" class="form-control" id="inclevel8">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 9 ( &#8377; )</label>
                    <input type="number" class="form-control" id="inclevel9">

                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Llevel 10 ( &#8377; )</label>
                    <input type="number" class="form-control" id="inclevel10">
                </div>


            </div>


        </fieldset>

        <div class="row">
            <div class="col-lg-3 mt-2">
                <label for="">Booster Income ( &#8377; )</label>
                <input type="number" class="form-control" id="boosterIncome">
            </div>
            <div class="col-lg-3 mt-2">
                <label for="">Fast Track Income ( &#8377; )</label>
                <input type="number" class="form-control" id="fastrackIncome">
            </div>
            <div class="col-lg-4 mt-2">
                <label for="">Fast Track Income Duration ( months )</label>
                <input type="number" class="form-control w-50" id="fastrackDuration">
            </div>
        </div>
        <fieldset class="form-group border p-3 mt-3">

            <legend class="w-auto px-2 text-left">FAST TRACK BENEFIT B</legend>
            <div class="row">
                <div class="col-lg-2 mt-2">
                    <label for="">1 Year ( % )</label>
                    <input type="number" class="form-control" id="f1y">

                </div>
                <div class="col-lg-2 mt-2">
                    <label for="">2 Year( % )</label>
                    <input type="number" class="form-control" id="f2y">

                </div>
                <div class="col-lg-2 mt-2">
                    <label for="">3 Year ( % )</label>
                    <input type="number" class="form-control" id="f3y">

                </div>
                <div class="col-lg-2 mt-2">
                    <label for="">4 Year ( % )</label>
                    <input type="number" class="form-control" id="f4y">

                </div>
                <div class="col-lg-2 mt-2">
                    <label for="">5 year ( % )</label>
                    <input type="number" class="form-control" id="f5y">
                </div>



            </div>


        </fieldset>

        <div class="row mt-3">
            <div class="col-lg-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="autopool">
                    <label class="form-check-label" for="flexCheckChecked">
                        Allow in Autopool
                    </label>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="clubachieve">
                    <label class="form-check-label" for="flexCheckChecked">
                        Club Achieve
                    </label>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12 text-right">
                <button class="btn btn-success mt-4" onclick="add_package();">Save & Continue</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="row px-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Field Name</label>
                                <input type="text" name="" placeholder="Field name" id="name" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Field Name</label>
                                <input type="text" name="" placeholder="Field name" id="name" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Field Name</label>
                                <input type="text" name="" placeholder="Field name" id="name" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Field Name</label>
                                <input type="text" name="" placeholder="Field name" id="name" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
add_package = function() {
    if ($("#packagename").val() == "" || $("#p_amount").val() == "") return;
    var d = {
        "p_name": $("#packagename").val(),
        "p_amount": $("#p_amount").val(),
        "d_wallet": $("#dwallet").val(),
        "quopon": $("#quopon").val(),
        "noquopon": $("#noquopon").val(),
        "magicpoint": $("#magicpoint").val(),
        "giftamt": $("#giftamt").val(),
        "sponsoramt": $("#sponsoramt").val(),
        "regpoint": $("#regpoint").val(),
        "refpoint": $("#refpoint").val(),
        "salespoint": $('#salesPoint').val(),
        "level1": $("#level1").val(),
        "level2": $("#level2").val(),
        "level3": $("#level3").val(),
        "level4": $("#level4").val(),
        "level5": $("#level5").val(),
        "level6": $("#level6").val(),
        "level7": $("#level7").val(),
        "level8": $("#level8").val(),
        "level9": $("#level9").val(),
        "level10": $("#level10").val(),
        "inclevel1": $("#inclevel1").val(),
        "inclevel2": $("#inclevel2").val(),
        "inclevel3": $("#inclevel3").val(),
        "inclevel4": $("#inclevel4").val(),
        "inclevel5": $("#inclevel5").val(),
        "inclevel6": $("#inclevel6").val(),
        "inclevel7": $("#inclevel7").val(),
        "inclevel8": $("#inclevel8").val(),
        "inclevel9": $("#inclevel9").val(),
        "inclevel10": $("#inclevel10").val(),

        "f1y": $("#f1y").val(),
        "f2y": $("#f2y").val(),
        "f3y": $("#f3y").val(),
        "f4y": $("#f4y").val(),
        "f5y": $("#f5y").val(),

        "autopoolallow": ($("#autopool").is(':checked') ? 1 : 0),
        "clubachieve": ($("#clubachieve").is(':checked') ? 1 : 0),
        "boosterIncome": $("#boosterIncome").val(),
        "directpoint": $("#directpoint").val(),
        "fastrackIncome": $("#fastrackIncome").val(),
        "fastrackDuration": $("#fastrackDuration").val()

    }
    $.ajax({
        url: "<?=base_url("package/addPackage")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            //  alert(data);
            alert("Package Added Successfully")
            window.location.reload();
        },
        error: function(data) {
            alert(data);
        }

    })
}
</script>