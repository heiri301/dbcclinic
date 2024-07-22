dashboardInit();

function timeDateDiv(){
    function displayTime () {
        var displayClock = new Date().toLocaleTimeString();
        document.getElementById('dashBShowTime').innerHTML = displayClock; 
    }

    function displayDate () {
        var displayDate = new Date()
        var DisplayDateNum = displayDate.toLocaleDateString();
        var currMonth = displayDate.getMonth();
        var currDay = displayDate.getDay();
        var currDate = displayDate.getDate();
        var displayDateMonths = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        var displayDateDays = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        var displayDateWordForm = `${displayDateDays[currDay]}, ${displayDateMonths[currMonth]} ${currDate}`;
        
        document.getElementById('dashBShowDate').innerHTML = DisplayDateNum;
        document.getElementById('dashBShowDate2').innerHTML = displayDateWordForm;
    }
    displayTime();
    displayDate();
    setInterval(displayTime,1000);
}

function databaseRequest () {

}

function quickActions () {

}

function chartsColorGenerator () {

}

function chartsDivBtnHandler () {
    // DIV
    var chartCanvas = document.getElementById('mainpageChartDiv');
    var chartTitle = document.getElementById('mainpageChartTitle');
    var expandChartBtn = document.getElementById('expandChartBtn');

    // Nav Buttons
    var chartPatientData = document.getElementById('chartPatientData');
    var chartLogTypes = document.getElementById('chartLogTypes');
    var chartPatientTypes = document.getElementById('chartPatientTypes');
    
    expandChartBtn.addEventListener('click', evt => {
        evt.preventDefault();
    }, true);

    chartPatientData.addEventListener('click', evt => {
        evt.preventDefault();   
        let chartStatus = Chart.getChart(chartCanvas);
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }  
        chartTitle.innerHTML = "Chart Patient Data";

        let type = 'doughnut';
        const pieChartData = {
            labels: [
                'Allergy - Food', // autopopulate array from db 
                'Allergy - Drugs',
                'Asthma',
                'Anemia',
                'Bleeding Problems',
                'Behavioral Problems',
                'Hearing Problems',
                'Speech Problems',
                'Visual Problems',
                'Recurrent Indigestion',
                'Jaundice',
                'Eating Disorder',
                'Chicken Pox',
            ],
            datasets: [{
                label: [
                    'Amount of Patients', // autopopulate array from db 
                ],
                data: [2, 20, 25, 9, 3, 5, 33, 4, 0, 1, 4, 4, 9], // autopopulate array from db
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(122, 222, 235)',
                'green',
                'purple',
                'red',
                'orange',
                'violet',
                'dark-green',
                'dark-red',
                'pink',
                'indigo',
                ],
                hoverOffset: 4
            }]
        };
     
        createChart(chartCanvas,pieChartData,type);
    }, false);

    chartLogTypes.addEventListener('click', evt => {
        evt.preventDefault();
        let chartStatus = Chart.getChart(chartCanvas);
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }
        chartTitle.innerHTML = "Chart Log Types";
        
        let type = 'doughnut';
        const pieChartData = {
            labels: [
                'Visitation', // autopopulate array from db 
                'Checkup',
                'Admission',
                'Other',
            ],
            datasets: [{
                label: [
                    'Amount of Patients', // autopopulate array from db 
                ],
                data: [10, 6, 4, 4,], // autopopulate array from db
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(122, 222, 235)',
                'green',
                'purple',
                'red',
                'orange',
                'violet',
                'dark-green',
                'dark-red',
                'pink',
                'indigo',
                ],
                hoverOffset: 4
            }]
        };
     
        createChart(chartCanvas,pieChartData,type);

    }, false);

    chartPatientTypes.addEventListener('click', evt => {
        evt.preventDefault();
        let chartStatus = Chart.getChart(chartCanvas);
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }
        chartTitle.innerHTML = "Chart Patient Types";

        let type = 'doughnut';
        const pieChartData = {
            labels: [
                'College Dept', // autopopulate array from db 
                'Junior High School Dept',
                'Senior High School Dept',
                'Elementary Dept',
                'Institutional Staff / LAMPs',
            ],
            datasets: [{
                label: [
                    'Amount of Patients', // autopopulate array from db 
                ],
                data: [15, 4, 3, 22, 9], // autopopulate array from db
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(122, 222, 235)',
                'green',
                'purple',
                'red',
                'orange',
                'violet',
                'dark-green',
                'dark-red',
                'pink',
                'indigo',
                ],
                hoverOffset: 4
            }]
        };
     
        createChart(chartCanvas,pieChartData,type);
    }, false);
}

function createChart (div,data,type) {
    dashboardChart = new Chart(div, {
        options: {
            maintainAspectRatio: true,
            aspectRatio: 1 | 1,
        },
        type: type,
        data: data
    });
}

function dashboardInit(){
    chartsDivBtnHandler();
    quickActions();
    timeDateDiv();
}