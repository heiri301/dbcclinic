/*
    TODO:
    - Clear Form data whenever an action is accomplished
    - check deletion if only single user remains 

*/
// initialize function
appointmentsInit();

function tinymceStart () {
    tinymce.init({
        selector: 'textarea#appt_notes',
        license_key: 'gpl',
        plugins: 'image link insertdatetime fullscreen emoticons',
        file_picker_types: 'image',
        images_upload_base_path: '../data/media/tinymce', // folder for tinymce files
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | insertdatetime emoticons | image link | fullscreen',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        promotion: false
    });
}

// Appointment form Button handlers
function apptFormButtonHandlers() {
    // Quick Action Buttons
    var QASetAppointmentBtn = document.getElementById('apptQASchedAppointmentBtn');
    // Appointment form DIV 
    var appointmentFormDiv = document.getElementById('setApptForm');
    var closeAppointmentFormBtn = document.getElementById('setApptBodybtnClose');
    var searchPIDAppointmentFormBtn = document.getElementById('apptPatientSearchBtn');
    
        QASetAppointmentBtn.addEventListener('click', evt=> {
            evt.preventDefault();
            document.getElementById('appt_pid').removeAttribute("data-uuid");
            appointmentFormDiv.reset();
            document.getElementById('setApptDiv').hidden = false;
            document.getElementById('setApptDivHeader').innerText = 'Add New Patient Log';
            document.getElementById('setApptBodybtnSubmit').innerText = 'Submit';
            document.getElementById('setApptDiv').scrollIntoView();

            tinymce.get("appt_notes").setContent("Insert your text here...");

            apptFormSetForm();
            QASetAppointmentBtn.classList.add('disabled');
        },false);

        // Appointment Data Submission & Update
        appointmentFormDiv.addEventListener('submit', evt => {
            evt.preventDefault();
            let appt = new FormData(appointmentFormDiv);  
            let apptData = Object.fromEntries(appt);
            createUpdateAppointmentData(apptData);
        }); 

        // Close Appointment Form Btn

        closeAppointmentFormBtn.addEventListener('click', evt => {
            evt.preventDefault();
            appointmentFormDiv.reset();
            document.getElementById('setApptDiv').hidden = true;
            document.getElementById('apptQASchedAppointmentBtn').classList.remove('disabled');
            document.getElementById('apptSearchDiv').scrollIntoView();
        });


        // PID Lookup

        searchPIDAppointmentFormBtn.addEventListener('click', evt => {
            evt.preventDefault();
            new bootstrap.Modal(document.getElementById('apptSearchPatientModal')).show();
            getPatientPid();
        });

}

/*==================== ASYNC FUNCTIONS ====================*/

// ApptData Search
async function getApptDataQuery (data) {
    let url = "../query/appointments.qry.php";
    try {
        var reqAppt  = await fetch(url,{
            method: "POST", 
            headers: {"Content-Type": "application/json",},
            body: JSON.stringify(data),
        })
        var resAppt = await reqAppt.json();
        return resAppt; // you can call this function by async return call instead of copypasting the entire function code.
    }
    catch (error) {
        console.log(error);
    }
}

// PID Search
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

/*==================== ASYNC FUNCTIONS (END) ====================*/

/*==================== CRUD ====================*/

// Set Appointment & Scheduler Entry (Buttons)
function apptFormSetForm () {
    // set current datetime (note: should follow MySQL time format - YYYY-MM-DD hh:mm:ss)
    var dateSet = new Date();
    var currHour = ("0" + dateSet.getHours()).slice(-2);
    var currMinute = ("0" + dateSet.getMinutes()).slice(-2);
    var currSecs = ("0" + dateSet.getSeconds()).slice(-2); 

    var currYr = ("0" + dateSet.getFullYear()).slice(-4);
    var currMonth = dateSet.getMonth()+1;
    var currMonth = ("0" + currMonth).slice(-2);
    var currDay = ("0" + dateSet.getDate()).slice(-2);
    
    
    var currTime = `${currHour}:${currMinute}:${currSecs}`;
    var currentDate = `${currYr}-${currMonth}-${currDay}`;

    document.getElementById('appt_time').value = currTime;
    document.getElementById('appt_date').value = currentDate;
}

