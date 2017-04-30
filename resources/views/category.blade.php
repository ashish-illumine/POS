<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Categories
    <small>Manage All of Your Categories Here</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="#/dashboard">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Categories</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">
                        <i class="icon-user"></i> New User </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-present"></i> New Event
                        <span class="badge badge-success">4</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-basket"></i> New order </a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="#">
                        <i class="icon-flag"></i> Pending Orders
                        <span class="badge badge-danger">4</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-users"></i> Pending Users
                        <span class="badge badge-warning">12</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN MAIN CONTENT -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="#/add_category" id="sample_editable_1_new" class="btn sbold green"> Add New
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group pull-right">
                                <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-print"></i> Print </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                        <tr>
                            <th width="1%"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>
                            <th> Category </th>
                            <th> Description </th>
                            <th width="15%"> -- </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- END MAIN CONTENT -->
<!-- BEGIN MAIN JS -->
<script>
    TableDatatablesManaged.init();
    $('#sample_1').dataTable().fnDestroy();

    $(document).ready(function() {
        /* Datatable for categories */
        var url = site_url + 'api/category';
        $('#sample_1').DataTable( {
            "ajax": {
              "url": url,
              "dataSrc": "categories",
           },
           "columns": [
             {"render": function (data, type, full, meta) { return '<input type="checkbox" class="checkboxes" value="1" />'; } },
             {"data": "category"},
             {"data": "description"},
             {"render": function (data, type, full, meta)
                {
                    return '<a href="'+ site_url +'#/edit_category/'+ full.id +'" class="btn blue btn-sm">Edit</a><a href="" id="'+ full.id +'" class="btn red btn-sm delete">Delete</a>';
                }
             },
            ]
        });

        var token = "{{ csrf_token() }}"; // csrf fot post data

        /* Delete categories */
        $('.table').on('click', '.delete', function()
        {
            if(confirm('Are you sure delete this data?'))
            {
                // ajax delete data to database
                $.ajax({
                    url : site_url + "api/delete_category",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        id: this.id,
                        _token: token,
                    },
                    success: function(data)
                    {
                        alertify.success(data.message);
                        $('#sample_1').dataTable()._fnAjaxUpdate();
                        // $("#sample_1").dataTable().fnDraw();
                        return false;
                    }
                });
            }
        });
    });

    /* Edit categories */
    function edit(id)
    {
        save_method = 'update';
        $.ajax({
            url : site_url + "edit_category",
            type: "POST",
            dataType: "JSON",
            data: {
                id:id,
                _token: token,
            },
            success: function(data)
            {
                $('[name="id"]').val(data.id);
                $('[name="category"]').val(data.category);
                $('[name="description"]').val(data.description);
                $('#large').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Category'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
</script>
<!-- END MAIN JS -->
