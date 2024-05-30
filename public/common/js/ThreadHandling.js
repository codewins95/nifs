function AssignThread(strClientID) {
    var AirportType = $("#domastic").prop("checked") ? "D" : "I"
    var arrAirporType = [];
    $(".clrcity").each(function () {
        if ($(this).val() != "" && ($(this).val()).includes("(")) {
            var OriginDest = ($(this).val()).split("(")[1].split(")")[0].trim();
            var arr_OriginDest = $.grep(loadGlobalcityArrry, function (n, i) {
                return n.ID == OriginDest;
            });
            "IN" == arr_OriginDest[0].CN ? arrAirporType.push("D") : arrAirporType.push("I");
        }
    })
    AirportType = arrAirporType.length > 0 && arrAirporType.indexOf("I") == -1 ? "D" : "I";

    var param = {
        strClientID: strClientID != null ? strClientID : "",
        strAirportType: AirportType,
    }
    if (strClientID != null && strClientID != undefined && strClientID != "") {
        $.blockUI({
            message: '<img alt="Please Wait..." src="' + loaderurl + '" id="FareRuleLodingImage" />',
        });
    }
    $.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        url: AssignedThreadURL,
        data: JSON.stringify(param),
        async: true,
        dataType: "json",
        success: function (data) {
            $.unblockUI();
            if (data.Status == "-1") {
                window.location = sessionExb;
                return false;
            }
            else if (data.Status == "00") {
                if (data.Result != "") {
                    var ThreadDetails = JSON.parse(data.Result);
                    $("#hdnNormalThread").val(ThreadDetails[0].NormalThread);
                    $("#hdnLCCThread").val(ThreadDetails[0].LCCThread);
                    $("#hdnFSCThread").val(ThreadDetails[0].FSCThread);
                    $("#hdnLCCCodeThread").val(ThreadDetails[0].LCCCodeThread);
                    $("#hdnFSCCodeThread").val(ThreadDetails[0].FSCCodeThread);
                    $("#hdnRoundTripSplThread").val(ThreadDetails[0].RoundTripSplThread);
                    $("#hdnAllowCodeThread").val(ThreadDetails[0].AllowCodeThread);
                    $("#hdnMulticityThread").val(ThreadDetails[0].MulticityThread);
                }
                else {
                    console.log("******No Thread found from Thread hit******");
                    return false;
                }
            }
            else {
                console.log("******" + data.Message + "******");
                return false;
            }
        },
        error: function (result) {
            $.unblockUI();
            console.log("******Exception From Assigned Thread function start******");
            console.log(ex.toString());
            console.log("******Exception From Assigned Thread function End******");
            return false;
        }
    });
}

