patientManagmentInit();
/*==================== BUTTON LISTENER FUNCTIONS ====================*/
//EHR Button function listeners (lower part of div)
function EHRbtnEventListeners () {
    document.getElementById('EHR_dataAll').addEventListener('submit', async evt => {
        evt.preventDefault();
        let patientSubmit = new FormData(document.getElementById('EHR_dataAll'))  
        let patientSubmitData = Object.fromEntries(patientSubmit);
        let pid = sessionStorage.getItem("EHRactivepid_search");
        let dataReq = updPatientData(patientSubmitData,pid);
        let dataRes = await getEHRQuery(dataReq);
        ModalAndAlertPopups(dataRes);
        
    });  

    document.getElementById('EHRShowMHBModalBtn').addEventListener('click', async evt => {
        evt.preventDefault();
        let data = {'data':parseInt(sessionStorage.getItem("EHRactivepid_search")),'type':'EHRGetDisList'};
        let dislistData = await getEHRQuery(data);
        disListHandler(dislistData);
        
    }); 

    document.getElementById("EHR_csvImportModalSubmitBtn").addEventListener('click', evt => {
        evt.preventDefault();
        importCSVData();
    });

    document.getElementById("EHRMHModalCloseBtn").addEventListener('click', evt => {
        evt.preventDefault();
         document.querySelectorAll('#apptPaginateStart').forEach(e => e.remove());
    });
}

function medicalHistoryModalBtnHandlers() {
    let EHRMH_DisListClear = document.getElementById("EHRMHDisListClear");
    let EHRMH_DisListUpdate = document.getElementById("EHRMHDisListDivSubmit");
   
    EHRMH_DisListClear.addEventListener('click', evt => {
        evt.preventDefault();
        let EHRDislistCheck = document.querySelectorAll('input[type=checkbox]');
        EHRDislistCheck.forEach(check => {
            if(check.checked == true) {;
                check.checked = false;
            }
        }) 
    }, false);

    EHRMH_DisListUpdate.addEventListener('click', async evt => {
        evt.preventDefault();
        let EHRDislistChkReq = [];
        let EHRDislistCheck = document.querySelectorAll('input[type=checkbox]:checked');
        for (var i = 0; i < EHRDislistCheck.length; i++) {  
            EHRDislistChkReq.push(EHRDislistCheck[i].value);
        }
        let submitData = setDisList(EHRDislistChkReq);
        let dataRes = await getEHRQuery(submitData);

    }, false);
}

/*==================== CRUD FUNCTIONS ====================*/

// Get Health Record Data 
function disListHandler(dislistData) { 
    let EHRpersdisListPID = dislistData.pidDisList.split(',');
    let EHR_DisListFormBody = document.getElementById("EHRMHDislistBody");
    let EHR_DisListChkbox = document.getElementsByClassName('EHR_DisListChkbox');
    EHR_DisListFormBody.innerHTML = '';

    for (var i = 0; i < dislistData.disList.length; i++){  
        var add = `<div class="form-check">
                        <input class="form-check-input EHR_DisListChkbox" type="checkbox" value="${dislistData.disList[i].disid}">
                        <label class="form-check-label" for="flexCheckDefault">${dislistData.disList[i].disease}</label>
                    </div>`
        EHR_DisListFormBody.innerHTML += add;
    }

    // ignore when this throws an exception/error. It is WAD 
    try {
        for(let pid in EHRpersdisListPID){
            if(EHR_DisListChkbox) {
                $('.form-check input[value='+EHRpersdisListPID[pid]+']').prop("checked", true);
            }
        }
    }
    catch {

    }
}

// Set Disease List 
function setDisList (EHRDislistChkReq) {
    let pid = sessionStorage.getItem("EHRactivepid_search");
    let EHRDislistDataReq = {
        'data': {
            'pid':pid, 
            'dislistChecked':EHRDislistChkReq
        },
        'type': 'EHRSetDisList'
    };

    return EHRDislistDataReq;
}

// Update EHR Data
function updPatientData (data,pid) {
    let dataReq = {
        data : {
            'pid':pid,
            'weight':data.weight,
            'height':data.height,
        },
        'type':'EHRUpdData',   
    }
    return dataReq;
}

