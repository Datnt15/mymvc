<div class="col-md-12">
    <form class="form-horizontal" action="<?= base_url;?>cart" method="POST" enctype="multipart/form-data">
        <fieldset>

            <!-- Form Name -->
            <legend>Add New Product To Cart</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="product_url">
                    Product URL
                </label>  
                <div class="col-md-5">
                    <input id="product_url" name="product_url" type="text" placeholder="" class="form-control input-md" required="">

                </div>
            </div>

            <!-- File Button --> 
            <div class="form-group">
                <label class="col-md-4 control-label" for="image">Product Image</label>
                <div class="col-md-4">
                    <input id="image" name="image[]" class="input-file" type="file">
                    <img src="" alt="" width="150" height="150" id="preview-img">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="product_name">Product Name</label>  
                <div class="col-md-5">
                    <input id="product_name" name="product_name" type="text" placeholder="Chealsea Boots" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="customer">Customer</label>  
                <div class="col-md-5">
                    <input id="customer" name="customer" type="text" placeholder="John Doe" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="phone">Phone Number</label>  
                <div class="col-md-5">
                    <input id="phone" name="phone" type="text" placeholder="000 000 00000" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="address">Customer Address</label>  
                <div class="col-md-5">
                    <input id="address" name="address" type="text" placeholder="123 Bạch Mai, Hà Nội" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="quantity">Quantity</label>  
                <div class="col-md-5">
                    <input id="quantity" name="quantity" type="text" placeholder="30" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-4">
                    <button id="submit" name="submit" class="btn btn-primary">Order</button>
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
                    alert('This file is not an image');
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