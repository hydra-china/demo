@extends("layouts.app")
@section("content")
    <form action="{{url('verify')}}" method="post" enctype="multipart/form-data">
        @csrf
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

        <div class="p-2 font-semi-bold text-mb h5">Thông tin cá nhân</div>
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
                <input type="date" name="birthday" class="form-control" id="name" placeholder="">
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
        <div class="p-2 font-semi-bold text-mb h5 mt-1">Thông tin ví liên kết</div>
        <div class="px-2">
            <div class="mb-3">
                <label for="name" class="form-label">Số tài khoản </label>
                <input type="text" name="bank_account" class="form-control" id="name" placeholder="">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Tên chủ tài khoản </label>
                <input type="text" name="account_name" class="form-control" id="name" placeholder="">
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Chọn ngân hàng thụ hưởng</label>
                <select name="bank_name" class="form-select" aria-label="Chọn ngân hàng">
                    @foreach(bankOptions() as $code => $label)
                        <option value="{{$code}}"> {{$label}}</option>
                    @endforeach
               </select>
           </div>
       </div>
       <div class="px-2">
           <button class="btn bg-mb text-white d-block w-100 p-2">Gửi thông tin</button>
       </div>
   </form>
@endsection
