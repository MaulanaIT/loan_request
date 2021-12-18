@extends('layout.layout')

@section('style')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('main')
<div id="popup-daily-limit" class="background-popup d-none">
    <div class="overlay-popup">
        <div class="bg-white card-form p-4 text-center">
            <p>Sorry, daily requests have reached the maximum number (50).<br />Please come back tomorrow.</p>
        </div>
    </div>
</div>
<div id="popup-result" class="background-popup d-none">
    <div class="overlay-popup">
        <div class="bg-white card-form p-4 text-center">
            <p id="title-result">Error!</p>
            <p id="text-result">Sorry, daily requests have reached the maximum number (50).<br />Please come back tomorrow</p>
            <button class="btn btn-success mt-4 px-5" onclick="document.getElementById('popup-result').classList.add('d-none');">OK</button>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center p-lg-5 p-md-4 p-3">
    <form class="card-form col-lg-6 col-md-8 col-12" action="/loan/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="header">
            <p>Loan Application Request</p>
        </div>
        <div class="title-content">
            <p>I. Your Information</p>
        </div>
        <div class="content">
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="input-ktp" class="col-12 col-md-2 col-form-label">No. KTP <span class="text-danger">*</span></label>
                <div class="col-12 col-md-4">
                    <input type="text" id="input-ktp" name="input-ktp" class="form-control" oninput="inputNumber(event)" maxlength="16" placeholder="0000000000000000" required>
                </div>
            </div>
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="input-full-name" class="col-12 col-md-2 col-form-label">Full Name <span class="text-danger">*</span></label>
                <div class="col-12 col-md-10">
                    <input type="text" id="input-full-name" name="input-full-name" class="form-control" maxlength="50" placeholder="Your Name" required>
                </div>
            </div>
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="input-gender" class="col-12 col-md-2 col-form-label">Gender <span class="text-danger">*</span></label>
                <div class="col-12 col-md-4">
                    <select name="select-gender" id="select-gender" class="form-select" required>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="input-date-of-birth" class="col-12 col-md-2 col-form-label">Date of Birth <span class="text-danger">*</span></label>
                <div class="col-12 col-md-4">
                    <input type="date" id="input-date-of-birth" name="input-date-of-birth" class="form-control" required>
                    <p class="note-input">Min Age : 17 &nbsp; Max Age : 80</p>
                </div>
            </div>
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="input-address" class="col-12 col-md-2 col-form-label">Address <span class="text-danger">*</span></label>
                <div class="col-12 col-md-10">
                    <textarea type="text" id="input-address" name="input-address" class="form-control" required></textarea>
                </div>
            </div>
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="select-province" class="col-12 col-md-2 col-form-label">Province <span class="text-danger">*</span></label>
                <div class="col-12 col-md-4">
                    @if (count($listProvince) > 0)
                    <select name="select-province" id="select-province" class="form-select" required>
                        @foreach ($listProvince as $data)
                        <option value="{{$data->name}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                    @else
                    <select name="select-province" id="select-province" class="form-select" disabled required>
                        <option value="">-- No Data --</option>
                    </select>
                    @endif
                </div>
            </div>
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="select-nationality" class="col-12 col-md-2 col-form-label">Nationality <span class="text-danger">*</span></label>
                <div class="col-12 col-md-4">
                    @if (count($listNationality) > 0)
                    <select name="select-nationality" id="select-nationality" class="form-select" required>
                        @foreach ($listNationality as $data)
                        <option value="{{$data->name}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                    @else
                    <select name="select-nationality" id="select-nationality" class="form-select" disabled required>
                        <option value="">-- No Data --</option>
                    </select>
                    @endif
                </div>
            </div>
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="input-email" class="col-12 col-md-2 col-form-label">Email <span class="text-danger">*</span></label>
                <div class="col-12 col-md-10">
                    <input type="email" id="input-email" name="input-email" class="form-control" maxlength="100" placeholder="example@gmail.com" required>
                </div>
            </div>
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="input-telephone" class="col-12 col-md-2 col-form-label">Telephone <span class="text-danger">*</span></label>
                <div class="col-12 col-md-4">
                    <input type="text" id="input-telephone" name="input-telephone" class="form-control" maxlength="13" oninput="inputNumber(event)" placeholder="000111222333" required>
                </div>
            </div>
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="input-image-ktp" class="col-12 col-md-2 col-form-label">Image KTP <span class="text-danger">*</span></label>
                <div class="col-12 col-md-10">
                    <input type="file" id="input-image-ktp" name="input-image-ktp" class="form-control" accept=".jpg, .png, .jpeg" required>
                    <p class="note-input">Format Image : .jpg, .jpeg, .png</p>
                </div>
            </div>
            <div class="d-flex flex-wrap px-0">
                <label for="input-image-selfie" class="col-12 col-md-2 col-form-label">Image Selfie <span class="text-danger">*</span></label>
                <div class="col-12 col-md-10">
                    <input type="file" id="input-image-selfie" name="input-image-selfie" class="form-control" accept=".jpg, .png, .jpeg" required>
                    <p class="note-input">Format Image : .jpg, .jpeg, .png</p>
                </div>
            </div>
        </div>
        <div class="title-content">
            <p>II. Loan Request</p>
        </div>
        <div class="content">
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="input-amount-of-loan" class="col-12 col-md-3 col-form-label">Amount of Loan <span class="text-danger">*</span></label>
                <div class="col-12 col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="text" id="input-amount-of-loan" name="input-amount-of-loan" class="form-control" onchange="inputLoan(event)" maxlength="8" value="1000000" required>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="select-tenor" class="col-12 col-md-3 col-form-label">Tenor <span class="text-danger">*</span></label>
                @if (count($listTenor) > 0)
                <div class="col-12 col-md-4">
                    <div class="input-group">
                        <select name="select-tenor" id="select-tenor" class="form-select text-center" onchange="calculatePaymentInstallment()" required>
                            @foreach ($listTenor as $data)
                            <option value="{{$data->tenor}}">{{$data->tenor}}</option>
                            @endforeach
                        </select>
                        <span class="input-group-text">Months</span>
                    </div>
                </div>
                @else
                <div class="col-12 col-md-4">
                    <select name="select-tenor" id="select-tenor" class="form-select" disabled required>
                        <option value="">-- No Data --</option>
                    </select>
                </div>
                @endif
            </div>
            <div class="d-flex flex-wrap pb-2 px-0">
                <label for="input-payment-installment" class="col-12 col-md-3 col-form-label">Payment Installment</label>
                <div class="col-12 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="text" id="input-payment-installment" name="input-payment-installment" class="form-control text-end" value="0" readonly>
                        <span class="input-group-text">/ Month</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-grid">
            <input type="submit" class="btn btn-request mb-2" value="Submit">
            <input type="reset" class="btn btn-danger" value="Clear">
        </div>
    </form>
