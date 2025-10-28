<!-- Cropper CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet" />
<!-- Cropper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?=$page_name?></h3>

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
        <form id="healthCardForm" action="<?php echo base_url('customer/upload_health_card') ?>" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="customerid" id="customerid" required>

            <!-- Hidden file inputs -->
            <input type="file" id="card" accept="image/*" style="display: none;">
            <input type="file" id="card_back" accept="image/*" style="display: none;">

            <!-- Cropped image placeholders -->
            <input type="hidden" name="card_cropped" id="card_cropped">
            <input type="hidden" name="card_back_cropped" id="card_back_cropped">

            <div class="row">
                <div class="col-lg-4 mb-2">
                    <label>Customer ID</label>
                    <input type="text" class="form-control" placeholder="Enter customer ID" name="customerid_display"
                        id="customerid_display" required>
                </div>

                <div class="col-lg-4 mb-2">
                    <label>Health Card (Front)</label>
                    <button type="button" class="btn btn-primary btn-block"
                        onclick="document.getElementById('card').click();">Select Front Image</button>
                    <img id="preview_front" src="" class="img-fluid mt-2" style="max-height: 100px;">
                </div>

                <div class="col-lg-4 mb-2">
                    <label>Health Card (Back)</label>
                    <button type="button" class="btn btn-primary btn-block"
                        onclick="document.getElementById('card_back').click();">Select Back Image</button>
                    <img id="preview_back" src="" class="img-fluid mt-2" style="max-height: 100px;">
                </div>

                <div class="col-lg-12 text-right">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
#cropModal .modal-dialog {
    max-width: 700px;
    width: 100%;
}

#cropModal .modal-body {
    max-height: 500px;
    overflow: auto;
    text-align: center;
}

#cropModal #cropper-image {
    max-width: 100%;
    max-height: 400px;
    display: inline-block;
}

@media (max-width: 768px) {
    #cropModal .modal-dialog {
        max-width: 100%;
        margin: 1rem;
    }

    #cropModal #cropper-image {
        max-height: 250px;
    }
}
</style>

<!-- Modal for Cropping -->
<div class="modal fade" id="cropModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img id="cropper-image" src="" class="img-fluid" style="width:100%;" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="cropImageBtn">Crop</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
let cropper;
let croppingFor = '';

function loadCropper(input, type) {
    croppingFor = type;

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const image = document.getElementById('cropper-image');
            image.src = e.target.result;

            $('#cropModal').modal('show');
            setTimeout(() => {
                cropper = new Cropper(image, {
                    aspectRatio: 4 / 3,
                    viewMode: 1,
                    responsive: true
                });
            }, 200);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Bind file inputs
document.getElementById('card').addEventListener('change', function() {
    loadCropper(this, 'front');
});

document.getElementById('card_back').addEventListener('change', function() {
    loadCropper(this, 'back');
});

// Handle cropping
document.getElementById('cropImageBtn').addEventListener('click', function() {
    const canvas = cropper.getCroppedCanvas({
        width: 600,
        height: 400,
    });

    canvas.toBlob(blob => {
        const reader = new FileReader();
        reader.onloadend = function() {
            if (croppingFor === 'front') {
                document.getElementById('card_cropped').value = reader.result;
                document.getElementById('preview_front').src = reader.result;
            } else {
                document.getElementById('card_back_cropped').value = reader.result;
                document.getElementById('preview_back').src = reader.result;
            }
        };
        reader.readAsDataURL(blob);
    });

    cropper.destroy();
    $('#cropModal').modal('hide');
});
</script>