// Show EHR to Patient Details
function ShowEHRDiv (EHRdataRes) {
    var EHRDetailsDiv = document.getElementById('EHR_SearchShowDtls');
    EHRDetailsDiv.hidden = false;
    EHRDetailsDiv.scrollIntoView();

    sessionStorage.setItem('EHRactivepid_search',EHRdataRes.pid)
    
    // for header
    document.getElementById('EHR_lnameGet_Head').innerText = EHRdataRes.lname;
    document.getElementById('EHR_fnameGet_Head').innerText = EHRdataRes.fname;

    // for input fields

    //calculate age
    var dob = new Date(EHRdataRes.birthday);
    var month_diff = Date.now() - dob.getTime();
    var age_dt = new Date(month_diff); 
    var year = age_dt.getUTCFullYear();
    var age = Math.abs(year - 1970);

    document.getElementById('fname').value = EHRdataRes.fname;
    document.getElementById('lname').value = EHRdataRes.lname;
    document.getElementById('mname').value = EHRdataRes.mname;
    document.getElementById('address').value = EHRdataRes.address;
    document.getElementById('weight').value = EHRdataRes.weight;
    document.getElementById('height').value = EHRdataRes.height;
    document.getElementById('bday').value = EHRdataRes.birthday;
    document.getElementById('dept').value = EHRdataRes.dept;
    document.getElementById('age').value = age;
    document.getElementById('contactno').value = EHRdataRes.contactno;
    document.getElementById('gender').value = EHRdataRes.gender;
}

