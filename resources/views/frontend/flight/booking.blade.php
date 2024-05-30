@extends('layouts.master')
@section('title', 'Booking')
@section('content')


    <!-- Breadcrumbs S t a r t -->
    <section class="breadcrumbs-area breadcrumb-bg">
        <div class="container">
            <h1 class="title wow fadeInUp" data-wow-delay="0.0s">Booking</h1>
            <div class="breadcrumb-text">
                <nav aria-label="breadcrumb" class="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s">
                    <ul class="breadcrumb listing">
                        <li class="breadcrumb-item single-list"><a href="" class="single">Home</a></li>
                        <li class="breadcrumb-item single-list" aria-current="page">
                            <a href="javascript:void(0)" class="single active">Booking</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <!--/ End-of Breadcrumbs-->
    @php
        $trackid = $responseData['Trackid'];
        $flights = $responseData['AvailabilityResponse'];
        $fares = $responseData['AvailabilityResponse'][0]['Fares'][0];
    @endphp
    <section class="tour-list-section section-padding2">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-6 row">
                    <div class="border rounded p-3 col-12">
                        @foreach ($flights as $flight)
                            @foreach ($flight['Flights'] as $flights_details)
                                <ul id="menu">
                                    <li class="text-blue">{{ @$flights_details['Origin'] }}</li> <i
                                        class="ri-flight-takeoff-fill text-blue"></i>
                                    <li class="text-blue">{{ @$flights_details['Destination'] }}</li>
                                    <li class="date"> <i class="ri-calendar-close-line"></i>
                                        {{ @$flights_details['DepartureDateTime'] }}
                                    </li>
                                    <li class="left text-black">
                                        @if (@$flights_details['FareType'] == 'N')
                                            Normal
                                        @elseif (@$flights_details['FareType'] == 'C')
                                            Corporate
                                        @elseif (@$flights_details['FareType'] == 'R')
                                            Retail Fare
                                        @endif
                                    </li>
                                    <li class="float-end right"> <i class="ri-timer-line"></i>
                                        {{ convertToHoursAndMinutes(@$flights_details['FlyingTime']) }} </li>
                                </ul>

                                <div class="row border-top mt-3">
                                    <div class="col-sm-3 col-12 col-xs-12 mb-1">
                                        <div class="row">
                                            <div class="col-sm-12 col-6 col-xs-6">
                                                <div class="booking mt-3">
                                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS55v2g9kCAg8aXI9UpmTRcnwmgTCBd-Zd7GWWztPUopQ&s"
                                                        width="25%" alt="">
                                                    <p class="p-3">{{ $flights_details['FlightNumber'] }}</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-6 col-x-6 d-xs-block d-sm-none d-md-none d-lg-none">
                                                <span
                                                    class="float-left tx-11 tx-semibold tx-color-03 rounded white px-2 pd-2 bg_themeclr mb-1 flt-rightres"
                                                    onclick="">U</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-7 col-9 col-xs-9">
                                        <div class="row">
                                            <div class="col-sm-4 col-4 col-xs-4">
                                                <div class="timimg mt-3">
                                                    <div class="">
                                                        <p><b>{{ @$flights_details['Origin'] }}(T{{ @$flights_details['DepartureTerminal'] }})</b>
                                                        </p>
                                                    </div>
                                                    {{-- <div class="">18:35</div> --}}
                                                    <div class="">
                                                        <p><b>{{ @$flights_details['DepartureDateTime'] }}</b></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-4 col-xs-6">
                                                <div class="timimg mt-3">
                                                    <div class="">
                                                        <p><b>{{ @$flights_details['Stops'] == 0 ? 'Non stop' : @$flights_details['Stops'] . ' - Change' }}</b>
                                                        </p>
                                                    </div>
                                                    <div class="">
                                                        <hr class="arrow">
                                                    </div>
                                                    <div class=""> </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-4 col-xs-3">
                                                <div class="timimg mt-3">
                                                    <div class="">
                                                        <p><b>{{ @$flights_details['Destination'] }}(T{{ @$flights_details['ArrivalTerminal'] }})</b>
                                                        </p>
                                                    </div>
                                                    {{-- <div class="">19:45</div> --}}
                                                    <div class="">
                                                        <p><b>{{ @$flights_details['ArrivalDateTime'] }}</b></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 col-3 col-x-3">
                                        <div class="timimg mt-3">
                                            <div class=""><b>Type</b></div>
                                            <span class="float-right text-center">
                                                @if ($flights_details['Cabin'] == 'E')
                                                    Economy
                                                @elseif ($flights_details['Cabin'] == 'P')
                                                    Premium
                                                @elseif ($flights_details['Cabin'] == 'B')
                                                    Business
                                                @elseif ($flights_details['Cabin'] == 'F')
                                                    First
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>

                    <div class="border rounded mt-4 p-4 col-12">
                        <h5 class="float-start  w-100"> Passenger Details </h5>
                        <span class="float-end text-danger d-none right h6"> <i class="ri-profile-line"></i> Get Passenger
                        </span>
                        @if ($AdultCount != '0')
                            @for ($i = 1; $i <= $AdultCount; $i++)
                                <div class="row mt-5">
                                    <div class="col-md-12 mb-2"><span class="h5 fw-bold">Adult - {{ $i }}</span>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="inputState" class="form-select">
                                            <option selected>Mr.</option>
                                            <option>Ms.</option>
                                            <option>Mrs.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" id="firstName" placeholder="First Name"
                                            oninput="this.value = this.value.toUpperCase()"
                                            onkeypress="javascript: return ValidateAlpha(event)">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" id="lastName" placeholder="Last Name"
                                            oninput="this.value = this.value.toUpperCase()"
                                            onkeypress="javascript: return ValidateAlpha(event)">
                                    </div>
                                    <div class="col-3 mt-3">
                                        <input type="date" class="form-control" id="inputDate" placeholder="date">
                                    </div>
                                </div>
                            @endfor
                        @endif
                        @if ($ChildCount != '0')
                            @for ($i = 1; $i <= $ChildCount; $i++)
                                <div class="row mt-5">
                                    <div class="col-md-12 mb-2"><span class="h5 fw-bold">Child - {{ $i }}</span>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="inputState" class="form-select">
                                            <option selected>Mr.</option>
                                            <option>Ms.</option>
                                            <option>Mrs.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" id="firstName" placeholder="First Name"
                                            oninput="this.value = this.value.toUpperCase()"
                                            onkeypress="javascript: return ValidateAlpha(event)">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" id="lastName"
                                            placeholder="Last Name" oninput="this.value = this.value.toUpperCase()"
                                            onkeypress="javascript: return ValidateAlpha(event)">
                                    </div>
                                    <div class="col-3 mt-3">
                                        <input type="date" class="form-control" id="inputDate" placeholder="date">
                                    </div>
                                </div>
                            @endfor
                        @endif
                        @if ($InfantCount != '0')
                            @for ($i = 1; $i <= $InfantCount; $i++)
                                <div class="row mt-5">
                                    <div class="col-md-12 mb-2"><span class="h5 fw-bold">Infant -
                                            {{ $i }}</span>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="inputState" class="form-select">
                                            <option selected>Mr.</option>
                                            <option>Ms.</option>
                                            <option>Mrs.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" id="firstName"
                                            placeholder="First Name" oninput="this.value = this.value.toUpperCase()"
                                            onkeypress="javascript: return ValidateAlpha(event)">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" id="lastName"
                                            placeholder="Last Name" oninput="this.value = this.value.toUpperCase()"
                                            onkeypress="javascript: return ValidateAlpha(event)">
                                    </div>
                                    <div class="col-3 mt-3">
                                        <input type="date" class="form-control" id="inputDate" placeholder="date">
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>

                    <div class="border rounded mt-4 p-4 col-12">
                        <h5>Contact Information</h5>
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <select id="inputState" class="form-select">
                                    <option selected>+91</option>
                                    <option>+92</option>
                                    <option>+93</option>
                                    <option>+94</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input name="ContactNumber" id="txtContactNo" type="text" class="form-control"
                                    id="inputMobile" placeholder="Mobile Number"
                                    onkeypress="javascript: return isNumericVal(event)" maxlength="13">
                            </div>
                            <div class="col-md-5">
                                <input name="EmailID" id="txtEmailid" type="mail" class="form-control"
                                    id="inputMobile" placeholder="Emial Address"
                                    onkeypress="javascript: return ValidateEmailtxt(event)">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-0 ">
                        <div class="container mt-2">
                            <a href="#GST" class="add-gst h6" data-bs-toggle="collapse">
                                <i class="ri-mail-check-line"></i> Add GST Details
                            </a>
                            <div id="GST" class="collapse">
                                <div class="mt-3 mb-4 card p-2">
                                    <div class="row">
                                        <div class="col-md-2  p-2">
                                            <input type="text" name="GSTNumber" class="form-control" id="Gst_No"
                                                placeholder="GST">
                                        </div>
                                        <div class="col-md-2 p-2">
                                            <input type="text" name="GSTCompanyName" id="Gst_Company"
                                                class="form-control" placeholder="Company"
                                                onkeypress="javascript: return ValidateAlpha(event);">
                                        </div>
                                        <div class="col-md-2 p-2">
                                            <input type="text" name="GSTAddress" id="Gst_Address"
                                                class="form-control" placeholder="Address" maxlength="250">
                                        </div>
                                        <div class="col-md-2 p-2">
                                            <input type="emial" name="GSTEmailID" id="Gst_Emailid"
                                                class="form-control" placeholder="Emial ID"
                                                onkeypress="javascript: return ValidateEmailtxt(event)">
                                        </div>
                                        <div class="col-md-2 p-2">
                                            <input type="tel" name="GSTMobileNumber" id="Gst_MobileNo"
                                                class="form-control" placeholder="Phone"
                                                onkeypress="javascript:return isNumericVal(event);">
                                        </div>
                                        <div class="col-md-2 p-2">
                                            <button type="button" class="btn btn-danger"
                                                onclick="ClearGstdetails()">Clear</button>
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="form-check mb-3">
                                    <label class="form-check-label h6">
                                        <input class="form-check-input" type="checkbox" name="remember"> Save GST
                                        Details
                                    </label>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label  h6" for="gridCheck">
                                I have accepted the <a href="" class="text-danger"><span>T&C</span></a>
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" onclick="BookNowbtn()">Book Now </button>
                    </div>

                    </h5>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="border rounded p-3">
                        <div class="book-fare">
                            <h5>FARE SUMMARY</h5>
                            <div class="book-fare_ACI">
                                <p class="p-0">Passenger - <b>1 Adults</b></p>

                                <div class="mt-3">
                                    <a href="#Basefare" class="" data-bs-toggle="collapse"> Base Fare <i
                                            class="ri-arrow-down-s-line"></i>
                                        <span class="fare">
                                            @php $total = 0; @endphp
                                            @foreach ($fares['Faredescription'] as $price)
                                                @if ($price['Paxtype'] == 'ADT')
                                                    @php
                                                        $total += $price['BaseAmount'] * $AdultCount;
                                                    @endphp
                                                @elseif ($price['Paxtype'] == 'CHD')
                                                    @php
                                                        $total += $price['BaseAmount'] * $ChildCount;
                                                    @endphp
                                                @elseif ($price['Paxtype'] == 'INF')
                                                    @php
                                                        $total += $price['BaseAmount'] * $InfantCount;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            {{ formatPrice(@$total) }}
                                        </span>
                                    </a>
                                    <div id="Basefare" class="collapse">
                                        @foreach ($flights as $flight)
                                            @foreach ($flight['Fares'] as $flights_fare)
                                                @foreach ($flights_fare['Faredescription'] as $flights_fares)
                                                    @if ($flights_fares['Paxtype'] == 'ADT')
                                                        <div>
                                                            <span>Adult</span>
                                                            <span class="ps-5">
                                                                {{ $flights_fares['BaseAmount'] }} x {{ $AdultCount }}
                                                            </span>
                                                            <span class="fare">
                                                                {{ formatPrice($flights_fares['BaseAmount'] * $AdultCount) }}
                                                            </span>
                                                        </div>
                                                    @elseif ($flights_fares['Paxtype'] == 'CHD')
                                                        <div>
                                                            <span>Children</span>
                                                            <span class="ps-5">
                                                                {{ $flights_fares['BaseAmount'] }} x {{ $ChildCount }}
                                                            </span>
                                                            <span class="fare">
                                                                {{ formatPrice($flights_fares['BaseAmount'] * $ChildCount) }}
                                                            </span>
                                                        </div>
                                                    @elseif ($flights_fares['Paxtype'] == 'INF')
                                                        <div>
                                                            <span>Infant</span>
                                                            <span class="ps-5">
                                                                {{ $flights_fares['BaseAmount'] }} x {{ $InfantCount }}
                                                            </span>
                                                            <span class="fare">
                                                                {{ formatPrice($flights_fares['BaseAmount'] * $InfantCount) }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <a href="#taxes" class="" data-bs-toggle="collapse"> Taxes and Fees <i
                                            class="ri-arrow-down-s-line"></i>
                                        <span class="fare">
                                            @php $totaltax = 0; @endphp
                                            @foreach ($fares['Faredescription'] as $price)
                                                @if ($price['Paxtype'] == 'ADT')
                                                    @php
                                                        $totaltax += $price['TotalTaxAmount'] * $AdultCount;
                                                    @endphp
                                                @elseif ($price['Paxtype'] == 'CHD')
                                                    @php
                                                        $totaltax += $price['TotalTaxAmount'] * $ChildCount;
                                                    @endphp
                                                @elseif ($price['Paxtype'] == 'INF')
                                                    @php
                                                        $totaltax += $price['TotalTaxAmount'] * $InfantCount;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            {{ formatPrice(@$totaltax) }}
                                        </span>
                                    </a>
                                    <div id="taxes" class="collapse">
                                        @foreach ($flights as $flight)
                                            @foreach ($flight['Fares'] as $flights_fares)
                                                @foreach ($flights_fare['Faredescription'] as $flights_fares)
                                                    @if ($flights_fares['Paxtype'] == 'ADT')
                                                        <div>
                                                            <span>Adult</span>
                                                            <span class="ps-5">
                                                                {{ $flights_fares['TotalTaxAmount'] }} x
                                                                {{ $AdultCount }}
                                                            </span>
                                                            <span class="fare">
                                                                {{ formatPrice($flights_fares['TotalTaxAmount'] * $AdultCount) }}
                                                            </span>
                                                        </div>
                                                    @elseif ($flights_fares['Paxtype'] == 'CHD')
                                                        <div>
                                                            <span>Children</span>
                                                            <span class="ps-5">
                                                                {{ $flights_fares['TotalTaxAmount'] }} x
                                                                {{ $ChildCount }}
                                                            </span>
                                                            <span class="fare">
                                                                {{ formatPrice($flights_fares['TotalTaxAmount'] * $ChildCount) }}
                                                            </span>
                                                        </div>
                                                    @elseif ($flights_fares['Paxtype'] == 'INF')
                                                        <div>
                                                            <span>Infant</span>
                                                            <span class="ps-5">
                                                                {{ $flights_fares['TotalTaxAmount'] }} x
                                                                {{ $InfantCount }}
                                                            </span>
                                                            <span class="fare">
                                                                {{ formatPrice($flights_fares['TotalTaxAmount'] * $InfantCount) }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                        <div>
                                            <span>Servicecharge</span>
                                            <span class="fare">{{ formatPrice(0) }}</span>
                                        </div>


                                    </div>
                                </div>
                                {{-- <div class="mt-2">
                                    <a href="" class="" data-bs-toggle="collapse"> Seat Amount <span
                                            class="fare">0.00<span></a>
                                </div>
                                <div class="mt-2">
                                    <a href="" class="" data-bs-toggle="collapse"> Other SSR Amount <span
                                            class="fare">0.00<span></a> --}}
                            </div>
                            <div class="mt-4 p-2 border-top">
                                <a href="#total" class="" data-bs-toggle="collapse"> Total Amount
                                    <i class="ri-focus-2-fill"></i>
                                    <span class="fare">{{ formatPrice($total + $totaltax) }} </span>
                                </a>
                                <div id="total" class="collapse p-2">
                                    <a href="javascript:void(0)" class="" data-bs-toggle="collapse"> -
                                        Commission
                                        <span class="fare">
                                            {{ formatPrice(@$fares['Faredescription'][0]['Commission']) }}
                                        </span>
                                    </a> <br>
                                    <a href="javascript:void(0)" class="" data-bs-toggle="collapse">
                                        + TDS<span class="fare">
                                            {{ formatPrice(@$fares['Faredescription'][0]['TDS']) }}
                                        </span>
                                    </a><br>
                                    <input type="hidden" id="NetFare" value="{{ $total + $totaltax }}">
                                    <a href="javascript:void(0)" class="" data-bs-toggle="collapse">
                                        NetFare
                                        <span class="fare"> {{ formatPrice($total + $totaltax) }} </span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <div class="modal fade" id="loginModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="login-card">
                        <span id="messagePrint" ></span>
                        <div class="position-relative contact-form mb-24">
                            <label class="contact-label">{{ __('Email Address') }} </label>
                            <input id="email" type="email" class="form-control contact-input" required
                                autocomplete="email" autofocus placeholder="Enter Your Email">
                        </div>

                        <div class="contact-form mb-24">
                            <div class="position-relative ">
                                <div class="d-flex justify-content-between aligin-items-center">
                                    <label class="contact-label">Password</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            <span class="text-primary text-15">{{ __('Forgot Your Password?') }}</span>
                                        </a>
                                    @endif
                                </div>
                                <input type="password" class="form-control contact-input password-input contact-input"
                                    id="txtPasswordLogin" required autocomplete="current-password"
                                    placeholder="Enter Password">
                                <i class="toggle-password ri-eye-line"></i>
                            </div>

                        </div>

                        <button type="button" onclick="loginAuth()"
                            class="btn-primary btn justify-content-center w-100 p-2">
                            <span class="d-flex justify-content-center gap-6">
                                <span class="text-white">Login</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('custom_css')
        <style>
            ul#menu li {
                display: inline;
                padding: 10px 20px;
            }

            li.right {
                margin-left: 170px;
            }

            li.date {
                color: crimson;
            }

            span.right {
                margin-left: 20pc;
            }

            span.fare {
                float: right;
            }

            a.add-gst {
                color: crimson;
            }

            .booking {
                text-align: center;
            }

            hr {
                border-bottom: 1px solid #3a3a3a;
                border-top: 0 none;
                margin: 5px 0;
                padding: 0;
            }

            .timimg {
                text-align: center;
            }

            @media (min-width: 320px) {

                ul#menu li {
                    display: inline;
                    padding: 6px 5px;
                }
            }
        </style>
    @endpush
    @push('custom_js')
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
        <script>
            // Validate Alpha Fields
            function ValidateAlpha(event) {
                var regex = new RegExp("^[a-zA-Z\b]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                var keyCode = (event.which) ? event.which : event.keyCode
                if (!regex.test(key) && keyCode != 9 && keyCode != 32) {
                    event.preventDefault();
                    return false;
                } else {
                    return true;
                }
            }

            function ValidateEmailtxt(event) { // Allows AlphaNumeric and only . _ @ for EMail purpose..
                try {
                    var keyCode = event.keyCode == 0 ? event.charCode : event.keyCode;
                    var ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (keyCode >= 48 &&
                        keyCode <= 57) || (keyCode == 95) || (keyCode == 46) || (keyCode == 64) || (specialKeys.indexOf(
                        event.keyCode) != -1 && event.charCode != event.keyCode));
                    return ret;
                } catch (Error) {}
            }
            // To validate  numeric fields
            function isNumericVal(event) {
                if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
                    var code;
                    if (!event) var event = window.event
                    //      if (e.keyCode) code = e.keyCode;
                    if (event.which) code = event.which;

                    if ((code != 8) && (code < 48) || (code > 57)) {
                        event.preventDefault();
                        return false;
                    } else
                        return true;
                } else {
                    var code;
                    if (!event) var event = window.event
                    if (event.keyCode) code = event.keyCode;
                    //if (e.which) code = e.which;
                    if ((code < script script script script script script script script 48) || (code > 57) && (code != 8) && (
                            code !=
                            46)) {
                        event.preventDefault();
                        return false;
                    } else
                        return true;
                }
            }

            function ClearGstdetails() {
                $('#GSTNumber').val("");
                $('#GSTCompanyName').val("");
                $('#GSTAddress').val("");
                $('#GSTEmailID').val("");
                $('#GSTMobileNumber').val("");
            }
        </script>
        <script>
            function BookNowbtn() {
                var price = parseFloat($('#NetFare').val());
                $.ajax({
                    type: "POST",
                    url: "{{ route('auth.check') }}",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.isAuthenticated) {
                            payRazorpay(price);
                        } else {
                            $('#loginModel').modal('show');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }



            // function updateOrderStatus(paymentId, amount) {
            //     console.log("Payment ID: " + paymentId);
            //     console.log("Amount: " + amount);
            //     $.ajax({
            //         type: "POST",
            //         url: "",
            //         data: {
            //             _token: "{{ csrf_token() }}",
            //             payment_id: paymentId,
            //             amount: amount
            //         },
            //         success: function(response) {
            //             console.log("Order status updated:", response);
            //         },
            //         error: function(error) {
            //             console.log("Error updating order status:", error);
            //         }
            //     });
            // }

            function loginAuth() {
                const  email = $('#email').val();
                const  password = $('#txtPasswordLogin').val();
                const  price = parseFloat($('#NetFare').val());


                $.ajax({
                    type: "POST",
                    url: "{{ route('auth.login') }}",
                    data: {
                        email: email,
                        password: password,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.isAuthenticated) {
                            console.log(res);
                            $('#messagePrint').html("Login successfully ").addClass('text-success');

                            setTimeout(() => {
                                $('#loginModel').modal('hide');
                                payRazorpay(price);
                            }, 1000);
                            
                            
                        } else {
                            $('#messagePrint').html("Invalid email or password!").addClass('text-danger');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        $('#messagePrint').html("Something went wrong!").addClass('text-danger');
                    }
                });
            }

            function payRazorpay(price) {
                var options = {
                    "key": "rzp_test_wt0qNKdTqFwnPQ",
                    "amount": price * 100,
                    "currency": "INR",
                    "name": "Nifs travels",
                    "description": "Payment for booking ticket",
                    "image": "{{ static_asset('assets/images/logo/logo.png') }}",
                    "handler": function(response) {
                        console.log(response);
                        //updateOrderStatus(response.razorpay_payment_id, price);
                    }
                };

                var rzp1 = new Razorpay(options);
                rzp1.open();
            }

            function updateOrderStatus(paymentId, amount) {
                console.log("Payment ID: " + paymentId);
                console.log("Amount: " + amount);
            }
        </script>
    @endpush
@endsection
