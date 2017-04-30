<h1 class="page-title"><span class="title-text"> Add</span> Products
    <small><span class="title-text">Add</span> Your Products Here</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('/')}}/#/dashboard">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{url('/')}}/#/product">Products</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span><span class="title-text">Add</span> Product</span>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<form method="post" class="addProduct">
    <div class="row">
        <div class="col-md-2">
            <div style="padding-left:10px">
                <h4>Basic Product Information</h4>
                <h5><span class="title-text">Add</span> the basic product information</h5>
            </div>
        </div>
        <div class="col-md-10">
            <div class="portlet light ">
                <div>
                    <div class="form-body">
                        <input type="hidden" value="" name="id">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" placeholder="Product Name" name="product">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" placeholder="Product Description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="single" class="control-label">Category</label>
                            <select id="category" class="form-control select2" name="category">
                                <option value="">Select Category</option>
                            </select>
                        </div>
                       <div class="form-group">
                            <label>Product Tags</label>
                            <div>
                                <input type="text" class="form-control input-large" value="Summer, Vintage, Gifts" data-role="tagsinput">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Product Image</label>
                            <div>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="input-group input-large">
                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                                &nbsp;
                                            <span class="fileinput-filename"> </span>
                                        </div>
                                        <span class="input-group-addon btn default btn-file">
                                            <span class="fileinput-new"> Select file </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="..."> </span>
                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
                <div style="padding-left:10px">
                    <h4>Price Information</h4>
                    <h5>Add here all product price information</h5>
                </div>
        </div>
        <div class="col-md-10">
            <div class="portlet light ">
                <div>
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Cost</label>
                                <div class="input-icon">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                <input class="form-control" id="exampleInputEmail2" name="cost" placeholder="Cost"></div>
                            </div>
                            <div class="form-group col-md-1" style="font-size: 20px">
                            <div>&nbsp;</div>
                            <div><b>=</b></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Marckup</label>
                                <div class="input-icon">
                                <i class="fa fa-percent" aria-hidden="true"></i>
                                <input class="form-control" id="exampleInputEmail2" placeholder="Marckup" disabled=""></div>
                            </div>
                            <div class="form-group col-md-1" style="font-size: 20px">
                            <div>&nbsp;</div>
                            <div><b>×</b></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Selling Price</label>
                                <div class="input-icon">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                <input class="form-control" id="exampleInputEmail2" placeholder="Selling Price"></div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
                <div style="padding-left:10px">
                    <h4>Product Variant</h4>
                    <h5>Manage the product vairiant here</h5>
                </div>
        </div>
        <div class="col-md-10">
            <div class="portlet light ">
                <div>
                    <div class="form-body">
                       <div class="form-group">
                            <label>Does this product come in multiple variations like size or color?</label>
                            </br>
                            <input type="checkbox"  class="make-switch" data-on-text="&nbsp;YES&nbsp;" data-off-text="&nbsp;NO&nbsp;" data-size="normal" id="variantck">
                        </div>
                        <div class="form-group mt-repeater" id="vairant">
                        <div data-repeater-list="group-c">
                                <div data-repeater-item class="mt-repeater-item">
                                    <div class="row mt-repeater-row">
                                        <div class="col-md-3">
                                            <label class="control-label">Option Name</label>
                                            <input type="text" placeholder="i.e. Size, Large, Small..." class="form-control" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Barcode</label>
                                            <input type="text" placeholder="Barcode" class="form-control" />
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label">Cost</label>
                                            <input type="text" placeholder="Supply Price" class="form-control" />
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label">Price</label>
                                            <input type="text" placeholder="Retail Price" class="form-control" />
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label">Quantity</label>
                                            <input type="text" placeholder="" class="form-control" />
                                        </div>

                                        <div class="col-md-1">
                                            <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add">
                                <i class="fa fa-plus"></i> Add Another Option</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
                <div style="padding-left:10px">
                    <h4>Inventory</h4>
                    <h5>Add here all product Inventory information</h5>
                </div>
        </div>
        <div class="col-md-10">
            <div class="portlet light ">
                <div>
                    <div class="form-body">
                       <div class="form-group">
                                <label>SKU (Stock Keeping Unit)</label>
                                <input class="form-control" id="exampleInputEmail2" placeholder="SKU (Stock Keeping Unit)">
                        </div>
                        <div class="form-group">
                                <label>Barcode (ISBN, UPC, GTIN, etc.)</label>
                                <input class="form-control" id="exampleInputEmail2" placeholder="Barcode">
                        </div>
                        <div class="form-group">
                            <label>Track Inventory?</label>
                            </br>
                            <input type="checkbox" checked class="make-switch" data-on-text="&nbsp;YES&nbsp;" data-off-text="&nbsp;NO&nbsp;" data-off-color="danger" data-size="normal">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="text" class="form-control input-medium" name="quantity" placeholder="Quantity">
                        </div>
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <button class="btn blue btn-sm" id="save">Save</button>
                            <button type="reset" class="btn blue btn-sm">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
$(document).ready(function() {
    var url = site_url + 'api/category';

    jQuery.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function(response) {
            $.each(response.categories, function(k, v) {
                $('#category').append("<option value='"+ v.id +"'>"+ v.category +"</option>>");
            });
        }
    });

    $("#save").click(function()
    {
        var url1 = site_url + 'api/add_product';
        var form_data = $('.addProduct').serialize();

        jQuery.ajax({
            type: "POST",
            url: url1,
            dataType: 'json',
            data: form_data,
            success: function(res) {
                if (res.errors){
                    $.each(res.errors, function(k, v){
                        alertify.success(v); //show validation error
                    });
                }else{
                    alertify.success(res.message);
                    setTimeout(function(){
                        window.location.href = site_url + "#/product";
                    }, 1000);
                    return false;
                }
            }
        });
    });

    var pathname = window.location.href;
    var lastItem = pathname.split("/").pop(1);
    var token = "{{ csrf_token() }}";
    if(lastItem)
    {
        var url2 = site_url + 'api/edit_product/' + lastItem;

        jQuery.ajax({
            type: "POST",
            url: url2,
            dataType: "json",
            data: {
                id:lastItem,
                _token: token,
            },
            success: function(data)
            {
                $('[name="id"]').val(data.product.id);
                $('[name="product"]').val(data.product.product_name);
                $('[name="description"]').val(data.product.product_desc);
                $('[name="cost"]').val(data.product.product_price);
                $('[name="quantity"]').val(data.product.product_quantity);
                $('.title-text').text('Edit'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
});
</script>
