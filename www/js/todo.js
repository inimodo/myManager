let showDos = true;
let upper,uset = false,lower,lset=false;
let ntoken="";
function init()
{
  ntoken = token();
  let dayDate = new Date();
  currentDate[0] = dayDate.getDate();
  currentDate[1] = dayDate.getMonth();
  currentDate[2] = dayDate.getFullYear();

  upper = new Date(currentDate[2], currentDate[1], currentDate[0]);
  lower = new Date(currentDate[2], currentDate[1], currentDate[0]);

  updateCalendar();
  switchView(true);
}
function updateCalendar()
{
  let slower = lower.getDate()+"."+(lower.getMonth()+1)+"."+lower.getFullYear();
  let supper = upper.getDate()+"."+(upper.getMonth()+1)+"."+upper.getFullYear();
  document.getElementById('t_time').textContent=slower+" bis Deadline am "+supper;

  slower = lower.getFullYear()+"."+(lower.getMonth()+1)+"."+lower.getDate();
  supper = upper.getFullYear()+"."+(upper.getMonth()+1)+"."+upper.getDate();
  document.getElementById('t_editor').action ="php/todo_edit.php?lower="+slower+"&upper="+supper;
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

  if(currentDate[1]==upper.getMonth() && currentDate[2]==upper.getFullYear()){
    document.getElementById('d_'+(upper.getDate()+offset-1)).style.backgroundColor =colortable["Deadline"];
    document.getElementById('d_'+(upper.getDate()+offset-1)).style.borderColor =colortable["Deadline"];
  }
  if(currentDate[1]==lower.getMonth() && currentDate[2]==lower.getFullYear()){
    document.getElementById('d_'+(lower.getDate()+offset-1)).style.backgroundColor ="#2b86a8";
    document.getElementById('d_'+(lower.getDate()+offset-1)).style.borderColor ="#2b86a8";
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
  let selday= day-offset+1;
  if(selday >= 1 && selday <=days){
    let today = new Date(currentDate[2], currentDate[1], currentDate[0]);
    let seldate = new Date(currentDate[2],currentDate[1],selday);

    if(uset == false && Date.parse(seldate) > Date.parse(lower))
    {
      upper = seldate;
      uset = true;
    }else if(lset == false && Date.parse(seldate) < Date.parse(upper))
    {
      lower = seldate;
      lset = true;
    }else{
      if(uset == true && Date.parse(seldate) == Date.parse(upper))
      {
        upper = today;
        uset = false;
      }else if(lset == true && Date.parse(seldate) == Date.parse(lower))
      {
        lower = today;
        lset = false;
      }
    }
    updateCalendar();
  }

}

function switchView(state) {
  fetchList();
  showDos = state;
  if(showDos)
  {
    document.getElementById('t_navi_active').style.backgroundColor ="White";
    document.getElementById('t_navi_active').style.borderColor ="White";
    document.getElementById('t_navi_active').style.color ="Black";

    document.getElementById('t_navi_inactive').style.backgroundColor ="Black";
    document.getElementById('t_navi_inactive').style.borderColor ="White";
    document.getElementById('t_navi_inactive').style.color ="White";
  }else
  {
    document.getElementById('t_navi_inactive').style.backgroundColor ="White";
    document.getElementById('t_navi_inactive').style.borderColor ="White";
    document.getElementById('t_navi_inactive').style.color ="Black";

    document.getElementById('t_navi_active').style.backgroundColor ="Black";
    document.getElementById('t_navi_active').style.borderColor ="White";
    document.getElementById('t_navi_active').style.color ="White";
  }
}

function  doneWith(index)
{
  sendUpdate(index);
  setTimeout(function() {fetchList();}, 1000);
}

function openAddWindow()
{
  lset = false;
  uset=false;
  document.getElementById('t_editor').style.display ="block";
}

function downloadList() {
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
        httprequest.open('get', 'https://www.ini02.xyz/manager/php/todo_fetch.php?token='+ntoken, true);
        httprequest.send();
    });
}

async function  fetchList()
{
    downloadList().then(function(result) {
      while (document.getElementById("t_list").firstChild) {
          document.getElementById("t_list").removeChild(document.getElementById("t_list").firstChild);
      }
      for (var index = 0; index < result.length; index++) {
        if(showDos && result[index]["STATE"] == "OPEN"){
          var celement = document.getElementById("element_entry").cloneNode(true);
          celement.style.display="block";
          celement.getElementsByClassName('fa fa-check')[0].setAttribute("onclick","doneWith("+result[index]["ID"]+")");
          celement.getElementsByClassName('t_text')[0].textContent = result[index]["TEXT"];

          let today = new Date(currentDate[2], currentDate[1], currentDate[0],1);
          let tmplower = new Date(result[index]["TILL"]);
          let tmpupper = new Date(result[index]["DEADLINE"]);
          let slower = tmplower.getDate()+"."+(tmplower.getMonth()+1)+"."+tmplower.getFullYear();
          let supper = tmpupper.getDate()+"."+(tmpupper.getMonth()+1)+"."+tmpupper.getFullYear();
          celement.getElementsByClassName('t_date')[0].textContent= "Till "+slower+" Deadline "+supper;

          let status = "White";
          if(Date.parse(today) ==Date.parse(tmplower)){
            status = "Today";
          }else
          if(Date.parse(today) >Date.parse(tmplower)){
            status = "Danger";
          }
          if(Date.parse(today) ==Date.parse(tmpupper)){
            status = "Deadline";
          }
          celement.style.borderColor = dangertable[status];
          document.getElementById("t_list").appendChild(celement);
        }
        if(!showDos && result[index]["STATE"] == "DONE"){
          var celement = document.getElementById("element_entry").cloneNode(true);
          celement.style.display="block";
          celement.getElementsByClassName('fa fa-check')[0].style.display="none";
          celement.getElementsByClassName('t_text')[0].textContent = result[index]["TEXT"];
          let tmplower = new Date(result[index]["TILL"]);
          let tmpupper = new Date(result[index]["DEADLINE"]);
          let slower = tmplower.getDate()+"."+(tmplower.getMonth()+1)+"."+tmplower.getFullYear();
          let supper = tmpupper.getDate()+"."+(tmpupper.getMonth()+1)+"."+tmpupper.getFullYear();
          celement.getElementsByClassName('t_date')[0].textContent= "Till "+slower+" Deadline "+supper;
          document.getElementById("t_list").appendChild(celement);
        }

      }
    }, function(error) {

    })

}

function sendUpdate(id) {
    var httprequest = new XMLHttpRequest();
    return new Promise(function(resolve, reject) {
        httprequest.onreadystatechange = function() {
            if (httprequest.readyState == 4) {
                if (httprequest.status >= 300) {
                    reject(httprequest.status)
                } else {
                    resolve(httprequest.responseText);
                }
            }
        }
        httprequest.open('get', 'https://www.ini02.xyz/manager/php/todo_update.php?id='+id+'&token='+ntoken, true);
        httprequest.send();
    });
}

async function  fetchUpdate(id)
{
    sendUpdate(id).then(function(result) {
      switchView(showDos);
      console.log("DONE");
    }, function(error) {

    })

}
