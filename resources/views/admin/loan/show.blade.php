@php
    use App\Models\Loan;
    use App\Models\Profile; @endphp
@php
    /**
     * @var Loan $loan
    * @var Profile $profile
     */
@endphp


<div id="show-tab">
    @include("admin.loan.show-tab",[
        'profile' => $profile,
        'loan' => $loan
    ])
</div>


<div id="edit-tab" class="d-none p-3">
    <form action="{{url('admin/all/update/'.$loan->id)}}" id="edit-form" enctype="multipart/form-data" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Họ và tên: </label>
                    <input id="profile[name]" class="form-control col-md-6" name="profile[name]"
                           value="{{$profile->name}}" type="text">
                </div>

                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Số CMT/CCCD: </label>
                    <input class="form-control col-md-6" name="profile[uuid]" value="{{$profile->uuid}}" type="text">
                </div>

                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Ngày tháng năm sinh: </label>
                    <input class="form-control col-md-6" name="profile[birthday]" value="{{$profile->birthday}}"
                           type="text">
                </div>

                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Địa chỉ: </label>
                    <input class="form-control col-md-6" name="profile[address]" value="{{$profile->address}}"
                           type="text">
                </div>
                <div class="border-top mb-3"></div>
                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Nghề nghiệp: </label>
                    <input class="form-control col-md-6" name="profile[job]" value="{{$profile->job}}" type="text">
                </div>

                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Thu nhập hàng tháng: </label>
                    <select class="form-control col-md-6" name="profile[salary]" value="{{$profile->salary}}"
                            type="text">
                        @foreach(Profile::salaryOptions() as $key => $option)
                            <option value="{{$key}}" @if($key == $profile->salary) @endif>{{$option}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Mục đích vay: </label>
                    <input class="form-control col-md-6" name="profile[in_order_to]" value="{{$profile->in_order_to}}"
                           type="text">
                </div>

                <div class="border-top mb-3"></div>
                <div class="mb-3 row">
                    <label class="text-primary col-md-6">SĐT người thân: </label>
                    <input class="form-control col-md-6" name="profile[alt_phone]" value="{{$profile->alt_phone}}"
                           type="text">
                </div>

                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Mối quan hệ với chủ khoản vay: </label>
                    <input class="form-control col-md-6" name="profile[alt_relation]" value="{{$profile->alt_relation}}"
                           type="text">
                </div>

                <div class="border-top mb-3"></div>
                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Số tài khoản: </label>
                    <input class="form-control col-md-6" name="profile[bank_account]" value="{{$profile->bank_account}}"
                           type="text">
                </div>

                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Chủ tài khoản: </label>
                    <input class="form-control col-md-6" name="profile[account_name]" value="{{$profile->account_name}}"
                           type="text">
                </div>

                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Ngân hàng: </label>
                    <select class="form-control col-md-6" name="profile[bank_name]" value="{{$profile->job}}"
                            type="text">
                        @foreach(bankOptions() as $code => $label)
                            <option value="{{$code}}"
                                    @if($code == $profile->bank_name) checked @endif > {{$label}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Số tiền vay: </label>
                    <input class="form-control col-md-6" name="loan[amount]" value="{{$loan->amount}}" type="text">
                </div>

                <div class="mb-3 row">
                    <label class="text-primary col-md-6">Ngân hàng: </label>
                    <select class="form-control col-md-6" name="loan[month]" type="text">
                        <option disabled>Chọn thời hạn vay</option>
                        <option value="6" {{$loan->amount == 6 ? 'selected': null}}>6 tháng</option>
                        <option value="12" {{$loan->amount == 12 ? 'selected': null}}>12 tháng</option>
                        <option value="24" {{$loan->amount == 24 ? 'selected': null}}>24 tháng</option>
                        <option value="36" {{$loan->amount == 36 ? 'selected': null}}>36 tháng</option>
                        <option value="48" {{$loan->amount == 48 ? 'selected': null}}>48 tháng</option>
                        <option value="60" {{$loan->amount == 60 ? 'selected': null}}>60 tháng</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">CCCD Mặt trước</div>
                        <div class="mb-3"><img src="{{$profile->getFrontCardImageUrl()}}" style="max-width: 200px">
                        </div>
                        <div class="mb-3">
                            <input class="form-control-file" type="file" name="profile[front-card]">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">CCCD Mặt sau</div>
                        <div class="mb-3"><img src="{{$profile->getBackCardImageUrl()}}" style="max-width: 200px"></div>
                        <div class="mb-3">
                            <input class="form-control-file" type="file" name="profile[back-card]">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">Chân dung</div>
                        <div class="mb-3"><img src="{{$profile->getSelfieImageUrl()}}" style="max-width: 200px"></div>
                        <div class="mb-3">
                            <input class="form-control-file" type="file" name="profile[verify-photo]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">Chữ ký</div>
                        <div class="mb-3"><img src="{{$loan->getSignature()}}" style="max-width: 200px"></div>
                        <div class="mb-3">
                            <input class="form-control-file" type="file" name="loan[signature]">
                        </div>
                    </div>
                </div>
                <button type="button" id="cancel" class="btn btn-success">Hủy</button>
                <button class="btn btn-success" type="submit">Cập nhật</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $("#edit-profile-btn").click(function (e) {
            $("#show-tab").hide()
            $("#edit-tab").removeClass("d-none")
        })

        $("#cancel").click(function (e) {
            $("#show-tab").show()
            $("#edit-tab").addClass("d-none")
        })
    })
</script>
<script>
    $(document).ready(function () {
        $("#edit-form").submit(function (event) {
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "{{ url('admin/all/update/'.$loan->id) }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    // Xử lý kết quả thành công ở đây
                    console.log("Server Response:", data);
                    $("#show-tab").html(data)
                    $("#show-tab").show()
                    $("#edit-tab").addClass("d-none")
                },
                error: function (error) {
                    // Xử lý lỗi ở đây
                    console.error("Error:", error.responseText);
                }
            });
        });
    });
</script>