function ThreadHandling() {
    try {
        var AirlineStock = [];
        var CoporateThread = [];
        var FltrThreadArry = [];
        var LCCCodeFltrAry = [];
        var FSCCodeFltrAry = [];
        var ThreadReqAry = [];
        var RepSectorAry = [];
        var StockThreadDet = [];
        var OrginCity = $("#hdtxt_origin").val();
        var DestinationCity = $("#hdtxt_destination").val();
        var Orgincountry = $("#hdn_origincntry").val();
        var Desnationcountry = $("#hdn_destincntry").val();
        var selectedAirline = $("#FlightName").val() != null && $("#FlightName").val() ? $("#FlightName").val() : [];
        //if ((($("#Flightno1").val().length > 2 && selectedAirline.length == 0) || ($("#Flightno2").val().length > 2 && selectedAirline.length == 0)) && AvailInputReq.TripType != "M") {
        //    if (AvailInputReq.TripType == "O" || (AvailInputReq.TripType == "R" && $("#Flightno1").val() != "" && $("#Flightno2").val() != "")) {
        //        $("#Flightno1").length && $("#Flightno1").val() != "" && !selectedAirline.includes($("#Flightno1").val().slice(0, 2).toUpperCase()) ? selectedAirline.push($("#Flightno1").val().slice(0, 2).toUpperCase()) : "";
        //        $("#Flightno2").length && $("#Flightno2").val() != "" && !selectedAirline.includes($("#Flightno2").val().slice(0, 2).toUpperCase()) ? selectedAirline.push($("#Flightno2").val().slice(0, 2).toUpperCase()) : "";
        //    }
        //}       
        //Normal - hdnNormalThread, LCC - hdnLCCThread, FSC - hdnFSCThread, RoundtripSpecil - hdnRoundTripSplThread,Mul - hdnMulticityThread
        var AssignedThread = "";
        if ($("#fli_option").val() == "LCC") {
            AssignedThread = $("#hdnLCCThread").val();
        }
        else if ($("#fli_option").val() == "FSC") {
            AssignedThread = $("#hdnFSCThread").val();
        }
        else if ($("#liRoundTripSpl").prop("checked") && AvailInputReq.TripType == "Y") {
            AssignedThread = $("#hdnRoundTripSplThread").val();
        }
        else if ($('#hdtxt_trip').val() == "M") {
            AssignedThread = $("#hdnMulticityThread").val();
            selectedAirline = $("#MulFlightName").length > 0 && $("#MulFlightName").val() != null && $("#MulFlightName").val() ? $("#MulFlightName").val() : [];

        }
        else {
            AssignedThread = $("#hdnNormalThread").val();
        }
        // AssignedThread = "OSC|ALL,IX|IXN,I5|I5N,I5|I5I,I5|I5C,6E|6EA,G8|G8F,6E|6EB,6E|6EN,BS|BSN,6E|6EM,1AAF|ALL,1AKL|ALL,SG|SGN,QP|QPN,VJ|VJN,1A|ALL,BO|BON,6E|6EO,SG|SGO,G8|G8O,EY|EYN,QP|QPM,KH|KHN,1ASQ|ALL,U4|U4N,BA|BAN,GF|GFN,XY|XYN,SQ|SQN,NDC|ALL";

        //Coporate/Retail Thread formation 
        if ($("#rd_corporate_retail").length && $("#rd_corporate_retail").prop("checked") && $('body').data("bhdcorporatefaredt") != "") { //Coporaate
            Corp_aircode = "";
            var CorpoateDetails = $('body').data("bhdcorporatefaredt").split(',');
            for (var i = 0; i < CorpoateDetails.length ; i++) {
                if (CorpoateDetails[i].split('~')[0] != "") {
                    //   if (AssignedThread.indexOf(CorpoateDetails[i].split('~')[0]) > -1) {
                    CoporateThread.push((CorpoateDetails[i].split('~').length > 3 ? CorpoateDetails[i].split('~')[4] : CorpoateDetails[i].split('~')[0]) + "|" + CorpoateDetails[i].split('~')[0]);
                    //  }
                }
            }
        }

        ThreadReqAry.push({ Org: OrginCity, Des: DestinationCity, AssignedThread: AssignedThread });
        if ($('#hdnAllowMulSectorReq').val() == "Y" && $('#hdtxt_trip').val() != "M") {
            RepSectorAry = ChkMultiSectorThreadReq(OrginCity, DestinationCity);
            ThreadReqAry = RepSectorAry.length > 0 ? ThreadReqAry.concat(RepSectorAry) : ThreadReqAry;
        }

        for (var cnt = 0; cnt < ThreadReqAry.length; cnt++) {
            var AssignedThreadarry = ThreadReqAry[cnt].AssignedThread != "" && ThreadReqAry[cnt].AssignedThread != "ALL" ? ThreadReqAry[cnt].AssignedThread.split(",") : ThreadReqAry[0].AssignedThread.split(",");

            //Airline Filteratin Region
            $.each(selectedAirline, function (i, val) {
                var TempThreadArry = [];
                if ($('#hdtxt_trip').val() != "M" && $('#hdnAllowMulSectorReq').val() == "Y" && cnt > 0 && ThreadReqAry[cnt].AssignedThread != "" && ThreadReqAry[cnt].AssignedThread != "ALL") {
                    $.each(AssignThread, function (j, value) {
                        if (value.indexOf(val) != -1 || value.indexOf("ALL") != -1) {
                            value = value.indexOf("ALL") != -1 ? value.replace("ALL", val) : value;
                            FltrThreadArry.push(value);
                        }
                    });
                }
                else {
                    if (GetInLcccheck(val)) {
                        TempThreadArry = $("#hdnLCCThread").val() != "" ? $("#hdnLCCThread").val().split(',') : [];
                        $.each(TempThreadArry, function (j, value) { //Check into LCC Thread
                            if (value.split('|')[1].indexOf(val) != -1 || value.indexOf("ALL") != -1) {
                                value = value.indexOf("ALL") != -1 ? value.replace("ALL", val) : value;
                                FltrThreadArry.push(value);
                            }
                        });

                        TempThreadArry = $("#hdnLCCCodeThread").val() != "" ? $("#hdnLCCCodeThread").val().split(',') : [];
                        $.each(TempThreadArry, function (j, value) { //Check into LCC code Thread
                            if (value.split('|')[1].indexOf(val) != -1 || value.indexOf("ALL") != -1) {
                                value = value.indexOf("ALL") != -1 ? value.replace("ALL", val) : value;
                                LCCCodeFltrAry.push(value);
                            }
                        });
                    }
                    else {
                        TempThreadArry = $("#hdnFSCThread").val() != "" ? $("#hdnFSCThread").val().split(',') : [];
                        $.each(TempThreadArry, function (j, value) { //Check into FSC Thread
                            if (value.split('|')[1].indexOf(val) != -1 || value.indexOf("ALL") != -1) {
                                value = value.indexOf("ALL") != -1 ? value.replace("ALL", val) : value;
                                FltrThreadArry.push(value);
                            }
                        });

                        TempThreadArry = $("#hdnFSCCodeThread").val() != "" ? $("#hdnFSCCodeThread").val().split(',') : []; //Check into FSC code Thread
                        $.each(TempThreadArry, function (j, value) {
                            if (value.split('|')[1].indexOf(val) != -1 || value.indexOf("ALL") != -1) {
                                value = value.indexOf("ALL") != -1 ? value.replace("ALL", val) : value;
                                FSCCodeFltrAry.push(value);
                            }
                        });
                    }
                }
            });

            var LCCCodeAry = ($("#hdnLCCCodeThread").val() != "" && $("#fli_option").val() != "FSC") ? $("#hdnLCCCodeThread").val().split(',') : [];
            var FSCCodeAry = ($("#hdnFSCCodeThread").val() != "" && $("#fli_option").val() != "LCC") ? $("#hdnFSCCodeThread").val().split(',') : [];
            if ($("#liRoundTripSpl").prop("checked") && $('#hdn_producttype').val() == "AIRIQ" && AvailInputReq.TripType == "Y") {
                AssignedThread = $("#hdnRoundTripSplThread").val();
                LCCCodeAry = [];
                FSCCodeAry = [];
                LCCCodeAry.push(AssignedThread);
            }

            AssignedThreadarry = $("#rd_corporate_retail").prop("checked") && $('body').data("bhdcorporatefaredt") != "" ? CoporateThread : selectedAirline.length > 0 ? FltrThreadArry : AssignedThreadarry;
            LCCCodeAry = selectedAirline.length > 0 ? LCCCodeFltrAry : LCCCodeAry;
            FSCCodeAry = selectedAirline.length > 0 ? FSCCodeFltrAry : FSCCodeAry;

            //Spicals fare Thread formation 
            //  if ($("#StudentFare").length && $("#StudentFare").prop("checked")) {
            var TempThreadArry = [];
            $.each(AssignedThreadarry, function (i, val) { // Filter from Normal Thread 
                StockThreadDet = val.split('|');

                if ($("#StudentFare").length && $("#StudentFare").prop("checked") && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1][StockThreadDet[1].length - 1] == 'X') {
                        TempThreadArry.push(val);
                    }
                }
                else if (($("#ArmyFare").length && $("#ArmyFare").prop("checked") == true || $("#chkDefenceavil").length && $("#chkDefenceavil").prop("checked") == true) && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1][StockThreadDet[1].length - 1] == 'D') {
                        TempThreadArry.push(val);
                    } else if ($('#hdn_producttype').val() == "FAUJI") {
                        TempThreadArry.push(val);
                    }
                }
                else if ($("#SrCitizenFare").length && $("#SrCitizenFare").prop("checked") && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1][StockThreadDet[1].length - 1] == 'O') {
                        TempThreadArry.push(val);
                    }
                }
                else if ($("#rd_labour").length && $("#rd_labour").prop("checked") && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1] != "ALL" && StockThreadDet[1][StockThreadDet[1].length - 1] == 'L') {
                        TempThreadArry.push(val);
                    }
                }
                else if ($("#DoubleFare").length && $("#DoubleFare").prop("checked") && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1][StockThreadDet[1].length - 1] == 'A') {
                        TempThreadArry.push(val);
                    }
                }
                else if (StockThreadDet.length > 1 && StockThreadDet[1].length > 2 && (StockThreadDet[1][StockThreadDet[1].length - 1] == 'X' || StockThreadDet[1][StockThreadDet[1].length - 1] == 'D' || StockThreadDet[1][StockThreadDet[1].length - 1] == 'O' || (StockThreadDet[1] != "ALL" && StockThreadDet[1][StockThreadDet[1].length - 1] == 'L') || StockThreadDet[1][StockThreadDet[1].length - 1] == 'A')) {
                    //if ($('#hdn_producttype').val() == "FAUJI" && $("#chkDefenceavil").length && $("#chkDefenceavil").prop("checked") == false) {
                    //    TempThreadArry.push(val);
                    //}
                }
                else {
                    TempThreadArry.push(val);
                }
            });
            AssignedThreadarry = TempThreadArry;

            TempThreadArry = [];
            $.each(LCCCodeAry, function (i, val) { //Filter from Lcc code Thread
                StockThreadDet = val.split('|');

                if ($("#StudentFare").length && $("#StudentFare").prop("checked") && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1][StockThreadDet[1].length - 1] == 'X') {
                        TempThreadArry.push(val);
                    }
                }
                else if (($("#ArmyFare").length && $("#ArmyFare").prop("checked") == true || $("#chkDefenceavil").length && $("#chkDefenceavil").prop("checked") == true) && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1][StockThreadDet[1].length - 1] == 'D') {
                        TempThreadArry.push(val);
                    } else if ($('#hdn_producttype').val() == "FAUJI") {
                        TempThreadArry.push(val);
                    }
                }
                else if ($("#SrCitizenFare").length && $("#SrCitizenFare").prop("checked") && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1][StockThreadDet[1].length - 1] == 'O') {
                        TempThreadArry.push(val);
                    }
                }
                else if ($("#rd_labour").length && $("#rd_labour").prop("checked") && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1] != "ALL" && StockThreadDet[1][StockThreadDet[1].length - 1] == 'L') {
                        TempThreadArry.push(val);
                    }
                }
                else if ($("#DoubleFare").length && $("#DoubleFare").prop("checked") && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1][StockThreadDet[1].length - 1] == 'A') {
                        TempThreadArry.push(val);
                    }
                }
                else if (StockThreadDet.length > 1 && StockThreadDet[1].length > 2 && (StockThreadDet[1][StockThreadDet[1].length - 1] == 'X' || StockThreadDet[1][StockThreadDet[1].length - 1] == 'D' || StockThreadDet[1][StockThreadDet[1].length - 1] == 'O' || (StockThreadDet[1] != "ALL" && StockThreadDet[1][StockThreadDet[1].length - 1] == 'L') || StockThreadDet[1][StockThreadDet[1].length - 1] == 'A')) {
                    //if ($('#hdn_producttype').val() == "FAUJI" && $("#chkDefenceavil").length && $("#chkDefenceavil").prop("checked") == false) {
                    //    TempThreadArry.push(val);
                    //}
                }
                else {
                    TempThreadArry.push(val);
                }
            });
            LCCCodeAry = TempThreadArry;

            TempThreadArry = [];
            $.each(FSCCodeAry, function (i, val) { //Filter from FSC code Thread
                StockThreadDet = val.split('|');

                if ($("#StudentFare").length && $("#StudentFare").prop("checked") && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1][StockThreadDet[1].length - 1] == 'X') {
                        TempThreadArry.push(val);
                    }
                }
                else if (($("#ArmyFare").length && $("#ArmyFare").prop("checked") || $("#chkDefenceavil").length && $("#chkDefenceavil").prop("checked") == true) && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1][StockThreadDet[1].length - 1] == 'D') {
                        TempThreadArry.push(val);
                    } else if ($('#hdn_producttype').val() == "FAUJI") {
                        TempThreadArry.push(val);
                    }
                }
                else if ($("#SrCitizenFare").length && $("#SrCitizenFare").prop("checked") && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1][StockThreadDet[1].length - 1] == 'O') {
                        TempThreadArry.push(val);
                    }
                }
                else if ($("#rd_labour").length && $("#rd_labour").prop("checked") && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1] != "ALL" && StockThreadDet[1][StockThreadDet[1].length - 1] == 'L') {
                        TempThreadArry.push(val);
                    }
                }
                else if ($("#DoubleFare").length && $("#DoubleFare").prop("checked") && StockThreadDet.length > 1 && StockThreadDet[1].length > 2) {
                    if (StockThreadDet[1][StockThreadDet[1].length - 1] == 'A') {
                        TempThreadArry.push(val);
                    }
                }
                else if (StockThreadDet.length > 1 && StockThreadDet[1].length > 2 && (StockThreadDet[1][StockThreadDet[1].length - 1] == 'X' || StockThreadDet[1][StockThreadDet[1].length - 1] == 'D' || StockThreadDet[1][StockThreadDet[1].length - 1] == 'O' || (StockThreadDet[1] != "ALL" && StockThreadDet[1][StockThreadDet[1].length - 1] == 'L') || StockThreadDet[1][StockThreadDet[1].length - 1] == 'A')) {
                    //if ($('#hdn_producttype').val() == "FAUJI" && $("#chkDefenceavil").length && $("#chkDefenceavil").prop("checked") == false) {
                    //    TempThreadArry.push(val);
                    //}
                }
                else {
                    TempThreadArry.push(val);
                }
            });
            FSCCodeAry = TempThreadArry;
            //}              

            //Special Fare (only OSC - static thread)
            if ($("#rd_Special_fare").length && $("#rd_Special_fare").prop("checked")) {
                AssignedThreadarry = [];
                AssignedThreadarry.push("OSC|")
                TempThreadArry = [];
                LCCCodeAry = TempThreadArry;
                FSCCodeAry = TempThreadArry;
            }


            //Code thread filter from multicity thread
            if ($('#hdtxt_trip').val() == "M") {
                var TempThreadArry = [];
                $.each(AssignedThreadarry, function (i, value) {
                    $.each(LCCCodeAry, function (j, val) { // Filter from LCC code Thread 
                        if (value.split("|")[0] == val.split("|")[0] && $.inArray(val, TempThreadArry) == -1) {
                            TempThreadArry.push(val);
                        }
                    });
                });
                LCCCodeAry = TempThreadArry;

                TempThreadArry = [];
                $.each(AssignedThreadarry, function (i, value) {
                    $.each(FSCCodeAry, function (j, val) { // Filter from FCC code Thread 
                        if (value.split("|")[0] == val.split("|")[0] && $.inArray(val, TempThreadArry) == -1) {
                            TempThreadArry.push(val);
                        }
                    });
                });
                FSCCodeAry = TempThreadArry;
            }


            var CodeThreadFrmDB = []
            if ($("#hdnAllowCodeThread").val() == "Y") {
                CodeThreadFrmDB = CodeBasedAssignThread(LCCCodeAry.join(','), FSCCodeAry.join(','), selectedAirline);
            }
            if ($("#hdnAllowCodeThread").val() != "Y" || ($("#rd_corporate_retail").length && $("#rd_corporate_retail").prop("checked") && $('body').data("bhdcorporatefaredt") != "")) {
                AssignedThreadarry = AssignedThreadarry.length > 0 && AssignedThreadarry[0] != "" ? AssignedThreadarry : [];
            }
            else {
                AssignedThreadarry = AssignedThreadarry.length > 0 && AssignedThreadarry[0] != "" ? AssignedThreadarry.concat(CodeThreadFrmDB) : CodeThreadFrmDB;
            }
            //********Thread Request************
            var fltnumviaopts = finalfltvia;
            if ($("#Mulrd_Booklet").is(":checked") == true) {         //Booklet Fare Request    
                if ($("#hdn_BookletThread").val() != null && $("#hdn_BookletThread").val() != undefined && $("#hdn_BookletThread").val() != "") {
                    $('.availSetParent').hide();
                    $('#dvonewayParent').show();
                    var BookletThread = $("#hdn_BookletThread").val().split('|');
                    $('body').data('segtype', "I");
                    for (var _booklet = 0; _booklet < BookletThread.length; _booklet++) {
                        var strBookletthread = BookletThread[_booklet].split('~');
                        AsyncThreadRequest(strBookletthread[0], strBookletthread[1], aryOrgMul.join(','), aryDstMul.join(','), aryDptMul.join(','), "", "", fltnumviaopts, "", "");
                        AvailRequestCount++;
                    }
                }
            }
            else { //General Request     
                //AssignedThreadarry = [];
                //AssignedThreadarry.push("1ASQ|SQ");
                if (AssignedThreadarry.length > 0 && AssignedThreadarry[0] != "") {
                    $.each(AssignedThreadarry, function (i, val) {
                        AirlineStock = val.split('|');
                        if (selectedAirline != null && selectedAirline != "" && AirlineStock.length > 1 && AirlineStock[1].includes('@')) {  //prefered airline (UAI|UK@AI)
                            AirlineStock[1] = AirlineStock[1].includes(selectedAirline) ? selectedAirline[0] : AirlineStock[1];
                        }
                        var fareType = AirlineStock.length > 3 ? AirlineStock[3] : "";
                        AirlineStock[1] = AirlineStock[1] == "ALL" ? "" : AirlineStock[1];
                        if ($('#hdtxt_trip').val() == "M") { //Multicity Thread Request
                            $("body").data("tripcheck", "");
                            if ($('body').data('segtype') == "D" || ($("#hdn_AvailabilityV4").length > 0 && $("#hdn_AvailabilityV4").val() == "Y" && $('body').data('segtype') == "I" && !Chkallequalarry(aryClassMul))) { //Multicity Domestic
                                for (var segcount = 0; segcount < aryOrgMul.length; segcount++) {
                                    AsyncThreadRequest(AirlineStock[0], AirlineStock[1], aryOrgMul[segcount], aryDstMul[segcount], aryDptMul[segcount], "", segcount, "", (AirlineStock.length > 2 ? AirlineStock[2] : ""), fareType, aryClassMul[segcount]);
                                    AvailRequestCount++;

                                }
                            }
                            else { //Multicity International
                                AsyncThreadRequest(AirlineStock[0], AirlineStock[1], aryOrgMul.join(','), aryDstMul.join(','), aryDptMul.join(','), "", "", fltnumviaopts, (AirlineStock.length > 2 ? AirlineStock[2] : ""), fareType, aryClassMul[0]);
                                AvailRequestCount++;
                            }
                        }

                        else {

                            if (RequestFiltration(AirlineStock[0], Orgincountry, Desnationcountry, ThreadReqAry[cnt].Org, ThreadReqAry[cnt].Des)) {
                                $("body").data("tripcheck", "");
                                AsyncThreadRequest(AirlineStock[0], AirlineStock[1], ThreadReqAry[cnt].Org, ThreadReqAry[cnt].Des, "", "", "", "", (AirlineStock.length > 2 ? AirlineStock[2] : ""), fareType);
                                AvailRequestCount++;
                            }
                            else {
                                console.log("Request Void Filtered for (" + ThreadReqAry[cnt].Org + " - " + ThreadReqAry[cnt].Des + ") " + AirlineStock[0]);
                            }

                            if ($('#hdtxt_trip').val() == "R" && $("#hdn_rtsplflag").val() != "Y") {//trip condition Roundtrip
                                $("body").data("tripcheck", "R");
                                if (RequestFiltration(AirlineStock[0], Desnationcountry, Orgincountry, ThreadReqAry[cnt].Des, ThreadReqAry[cnt].Org)) {
                                    AsyncThreadRequest(AirlineStock[0], AirlineStock[1], ThreadReqAry[cnt].Des, ThreadReqAry[cnt].Org, "", "", "2", "", (AirlineStock.length > 2 ? AirlineStock[2] : ""), fareType);
                                    AvailRequestCount++;
                                } else {
                                    console.log("Request Void Filtered for (" + ThreadReqAry[cnt].Des + " - " + ThreadReqAry[cnt].Org + ") " + AirlineStock[0]);
                                }
                            }

                        }
                    });
                }
            }
        }

        if (AvailRequestCount == 0) {
            $.unblockUI();
            $("#dvAvail").css("display", "none");
            $("#InterNational_Avail").css("display", "none");
            $("#dvSearch").css("display", "block");
            $(".divdisable").remove();
            $("#btn_Search").prop('disabled', false);
            console.log("***********************Request not initiated due to void request filter (or) Thread not assigned.********************************")
            showerralert("No Flights available.", "", "");
            return false;
        }
    }
    catch (e) {
        $.unblockUI();
        console.log("***********************Thread Handling Exception********************************")
        console.log("***********************" + e + ".********************************");
        showerralert("Problem occured while processing your request.", "", "");
    }
}

