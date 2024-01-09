


<?php $__env->startSection('element'); ?>
    <div class="row card">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h4><?php echo e(__('Upload KYC Documents')); ?></h4>

                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo e(url('/kyc-file-upload')); ?>" id="uploadForm" enctype="multipart/form-data">
                        <div class="row gy-4 ">
                            <div class="col-md-6">
                                <label for="">Select Document Type:</label>
                                <select name="doc_type" id="doc_type" class="form-control">
                                    <option value=""></option>
                                    <option value="proof_id1">Proof of ID 1</option>
                                    <option value="proof_id2">Proof of ID 2</option>
                                    <option value="proof_address1">Proof of Address 1</option>
                                    <option value="proof_address2">Proof of Address 2</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <div class="img-choose-div text-center">
                                    


                                    <input type="file" name="file" id="docUpload" class=""
                                        accept=".png, .jpg, .jpeg" hidden>
                                    <label for="docUpload" class="file-upload" id="upload_label"
                                        style="display: none"></label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="file" name="file_type" class="form-control" id="">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('style'); ?>
    <style>
        .file-id-preview {
            max-height: 300px;
            display: inline-block !important;
        }

        .doc-id-preview {
            max-height: 200px;
            display: none;
            margin-top: 10px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        'use strict'

        document.getElementById("imageUpload").onchange = function() {
            alert('fdf');
            show();
        };

        function show() {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-id-preview");
                preview.src = src;
                preview.style.display = "block";
                document.getElementById("file-id-preview").style.visibility = "visible";
            }
        }

        $('#doc_type').on('change', () => {

            $('#upload_label').show();

            var val = $('#doc_type').val();

            if (val == 'proof_id1') {
                $('#upload_label').html('Uplaod your Proof of ID 1');
            }
            if (val == 'proof_id2') {
                $('#upload_label').html('Uplaod your Proof of ID 2');
            }
            if (val == 'proof_address1') {
                $('#upload_label').html('Uplaod your Proof of Address 1');
            }
            if (val == 'proof_address2') {
                $('#upload_label').html('Uplaod your Proof of Address 2');
            }
        })
        $('#docUpload').on('change', function() {

            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("doc-id-preview");
                preview.src = src;
                preview.style.display = "block";
                document.getElementById("doc-id-preview").style.visibility = "visible";
            }

            $("#uploadForm").submit();

        });
        // }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/users/upload-kyc.blade.php ENDPATH**/ ?>