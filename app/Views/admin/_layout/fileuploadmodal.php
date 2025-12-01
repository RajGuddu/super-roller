    <div class="modal fade" id="imageUploadModal" tabindex="-1" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="imageUploadModalContent">
                
                    
            </div>
        </div>
    </div>

    <script>
        function imageUpload(outputId, imagename){
            // var imagename = 'before';
            // var outputId = 'bannerImage';
            $.ajax({
                url: "<?=base_url('/image_upload_show_modal')?>",
                type: "POST",
                data: { imagename:imagename, outputId:outputId },
                success: function (res) {
                    // console.log(res);
                    $("#imageUploadModalContent").html(res);
                },
            });
            // $('#imageUploadModal').modal({backdrop: 'static', keyboard: false}, 'show'); 
            $('#imageUploadModal').modal('show'); 
        }
    </script>