function CodeBasedAssignThread(strLCCCodeThread, strFSCCodeThread, slctdAirline) {
    try {
        var ThreadFormation = [];
        var ClientID = ""; var BranchID = "";
        if ($("#ddlclient").length > 0) {
            ClientID = sessionStorage.getItem('clientid') != null ? sessionStorage.getItem('clientid').trim() : "";
            BranchID = sessionStorage.getItem('branchid') != null ? sessionStorage.getItem('branchid').trim() : "";
        }
        else {
            ClientID = "";
            BranchID = "";
        }
        var AirportType = $("#domastic").prop("checked") ? "D" : "I"
        if ($('#hdn_producttype').val() != "RIYA" && $('#hdn_producttype').val() != "RBOA" && assignedcountry == 'IN') {
            var arrAirporType = [];
            $(".clrcity").each(function () {
                if ($(this).val() != "" && ($(this).val()).includes("(")) {
                    var OriginDest = ($(this).val()).split("(")[1].split(")")[0].trim();
                    var arr_OriginDest = $.grep(loadGlobalcityArrry, function (n, i) {
                        return n.ID == OriginDest;
                    });
                    "IN" == arr_OriginDest[0].CN ? arrAirporType.push("D") : arrAirporType.push("I");
                }
            })
            AirportType = arrAirporType.length > 0 && arrAirporType.indexOf("I") == -1 ? "D" : "I";
        }

        var SelectedAirline = ""
        $.each(slctdAirline, function (sl, val) { SelectedAirline += (val + ",") });
        SelectedAirline = SelectedAirline.slice(0, -1);
        var param = {
            strLCCCodeThread: strLCCCodeThread,
            strFSCCodeThread: strFSCCodeThread,
            strOrgin: $("#hdtxt_origin").val(),
            strDestination: $("#hdtxt_destination").val(),
            strDepDate: $("#txtdeparture").val().trim(),
            strArrDate: $("#txtarrivaldate").val().trim(),
            strCabin: $("#ddlclass").val(),
            strSegType: $("#hdtxt_trip").val(),
            strAirportID: AirportType,
            strClientID: ClientID,
            strBranchID: BranchID,
            strSelectAirline: SelectedAirline
        }

        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: CodeBasedAssignedThreadURL,
            data: JSON.stringify(param),
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.Status == "-1") {
                    window.location = sessionExb;
                    return false;
                }
                else if (data.Status == "01") {
                    var CodeThread = data.Result.trim().split(',');
                    ThreadFormation = [];
                    for (var i = 0; i < CodeThread.length ; i++) {
                        ThreadFormation.push(CodeThread[i])
                    }
                    return ThreadFormation;
                }
                else {
                    ThreadFormation = [];
                    console.log("**************CodeBasedAssignThread ************");
                    console.log("**************" + data.Message + "************");
                    return ThreadFormation;
                }
            },
            error: function (result) {
                console.log("**************CodeBasedAssignThread ajax Exception************");
                console.log(result.toString());
                return ThreadFormation;
            }
        });
        return ThreadFormation;
    }
    catch (ex) {
        console.log("**************CodeBasedAssignThread Exception************");
        console.log(ex.toString());
    }
}

