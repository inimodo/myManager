<?php include "php/access.php" ?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="icon.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
    <script language="javascript" type="text/javascript" src="js\data.js"></script>
    <script language="javascript" type="text/javascript" src="js\todo.js"></script>

    <title>Fuck Off!</title>
  </head>
  <body onload="init()">
    <div id="b_box">
      <a href="board.php"><i id="b_goback" class="fa fa-chevron-left" ></i></a>

      <div id="t_header">
        <a class="t_navi" id=t_navi_active onclick="switchView(true)">To Dos </a>
        <a class="t_navi" id=t_navi_inactive onclick="switchView(false)">Done </a>
      </div>
      <div class="t_element" id="element_entry" style="display:none">
        <i class="fa fa-check" id="c_done" ></i>
        <a class="t_text">Das ist ein Sample</a>
        <a class="t_date">Till 6.01.2022 Deadline 25.6.2022</a>
      </div>
      <div id="t_list">

      </div>
      <a id=t_edit onclick="openAddWindow()"><i class="fa fa-plus-square"  ></i></a>

      <form id="t_editor" action="php/todo_edit.php" method="post">

        <button class="t_button" type="submit" name="delete"><i class="fa fa-close" id="c_bico" ></i></button>
        <div id="c_calender" style="margin-top: 0px;margin-bottom: 0px">
          <div id="c_nav">
            <a onclick="navMonth(-1)" class="c_navico"><i class="fa fa-arrow-circle-left" ></i></a>
            <a id="c_mothyear">2012 Jänner</a>
            <a onclick="navMonth(1)" class="c_navico"><i class="fa fa-arrow-circle-right" ></i></a>
          </div>
          <div id="c_days">
            <div class="c_week">
              <a class="c_day" onclick="dateSel(0)" id="d_0">32</a>
              <a class="c_day" onclick="dateSel(1)" id="d_1">32</a>
              <a class="c_day" onclick="dateSel(2)" id="d_2">32</a>
              <a class="c_day" onclick="dateSel(3)" id="d_3">32</a>
              <a class="c_day" onclick="dateSel(4)" id="d_4">32</a>
              <a class="c_day" onclick="dateSel(5)" id="d_5">32</a>
              <a class="c_day" onclick="dateSel(6)" id="d_6">32</a>
            </div>
            <div class="c_week">
              <a class="c_day" onclick="dateSel(7)" id="d_7">32</a>
              <a class="c_day" onclick="dateSel(8)" id="d_8">32</a>
              <a class="c_day" onclick="dateSel(9)" id="d_9">32</a>
              <a class="c_day" onclick="dateSel(10)" id="d_10">32</a>
              <a class="c_day" onclick="dateSel(11)" id="d_11">32</a>
              <a class="c_day" onclick="dateSel(12)" id="d_12">32</a>
              <a class="c_day" onclick="dateSel(13)" id="d_13">32</a>
            </div>
            <div class="c_week">
              <a class="c_day" onclick="dateSel(14)" id="d_14">32</a>
              <a class="c_day" onclick="dateSel(15)" id="d_15">32</a>
              <a class="c_day" onclick="dateSel(16)" id="d_16">32</a>
              <a class="c_day" onclick="dateSel(17)" id="d_17">32</a>
              <a class="c_day" onclick="dateSel(18)" id="d_18">32</a>
              <a class="c_day" onclick="dateSel(19)" id="d_19">32</a>
              <a class="c_day" onclick="dateSel(20)" id="d_20">32</a>
            </div>
            <div class="c_week">
              <a class="c_day" onclick="dateSel(21)" id="d_21">32</a>
              <a class="c_day" onclick="dateSel(22)" id="d_22">32</a>
              <a class="c_day" onclick="dateSel(23)" id="d_23">32</a>
              <a class="c_day" onclick="dateSel(24)" id="d_24">32</a>
              <a class="c_day" onclick="dateSel(25)" id="d_25">32</a>
              <a class="c_day" onclick="dateSel(26)" id="d_26">32</a>
              <a class="c_day" onclick="dateSel(27)" id="d_27">32</a>
            </div>
            <div class="c_week">
              <a class="c_day" onclick="dateSel(28)" id="d_28">32</a>
              <a class="c_day" onclick="dateSel(29)" id="d_29">32</a>
              <a class="c_day" onclick="dateSel(30)" id="d_30">32</a>
              <a class="c_day" onclick="dateSel(31)" id="d_31">32</a>
              <a class="c_day" onclick="dateSel(32)" id="d_32">32</a>
              <a class="c_day" onclick="dateSel(33)" id="d_33">32</a>
              <a class="c_day" onclick="dateSel(34)" id="d_34">32</a>
            </div>
            <div class="c_week">
              <a class="c_day" onclick="dateSel(35)" id="d_35">32</a>
              <a class="c_day" onclick="dateSel(36)" id="d_36">32</a>
              <a class="c_day" onclick="dateSel(37)" id="d_37">32</a>
              <a class="c_day" onclick="dateSel(38)" id="d_38">32</a>
              <a class="c_day" onclick="dateSel(39)" id="d_39">32</a>
              <a class="c_day" onclick="dateSel(40)" id="d_40">32</a>
              <a class="c_day" onclick="dateSel(41)" id="d_41">32</a>
            </div>
          </div>
        </div>
        <input class="t_name" type="text" name="name" value="">
        <a id="t_time">1.12.2022 bis Deadline am 5.12.2022</a>
        <button class="t_button" type="submit" name="save"><i class="fa fa-check" id="c_bico"></i></button>

      </form>

    </div>
  </body>
</html>
