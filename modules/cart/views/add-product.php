<div class="col-md-12">
    <form class="form-horizontal" action="<?= BASE_URL;?>cart" method="POST" enctype="multipart/form-data">
        <fieldset>

            <!-- Form Name -->
            <legend>Thêm sản phẩm mới vào giỏ hàng</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="product_url">
                    Đường link tới sản phẩm
                </label>  
                <div class="col-md-5">
                    <input id="product_url" name="product_url" type="text" placeholder="" class="form-control input-md" required="">

                </div>
            </div>

            <!-- File Button --> 
            <div class="form-group">
                <label class="col-md-4 control-label" for="image">
                    Ảnh sản phẩm
                </label>
                <div class="col-md-4">
                    <input id="image" name="image[]" class="input-file" type="file">
                    <img src="" alt="" width="150" height="150" id="preview-img">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="product_name">Tên sản phẩm</label>  
                <div class="col-md-5">
                    <input id="product_name" name="product_name" type="text" placeholder="Chealsea Boots" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="customer">Người nhận</label>  
                <div class="col-md-5">
                    <input id="customer" name="customer" type="text" placeholder="John Doe" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="phone">Số điện thoại</label>  
                <div class="col-md-5">
                    <input id="phone" name="phone" type="text" placeholder="000 000 00000" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="address">Địa chỉ người nhận</label>  
                <div class="col-md-5">
                    <input id="address" name="address" type="text" placeholder="123 Bạch Mai, Hà Nội" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="quantity">Số lượng</label>  
                <div class="col-md-5">
                    <input id="quantity" name="quantity" type="text" placeholder="30" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-4">
                    <button id="submit" name="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>
<script>
    jQuery("#image").on('change', function() {
            var file, len = this.files.length;
            for (var i = 0 ; i < len; i++ ) {
                file = this.files[i];

                if (!file.type.match(/image.*/)) {
                    alert('Vui lòng chỉ chọn file ảnh');
                } else {
                    
                    if ( window.FileReader ) {
                        reader = new FileReader();
                        reader.onloadend = function (e) { 
                            jQuery("#preview-img").attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }
        }); 
</script>