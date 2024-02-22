<div class="p-2 px-3">
    <div style="display: flex; justify-content: center; align-items: center;">
        <div
            style="border-radius: 5px; width: 100%; height: 200px; display: flex; justify-content: space-between; flex-direction: column; background-image: url({{asset('img/card.d49cd7cf12be322a95cb.png')}}); background-position: center center; background-repeat: no-repeat; background-size: cover;">
            <div class="card-head-img p-1">
                <div>
                    <div class="m-1" style="width: 70px" ><img src="https://www.mbbank.com.vn/images/logo.png" alt="img"
                                                                     class="ant-image-img"></div>
                </div>
            </div>
            <div style="padding: 10px; justify-content: flex-start; min-width: 100%;">
                <div class="atm-card-information font-semi-bold">
                    <span class="text-white d-block">{{$wallet['account_bank']}}</span>
                    <span class="text-white d-block">{{$wallet['account_name']}}</span></div>
            </div>
        </div>
    </div>

</div>
