let ntoken="";
function init()
{
  ntoken = token();
  let dayDate = new Date();
  currentDate[0] = dayDate.getDate();
  currentDate[1] = dayDate.getMonth();
  currentDate[2] = dayDate.getFullYear();

  updateCalendar();

  let  offset = new Date(currentDate[2], currentDate[1], 0).getDay();
  dateSel(currentDate[0]+offset-1);

  console.log("Init");
}
function updateCalendar()
{
  fetchMonthData(currentDate[1],currentDate[2]);
  document.getElementById('c_mothyear').textContent = currentDate[2]+ " "+monthNames[currentDate[1]];
  let days = new Date(currentDate[2], currentDate[1]+1, 0).getDate();
  let  offset = new Date(currentDate[2], currentDate[1], 0).getDay();
  for (var day = 0; day < 42; day++) {
    document.getElementById('d_'+(day)).style.backgroundColor  ="darkgray";
    document.getElementById('d_'+(day)).style.color  ="darkgray";
    document.getElementById('d_'+(day)).textContent ="";
    document.getElementById('d_'+(day)).style.borderColor ="White";

  }
  for (var day = 0; day < days; day++) {
    document.getElementById('d_'+(day+offset)).textContent = day+1;
    document.getElementById('d_'+(day+offset)).style.backgroundColor  ="Black";
    document.getElementById('d_'+(day+offset)).style.color  ="White";
    document.getElementById('d_'+(day+offset)).style.borderColor ="Black";
  }

  let date = new Date();
  if(currentDate[1]==date.getMonth() && currentDate[2]==date.getFullYear()){
    document.getElementById('d_'+(date.getDate()+offset-1)).style.borderColor ="Red";
  }
}

function navMonth(step)
{
  currentDate[1]+=step;
  if(currentDate[1]==12)
  {
    currentDate[2]++;
    currentDate[1]=0;
  }
  if(currentDate[1]==-1)
  {
    currentDate[2]--;
    currentDate[1]=11;
  }
  updateCalendar();
}

function dateSel(day)
{
  let  offset = new Date(currentDate[2], currentDate[1], 0).getDay();
  let days = new Date(currentDate[2], currentDate[1]+1, 0).getDate();
  currentDate[0] = day-offset+1;
  if(currentDate[0] >= 1 && currentDate[0]<=days){
    fetchDayData(currentDate[0],currentDate[1],currentDate[2]);
    document.getElementById('c_activedate').textContent =currentDate[0]+". "+monthNames[currentDate[1]]+" "+ currentDate[2];
    document.getElementById('null_entry').action ="php/calender_edit.php?date="+currentDate[2]+"."+(currentDate[1]+1)+"."+currentDate[0];
  }

}



function downloadDayData(day,month,year) {
    var httprequest = new XMLHttpRequest();
    return new Promise(function(resolve, reject) {
        httprequest.onreadystatechange = function() {
            if (httprequest.readyState == 4) {
                if (httprequest.status >= 300) {
                    reject(httprequest.status)
                } else {
                    resolve(JSON.parse(httprequest.responseText));
                }
            }
        }
        httprequest.open('get', 'https://www.ini02.xyz/manager/php/calender_fetch.php?d='+day+'&m='+(month+1)+'&y='+year+'&token='+ntoken, true);
        httprequest.send();
    });
}

async function  fetchDayData(day,month,year)
{

  downloadDayData(day,month,year).then(function(result) {
    while (document.getElementById("c_container").firstChild) {
        document.getElementById("c_container").removeChild(document.getElementById("c_container").firstChild);
    }
    for (var index = 0; index < result.length; index++) {
      var celement = document.getElementById("null_entry").cloneNode(true);
      celement.action ="php/calender_edit.php?date="+currentDate[2]+"."+(currentDate[1]+1)+"."+currentDate[0]+"&id="+result[index]["ID"];
      celement.getElementsByClassName('c_text')[0].value = result[index]["TEXT"];
      celement.getElementsByClassName('c_prio')[0].value = result[index]["CAT"];
      document.getElementById("c_container").appendChild(celement);
    }
  }, function(error) {

  })

}

function downloadMonthData(month,year) {
    var httprequest = new XMLHttpRequest();
    return new Promise(function(resolve, reject) {
        httprequest.onreadystatechange = function() {
            if (httprequest.readyState == 4) {
                if (httprequest.status >= 300) {
                    reject(httprequest.status)
                } else {
                    resolve(JSON.parse(httprequest.responseText));
                }
            }
        }
        httprequest.open('get', 'https://www.ini02.xyz/manager/php/calender_fetch.php?m='+(month+1)+'&y='+year+'&token='+ntoken, true);
        httprequest.send();
    });
}

async function  fetchMonthData(month,year)
{
    downloadMonthData(month,year).then(function(result) {
      for (var index = 0; index < result.length; index++) {
        let  offset = new Date(currentDate[2], currentDate[1], 0).getDay();
        let date = new Date(result[index]["DATE"]).getDate()+offset-1;
        document.getElementById("d_"+date).style.backgroundColor = colortable[result[index]["CAT"]];
        document.getElementById('d_'+date).style.borderColor =colortable[result[index]["CAT"]];
      }
    }, function(error) {

    })

}
