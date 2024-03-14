@php

    $oldData = session('data') ?? ['months' => 0,'amount' => null,'payments' => []];
    $firstPayment = empty($oldData['payments']) ? 0 : $oldData['payments'][0]['amount']
@endphp

@extends("layouts.app")
@section('content')

    <form action="{{url('/vay')}}" method="post">
        @csrf
        <div class="bg-mb text-white fw-bolder p-1">
            <h3 class="my-2 text-center text-uppercase">Chọn khoản vay</h3>
        </div>
        @error('amount')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('months')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="p-2 mt-2">
            <label for="basic-url" class="form-label font-semi-bold">Số tiền cần vay</label>
            <div class="input-group">
                <input onkeyup="calculateFirstPayment()" placeholder="Nhập số tiền cần vay" name="amount" type="number"
                       class="form-control"
                       id="amount"
                       value="{{$oldData ? $oldData['amount']:null}}"
                       aria-describedby="basic-addon3 basic-addon4">
                <span class="input-group-text" id="basic-addon3">đ</span>
            </div>
            <div class="form-text" id="basic-addon4">Từ 20.000.000 VND - Đến 1.000.000.000 VND</div>
        </div>

        <div class="p-2">
            <label for="basic-url" class="form-label font-semi-bold">Thời hạn vay</label>
            <div>
                <select onchange="calculateFirstPayment()" id="months" class="form-select" name="months"
                        aria-label="Default select example">
                    <option disabled>Chọn thời hạn vay</option>
                    <option value="6" {{$oldData['months'] == 6 ? 'active': null}}>6 tháng</option>
                    <option value="12" {{$oldData['months'] == 12 ? 'active': null}}>12 tháng</option>
                    <option value="24" {{$oldData['months'] == 24 ? 'active': null}}>24 tháng</option>
                    <option value="36" {{$oldData['months'] == 36 ? 'active': null}}>36 tháng</option>
                    <option value="48" {{$oldData['months'] == 48 ? 'active': null}}>48 tháng</option>
                    <option value="60" {{$oldData['months'] == 60 ? 'active': null}}>60 tháng</option>
                </select>
            </div>
        </div>

        <div class="p-2">
            <div>Hình thức thanh toán: Trả góp hàng tháng</div>
            <div>Lãi suất hàng tháng: 1 %</div>
            <div>
                Trả nợ kỳ đầu: <b class="text-success" id="first-payment">{{number_format($firstPayment)}} đ</b>
            </div>
            <div class="my-2 font-semi-bold text-mb"><a onclick="calculatePayment()">Chi tiết thanh toán</a></div>
        </div>

        <div class="px-2">
            <button type="submit" class="btn bg-mb text-white d-block w-100 p-2">Đăng ký khoản vay</button>
        </div>
    </form>
    @if(! empty($oldData['payments']))
        <div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chi tiết thanh toán khoản vay</h5>
                        <button onclick="hideModal()" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="p-1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Đợt</th>
                                    <th scope="col">Ngày</th>
                                    <th scope="col">Số tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oldData['payments'] as $key => $payment)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$payment['date']}}</td>
                                        <td>{{number_format($payment['amount'])}} đ</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script>
        @if($oldData)
        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
        document.onreadystatechange = function () {
            myModal.show();
        };
        @endif

        function hideModal() {
            document.getElementById('exampleModal').style.display = 'none'
            document.getElementsByClassName('modal-backdrop')[0].style.display = 'none'
        }

        function calculatePayment() {
            const amount = document.getElementById('amount').value
            const months = document.getElementById('months').value

            if (!parseInt(months)) {
                alert('Thời gian không hợp lệ')
                return
            }

            if (!parseInt(amount)) {
                alert('Số tiền không hợp lệ')
                return
            }

            const url = '{{url('/vay/calculate')}}/amount/' + amount + '/months/' + months

            window.location.replace(url)
        }

        function calculateFirstPayment() {
            const amount = document.getElementById('amount').value
            const months = document.getElementById('months').value

            const firstPayment = (parseInt(amount) * 1.01) / parseInt(months)

            document.getElementById('first-payment').innerText = firstPayment.toLocaleString() + " đ"
        }

    </script>
@endsection


{{--<div class="input-group mb-3">--}}
{{--    <span class="input-group-text" id="basic-addon1">@</span>--}}
{{--    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">--}}
{{--</div>--}}

{{--<div class="input-group mb-3">--}}
{{--    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">--}}
{{--    <span class="input-group-text" id="basic-addon2">@example.com</span>--}}
{{--</div>--}}


{{--<div class="input-group mb-3">--}}
{{--    <span class="input-group-text">$</span>--}}
{{--    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">--}}
{{--    <span class="input-group-text">.00</span>--}}
{{--</div>--}}

{{--<div class="input-group mb-3">--}}
{{--    <input type="text" class="form-control" placeholder="Username" aria-label="Username">--}}
{{--    <span class="input-group-text">@</span>--}}
{{--    <input type="text" class="form-control" placeholder="Server" aria-label="Server">--}}
{{--</div>--}}

{{--<div class="input-group">--}}
{{--    <span class="input-group-text">With textarea</span>--}}
{{--    <textarea class="form-control" aria-label="With textarea"></textarea>--}}
{{--</div>--}}
