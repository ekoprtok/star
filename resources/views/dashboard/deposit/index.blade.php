@extends('layouts.dashboard')

@section('content')
<div class="container-xl wide-lg">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Deposit Request</h3>
             </div>
          </div>
       </div>
       <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <form method="post" id="form">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Date</label>
                            <div class="form-control-wrap">
                                <span class="form-control">{{ date('d F Y') }}</span>
                                <input type="hidden" name="file_path">
                                <input type="hidden" name="user_id" value={{ Helper::encrypt(Auth::user()->id) }}>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="form-label">Amount*</label>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control" name="amount">
                                <span class="text-danger amount_err"></span>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Please Upload a Pictire</label>
                                <div class="form-control-wrap">
                                    <div class="upload-zone">
                                        <div class="dz-message" data-dz-message>
                                            <span class="dz-message-text">Drag and drop file</span>
                                            <span class="dz-message-or">or</span>
                                            <button class="btn btn-primary">SELECT</button>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-danger file_path_err"></span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                        <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
         </div>
       </div>
    </div>
 </div>
@endsection

@push('script')
<script>

    $("#form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('deposit.process') }}",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "jSON",
            error: function(request, status, error) {
                showResponseHeader(request);
            },
            success: function(r) {
                NioApp.Toast(r.message, (r.success ? "success" : "error"), {
                    position: "top-right"
                });

                if (r.success) {
                    setTimeout(() => {
                        location.href = "{{ route('dashboard') }}";
                    }, 1000);
                }
            }
        })
    });

    NioApp.Dropzone.init = function () {
        NioApp.Dropzone('.upload-zone', {
            url           : '{{ route('deposit.uploadImage') }}',
            maxFiles      : 1,
            acceptedFiles : 'image/png,image/jpg',
            autoDiscover  : true,
            sending: function(file, xhr, formData) {
                // formData.append("invoice", $('input[name="invoice"]').val());
            },
            headers       : {
                Authorization : 'Bearer {{ Auth::user()->web_token }}'
            },
            accept : function(file, done) {
                done();
            },
            init : function() {
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            success: function(file, response) {
                NioApp.Toast(response.message, (response.success ? 'success' : 'error'), {
                    position: 'top-right'
                });
                if (response.success) {
                    $('input[name="file_path"]').val(response.data);
                }
            }
        });
    }
</script>
@endpush
