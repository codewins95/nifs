@extends('layouts.master')
@section('title', 'Home')
@section('content')
    <!-- Hero area S t a r t-->
    <section class="hero-padding-for-three video-overlay position-relative">
        <!-- Video -->
        <div class="hero-bg-video">
            <video class="hero-slider-video video-cover"
                poster="{{ static_asset('assets/images/hero/hero-three-banner.png') }}" loop autoplay muted>
                <source src="{{ static_asset('assets/images/videos/travel1.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-between g-4">
                <div class="col-xl-12">
                    <div class="hero-caption-three position-relative z-3">
                        <h4 class="title wow fadeInUp" data-wow-delay="0.0s">
                            Discover and book amazing travel experiences with Nifs Travels
                        </h4>
                        <p class="pera wow fadeInUp" data-wow-delay="0.1s">
                            Travel is a transformative and enriching experience that
                            allows individuals to explore new destinations, cultures, and
                            landscapes
                        </p>
                    </div>
                    <div class="hero-footer position-relative z-3 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="all-user">
                            <div class="happy-user">
                                <img src="{{ static_asset('assets/images/hero/user-1.jpeg') }}" alt="travello">
                            </div>
                            <div class="happy-user">
                                <img src="{{ static_asset('assets/images/hero/user-2.png') }}" alt="travello">
                            </div>
                            <div class="happy-user">
                                <img src="{{ static_asset('assets/images/hero/user-3.png') }}" alt="travello">
                            </div>
                            <div class="happy-user">
                                <img src="{{ static_asset('assets/images/hero/user-4.jpeg') }}" alt="travello">
                            </div>
                            <div class="happy-user-count">
                                <p class="user-count">5k+</p>
                            </div>
                            <p class="pera">Happy Customer</p>
                            <span class="wave-emoji">
                                <img src="{{ static_asset('assets/images/icon/hand.png') }}" alt="travello">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End-of Hero-->


    <!-- Plan area S t a r t -->
    <section class="plan-area-three">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="plan-section-three plan-shadow">
                        <div class="choose-plan-nav">
                            <form action="{{ route('flight.filter') }}" method="POST">
                                @csrf
                                <!-- Tab Search Contents -->
                                <div class="tab-content" id="tourTab">
                                    <div class="tab-pane fade show active" id="tour" role="tabpanel"
                                        aria-labelledby="tour-tab">
                                        <div class="d-flex gap-16 flex-wrap mb-26">
                                            <label class="one-way-label">
                                                <input class="one-way-input" type="radio" value="O"
                                                    name="flight_trip" checked id="lioneways">
                                                <span class="circle"></span>
                                                <span class="radio-text">One Way</span>
                                            </label>
                                            <label class="round-trip-label">
                                                <input class="round-trip-input" type="radio" value="R"
                                                    name="flight_trip" id="liRoundTrip">
                                                <span class="circle"></span>
                                                <span class="radio-text">Round Trip</span>
                                            </label>
                                        </div>
                                        <div class="row g-4 justify-content-end">
                                            <div class="col-xl-5 col-lg-12">
                                                <div class="destination-flex">
                                                    <div class="select-dropdown-section">

                                                        <input name="txtorigincity" type="text"
                                                            class="form-control clrcity clsOrgin" id="txtorigincity"
                                                            autocomplete="off" data-type="geolocate" data-button="true"
                                                            value="" placeholder="From"
                                                            onkeypress="javascript:return ValidateAlphaCapsspace(event);"
                                                            autocorrect="off" autocapitalize="off" />
                                                    </div>
                                                    <div class="select-dropdown-section">
                                                        <input type="text" name="txtdestinationcity"
                                                            class="form-control clrcity clsDestination"
                                                            id="txtdestinationcity" autocomplete="off" data-type="geolocate"
                                                            data-button="true" value="" placeholder="To"
                                                            onkeypress="javascript:return ValidateAlphaCapsspace(event);"
                                                            autocorrect="off" autocapitalize="off" />

                                                    </div>
                                                    <div class="swap-icon">
                                                        <i class="ri-arrow-left-right-line" onclick="chngeDegi()"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-lg-12">
                                                <div class="destination-flex">
                                                    <div class="dropdown-section">
                                                        <div class="d-flex gap-10 align-items-center">
                                                            <div class="select-dropdown-section">
                                                                <input id="hdn_departure" name="hdn_departure"
                                                                    type="text" class="form-control hdn_departure"
                                                                    readonly data-type="calendar" placeholder="Onward" />

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-section">
                                                        <div class="d-flex gap-10 align-items-center">
                                                            <div class="select-dropdown-section">

                                                                <input id="hdn_arrivaldate" name="hdn_arrivaldate"
                                                                    type="text" class="form-control hdn_departure"
                                                                    readonly data-type="calendar" placeholder="Return" />

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="swap-icon">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-2 col-lg-3">
                                                <div class="sign-btn text-right">
                                                    <button type="submit" class="btn-secondary-lg w-100 text-center">
                                                        <i class="ri-search-line mr-10 font-20"></i> Search
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-3 col-sm-12 ">
                                                <div class="srch-prsn">
                                                    <div class="srch-prsn-fild">
                                                        <div class="fltr-trvcls">
                                                            <div id="myDropdown" class="dropdown">
                                                                <a class="dropdown-toggle show" href="javascript:void(0)"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="true">
                                                                    <span id="qty_total" class="rotate-x">1</span>
                                                                    Passenger
                                                                </a>
                                                                <div class="dropdown-menu keep-open dropdown-menu-right p-3 show"
                                                                    style="display: none; position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 54.5455px, 0px);"
                                                                    data-popper-placement="bottom-start">

                                                                    <div class="dropdown-menu-content">
                                                                        <label><span>Adults</span><small>(12+
                                                                                yrs)</small></label>
                                                                        <div class="qty-buttons">

                                                                            <input type="button" value="+"
                                                                                class="qtyplus" name="adults">
                                                                            <input type="text" name="adults"
                                                                                id="ddladult" value="1"
                                                                                class="qty">
                                                                            <input type="button" value="-"
                                                                                class="qtyminus" name="adults">
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-menu-content">
                                                                        <label><span>Childrens</span><small> (2-12
                                                                                yrs)</small></label>
                                                                        <div class="qty-buttons">
                                                                            <input type="button" value="+"
                                                                                class="qtyplus" name="child">
                                                                            <input type="text" name="child"
                                                                                id="ddlchild" value="0"
                                                                                class="qty">
                                                                            <input type="button" value="-"
                                                                                class="qtyminus" name="child">
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-menu-content">
                                                                        <label><span>Infant(s)</span><small> (0-2
                                                                                yrs)</small></label>
                                                                        <div class="qty-buttons">
                                                                            <input type="button" value="+"
                                                                                class="qtyplus" name="infant">
                                                                            <input type="text" name="infant"
                                                                                id="ddlinfant" value="0"
                                                                                class="qty">
                                                                            <input type="button" value="-"
                                                                                class="qtyminus" name="infant">
                                                                        </div>
                                                                    </div>
                                                                    <div class="trvlcls">
                                                                        <label>Travel Class</label>
                                                                        <select name="flight_class" id="ddlclass">
                                                                            <option value="E" selected="">Economy
                                                                            </option>
                                                                            <option value="P">Premium Eco</option>
                                                                            <option value="B">Business</option>
                                                                            <option value="F">First class</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="mt-3 float-end">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="StudentFare"
                                                            name="Faredivide" value="StudentFare">
                                                        <label class="form-check-label" for="StudentFare">Students</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="ArmyFare"
                                                            name="Faredivide" value="ArmyFare">
                                                        <label class="form-check-label" for="ArmyFare">Armed
                                                            Force</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="SrCitizenFare"
                                                            name="Faredivide" value="SrCitizenFare">
                                                        <label class="form-check-label" for="SrCitizenFare">Senior
                                                            Citizen</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="DoubleFare"
                                                            name="Faredivide" value="DoubleFare">
                                                        <label class="form-check-label" for="DoubleFare">Double
                                                            Seat</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- / End-of Search Contents -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End-of Plan-->

    @push('custom_css')
        <link rel="stylesheet" href="{{ static_asset('common/css/Component.css') }}">
        {{-- <link rel="stylesheet" href="http://airiq.mywebcheck.in/Content/CSS/App/Theme/THEME22/style.css?V1.0.44"> --}}
        <style>
            .clsflicode {
                background-color: #f16367;
                text-align: center;
                color: #fff;
                border-radius: 4px;
                padding: 0 5px;
            }

            .select-dropdown-section ul {

                padding: .5rem 10px;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid rgba(0, 0, 0, .15);
                border-radius: .25rem;
            }

            .clsthmail {
                padding-left: 0.2rem
            }

            ul.typeahead li {
                margin-top: 5px;
            }

            .clstyphead p {
                color: #888 !important;
            }

            .srch-prsn {
                width: 100%;
                float: left;
                padding-left: 5px;
                padding-right: 5px;
                position: relative;
                display: block;
            }

            .srch-prsn-fild {
                border-radius: .25rem;
                border: 1px solid #ccc;
                background: #fff;
                height: 55px;
                display: inline-block;
                width: 100%;
                padding-right: 15px;
                padding-left: 12px;
            }

            .fltr-trvcls {
                float: left;
                width: 100%;
            }

            #qty_total {
                display: inline-block;
                font-size: 11px;
                font-weight: 600;
                line-height: 20px;
                text-align: center;
                position: relative;
                top: 2px;
                left: 2px;
                margin-right: 5px;
                height: 18px;
                width: 18px;
                background-color: #66676b;
                border-radius: 50%;
                color: #fff;
            }



            .fltr-trvcls .dropdown-menu-content label {
                display: block;
                flex: 1;
                color: #727b82;
            }

            .fltr-trvcls .dropdown a {
                color: #6c757d;
                font-size: 15px;
                font-weight: 500;
                transition: all .3s;
                width: auto;
                padding: 15px 0px 15px 0px;
                display: flex;
                text-decoration: none;
                position: relative;
            }

            .fltr-trvcls .dropdown-menu-content {
                display: flex;
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }

            .fltr-trvcls .trvlcls {
                display: flex;
                border-top: 1px solid #dedede;
                padding-top: 10px;
                margin-bottom: 0px;
            }

            #searc9cls #dvNormalSearch label,
            .clsliMSearchSec label {
                font-weight: 600;
                text-transform: capitalize;
                margin-bottom: 0px;
            }

            .fltr-trvcls .dropdown-menu-content label span {
                width: 100%;
                display: block;
                color: #333;
                font-size: 13px;
                font-weight: 600;
            }

            .fltr-trvcls .dropdown-menu-content label small {
                width: 100%;
                display: block;
                color: #999;
                font-size: 12px;
            }

            .fltr-trvcls .qty-buttons {
                position: relative;
                height: 30px;
                top: 5px;
                display: inline-block;
                width: 100px;
            }

            .fltr-trvcls input.qtyplus {
                background: url({{ static_asset('common/img/plus.png') }}) center center no-repeat #f2f2f2;
                right: 3px;
            }

            .fltr-trvcls input.qtyminus,
            .fltr-trvcls input.qtyplus {
                position: absolute;
                width: 28px;
                height: 28px;
                border: 0;
                outline: 0;
                cursor: pointer;
                -webkit-appearance: none;
                -webkit-border-radius: 50px;
                -moz-border-radius: 50px;
                -ms-border-radius: 50px;
                border-radius: 50px;
            }

            .fltr-trvcls input.qtyminus,
            .fltr-trvcls input.qtyplus {
                top: 1px;
                text-indent: -9999px;
                box-shadow: none;
            }

            .srch-prsn input {
                padding: 0px 15px 0px 15px;
            }

            .fltr-trvcls input.qty {
                width: 100%;
                text-align: center;
                background: none;
                border: none !important;
                color: #495057 !important;
                font-size: 15px;
                height: 30px;
            }

            .fltr-trvcls input.qtyminus {
                background: url({{ static_asset('common/img/minus.png') }}) center center no-repeat #f2f2f2;
                left: 3px;
            }

            .fltr-trvcls input.qtyminus,
            .fltr-trvcls input.qtyplus {
                position: absolute;
                width: 28px;
                height: 28px;
                border: 0;
                outline: 0;
                cursor: pointer;
                -webkit-appearance: none;
                -webkit-border-radius: 50px;
                -moz-border-radius: 50px;
                -ms-border-radius: 50px;
                border-radius: 50px;
            }

            .fltr-trvcls input.qtyminus,
            .fltr-trvcls input.qtyplus {
                top: 1px;
                text-indent: -9999px;
                box-shadow: none;
            }

            .airiq-search-cont .srch-prsn-fild .dropdown .dropdown-menu {
                font-size: 14px;
                cursor: pointer;
                -moz-transition: opacity .5s ease;
                -o-transition: opacity .5s ease;
                -webkit-transition: opacity .5s ease;
                -ms-transition: opacity .5s ease;
                transition: opacity .5s ease;
                margin-top: 10px;
                background: #fff;
                border: 1px solid #d2d8dd;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                -ms-border-radius: 3px;
                border-radius: 3px;
                box-shadow: 0 12px 35px 2px rgba(0, 0, 0, .12);
                padding: 15px 15px;
                white-space: normal;
                position: absolute !important;
                width: 236.39px !important;
                transform: translate3d(-12px, 55px, 0px) !important;
            }

            .fltr-trvcls .trvlcls {
                display: flex;
                border-top: 1px solid #dedede;
                padding-top: 10px;
                margin-bottom: 0px;
            }

            #searc9cls #dvNormalSearch label,
            .clsliMSearchSec label {
                font-weight: 600;
                text-transform: capitalize;
                margin-bottom: 0px;
            }

            .fltr-trvcls .trvlcls label {
                font-size: 13px;
                color: #333;
                width: 100%;
                padding-top: 5px;
            }

            .srch-prsn select {
                border: 1px solid #ccc;
                height: 36px;
                font-size: 13px;
                border-radius: 4px;
            }

            .dropdown-toggle::after {
                margin-left: 5.255em;
                border-top: .4em solid;
                border-right: .4em solid transparent;
                border-left: .4em solid transparent;
                margin-top: 10px;
            }
        </style>
    @endpush

    @push('custom_js')
        <script src="{{ static_asset('common/js/bootstrap-typeahead.js') }}"></script>
        <script src="{{ static_asset('common/js/jquery.xml2json.js') }}"></script>
        {{-- <script src="{{ static_asset('common/js/ThreadHandling.js')}}"></script> --}}
        {{-- <script src="http://airiq.mywebcheck.in/Content/JS/Common/daterangepicker.js"></script> --}}
        <script>
            function chngeDegi() {
                $('#txtorigincity').val($('#txtdestinationcity').val());
                $('#txtdestinationcity').val($('#txtorigincity').val());
            }

            function ValidateAlphaCapsspace(e) {

                if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
                    var code;
                    var code1;
                    if (!e) var e = window.event
                    //if (e.keyCode) code = e.keyCode;
                    //else if (e.which) code = e.which;
                    if (e.which) code = e.which;
                    if ((code < 65 || code > 90) && (code < 97 || code > 122) && (code != 13) && (code != 9) && (code != 8) && (
                            code != 219) && (code != 220) && (code != 32))
                        return false;
                    else
                    if (e.keyCode) code = e.keyCode;
                    if (code == 46) return true;
                    return true;
                } else {
                    var code;
                    if (!e) var e = window.event
                    if (e.keyCode) code = e.keyCode;
                    // else if (e.which) code = e.which;
                    if ((code < 65 || code > 90) && (code < 97 || code > 122) && (code != 13) && (code != 9) && (code != 8) && (
                            code != 32))
                        return false;
                    else
                        return true;
                }
            }
        </script>

        <script>
            var assignedcountry = 'IN';
            var TerminalType = 'W';
            // var AssignedThreadURL = '/Search/AssignThread';

            $(document).ready(function() {

                var JsonData = "";
                var jsonresults = "";
                var productNames = new Array();
                var productIds = new Object();
                $.ajax({
                    url: "{{ static_asset('XML/CityAirport_Lst.xml?V1.0.40') }}",
                    dataType: 'XML',
                    anync: false,
                    success: function(response) {
                        statedata = $("AIR", response).map(function() {
                            // if ($("ID", this).text() == $("#hdn_Baseorgin").val()) {
                            //     var citynames = "";
                            //     if ($("AN", this).text().indexOf('-') != -1) {
                            //         citynames = $("AN", this).text().split('-')[0].trim();
                            //     } else {
                            //         citynames = $("AN", this).text().trim();
                            //     }
                            //     $("#txtorigincity").val(citynames + "-(" + $("ID", this).text() +
                            //         ")");

                            //     Cityinfopopup = $("AIR", response).map(function() {
                            //         return {
                            //             value: $("AN", this).text(),
                            //             id: $("ID", this).text()
                            //         };
                            //     });

                            // }
                        }).get();

                        Cityairport = $("AIR", response).map(function() {
                            return {
                                value: $("AN", this).text() + " (" +
                                    ($.trim($("ID", this).text()) + ")"),
                                id: $("ID", this).text()
                            };

                        }).get();

                        json = $.xml2json(response);
                        JsonData = json.AIR;
                        JsonData_Round = json.AIR;
                        loadGlobalcityArrry = JsonData;
                        jsonresults = JSON.stringify(JsonData_Round);
                        var citynames = "";
                        //var assignedcountry="";
                        airlinecityloadfun(JsonData, assignedcountry);
                    },
                    error: function(e) {}
                });

            });





            function airlinecityloadfun(JsonData, assignedcountry) {
                try {
                    var citynames = "";
                    var productNames = new Array();
                    var productIds = new Object();
                    var ct = "";

                    $.each(JsonData_Round, function(index, AIR) {
                        if (AIR.AN.indexOf('-') != -1) {
                            citynames = AIR.AN.split('-')[0].trim();
                        } else {
                            citynames = AIR.AN.trim();
                        }

                        if (AIR.CN != "undefined" && AIR.CN.length > 0) {
                            productNames.push(citynames + "-(" + AIR.ID + ")" + "~" + AIR.CN + "~" + AIR.AN.split('-')[
                                1]); //if comes without ~ symbol normal typeahead ll work...
                            productIds[AIR.AN] = AIR.ID;
                        }

                    });
                } catch (ex) {}

                $('#txtorigincity, #txtdestinationcity').typeahead('destroy');
                $('#txtorigincity, #txtdestinationcity').typeahead({
                    source: productNames,
                    items: 5,
                    scrollBar: true,
                    onSelect: displayResults,
                });

                function displayResults(item) {
                    var selectedvalues = item.value;
                    $('.alert').show().html('You selected <strong>' + selectedvalues + '</strong>: <strong>' + item.text +
                        '</strong>');
                    var GetThread = setInterval(function() {
                        if ((TerminalType != "T" || $("#ddlTerminalId").val() != "") && $('#txtorigincity').val() !=
                            "" && $('#txtdestinationcity').val() != "") {
                            //TerminalType == "T" ? AssignThread($("#ddlTerminalId").val()) : AssignThread();
                        }
                        clearInterval(GetThread);
                    }, 500);
                }

            }



            $(document).ready(function() {

                $("#hdn_departure").datepicker({
                    numberOfMonths: 1,
                    showButtonPanel: false,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'D, dd M',
                    minDate: "0",
                    maxDate: "+1Y",
                    onSelect: function(dateText, inst) {
                        var depdate = (inst.currentDay.toString().length == 1 ? "0" + Number(inst
                            .currentDay) : inst.currentDay) + "/" + ((inst.currentMonth + 1).toString()
                            .length == 1 ? "0" + Number(inst.currentMonth + 1) : Number(inst
                                .currentMonth + 1)) + "/" + inst.currentYear;
                        changeReturndate(dateText, depdate);
                    },
                });
                $("#hdn_arrivaldate").datepicker({
                    numberOfMonths: 1,
                    showButtonPanel: false,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'D, dd M',
                    minDate: "0",
                    maxDate: "+1Y",
                    onSelect: function(dateText, inst) {
                        $("#hdn_arrivaldate").val(dateText);
                    },
                });

            });

            function changeReturndate(dateText, depdate) {

                var today = new Date();
                var nextYear = new Date(today.getFullYear() + 1, today.getMonth(), today.getDate());

                var options = {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                };
                var formattedDate = nextYear.toLocaleDateString('en-IN', options);


                $("#hdn_arrivaldate").val("");
                $("#hdn_arrivaldate").datepicker("destroy");
                $("#hdn_arrivaldate").datepicker({
                    numberOfMonths: 1,
                    showButtonPanel: false,
                    changeMonth: true,
                    dateFormat: 'dd/mm/yy',
                    minDate: depdate,
                    maxDate: formattedDate,
                    onSelect: function(dateText, inst) {
                        $("#liRoundTrip").click();
                        var dt = ChangeDateFromat(dateText.split("/")[1] + "/" + dateText.split("/")[0] + "/" +
                            dateText.split("/")[2]);
                        $("#hdn_arrivaldate").val(dt.HalfDay + ", " + dateText.split("/")[0] + " " + dt.HalfMonth);  
                    },
                });
                $("#liRoundTrip").prop("checked") ? $("#hdn_arrivaldate").val($("#hdn_departure").val()) : "";
            }




            function ChangeDateFromat(Reqdate) {
                
                const date = new Date(Reqdate);
                const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                const FullmonthNames = ["January", "Feburary", "March", "April", "May", "June", "July", "Augest", "Septempber",
                    "October", "November", "Decmber"
                ];
                var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                var Halfdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                var DateDetails = {
                    Date: date.getDate(),
                    FulDay: days[date.getDay()],
                    HalfDay: Halfdays[date.getDay()],
                    Month: date.getMonth() + 1,
                    HalfMonth: monthNames[date.getMonth()],
                    FullMonth: FullmonthNames[date.getMonth()],
                    Year: date.getFullYear()
                }
                return DateDetails;
            }


            $('#lioneways').on('click', function() {
                $("#hdn_arrivaldate").val("");
            });
        </script>
        <script>
            $(".qtyplus").on("click", function(e) {
                e.preventDefault();
                var fieldName = $(this).attr("name");
                var Adult = parseInt($("#ddladult").val() || "0");
                if (fieldName == "adults" && Adult < 9) {
                    $("#ddladult").val(Adult + 1);
                }
                Adult = parseInt($("#ddladult").val() || "0");

                var Child = parseInt($("#ddlchild").val() || "0");
                if (fieldName == "child" && (Adult + Child) < 9)
                    $("#ddlchild").val(Child + 1);
                if ((Adult + Child) > 9)
                    $("#ddlchild").val("0");

                var Infant = parseInt($("#ddlinfant").val() || "0");
                if (fieldName == "infant" && Adult > Infant && Infant < 4)
                    $("#ddlinfant").val(Infant + 1);
                if (Adult < Infant)
                    $("#ddlinfant").val("0");
            });
            $(".qtyminus").on("click", function(e) {
                e.preventDefault();
                fieldName = $(this).attr("name");
                var currentVal = parseInt($("#ddl" + fieldName).val() || "0");
                if (fieldName == "adults") {
                    currentVal = parseInt($("#ddladult").val() || "0")
                }
                if (currentVal > 1 && fieldName == "adults") {
                    $("#ddladult").val(currentVal - 1);
                    var Adult = parseInt($("#ddladult").val() || "0");
                    var Infant = parseInt($("#ddlinfant").val() || "0");
                    if (Adult < Infant)
                        $("#ddlinfant").val("0");
                }
                if (currentVal > 0 && fieldName != "adults") {
                    $("#ddl" + fieldName).val(currentVal - 1);
                }
            });
            $(".qtyplus,.qtyminus").on("click", function(e) {
                $("#qty_total").addClass("rotate-x");
                var sum = 0;
                $(".qty").each(function() {
                    sum += +$(this).val();
                });
                $("#qty_total").html(sum);
            });
            jQuery('.dropdown-toggle').on('click', function(e) {
                $(this).next().toggle();
            });
            jQuery('.dropdown-menu.keep-open').on('click', function(e) {
                e.stopPropagation();
            });
        </script>
    @endpush
@endsection
