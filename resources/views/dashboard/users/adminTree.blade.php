@extends('layouts.dashboard')

@push('style')
<link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
@endpush

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Team Tree</h3>
             </div>
          </div>
       </div>
       <div class="nk-block">
            <div class="card card-bordered card-preview" style="padding:5px">
                <ul id="tt" class="easyui-tree" ></ul>
            </div>
        </div>
    </div>
 </div>
@endsection

@push('script')
<script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
<script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
<script>
    $('#tt').tree({
        url:'{{ route('request.admin.tree', ['parent_id' => '-']) }}',
        method:'post',
        lines:true,
        formatter:function(node){
            var s = node.text;
            if (node.children?.length > 0){
                s += ` (${node.children.length}) <a class="text-info" href="${node.link}" target="_blank">Detail</a>`;
            }else {
                s += ` <a class="text-info" href="${node.link}" target="_blank">Detail</a>`;
            }
            return s;
        }
    });
</script>
@endpush
