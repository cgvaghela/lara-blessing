@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: {!! 'Metadata List' !!}
@stop
@section('styles')

@stop
{{-- Content --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Metadata List</h1>
        <ol class="breadcrumb">
            <li><a href="{!! URL::to('admin/metadata/create') !!}"><i class="fa fa-plus-square"></i> Add Metadata</a></li>
        </ol>
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
                        <table id="metadata_list" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Url</th>
                                    <th>Title</th>
                                    <th width="10%">Actions</th>
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
    $(document).ready(function() {
        oTable = $('#metadata_list').dataTable({
            "dom": "<'row no-gutters'<'col-md-4'l><'col-md-4'r><'col-md-4'f>>t<'row no-gutters'<'col-md-4'i><'col-md-4'><'col-md-4'p>>",
            "processing": true,
            "serverSide": true,
            "ajax": "{!! URL::to('admin/metadata/getMetadataData') !!}",
            "columnDefs": [
                {"orderable": false, "targets": [1,2]},
            ],
            "order": [[0, "desc"]]
        });

        $("#metadata_list").on('click', '.delete-btn', function() {
            var id = $(this).attr('id');
            var r = confirm("Are you sure to delete this Metadata?");
            if (!r) {
                return false
            }
            $.ajax({
                type: "POST",
                url: "metadata/" + id,
                data: {
                    _method: 'DELETE',
                    _token:"{!! csrf_token() !!}"
                },
                dataType: 'json',
                beforeSend: function() {
                    $(this).attr('disabled', true);
                    $('.alert .msg-content').html('');
                    $('.alert').hide();
                },
                success: function(resp) {
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
                error: function(e) {
                    alert('Error: ' + e);
                }
            });
        });

    });
</script>
@stop