function AsyncThreadRequest(stock, Airline, Org, Des, OnwardDate, ReturnDate, SegCnt, fltnumvia, TicketingOfficeID, FareType, fltClass)// fn, cate, Morg, Mdes, Mdep, setcnt, fltnumvia) {
{
    var AvailParams = "";
    var strfromCity = "";
    var strtoCity = "";
    var strDepartureDate = "";
    var strRetDate = "";
    var strAdults = "";
    var strChildrens = "";
    var strInfants = "";
    var strTrip = "";
    var Class = "";
    var segmenttype = $('body').data('segtype');
    var time = 100000;
    var O_R_Flag = 0;
    var UID = UIDCORP;
    var roundtripflg = "0";
    var AppCurrency = "";
    var reqker = sessionreq;
    var Corporatedetails = "";
    var BranchID = "";
    var GroupID = "";
    var fltnumkey = "";
    var fltsegmentkey = "";
    var mulfltnumvia = "";
    var ClientID = $("#hdn_availagent").val();
    var availterminal = $("#hdn_availterminal").val();
    var Agencyname = $("#hdn_availagencyname").val();
    roundtripflg = $('#rd_roundtripcnt').prop("checked") == true ? "1" : roundtripflg;
    time = $('#hdtxt_trip').val() != "O" ? 300000 : time;

    try {
        if ($("#ddlclient").length > 0) {
            ClientID = sessionStorage.getItem('clientid') != null ? sessionStorage.getItem('clientid').trim() : "";
            BranchID = sessionStorage.getItem('branchid') != null ? sessionStorage.getItem('branchid').trim() : "";
            GroupID = sessionStorage.getItem('Groupid') != null ? sessionStorage.getItem('Groupid').trim() : "";
            Agencyname = sessionStorage.getItem('clientname') != null ? sessionStorage.getItem('clientname').trim() : "";
        }
        else {
            BranchID = "";
            GroupID = "";
        }

        if ($('#hdtxt_trip').val() != "M") {

            if ($("#hdn_rtsplflag").val() == "Y") { /* For round trip spl LCC avail*/

                strfromCity = $("#hdtxt_origin").val();
                strtoCity = $("#hdtxt_destination").val();
                strDepartureDate = $("#hdtxt_depa_date").val();
                strRetDate = $("#hdtxt_Arrivedate").val();
                strAdults = $("#hdtxt_adultcount").val();
                strChildrens = $("#hdtxt_childcount").val() != "" ? $("#hdtxt_childcount").val() : "0";
                strInfants = $("#hdtxt_infantcount").val() != "" ? $("#hdtxt_infantcount").val() : "0";
                strTrip = $("#hdtxt_trip").val();
                Class = $("#ddlclass").val();
                console.log('hit count' + requestcount + "-" + stock + "|" + Airline + "|" + FareType + "(" + strfromCity + "-" + strtoCity + ")");
                O_R_Flag = "1";
                UID = UIDCORP;
                fltnumkey = "";//$("#Flightno1").val().toUpperCase().trim() + "," + $("#Flightno2").val().toUpperCase().trim()
                fltsegmentkey = $("#Via1").length && $("#Via2").length ? $("#Via1").val().toUpperCase().trim() + "," + $("#Via2").val().toUpperCase().trim() : "";
                AppCurrency = $("#ddlNationality").val();
            }
            else if ($("#hdn_rtsplflag").val() != "Y") {
                if ($("body").data("tripcheck") == "R") {
                    strfromCity = Org;// $("#hdtxt_destination").val();
                    strtoCity = Des;//$("#hdtxt_origin").val();
                    strDepartureDate = $("#hdtxt_Arrivedate").val();
                    strRetDate = $("#hdtxt_depa_date").val();
                    strAdults = $("#hdtxt_adultcount").val();
                    strChildrens = $("#hdtxt_childcount").val() != "" ? $("#hdtxt_childcount").val() : "0";
                    strInfants = $("#hdtxt_infantcount").val() != "" ? $("#hdtxt_infantcount").val() : "0";
                    strTrip = $("#hdtxt_trip").val();
                    Class = $("#ddlclass").val();
                    console.log('hit count' + requestcount + "-" + stock + "|" + Airline + "|" + FareType + "(" + strfromCity + "-" + strtoCity + ")");
                    O_R_Flag = "2";
                    UID = UIDCORP;
                    fltnumkey = "";//$("#Flightno2").val().toUpperCase().trim() + "," + $("#Flightno1").val().toUpperCase().trim() /* For double grid flight no option */
                    fltsegmentkey = $("#Via1").length && $("#Via2").length ? $("#Via2").val().toUpperCase().trim() + "," + $("#Via1").val().toUpperCase().trim() : ""; /* For double grid via option */
                    AppCurrency = $("#ddlNationality").val();
                } else {
                    strfromCity = Org;// $("#hdtxt_origin").val();
                    strtoCity = Des;//$("#hdtxt_destination").val();
                    strDepartureDate = $("#hdtxt_depa_date").val();
                    strRetDate = $("#hdtxt_Arrivedate").val();
                    strAdults = $("#hdtxt_adultcount").val();
                    strChildrens = $("#hdtxt_childcount").val() != "" ? $("#hdtxt_childcount").val() : "0";
                    strInfants = $("#hdtxt_infantcount").val() != "" ? $("#hdtxt_infantcount").val() : "0";
                    strTrip = $("#hdtxt_trip").val();
                    Class = $("#ddlclass").val();
                    console.log('hit count' + requestcount + "-" + stock + "|" + Airline + "|" + FareType + "(" + strfromCity + "-" + strtoCity + ")");
                    O_R_Flag = "1";
                    UID = UIDCORP;
                    fltnumkey = "";//$("#Flightno1").val().toUpperCase().trim() + "," + $("#Flightno2").val().toUpperCase().trim()
                    fltsegmentkey = $("#Via1").length && $("#Via2").length ? $("#Via1").val().toUpperCase().trim() + "," + $("#Via2").val().toUpperCase().trim() : ""
                    AppCurrency = $("#ddlNationality").val();
                }
            }
            if ($("#rd_corporate_retail").prop("checked") == true && $('body').data("bhdcorporatefaredt") != "") { //sts185
                AirlineCode = "";
                if (Airline.length > 3) {
                    var aircode = $('body').data("bhdcorporatefaredt").split(',');
                    for (var j = 0; j < Airline.split(',').length; j++) {
                        var checkair = Airline.split(',')[j];
                        if (checkair != "") {
                            for (var i = 0; i < aircode.length; i++) {
                                if (aircode[i].split('~')[0] == checkair) {
                                    Corporatedetails = aircode[i];
                                }
                            }
                        }
                    }
                    for (var i = 0; i < aircode.length - 1; i++) {
                        if (aircode[i].split('~')[0] == checkair) {
                            Corporatedetails = aircode[i];
                        }
                    }
                }
                else {
                    var checkair = Airline != "" ? Airline.split(',')[0] : stock;
                    var aircode = $('body').data("bhdcorporatefaredt").split(',');
                    for (var i = 0; i < aircode.length - 1; i++) {
                        if (aircode[i].split('~')[0] == checkair) {
                            Corporatedetails = aircode[i];
                        }
                    }
                }
            }
        }
        else { //For Multicity on 20170524...
            strfromCity = Org;
            strtoCity = Des;
            strDepartureDate = OnwardDate;
            strRetDate = OnwardDate;
            strAdults = $("#hdtxt_adultcount").val();
            strChildrens = $("#hdtxt_childcount").val() != "" ? $("#hdtxt_childcount").val() : "0";
            strInfants = $("#hdtxt_infantcount").val() != "" ? $("#hdtxt_infantcount").val() : "0";
            strTrip = $("#hdtxt_trip").val();
            Class = $("#hdn_AvailabilityV4").length > 0 && $("#hdn_AvailabilityV4").val() == "Y" ? fltClass : $("#grpcmbFlightClass").val();
            console.log('hit count' + requestcount + "-" + stock + "|" + Airline + "|" + FareType + "(" + strfromCity + "-" + strtoCity + " - " + strDepartureDate + ")");
            O_R_Flag = SegCnt != null && SegCnt != "undefined" && SegCnt != undefined && SegCnt != "" ? (SegCnt + 1) : 1;
            UID = UIDCORP;
            mulfltnumvia = fltnumvia;
            AppCurrency = $("#ddlMNationality").val();
        }

        var UIDTID = UIDCORP + "$" + sessionreq;
        var Splthread = $("#hdn_rtsplflag").val() == "" ? "N" : $("#hdn_rtsplflag").val();
        var studentFare = $("#StudentFare").length > 0 ? $("#StudentFare").prop("checked") : false;
        var ArmyFare = $("#ArmyFare").length > 0 ? $("#ArmyFare").prop("checked") : false;
        var SnrcitizenFare = $("#SrCitizenFare").length > 0 ? $("#SrCitizenFare").prop("checked") : false;
        var LabourFare = $("#rd_labour").length > 0 ? $("#rd_labour").prop("checked") : false;
        var HostSearch = $("#rd_Host").length > 0 ? $("#rd_Host").prop("checked") : false;
        var DirectFlight = $("#chkDirFlt").length > 0 ? $("#chkDirFlt").prop("checked") : false;
        var strAirportType = $('body').data('segtype');
        console.log(O_R_Flag);
        AvailParams = {
            strfromCity: strfromCity, strtoCity: strtoCity, strDepartureDate: strDepartureDate, strRetDate: strRetDate,
            strAdults: strAdults, strChildrens: strChildrens, strInfants: strInfants, strTrip: strTrip, strAirportType: strAirportType, strAirline: Airline, strFCategory: stock, strTktOfficeID: TicketingOfficeID,
            strFareType: FareType, strCabin: Class, boolHostSearch: HostSearch, boolDirectSearch: DirectFlight, strSegmenttype: segmenttype + "_" + O_R_Flag, strRoundtripflg: roundtripflg,
            strUID: UIDTID, strReqkey: sessionreq, strAppCurrency: AppCurrency, strfltnumkey: fltnumkey, strfltsegmentkey: fltsegmentkey, strmulfltnumvia: mulfltnumvia,
            strClientID: ClientID, strBranchID: BranchID, strGroupID: GroupID, strClientUserID: availterminal, strAgencyname: Agencyname, strCorporatethread: Corporatedetails,
            strThreadspl: Splthread, boolStudentFare: studentFare, boolArmyFare: ArmyFare, boolSnrcitizenFare: SnrcitizenFare, boolLabourFare: LabourFare, boolBookletFare: $("#Mulrd_Booklet").is(":checked")
        }
        requestcount++;
        if ($("#hdn_AvailabilityV4").length > 0 && $("#hdn_AvailabilityV4").val() == "Y") {
            AsyncAvailRequest(AvailParams, time);
        }
        else {
            FetchAvail(AvailParams, time, "Y");
        }

        sessionreq++;
    }
    catch (e) {
        console.log("***********************AsyncThread Request Exception********************************")
        console.log("***********************" + e.toString() + ".********************************");
    }
}