// Search Patient / EHR Data
function getPatientData () {    
    getPatientDataInit();

    function getPatienDataBtn () {
        var EHRsearchSubmit = document.getElementById('EHRsearchPatient');
        var pagePrevBtn = document.getElementById("paginatePrevBtn");
        var pageNextBtn = document.getElementById("paginateNextBtn");   

        EHRsearchSubmit.addEventListener('submit', async evt => {
            evt.preventDefault();
            document.querySelectorAll('#pidPaginateStart').forEach(e => e.remove());
            document.getElementById("EHRSearchPatientPagination").hidden = false;

            var EHRDataSubmit = new FormData(EHRsearchSubmit)  
            var ehrQueryData = Object.fromEntries(EHRDataSubmit);
            var ehrDataReq = {'data':ehrQueryData.query, 'type':'EHRQueryReq','currPageSel':1};
           
            getEHRQueryValues = await getEHRQuery(ehrDataReq);        
            
            displayTable(getEHRQueryValues);
            TableBtnEventHandlers();
        },false);
        
        pagePrevBtn.addEventListener('click', async evt => {
            evt.preventDefault();
            evt.stopImmediatePropagation();
            
            if (getEHRQueryValues.currPageSel !== 1) {
                let currPageSelVal = --getEHRQueryValues.currPageSel;
                let ehrDataReq = {'data':getEHRQueryValues.queryData,'type':'EHRQueryReq','currPageSel':currPageSelVal};              
                let getEHRQueryValuesLoc = await getEHRQuery(ehrDataReq);
                displayTable(getEHRQueryValuesLoc);
                TableBtnEventHandlers();
            }
        },false);

        pageNextBtn.addEventListener('click', async evt => {
            evt.preventDefault();
            evt.stopImmediatePropagation();
            if (getEHRQueryValues.currPageSel !== getEHRQueryValues.pageNumPaginate) {
                let currPageSelVal = ++getEHRQueryValues.currPageSel;
                let ehrDataReq = {'data':getEHRQueryValues.queryData,'type':'EHRQueryReq','currPageSel':currPageSelVal};              
                let getEHRQueryValuesLoc = await getEHRQuery(ehrDataReq);
                displayTable(getEHRQueryValuesLoc);

                TableBtnEventHandlers();
            }
        },false);
    }

    function displayTable (formData) {
        var searchRes = formData.searchRes;
        var pages = formData.pageNumPaginate; 
        var tBody = document.getElementById("EHRSearchPatientResTBody");

        document.querySelectorAll('#pidPaginateStart').forEach(e => e.remove());

        var j = 1; 
        var k = 1;
        var l = 1;
        while (j <= pages){
            paginateli = `<li id ="pidPaginateStart" class="page-item ehr-pageitem  ${getEHRQueryValues.currPageSel == l++ ? 'active' : ''}"><a class="page-link ehr-pagecount" role="button" data-val="${k++}">${j++}</a></li>`;
            document.getElementById('paginateNextBtn').insertAdjacentHTML("beforebegin", paginateli);
        }

        function pageCountEvtListener () {
            var pageCountBtn = document.getElementsByClassName("ehr-pagecount");
            let lengthCountBtn = pageCountBtn.length;
            for (var i = 0; i < lengthCountBtn; i++) {
                pageCountBtn[i].addEventListener('click', async event => {
                    event.preventDefault();
                    let currPageSelVal = parseInt(event.target.dataset.val);
                    getEHRQueryValues.currPageSel = currPageSelVal;
                    let ehrDataReq = {'data':getEHRQueryValues.queryData,'type':'EHRQueryReq','currPageSel':currPageSelVal};         
                    let getEHRQueryValuesLoc = await getEHRQuery(ehrDataReq); 
                    displayTable(getEHRQueryValuesLoc);

                TableBtnEventHandlers();
                },false);
            }    
        }

        if(searchRes.length !=0 || searchRes.length != null) {
            while (tBody.firstChild) {
                tBody.removeChild(tBody.lastChild);
            }    
            for (var i = 0; i < searchRes.length; i++){
                var row = `<tr>
                            <td>${searchRes[i].lname}, ${searchRes[i].fname} ${searchRes[i].mname}</td>
                            <td class="EHRSearchData"></td>
                            <td class="text-center py-2 align-middle"><button class = "btn btn-primary btn-group btn-sm waves-effect EHRSearchBtn" data-pid = "${searchRes[i].pid}"><i class = "material-icons">visibility</i><span>View</span></button></td>
                           </tr>`
                tBody.innerHTML += row;
            }
        }

        for (var i = 0; i < searchRes.length; i++){
            switch (searchRes[i].dept) {
                case 1: document.getElementsByClassName('EHRSearchData')[i].innerHTML = 'College Department'; break; 
                case 2: document.getElementsByClassName('EHRSearchData')[i].innerHTML = 'Junior High School Department'; break; 
                case 3: document.getElementsByClassName('EHRSearchData')[i].innerHTML = 'Senior High School Department'; break; 
                case 4: document.getElementsByClassName('EHRSearchData')[i].innerHTML = 'Elementary Department'; break; 
                case 5: document.getElementsByClassName('EHRSearchData')[i].innerHTML = 'Institutional Staff / LAMPs'; break; 
                default: console.log('N/A'); break;
            }
        }

        if(tBody.rows.length <= 0) {
            document.getElementById('EHR_SearchShowDtls').hidden = 'true';
            document.getElementById('EHR_dataAll').reset();
        } 

        var searchResultCount = `Showing ${formData.pagePaginateStart}-${formData.searchRC} of ${formData.searchRC} results`;
        document.getElementById('EHRSearchPatientRC').innerText = searchResultCount;

        pageCountEvtListener();        
    }    

    function getPatientDataInit() {
        getPatienDataBtn();
    }
}