// Set Appointment & Scheduler Entry (From Table)
async function apptFormSetFormFromUUID (data) {
    document.getElementById('setApptDiv').scrollIntoView();
    document.getElementById('apptQASchedAppointmentBtn').classList.add('disabled');
    document.getElementById('setApptDivHeader').innerText = 'Update Patient Log';
    document.getElementById('setApptBodybtnSubmit').innerText = 'Update Data';
    
    if (document.getElementById('setApptDiv').hidden == true) {
        document.getElementById('setApptDiv').hidden = false;
    }

    let dateTime = data.appt_datetime.split(" ");
    var dataCurrDate = `${dateTime[0]}`;
    var dataCurrTime = `${dateTime[1]}`;
    var dataFullNamePIDReq = {'data':data.pid,'type':'EHRDivReq'};
    var dataFullNamePID = await getEHRQuery(dataFullNamePIDReq);
    
    const apptPatientInfoFullName = dataFullNamePID.lname.concat(", ",dataFullNamePID.fname," ",dataFullNamePID.mname);
    
    document.getElementById('appt_pid').value = apptPatientInfoFullName;
    document.getElementById('appt_time').value = dataCurrTime;
    document.getElementById('appt_date').value = dataCurrDate;
    document.getElementById('appt_type').value = data.appt_type;
    document.getElementById('appt_subject').value = data.appt_subject;
    tinymce.get("appt_notes").setContent(data.appt_notes);

    document.getElementById('appt_date').setAttribute("data-datetime",data.appt_datetime);
    document.getElementById('appt_pid').setAttribute('data-uuid',data.appt_uuid); 
    document.getElementById('appt_pid').setAttribute("data-pid",data.pid);
    
    // Data only allowed to be updated are Notes and Subject
    // Original timedate will be kept as it is and in place appt_modifiedtimedate will be used as a reminder that the appointment form has been updated. (PLANNED) 
    // Actual Data submission (eg. button click will be handled by the Event Listener Buttons).
    document.getElementById('setApptDiv').scrollIntoView();
}

// Set appointment data to database
async function createUpdateAppointmentData (data) {
    var patientId = document.getElementById('appt_pid').dataset.pid;
    var uuid = document.getElementById('appt_pid').dataset.uuid;
    var notesData = tinymce.get("appt_notes").getContent();
    
    if (uuid == null || uuid == undefined) {
        let dataReq = {
            'data':{
                'appt_datetime':`${data.appt_date} ${data.appt_time}`,
                'appt_pid':patientId,
                'appt_notes':notesData,
                'appt_subject':data.appt_subject,
                'appt_type':data.appt_type,
            },
            'type':'ApptDataSet'
            
        };
        if(dataReq.data.appt_pid == '' || dataReq.data.appt_pid == 'null'|| dataReq.data.appt_pid == undefined) {
            let appt_pidshowWarning = {
                'alerttype':'apptSetMissingPID',
                'alertinfo': {
                    'alertType': 'alert-danger',
                    'dataIcon' : 'cancel',
                    'dataText' : 'Patient Name must not be empty.',
                }
            }
            ModalAndAlertPopups(appt_pidshowWarning);        
        }
        else {
            let alertData = await getApptDataQuery(dataReq);
            ModalAndAlertPopups(alertData);
        }
    }   
    else {
        let dataReq = {
            'data':{
                'appt_datetime':`${data.appt_date} ${data.appt_time}`,
                'appt_pid':patientId,
                'appt_notes':notesData,
                'appt_subject':data.appt_subject,
                'appt_type':data.appt_type,
                'appt_uuid':uuid
            },
            'type':'ApptDataUpdate'
        };
        let alertData = await getApptDataQuery(dataReq);
        ModalAndAlertPopups(alertData);
    }
    
}