function Chkallequalarry(array) {
    const result = array.every(element => {
        if (element === array[0]) {
            return true;
        }
    });
    return result;
}
var LCCAirXML = "";
function GetInLcccheck(res) {
    var sTitle = "";
    var SChar = "";
    try {
        if (LCCAirXML == "") {
            $.ajax({
                type: "GET",
                url: lccAirXML_path,
                async: false,
                dataType: "xml",
                success: function (xml) {
                    LCCAirXML = xml;
                    $(xml).find('LCCAIRLINES').each(function () {
                        SChar = $(this).find('AIR_AIRLINE_CODE').text();
                        if (SChar == res) {
                            sTitle = true;
                        }
                        else {
                            SChar = "";
                        }
                    });

                    if (sTitle == "")
                        sTitle = false;

                },
                error: function (ex) {
                    showerralert("An error occurred while processing XML file.", "", "");
                }
            });
        }
        else {
            $(LCCAirXML).find('LCCAIRLINES').each(function () {
                SChar = $(this).find('AIR_AIRLINE_CODE').text();
                if (SChar == res) {
                    sTitle = true;
                }
                else {
                    SChar = "";
                }
            });

            if (sTitle == "")
                sTitle = false;
        }
    } catch (e) {
        showerralert(e.message.toString(), "", "");
    }
    return sTitle;
    //return false;
}