// Medical History - Get Appointment/Logs Data
function getAppointmentData() {
    getApptDataInit();
    function searchBtns () {
        var pagePrevBtn = document.getElementById("getApptSearchPaginatePrevBtn");
        var pageNextBtn = document.getElementById("getApptSearchPaginateNextBtn");   
        var appointmentSearchSubmit = document.getElementById('EHRHMApptSearchSubmit');

        // Appointment Search
        appointmentSearchSubmit.addEventListener('submit', async evt => {
            evt.preventDefault();

            document.querySelectorAll('#apptPaginateStart').forEach(e => e.remove());
            document.getElementById("EHRHMApptSearchPagination").hidden = false;

            var apptSearchSubmit = new FormData(appointmentSearchSubmit);  
            var apptData = Object.fromEntries(apptSearchSubmit); 
            let pid = sessionStorage.getItem("EHRactivepid_search");
            var dataReq = {'data':{'pid':pid,'query':apptData.query},'type':'getApptDataFromPID','currPageSel':1};

            apptDataRes = await getEHRQuery(dataReq);
            displayTable(apptDataRes);
            TableBtnEventHandlers();
        }); 
        
        pagePrevBtn.addEventListener('click', async evt => {
            evt.preventDefault();
            evt.stopImmediatePropagation();
            if (apptDataRes.currPageSel !== 1) {
                let pid = sessionStorage.getItem("EHRactivepid_search");
                let currPageSelVal = --apptDataRes.currPageSel;
                let ehrDataReq = {'data':{'pid':pid,'query':apptDataRes.query},'type':'getApptDataFromPID','currPageSel':currPageSelVal};              
                let apptDataResLoc = await getEHRQuery(ehrDataReq);
                displayTable(apptDataResLoc);
                TableBtnEventHandlers();
            }
        },false);

        pageNextBtn.addEventListener('click', async evt => {
            evt.preventDefault();
            evt.stopImmediatePropagation();           
            if (apptDataRes.currPageSel !== apptDataRes.pageNumPaginate) {
                let pid = sessionStorage.getItem("EHRactivepid_search");
                let currPageSelVal = ++apptDataRes.currPageSel;
                let ehrDataReq = {'data':{'pid':pid,'query':apptDataRes.query},'type':'getApptDataFromPID','currPageSel':currPageSelVal};              
                let apptDataResLoc = await getEHRQuery(ehrDataReq);
                displayTable(apptDataResLoc);
                TableBtnEventHandlers();
            }
        },false);
    }

    function displayTable (formData) {
        var searchRes = formData.searchRes;
        var pages = formData.pageNumPaginate; 
        var tBody = document.getElementById("EHRMHPatientLogsTableBody");
        document.querySelectorAll('#apptPaginateStart').forEach(e => e.remove());

        var j = 1; 
        var k = 1;
        var l = 1;

        while (j <= pages){
            paginateli = `<li id = "apptPaginateStart" class="page-item appt-pageitem ${apptDataRes.currPageSel == l++ ? 'active' : ''}"><a class="page-link appt-pagecount" role="button" data-val="${k++}">${j++}</a></li>`;
            document.getElementById('getApptSearchPaginateNextBtn').insertAdjacentHTML("beforebegin", paginateli);
        }

        function pageCountEvtListener () {
            var pageCountBtn = document.getElementsByClassName("appt-pagecount");
            let length = pageCountBtn.length;
            for (var i = 0; i < length; i++) {
                pageCountBtn[i].addEventListener('click', async event => {
                    event.preventDefault();  
                    let pid = sessionStorage.getItem("EHRactivepid_search");
                    let currPageSelVal = parseInt(event.target.dataset.val);
                    apptDataRes.currPageSel = currPageSelVal;
                    let ehrDataReq = {'data':{'pid':pid,'query':apptDataRes.query},'type':'getApptDataFromPID','currPageSel':currPageSelVal};         
                    let apptDataResLoc = await getEHRQuery(ehrDataReq); 
                    displayTable(apptDataResLoc);

                    TableBtnEventHandlers();
                },false);
            }
        }

        if(searchRes.length !=0 || searchRes.length != null) {
            while (tBody.firstChild) {
                tBody.removeChild(tBody.lastChild);
            }    
            for (var i = 0; i < searchRes.length; i++){
                var row = `<tr>
                            <td>${searchRes[i].appt_subject}</td>
                            <td class = "apptSearchData"</td>
                            <td>${searchRes[i].appt_datetime}</td>
                            <td class="text-center align-middle"><div class="btn-group btn-sm" role="group">
                            <a type = "button" class = "btn btn-secondary btn-sm waves-effect apptSearchView" data-value = "${searchRes[i].appt_uuid}"><i class = "material-icons">visibility</i></a>
                            </div>
                            </td>
                           </tr>`
                tBody.innerHTML += row;
            }
        }
        if(tBody.rows.length <= 0) {

        } 

        for (var i = 0; i < searchRes.length; i++){
            switch (parseInt(searchRes[i].appt_type)) {
                case 1: document.getElementsByClassName('apptSearchData')[i].innerHTML = 'Visitation'; break; 
                case 2: document.getElementsByClassName('apptSearchData')[i].innerHTML = 'Checkup'; break; 
                case 3: document.getElementsByClassName('apptSearchData')[i].innerHTML = 'Admission'; break; 
                case 4: document.getElementsByClassName('apptSearchData')[i].innerHTML = 'Other'; break; 
                default: document.getElementsByClassName('apptSearchData')[i].innerHTML = 'N/A'; break;
            };
        }

        var searchResultCount = `Showing ${formData.pagePaginateStart}-${apptDataRes.searchRC} of ${apptDataRes.searchRC} results`;
        document.getElementById('EHRHMApptSearchStats').innerText = searchResultCount;
        pageCountEvtListener();
    }    

    function getApptDataInit() {
        searchBtns();
    }
}

