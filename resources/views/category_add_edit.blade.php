<h1 class="page-title"> Add Category
    <small>Add Your Category Here</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('/')}}/#/dashboard">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{url('/')}}/#/category">Categories</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Add Category</span>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<form method="post" class="addCategory">
<div class="row">
    <div class="col-md-2">
            <div style="padding-left:10px">
                <h4>Category Information</h4>
                <h5>Add the category information</h5>
            </div>
    </div>
    <div class="col-md-10">
        <div class="portlet light ">
            <div>
                <div class="form-body">
                    <input type="hidden" value="" name="id">
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" placeholder="Category Name" name="category">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" placeholder="Category Description" name="description"></textarea>
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

<script type="text/javascript">
$(document).ready(function() {

    $("#save").click(function()
    {
        var url1 = site_url + 'api/add_category';
        var form_data = $('.addCategory').serialize();

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
                }
                else{
                    alertify.success(res.message);
                    setTimeout(function(){
                        window.location.href = site_url + "#/category";
                    }, 1000);
                    return false;
                }
            },
            error: function (res)
            {

            }
        });
    });

    var pathname = window.location.href;
    var lastItem = pathname.split("/").pop(1);
    var token = "{{ csrf_token() }}";
    if(lastItem)
    {
        var url2 = site_url + 'api/edit_category/' + lastItem;

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
                $('[name="id"]').val(data.category.id);
                $('[name="category"]').val(data.category.category);
                $('[name="description"]').val(data.category.description);
                $('.title-text').text('Edit'); // Set title to Bootstrap modal title
            }
        });
    }
});
</script>