</div>
@endsection

@section('script')
@if (Session::get('Failed'))
<script>
    document.getElementById('title-result').innerHTML = "Error!";
    document.getElementById('title-result').className = 'text-danger';

    document.getElementById('text-result').innerHTML = "{{Session::get('Failed')}}";
    
    document.getElementById('popup-result').classList.remove('d-none');
</script>
@elseif (Session::get('Success'))
<script>
    document.getElementById('title-result').innerHTML = "Success!";
    document.getElementById('title-result').className = 'text-success';

    document.getElementById('text-result').innerHTML = "{{Session::get('Success')}}";
    
    document.getElementById('popup-result').classList.remove('d-none');
</script>
@endif
<script>
    document.getElementById('input-date-of-birth').setAttribute('min', moment().subtract(80, 'year').toISOString().split('T')[0]);
    document.getElementById('input-date-of-birth').setAttribute('max', moment().subtract(17, 'year').toISOString().split('T')[0]);

    calculatePaymentInstallment();

    axios.get('/api/daily-loan-request').then(response => {
        if (response.data.length > 50) {
            document.getElementById('popup-daily-limit').classList.remove('d-none');
        }
    });

    function inputLoan(event) {
        inputNumber(event);

        if (event.target.value < 1000000) {
            document.getElementById(event.target.id).value = "1000000";
        }

        if (event.target.value > 10000000) {
            document.getElementById(event.target.id).value = "10000000";
        }

        calculatePaymentInstallment();
    }

    function calculatePaymentInstallment() {
        document.getElementById('input-payment-installment').value = parseFloat(parseInt(document.getElementById('input-amount-of-loan').value) / parseInt(document.getElementById('select-tenor').value)).toFixed(2);
    }
</script>
@endsection