/*(END) ==================== CRUD FUNCTIONS ==================== (END)*/

/*==================== ASYNC FUNCTIONS ====================*/

// EHR Fetch to PHP/Database (EHRsearch.qry.php) 
async function getEHRQuery (data) {
    let url = "../query/EHRsearch.qry.php";
    try {
        var EHRdataReq  = await fetch(url,{
            method: "POST", 
            headers: {"Content-Type": "application/json",},
            body: JSON.stringify(data),
        })
        var EHRdataRes = await EHRdataReq.json();
        return EHRdataRes;
    }
    catch (error) {
        console.log(error);
    }
}

async function getApptDataQuery (data) {
    let url = "../query/appointments.qry.php";
    try {
        var ApptdataReq  = await fetch(url,{
            method: "POST", 
            headers: {"Content-Type": "application/json",},
            body: JSON.stringify(data),
        })
        var ApptdataRes = await ApptdataReq.json();
        return ApptdataRes;
    }
    catch (error) {
        console.log(error);
    }
}


/*(END) ==================== ASYNC FUNCTIONS ==================== (END)*/

/*==================== MISC / INITALIZER FUNCTIONS ====================*/

/**
 * CSV to JSON reader by matthew-e-brown (https://stackoverflow.com/users/10549827/matthew-e-brown)
 *
 * Takes a raw CSV string and converts it to a JavaScript object.
 * @param {string} text The raw CSV string.
 * @param {string[]} headers An optional array of headers to use. If none are
 * given, they are pulled from the first line of `text`.
 * @param {string} quoteChar A character to use as the encapsulating character.
 * @param {string} delimiter A character to use between columns.
 * @returns {object[]} An array of JavaScript objects containing headers as keys
 * and row entries as values.
 */
function csvToJson(text, headers, quoteChar = '"', delimiter = ',') {
  const regex = new RegExp(`\\s*(${quoteChar})?(.*?)\\1\\s*(?:${delimiter}|$)`, 'gs');
  const match = line => [...line.matchAll(regex)]
    .map(m => m[2])  // we only want the second capture group
    .slice(0, -1);   // cut off blank match at the end

  const lines = text.split('\n');
  const heads = headers ?? match(lines.shift());

  return lines.map(line => {
    return match(line).reduce((acc, cur, i) => {
      // Attempt to parse as a number; replace blank matches with `null`
      const val = cur.length <= 0 ? null : Number(cur) || cur;
      const key = heads[i] ?? `extra_${i}`;
      return { ...acc, [key]: val };
    }, {});
  });
}

