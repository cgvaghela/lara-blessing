@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: {!!'Active Prayer Request List'!!}
@stop
@section('styles')

@stop
{{-- Content --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Category header) -->
    <section class="content-header">
        <h1>Active Prayer Request List</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <!-- Notifications -->
                @include('admin.includes.notifications')
                <!-- ./ notifications -->
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="category_list" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First/Last/Email</th>
                                    <th>Prayer Request</th>
                                    <th>IP</th>
                                    <th>Posted</th>
                                    <th># Prayers</th>
                                    <th>-</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> <!-- /. box body -->
                </div> <!-- /.box -->
            </div> <!-- /.col-xs-12 -->
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop
{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
    var oTable;
    $(document).ready(function () {
        $('#category_list').DataTable({    
            "ajax" : {
                "url" : "{!! URL::to('admin/active/ActiveData') !!}",
                "type" : "PATCH",
                "data" : {
                    "list" : "list"
                }
            },
            "columns" : [{
                "data" : "id"
            },{
                "data" : "info"
            },{
                "data" : "request"
            },{
                "data" : "ip"
            },{
                "data" : "date"
            },{
                "data" : "prayes"
            },{
                "data" : "action"
            }], 
        });

        /*oTable = $('#category_list').dataTable({
            "dom": "<'row no-gutters'<'col-md-4 no-padding'l><'col-md-4'r><'col-md-4 no-padding'f>>t<'row no-gutters'<'col-md-4 no-padding'i><'col-md-4'><'col-md-4 no-padding'p>>",
            "processing": true,
            "serverSide": true,
            "ajax": "{!! URL::to('admin/active/ActiveData') !!}",
            "columnDefs": [
                {"orderable": false, "targets": [0,1,2,3]},
            ],
            "order": [[0, "asc"]]
        });*/

        $("#category_list").on('click', '.delete-btn', function () {
            var id = $(this).attr('id');
            var r = confirm("Are you sure to delete this category?");
            if (!r) {
                return false
            }
            $.ajax({
                type: "POST",
                url: "category/" + id,
                data: {
                    _method: 'DELETE',
                    _token: "{!! csrf_token() !!}"
                },
                dataType: 'json',
                beforeSend: function () {
                    $(this).attr('disabled', true);
                    $('.alert .msg-content').html('');
                    $('.alert').hide();
                },
                success: function (resp) {
                    $('.alert:not(".session-box")').show();
                    if (resp.success) {
                        $('.alert-success .msg-content').html(resp.message);
                        $('.alert-success').removeClass('hide');
                    } else {
                        $('.alert-danger .msg-content').html(resp.message);
                        $('.alert-danger').removeClass('hide');
                    }
                    $(this).attr('disabled', false);
                    oTable.fnDraw();
                },
                error: function (e) {
                    alert('Error: ' + e);
                }
            });
        });

        $("#category_list").on('click', '.status-btn', function () {
            var id = $(this).attr('id');
            var r = confirm("Are you sure to change status?");
            if (!r) {
                return false
            }
            $.ajax({
                type: "POST",
                url: "{!! URL::to('admin/category/changeStatus') !!}",
                data: {
                    id: id,
                    _token: "{!! csrf_token() !!}"
                },
                dataType: 'json',
                beforeSend: function () {
                    $(this).attr('disabled', true);
                    $('.alert .msg-content').html('');
                    $('.alert').hide();
                },
                success: function (resp) {
                    $('.alert:not(".session-box")').show();
                    if (resp.success) {
                        $('.alert-success .msg-content').html(resp.message);
                        $('.alert-success').removeClass('hide');
                    } else {
                        $('.alert-danger .msg-content').html(resp.message);
                        $('.alert-danger').removeClass('hide');
                    }
                    $(this).attr('disabled', false);
                    oTable.fnDraw();
                },
                error: function (e) {
                    alert('Error: ' + e);
                }
            });
        });
    });
</script>
@stop