// Get and Display Appointment Data in Table
function getAppointmentData() {
    getPatientDataInit();
    function searchBtns () {
        var pagePrevBtn = document.getElementById("getApptSearchPaginatePrevBtn");
        var pageNextBtn = document.getElementById("getApptSearchPaginateNextBtn");   
        var appointmentSearchSubmit = document.getElementById('EHR_AppointmentSearch');

        // Appointment Search
        appointmentSearchSubmit.addEventListener('submit', async evt => {
            evt.preventDefault();
            document.querySelectorAll('.ehr-pageitem').forEach(e => e.remove());
            document.getElementById("ApptSearchPagination").hidden = false;

            var apptSearchSubmit = new FormData(appointmentSearchSubmit);  
            var apptData = Object.fromEntries(apptSearchSubmit); 
            var dataReq = {'data':apptData.query,'type':'ApptSearch','currPageSel':1};
           
            apptDataRes = await getApptDataQuery(dataReq);

            displayTable(apptDataRes);
            TableBtnEventHandlers();
        }); 
        
        pagePrevBtn.addEventListener('click', async evt => {
            evt.preventDefault();
            evt.stopImmediatePropagation();
            if (apptDataRes.currPageSel !== 1) {
                let currPageSelVal = --apptDataRes.currPageSel;
                let ehrDataReq = {'data':apptDataRes.queryData,'type':'ApptSearch','currPageSel':currPageSelVal};              
                let apptDataResLoc = await getApptDataQuery(ehrDataReq);
                displayTable(apptDataResLoc);
                TableBtnEventHandlers();
            }
        },false);

        pageNextBtn.addEventListener('click', async evt => {
            evt.preventDefault();
            evt.stopImmediatePropagation();
            if (apptDataRes.currPageSel !== apptDataRes.pageNumPaginate) {
                let currPageSelVal = ++apptDataRes.currPageSel;
                let ehrDataReq = {'data':apptDataRes.queryData,'type':'ApptSearch','currPageSel':currPageSelVal};              
                let apptDataResLoc = await getApptDataQuery(ehrDataReq);
                displayTable(apptDataResLoc);
                TableBtnEventHandlers();
            }
        },false);
    }

    function displayTable (formData) {
        var searchRes = formData.searchRes;
        var pages = formData.pageNumPaginate; 
        var tBody = document.getElementById("getApptSearchTableBody");
        document.querySelectorAll('.appt-pageitem').forEach(e => e.remove());

        var j = 1; 
        var k = 1;
        var l = 1;

        while (j <= pages){
            paginateli = `<li class="page-item appt-pageitem ${apptDataRes.currPageSel == l++ ? 'active' : ''}"><a class="page-link appt-pagecount" role="button" data-val="${k++}">${j++}</a></li>`;
            document.getElementById('getApptSearchPaginateNextBtn').insertAdjacentHTML("beforebegin", paginateli);
        }

        function pageCountEvtListener () {
            var pageCountBtn = document.getElementsByClassName("appt-pagecount");
            let length = pageCountBtn.length;
            for (var i = 0; i < length; i++) {
                pageCountBtn[i].addEventListener('click', async event => {
                    event.preventDefault();  
                    let currPageSelVal = parseInt(event.target.dataset.val);
                    apptDataRes.currPageSel = currPageSelVal;
                    let ehrDataReq = {'data':apptDataRes.queryData,'type':'ApptSearch','currPageSel':currPageSelVal};         
                    let apptDataResLoc = await getApptDataQuery(ehrDataReq); 
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
                            <td>${searchRes[i].appt_datetime}</td>
                            <td class = "apptSearchData"></td>
                            <td class="text-center align-middle"><div class="btn-group btn-sm" role="group">
                            <a type = "button" class = "btn btn-primary btn-sm waves-effect apptSearchEdit" data-value = "${searchRes[i].appt_uuid}"><i class = "material-icons">edit</i></a>
                            <a class = "btn btn-danger btn-sm waves-effect EHRSearchBtn apptSearchDel" data-value = "${searchRes[i].appt_uuid}"><i class = "material-icons">delete</i></a>
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
        document.getElementById('searchApptShowStats').innerText = searchResultCount;
        pageCountEvtListener();
    }    

    function getPatientDataInit() {
        searchBtns();
    }
}

// Search and Get Patient Info (pid)
function getPatientPid() {
    getPatientDataInit();
    function getPatienDataBtn () {
        var EHRsearchSubmit = document.getElementById('apptSearchPatientForm');
        var pagePrevBtn = document.getElementById("paginatePrevBtn");
        var pageNextBtn = document.getElementById("paginateNextBtn");   

        EHRsearchSubmit.addEventListener('submit', async evt => {
            evt.preventDefault();
            document.querySelectorAll('.ehr-pageitem').forEach(e => e.remove());
            document.getElementById("pidSearchPagination").hidden = false;

            var EHRDataSubmit = new FormData(document.querySelector("#apptSearchPatientForm"))  
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
        var tBody = document.getElementById("apptSearchPatientBodyInner");
        document.querySelectorAll('.ehr-pageitem').forEach(e => e.remove());

        var j = 1; 
        var k = 1;
        var l = 1;

        while (j <= pages){
            paginateli = `<li class="page-item ehr-pageitem ${getEHRQueryValues.currPageSel == l++ ? 'active' : ''}"><a class="page-link ehr-pagecount" role="button" data-val="${k++}">${j++}</a></li>`;
            document.getElementById('paginateNextBtn').insertAdjacentHTML("beforebegin", paginateli);
        }

        function pageCountEvtListener () {
            var pageCountBtn = document.getElementsByClassName("ehr-pagecount");
            let length = pageCountBtn.length;
            for (var i = 0; i < length; i++) {
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
                            <td class = 'apptPIDDept'></td>
                            <td class="text-center align-middle "><div class="btn-group btn-sm" role="group">
                            <a type = "button" class = "btn btn-primary btn-sm waves-effect apptSearchPIDAdd" data-value = "${searchRes[i].pid}"><i class = "material-icons">add</i></a>
                            <a class = "btn btn-secondary btn-sm waves-effect EHRSearchBtn apptSearchPIDView" data-value = "${searchRes[i].pid}"><i class = "material-icons">visibility</i></a>
                            </div>
                            </td>
                           </tr>`
                tBody.innerHTML += row;
            }
        }
        if(tBody.rows.length <= 0) {

        } 

        for (var i = 0; i < searchRes.length; i++){
            switch (searchRes[i].dept) {
                case 1: document.getElementsByClassName('apptPIDDept')[i].innerHTML = 'College Department'; break; 
                case 2: document.getElementsByClassName('apptPIDDept')[i].innerHTML = 'Junior High School Department'; break; 
                case 3: document.getElementsByClassName('apptPIDDept')[i].innerHTML = 'Senior High School Department'; break; 
                case 4: document.getElementsByClassName('apptPIDDept')[i].innerHTML = 'Elementary Department'; break; 
                case 5: document.getElementsByClassName('apptPIDDept')[i].innerHTML = 'Institutional Staff / LAMPs'; break; 
                default: console.log('N/A'); break;
            }
        }

        var searchResultCount = `Showing ${formData.pagePaginateStart}-${formData.searchRC} of ${formData.searchRC} results`;
        document.getElementById('apptSearchPatientShowStats').innerText = searchResultCount;
        pageCountEvtListener();
    }    

    function getPatientDataInit() {
        getPatienDataBtn();
    }
}

// Delete Appointment Data
function deleteAppointmentData (appt_uuid) {
    let modalTriggerDiv = document.getElementsByClassName('apptModalPopUp')[0];
    let modal = `
        <div class="modal fade" id="confirmDeletionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content rounded-2">
                <div class="row modal-header text-center">
                    <i class = "h1 material-icons">delete</i>
                    <span class = "h3 text-center"><strong>Delete Data?</strong></span>
                </div>
                <div class="modal-body text-center">
                    <strong>Confirm data deletion? Changes are irreversible.</strong>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary btn-lg waves-effect" data-bs-dismiss="modal">No</button>
                    <button type="button" id = "deleteApptConfirmed" class="btn btn-danger btn-lg waves-effect">Yes</button>
                </div>
            </div>
        </div>
    </div>
    `

    modalTriggerDiv.innerHTML = modal;
    let newModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('confirmDeletionModal'));
    let deleteApptConfirmed = document.getElementById('deleteApptConfirmed');
    newModal.show();

    deleteApptConfirmed.addEventListener('click', evt => {
        evt.preventDefault();

        let data = {'data':appt_uuid.data, 'type':'ApptDataDelete'};
        getApptDataQuery(data);
        
        newModal.hide();
    });
}


/*==================== CRUD (END) ====================*/

/*==================== MISC FUNCTIONS ====================*/
function validateFormData () {

}

// Table Selectors Classes
function TableBtnEventHandlers() {
    var apptPIDsearchAdd = document.getElementsByClassName('apptSearchPIDAdd');
    var apptPIDsearchView = document.getElementsByClassName('apptSearchPIDView');
    var apptPIDsearchBtnLen = document.getElementsByClassName('apptSearchPIDView').length;

    // Patient Search
    for (var i = 0; i < apptPIDsearchBtnLen; i++) {
        apptPIDsearchAdd[i].addEventListener('click', async event => {
            event.preventDefault();
            let currPID = event.currentTarget.dataset.value;
            let data = {'data':currPID, 'type':'EHRDivReq'}
            let queryValues = await getEHRQuery(data);
            addPIDtoApptForm(queryValues);

            // get PID and Include to Appointment Form
            function addPIDtoApptForm (data) {
                const apptPatientInfoFullName = data.lname.concat(", ",data.fname," ",data.mname);
    
                document.getElementById('appt_pid').value = apptPatientInfoFullName;
                document.getElementById('appt_pid').setAttribute("data-pid",data.pid);

                const closeModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('apptSearchPatientModal'));
                closeModal.hide();
            }

        },false);
    }   

    for (var i = 0; i < apptPIDsearchBtnLen; i++) {
        apptPIDsearchView[i].addEventListener('click', async event => {
            event.preventDefault();
            let currPID = event.currentTarget.dataset.value;
            // Page redirection
            window.location.replace(`./managepatient.php?action=getpatientdata&pid=${currPID}`)

        },false);
     }


    // Appointment Search
    var apptSearchEdit = document.getElementsByClassName('apptSearchEdit');
    var apptSearchDel = document.getElementsByClassName('apptSearchDel');
    var apptSearchTableLength = document.getElementsByClassName('apptSearchEdit').length;

    for (var i = 0; i < apptSearchTableLength; i++) {
        apptSearchEdit[i].addEventListener('click', async event => {
            event.preventDefault();

            let currApptUUID = event.currentTarget.dataset.value;
            let data = {'data':currApptUUID, 'type':'ApptGetDataUUID'}

            let apptData = await getApptDataQuery(data);
            
            apptFormSetFormFromUUID(apptData);
        },false);
    }   

    for (var i = 0; i < apptSearchTableLength; i++) {
        apptSearchDel[i].addEventListener('click', async event => {
            event.preventDefault();
            let currApptUUID = event.currentTarget.dataset.value;
            let data = {'data':currApptUUID, 'type':'ApptGetDataUUID'};
            deleteAppointmentData(data);
        },false);
    }   
}

function ModalAndAlertPopups (data) {
    let alertType = data.alertinfo.alertType;
    let dataIcon = data.alertinfo.dataIcon;
    let dataText = data.alertinfo.dataText;

    switch(data.alerttype){
        case 'apptSetSuccess' : apptDivAlert(alertType,dataIcon,dataText) ; break;
        case 'apptSetFail': apptDivAlert(alertType,dataIcon,dataText); break;
        case 'apptUpdSuccess' : apptDivAlert(alertType,dataIcon,dataText) ; break;
        case 'apptUpdFail': apptDivAlert(alertType,dataIcon,dataText); break;
        case 'apptSetMissingPID':apptDivAlert(alertType,dataIcon,dataText); break;
        default: break;
    }

    function apptDivAlert (alertType,dataIcon,dataText) {
        var viewEHRDivShow = document.getElementById('setApptBodyDtlsShowAlert');
        var alertInner = 
        `<div class="mx-auto alert ${alertType} rounded d-flex align-items-center column-gap-2" style="width: 85%;">
            <i class = "material-icons">${dataIcon}</i>
            <span class = "fw-bolder">${dataText}</span>
        </div>`;
        viewEHRDivShow.innerHTML = alertInner;
    }
}

async function windowListener () {
    getQueryString = new URLSearchParams(window.location.search);
    if (getQueryString.get('action') === 'getapptdata') {
        let uuid = getQueryString.get('uuid');
        let data = {'data':uuid, 'type':'ApptGetDataUUID'}
        let apptData = await getApptDataQuery(data);
        apptFormSetFormFromUUID(apptData);
    }
}



/*(END) ==================== MISC FUNCTIONS ==================== (END)*/

function appointmentsInit() {
    TableBtnEventHandlers();
    apptFormButtonHandlers();
    tinymceStart();
    getAppointmentData();
    windowListener();
}