function importCSVData () {
    var CSVInput = document.querySelector('input[type="file"]');
    const reader = new FileReader();

    if(CSVInput.files[0] == null || CSVInput.files[0] == '' || CSVInput.files[0] == undefined) {
        var alertData = {'alertStatus':'warning', 'alertText':'No file attached. Please attach a file to upload!', 'alertIcon':'warning'};
        alertHandlerCSVUpload(alertData);
    }
    if(CSVInput.files[0].type !== 'application/vnd.ms-excel') {
        var alertData = {'alertStatus':'danger', 'alertText':'Invalid file type. Only .csv files are supported.', 'alertIcon':'cancel'};
        alertHandlerCSVUpload(alertData);
    }
    else {
        reader.readAsText(CSVInput.files[0]);       
        reader.onload = function() {
            var text = reader.result;
            var jsonText = csvToJson(text);
            setHealthRecordFromCsv(jsonText)
        }
    }

    async function setHealthRecordFromCsv (data) {
        let dataArray = {type: 'importFromCSV', data: data};
        let url = "../query/EHRsearch.qry.php";
        try {
            var EHRdataReq  = await fetch(url,{
                method: "POST", 
                headers: {"Content-Type": "application/json",},
                body: JSON.stringify(dataArray),
            })
            var EHRdataRes = await EHRdataReq.json();
            alertHandlerCSVUpload(EHRdataRes);
        }
        catch (error) {
            console.log(error);
        }
    }

    function alertHandlerCSVUpload (alertData) {
        document.getElementById('showAlertDivModal').innerHTML = [
            `<div class="alert alert-${alertData.alertStatus} d-flex align-items-center mt-4 rounded column-gap-2" role="alert">
                <i class = "material-icons">${alertData.alertIcon}</i>
                <div class = "fw-bolder" >${alertData.alertText}</div>
            </div>`
        ];
    }


}

function TableBtnEventHandlers() {
    var EHRPIDsearchView = document.getElementsByClassName('EHRSearchBtn');
    var EHRPIDsearchBtnLen = document.getElementsByClassName('EHRSearchBtn').length;

    // Patient Search
    for (var i = 0; i < EHRPIDsearchBtnLen; i++) {
        EHRPIDsearchView[i].addEventListener('click', async event => {
            event.preventDefault();
            let currPID = event.currentTarget.dataset.pid;
            let data = {'data':currPID, 'type':'EHRDivReq'};
            let queryValues = await getEHRQuery(data);
            ShowEHRDiv(queryValues);

        },false);
    }   

    //Appointment Search
    var EHRApptsearchView = document.getElementsByClassName('apptSearchView');
    var EHRApptsearchBtnLen = document.getElementsByClassName('apptSearchView').length;

    for (var i = 0; i < EHRApptsearchBtnLen; i++) {
        EHRApptsearchView[i].addEventListener('click', async event => {
            event.preventDefault();
            let apptUUID = event.currentTarget.dataset.value;
            // Page redirection
            window.location.replace(`./appointments.php?action=getapptdata&uuid=${apptUUID}`)

        },false);
    }   
}


async function windowListener () {
    getQueryString = new URLSearchParams(window.location.search);
    if (getQueryString.get('action') === 'getpatientdata') {
        let pid = getQueryString.get('pid');
        let data = {'data':pid, 'type':'EHRDivReq'}
        let pidData = await getEHRQuery(data);
        ShowEHRDiv(pidData);
    }
}

function ModalAndAlertPopups (data) {
    let alertType = data.alertinfo.alertType;
    let dataIcon = data.alertinfo.dataIcon;
    let dataText = data.alertinfo.dataText;

    switch(data.alerttype){
        case 'EHRQueryUpdSuccess' : ehrDIVAlert(alertType,dataIcon,dataText) ; break;
        case 'EHRQueryUpdFail': ehrDIVAlert(alertType,dataIcon,dataText); break;
        default: break;
    }

    function ehrDIVAlert (alertType,dataIcon,dataText) {
        var viewEHRDivShow = document.getElementById('EHR_SearchShowDtlsShowAlert');
        var alertInner = 
        `<div class="mx-auto alert ${alertType} rounded d-flex align-items-center column-gap-2" style="width: 85%;">
            <i class = "material-icons">${dataIcon}</i>
            <span class = "fw-bolder">${dataText}</span>
        </div>`;
        viewEHRDivShow.innerHTML = alertInner;
    }
}

function patientManagmentInit () {
    getPatientData();
    getAppointmentData();
    EHRbtnEventListeners();
    windowListener();
    medicalHistoryModalBtnHandlers();
}

/*(END) ==================== MISC / INITALIZER FUNCTIONS ==================== (END)*/