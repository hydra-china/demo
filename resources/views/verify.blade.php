@extends("layouts.app")
@section("content")
    <form action="{{url('verify')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div id="tab-1">
            <div class="bg-mb text-white fw-bolder p-1">
                <h3 class="my-2 text-center text-uppercase">Xác minh hồ sơ</h3>
            </div>
            <div class="p-2 font-semi-bold text-mb h5 mt-1">Định danh eKYC</div>
            <div class="px-2">
                <label for="basic-url" class="form-label font-semi-bold">Ảnh mặt trước CMT/CCCD</label>
                <div class="mb-3">
                    <input class="form-control" name="front-card" type="file" id="formFile">
                </div>
            </div>
            <div class="px-2">
                <label for="basic-url" class="form-label font-semi-bold">Ảnh mặt sau CMT/CCCD</label>
                <div class="mb-3">
                    <input class="form-control" name="back-card" type="file" id="formFile">
                </div>
            </div>
            <div class="px-2">
                <label for="basic-url" class="form-label font-semi-bold">Ảnh chụp chân dung</label>
                <div class="mb-3">
                    <input class="form-control" name="verify-photo" type="file" id="formFile">
                </div>
            </div>
            <button class="btn bg-mb text-white" onclick="changeToTab2()" type="button">Tiếp tục</button>
        </div>

        <div id="tab-2" class="d-none">
            <div class="bg-mb text-white fw-bolder p-1">
                <h3 class="my-2 text-center text-uppercase">Xác minh hồ sơ</h3>
            </div>
            <div class="p-2 font-semi-bold text-mb h5 text-center">Thông tin cá nhân</div>
            <div class="px-2">
                <div class="mb-3">
                    <label for="name" class="form-label">Họ và tên</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nguyễn văn A">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Số CMT/CCCD</label>
                    <input type="number" name="uuid" class="form-control" id="name" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Ngày tháng năm sinh</label>
                    <input type="text" name="birthday" class="form-control" id="name" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nghề nghiệp</label>
                    <input type="text" name="job" class="form-control" id="name" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Thu nhập hàng tháng</label>
                    <select name="salary" class="form-select" aria-label="Chọn thu nhập hàng tháng">
                        <option value="1">Dưới 5 triệu</option>
                        <option value="2">Từ 5 - 10 triệu</option>
                        <option value="3">Từ 10 - 20 triệu</option>
                        <option value="3">Trên 20 triệu</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Mục đích vay </label>
                    <input type="text" name="in_order_to" class="form-control" id="name" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Địa chỉ </label>
                    <input type="text" name="address" class="form-control" id="name" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">SĐT người thân </label>
                    <input type="text" name="alt_phone" class="form-control" id="name" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Mối quan hệ với chủ khoản vay </label>
                    <input type="text" name="alt_relation" class="form-control" id="name" placeholder="">
                </div>
            </div>
            <button class="btn bg-mb text-white" onclick="changeToTab3()" type="button">Tiếp tục</button>
        </div>

        <div id="tab-3" class="d-none">
            <div class="bg-mb text-white fw-bolder p-1">
                <h3 class="my-2 text-center text-uppercase">Xác minh hồ sơ</h3>
            </div>
            <div class="p-2 font-semi-bold text-mb h5 mt-1">Thông tin ví liên kết</div>
            <div class="px-2">
                <div class="mb-3">
                    <label for="name" class="form-label">Số tài khoản </label>
                    <input type="text" name="bank_account" class="form-control" id="name" placeholder="" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Tên chủ tài khoản </label>
                    <input type="text" name="account_name" class="form-control" id="name" placeholder="" required>
                </div>
                <div class="mb-3">
                    <label for="imageSelect" class="form-label">Chọn ngân hàng thụ hưởng</label>
                    <select name="bank_name" id="imageSelect" class="form-control p-2">
                        @foreach(bankOptionsWithIcon() as $code => $label)
                            <option value="{{$code}}" data-image="{{$label['image']}}"><img
                                        src="{{$label['image']}}"> {{$label['label']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="px-2">
                <button class="btn bg-mb text-white d-block w-100 p-2">Gửi thông tin</button>
            </div>
        </div>
    </form>
@endsection
@push("after_scripts")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            display: flex;
            align-items: center;
        }


        img {
            width: 40px;
            height: auto;
            margin-right: 5px;
        }
    </style>
    <script>
        function changeToTab2() {
            const front = $("input[name=front-card]").val()
            const back = $("input[name=back-card]").val()
            const body = $("input[name=verify-photo]").val()

            if (!front || !back || !body) {
                alert('Vui lòng cập nhật đủ')
            } else {
                $("#tab-1").hide()
                $("#tab-2").removeClass("d-none")
            }
        }

        function changeToTab3() {
            let next = true
            const name = $("input[name=name]").val()
            const uuid = $("input[name=uuid]").val()
            const birthday = $("input[name=birthday]").val()
            const job = $("input[name=job]").val()
            const salary = $("select[name=salary]").val()
            const in_order_to = $("input[name=in_order_to]").val()
            const address = $("input[name=address]").val()
            const alt_phone = $("input[name=alt_phone]").val()
            const alt_relation = $("input[name=alt_relation]").val()

            if (!name) {
                next = false
                $("input[name=name]").addClass('border-danger border')
                $("input[name=name]").attr('placeholder', 'Vui lòng điền đầy đủ họ và tên')
            }

            if (!uuid) {
                next = false
                $("input[name=uuid]").addClass('border-danger border')
                $("input[name=uuid]").attr('placeholder', 'Vui lòng điền CMT / CCCD')
            }

            if (!birthday) {
                next = false
                $("input[name=birthday]").addClass('border-danger border')
                $("input[name=birthday]").attr('placeholder', 'Vui lòng điền ngày sinh')
            }

            if (!job) {
                next = false
                $("input[name=job]").addClass('border-danger border')
                $("input[name=job]").attr('placeholder', 'Vui lòng điền công việc hiện tại')
            }

            if (!salary) {
                next = false
                $("select[name=salary]").addClass('border-danger border')
                $("select[name=salary]").attr('placeholder', 'Vui lòng chọn thu nhập')
            }

            if (!in_order_to) {
                next = false
                $("input[name=in_order_to]").addClass('border-danger border')
                $("input[name=in_order_to]").attr('placeholder', 'Vui lòng điền mục đích vay')
            }

            if (!address) {
                next = false
                $("input[name=address]").addClass('border-danger border')
                $("input[name=address]").attr('placeholder', 'Vui lòng điền địa chỉ')
            }

            if (!alt_phone) {
                next = false
                $("input[name=alt_phone]").addClass('border-danger border')
                $("input[name=alt_phone]").attr('placeholder', 'Vui lòng điền SĐT người thân')
            }

            if (!alt_relation) {
                next = false
                $("input[name=alt_relation]").addClass('border-danger border')
                $("input[name=alt_relation]").attr('placeholder', 'Vui lòng điền mối quan hệ với chủ khoản vay')
            }

            if (next) {
                $("#tab-2").hide()
                $("#tab-3").removeClass('d-none')
            }
        }


        $(document).ready(function () {
            $(document).ready(function() {
                $('#imageSelect').select2({
                    templateResult: formatState,
                    templateSelection: formatState
                });

                function formatState (state) {
                    console.log(state)
                    if (!state.id) { return state.text; }
                    return $(
                        '<span><img src="' + state.element.dataset.image + '" class="img-flag" /> ' + state.text + '</span>'
                    );
                };
            });
        })
    </script>
@endpush
