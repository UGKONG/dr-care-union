<!-- |index| -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta http-equiv="Expires" content="Mon, 06 Jan 1990 00:00:01 GMT">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">

    <?php
      header("Expires:Mon, 26 Jul 1997 05:00:00 GMT");
      header("Cache: no-cache");
      header("Pragma: no-cache");
      header("Cache-Control: no-cache, must-revalidate");
    ?>
    
    <!-- 주소창 등의 웹 브라우저 UI를 표시하지 않기 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- 상태 바의 스타일을 지정 -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- 홈 화면에서 표시되는 앱 이름을 지정 -->
    <meta name="apple-mobile-web-app-title" content="Dr.Care Union">
    <!-- 홈 화면에서 표시되는 앱 아이콘을 지정 -->
    <link rel="apple-touch-icon" href="./app-icon.png">
    <link rel="apple-touch-icon" href="icons/icon-152x152.png">

    <script>
      window.history.forward();
      function onBack() {
        window.history.forward();
      }
    </script>

    <!-- [Android와 PC, 크롬·엣지에 대응] -->
    <!-- 웹 앱 매니페스트를 읽어 들이기 -->
    <link rel="manifest" href="manifest.json">
    <!-- 서비스 워커를 등록 -->
    <script>
      if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('sw.js')
        .then((reg) => {
          alert('서비스 워커가 등록됨.');
          console.log('서비스 워커가 등록됨.', reg);
        });
      }
    </script>

    <link rel="stylesheet" href="css/common.css">
    <script src="js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="js/icon.js"></script>
    <script src="js/jswLib.js"></script>
    <title>Dr. Care Union</title>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LKB73WYQGN"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-LKB73WYQGN');
    </script>

    <?php
        require_once 'lib/_init.php';
        $session = new Session();
        date_default_timezone_set('Asia/Seoul');
        validateAdmin($session, 1);
        $USER_SQ = $session->user["USER_SQ"];
    ?>

</head>
<body onload="onBack()" onpageshow="if(event.persisted) noBack();" onunload="">
    <script>
        var USER_SQ = <?php echo $USER_SQ ?>;
        var RESERV_SET = [];
        useAjax('getCurrentReservationSetting', (data) => {
            RESERV_SET = JSON.parse(data)[0];
        });
        // 이 변수로 인하여 스크립트가 사용자 정보를 출력함.
        document.documentElement.addEventListener('touchstart', function (event) {
            if (event.touches.length > 1) {
                event.preventDefault();
            }
        }, false);
    </script>
    <script src="js/index.js"></script>

    <!-- 상단 고정 해더 -->
    <header id="header">
        <div class="menu">
            <a href="">
                <i class="fas fa-bars"></i>
            </a>
        </div>
        <h1 class="logo">
            <a href="">
                Dr. Care Union
            </a>
        </h1>
        <div class="notice">
            <a href="">
                <i class="fas fa-bell"></i>
            </a>
        </div>
    </header>

    <!-- 사이드메뉴 -->
    <menu>
        <div class="menuHeader">
            <a class="homeGo" href="home">
                <!-- <i class="fas fa-home"></i> -->
                Dr.Care Union
            </a>
            <a href="menuHide" class="menuHide">
                <i class="fas fa-chevron-left"></i>
            </a>
        </div>
        <ul class="menuContents">
            <li>
                <a href="mainPage">메인화면</a>
            </li>
            <li>
                <a href="classInfo">수업정보</a>
            </li>
            <li>
                <a href="scheduleSet">스케줄 관리</a>
            </li>
            <li>
                <a href="bodyInfo">건강정보</a>
            </li>
            <li>
                <a href="haveVoucher">보유 이용권</a>
            </li>
            <li>
                <a href="myInfo">개인정보</a>
            </li>
            <li>
                <a href="makeCompany">고객센터</a>
            </li>
            <li>
                <a href="logoutBtn">로그아웃</a>
            </li>
        </ul>
    </menu>

    <!-- 메인화면 -->
    <section id="mainPage" class="main real">
        <article class="barcodeWrap">
            <div class="memberInfo">
                <div id="memberProfileImage" class="memberProfileImage">
                    <!-- Background-image -->
                </div>
                <div class="memberProfileText">
                    <p class="memberName">
                        <span id="userName">
                        <!-- 김형준 -->
                        </span>
                        <small>
                          회원님 
                          (<span id="userCode">
                          <!-- 0486 -->
                          </span>)
                        </small>
                    </p>
                    <p id="memberPhone">
                        <!-- 010-1234-5678 -->
                    </p>
                    <p id="barcodeNumber">
                        <!-- 1234-1234-1234-1122 -->
                    </p>
                </div>
            </div>
            <div class="barcodeInfo">
                <a href="barcode">
                    <img src="img/barcode/sample_barcode.png" alt="샘플바코드">
                </a>
            </div>
        </article>
        <article class="useTicket">
            <p><i class="fas fa-ticket-alt"></i> 보유 이용권</p>
            <ul id="useTicketList">
                <!-- js -->
            </ul>
        </article>
        <article class="iconMenu">
            <div id="mySchedule">
                <a href="">
                    <i class="far fa-calendar-alt"></i>
                    <p>스케줄</p>
                </a>
            </div>
            <div id="myBody">
                <a href="">
                    <i class="fas fa-running"></i>
                    <p>건강정보</p>
                </a>
            </div>
            <div id="myInformation">
                <a href="">
                    <i class="fas fa-user"></i>
                    <p>개인정보</p>
                </a>
            </div>
        </article>
        <article class="todayPlan">
            <button>오늘의 운동 플랜</button>
        </article>
    </section>

    <!-- 공지사항 -->
    <aside id="noticePage" class="main">
        <h2>
            <i class="fas fa-chevron-right"></i>
            공지사항
        </h2>
        <ul>
            <li>
                <h3>전체공지</h3>
                <p class="content">크리스마스 할인 프로모션</p>
                <p class="date">2020-12-20</p>
                <i class="fas fa-chevron-down"></i>
            </li>
            <li>
                <h3>전체공지</h3>
                <p class="content">크리스마스 할인 프로모션</p>
                <p class="date">2020-12-20</p>
                <i class="fas fa-chevron-down"></i>
            </li>
        </ul>
    </aside>

    <!-- 스케줄 -->
    <section id="mySchedulePage" class="main">
        <i class="fas fa-chevron-left pageBack"></i>
        <h2>
            수업 목록
            <button type="button" class="nowMyTicketingBtn">예약현황</button>
        </h2>
        <div class="schedulePage_date">
            <i class="fas fa-chevron-left"></i>
            <span><!-- 날짜 --></span>
            <i class="fas fa-chevron-right"></i>
        </div>

        <div class="schedulerFrame">
            <div class="schedulerWrap">
                <!-- js -->
                <!-- 날짜 1 ~ 31 -->
            </div>
        </div>

        <div class="scheduleList">
            <ul class="list">
                <!-- js -->
            </ul>
        </div>
    </section>

    <!-- 예약하기 -->
    <section id="reservationPage" class="main">
        <i class="fas fa-chevron-left"></i>
        <h2>수업예약</h2>
        <div class="content">
            <article class="solo">
                <div class="name">
                    <h3>수업명</h3>
                    <p>
                        <span>수업명입니다. <small class="attr">(개인)</small></span>
                    </p>
                </div>
                <div class="date">
                    <h3>수업일</h3>
                    <p>
                        <span>0000년 00월 00일 <small>(월)</small></span>
                    </p>
                </div>
                <div class="time">
                    <h3>수업시간</h3>
                    <p>
                        <span>00:00 ~ 00:00</span>
                    </p>
                </div>
                <hr>
                <div class="member">
                    <h3>회원명</h3>
                    <p>
                        <span>홍길동 <small>(010-0000-0000)</small></span>
                    </p>
                </div>
                <div class="manager">
                    <h3>담당자</h3>
                    <p class="shot">
                        <span>홍길똥</span>
                    </p>
                    <a href="tel:01047229330" class="stopCall btn help">문의하기</a>
                </div>
                <div class="voucher">
                    <h3>사용 이용권</h3>
                    <p>
                        <select name="reservation_myVoucher" id="reservation_myVoucher">
                            <option value="">이용권1</option>
                            <option value="">이용권2</option>
                            <option value="">이용권3</option>
                        </select>
                    </p>
                </div>
                <div class="voucherInfo">
                    <h3>이용권 정보</h3>
                    <p>
                        <span>잔여 : 6회 <small>(사용 : 4회 / 총 : 10회)</small></span>
                    </p>
                </div>

                <button class="solo">예 약</button>

            </article>

            <!-- 그룹 -->
            <article class="group">
                <div class="name">
                    <h3>수업명</h3>
                    <p>
                        <span>수업명입니다. <small class="attr">(그룹)</small></span>
                    </p>
                </div>
                <div class="date">
                    <h3>수업일</h3>
                    <p>
                        <span>0000년 00월 00일 <small>(월)</small></span>
                    </p>
                </div>
                <div class="time">
                    <h3>수업시간</h3>
                    <p>
                        <span>00:00 ~ 00:00</span>
                    </p>
                </div>
                <div class="reservState">
                    <h3>예약현황</h3>
                    <p>
                        <span>4 / 10명 예약 (대기 : 2명)</span>
                    </p>
                </div>
                <hr>
                <div class="member">
                    <h3>회원명</h3>
                    <p>
                        <span>홍길동 <small>(010-0000-0000)</small></span>
                    </p>
                </div>
                <div class="manager">
                    <h3>트레이너</h3>
                    <p class="shot">
                        <span>홍길똥</span>
                    </p>
                    <a href="tel:01047229330" class="stopCall btn help">문의하기</a>
                </div>
                <div class="voucher">
                    <h3>사용 이용권</h3>
                    <p>
                        <select name="reservation_myVoucher_group" id="reservation_myVoucher_group">
                            <option value="">이용권1</option>
                            <option value="">이용권2</option>
                            <option value="">이용권3</option>
                        </select>
                    </p>
                </div>
                <div class="voucherInfo">
                    <h3>이용권 정보</h3>
                    <p>
                        <span>잔여 : 6회 <small>(사용 : 4회 / 총 : 10회)</small></span>
                    </p>
                </div>

                <button class="group">예 약</button>

            </article>
        </div>
    </section>

    <!-- 나의 예약현황 -->
    <section id="myNowTicketingPage" class="main">
        <i class="fas fa-chevron-left"></i>
        <h2>
            예약현황
            <button type="button" class="nowMyTicketBtn">이용권현황</button>
        </h2>
        <div class="schedulePage_date">

            <i class="fas fa-chevron-left"></i>
            <span><!-- 날짜 --></span>
            <i class="fas fa-chevron-right"></i>

            <div class="class">
                <p><span class="solo"></span> 개인레슨<p>
                <p><span class="group"></span> 그룹레슨<p>
            </div>

            <div class="state">
                <p><span class="reserv"></span> 예약<p>
                <p><span class="waiting"></span> 예약대기<p>
                <p><span class="yes"></span> 출석<p>
                <p><span class="no"></span> 결석<p>
            </div>

        </div>
        <div class="mySchedule">
            <table border="1">
                <thead>
                    <tr>
                        <th>
                            <div class="day">
                                <div>일</div>
                                <div>월</div>
                                <div>화</div>
                                <div>수</div>
                                <div>목</div>
                                <div>금</div>
                                <div>토</div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="dateList">
                                <!-- js -->
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <ul class="allList">
            <!-- js -->
            <!-- <li>
                <div class="left">
                    <p class="date">2021.03.11</p>
                    <p class="time">시작 : 10시 00분<br>종료 : 12시 00분</p>
                </div>
                <div class="center">
                    <p class="title">강사명 : 전상욱 / 장소 : ROOM 대표이사실</p>
                    <p class="main">100명 애플힙 만들기 프로젝트!!!</p>
                </div>
                <div class="right">
                    <button type="button">취소하기</button>
                </div>
            </li>
            <li>
                <div class="left">
                    <p class="date">2021.03.12</p>
                    <p class="time">시작 : 10시 00분<br>종료 : 12시 00분</p>
                </div>
                <div class="center">
                    <p class="title">강사명 : 전상욱 / 장소 : ROOM 대표이사실</p>
                    <p class="main">100명 애플힙 만들기 프로젝트!!!</p>
                </div>
                <div class="right">
                    <button type="button">취소하기</button>
                </div>
            </li>
            <li>
                <div class="left">
                    <p class="date">2021.03.16</p>
                    <p class="time">시작 : 10시 00분<br>종료 : 12시 00분</p>
                </div>
                <div class="center">
                    <p class="title">강사명 : 전상욱 / 장소 : ROOM 대표이사실</p>
                    <p class="main">100명 애플힙 만들기 프로젝트!!!</p>
                </div>
                <div class="right">
                    <button type="button">취소하기</button>
                </div>
            </li>
            <li>
                <div class="left">
                    <p class="date">2021.03.16</p>
                    <p class="time">시작 : 10시 00분<br>종료 : 12시 00분</p>
                </div>
                <div class="center">
                    <p class="title">강사명 : 전상욱 / 장소 : ROOM 대표이사실</p>
                    <p class="main">100명 애플힙 만들기 프로젝트!!!</p>
                </div>
                <div class="right">
                    <button type="button">취소하기</button>
                </div>
            </li> -->
        </ul>

    </section>

    <!-- 건강정보 -->
    <section id="myBodyPage" class="main">
        <i class="fas fa-chevron-left pageBack"></i>
        <article class="up">
            <h2><b>전상욱</b> 님의 건강정보</h2>
            <div class="infoTabBtn">
                <a href="body" class="body">신체구성</a>
                <a href="pose" class="pose">체형상태</a>
                <a href="rom" class="rom">ROM</a>
                <div class="bgBox"></div>
            </div>
        </article>

        <article class="down">
            <div class="infoTabDataWrap">

                <!-- INBODY -->
                <section class="body">
                    <article class="numberData">
                        <div class="WEIGHT">
                            <h3>체중 / Kg</h3>
                            <p>0</p>
                        </div>
                        <div class="FAT">
                            <h3>체지방량 / Kg</h3>
                            <p>0</p>
                        </div>
                        <div class="MUSCLE">
                            <h3>근육량 / Kg</h3>
                            <p>0</p>
                        </div>
                    </article>
                    <article class="chartData">
                        <select name="BODY_DATE" id="BODY_DATE" class="DATE_SELECT">
                            <!-- <option value="">1차 2020.12.31</option>
                            <option value="">2차 2021.01.01</option>
                            <option value="">3차 2021.01.02</option>
                            <option value="">4차 2021.01.05</option> -->
                            <option value="HEIGHT">신장</option>
                            <option value="WEIGHT">체중</option>
                            <option value="FAT">체지방량</option>
                            <option value="MUSCLE">근육량</option>
                        </select>
                        <div class="chart">
                            <canvas id="body_chart" style="height: 160px;"></canvas>
                        </div>
                    </article>
                </section>

                <!-- POSE -->
                <section class="pose">
                    <select name="POSE_DATE" id="POSE_DATE" class="DATE_SELECT">
                        <option value="">1차 2020.12.31</option>
                        <option value="">2차 2021.01.01</option>
                        <option value="">3차 2021.01.02</option>
                        <option value="">4차 2021.01.05</option>
                    </select>
                    <div class="FrSiBtn">
                        <a href="front">정면</a>
                        <a href="side">측면</a>
                        <div class="bgBox"></div>
                    </div>
                    <div class="FrSi_DATA">
                        <div class="Fr_Si">
                            <div class="Fr">
                                <div class="img">
                                    <h3><i class="fas fa-camera"></i>측정 이미지</h3>
                                    <img src="img/front.png" alt="정면측정 이미지">
                                </div>
                                <h3><i class="fas fa-table"></i>측정 데이터</h3>
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th>부위</th>
                                            <td colspan="4">상태</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>전체</th>
                                            <td colspan="3">이상 없음</td>
                                            <td><span class="pose_none"><i class="fas fa-check"></i></span></td>
                                        </tr>
                                        <tr>
                                            <th>목</th>
                                            <td>R - 목 불균형</td>
                                            <td><span class="pose_right_neck"></span></td>
                                            <td>L - 목 불균형</td>
                                            <td><span class="pose_left_neck"></span></td>
                                        </tr>
                                        <tr>
                                            <th>어깨</th>
                                            <td>R - 어깨 불균형</td>
                                            <td><span class="pose_right_shoulder"></span></td>
                                            <td>L - 어깨 불균형</td>
                                            <td><span class="pose_left_shoulder"></span></td>
                                        </tr>
                                        <tr>
                                            <th>골반</th>
                                            <td>R - 골반 불균형</td>
                                            <td><span class="pose_right_trunk"></span></td>
                                            <td>L - 골반 불균형</td>
                                            <td><span class="pose_left_trunk"></span></td>
                                        </tr>
                                        <tr>
                                            <th>다리</th>
                                            <td>O 다리</td>
                                            <td><span class="pose_o_leg"></span></td>
                                            <td>X 다리</td>
                                            <td><span class="pose_x_leg"></span></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- SVG 이미지 -->
                                <!-- <div id="errorBodyFront" class="errorBody">
                                </div> -->
                            </div>
                            <div class="Si">
                                <div class="img">
                                    <h3><i class="fas fa-camera"></i>측정 이미지</h3>
                                    <img src="img/side.png" alt="측면측정 이미지">
                                </div>
                                <h3><i class="fas fa-table"></i>측정 데이터</h3>
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th>부위</th>
                                            <td colspan="4">상태</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>전체</th>
                                            <td colspan="3">이상 없음</td>
                                            <td><span class="rom_none"></span></td>
                                        </tr>
                                        <tr>
                                            <th>목</th>
                                            <td colspan="3">거북목</td>
                                            <td><span class="rom_neck"><i class="fas fa-check"></i></span></td>
                                        </tr>
                                        <tr>
                                            <th>어깨</th>
                                            <td colspan="3">굽은등</td>
                                            <td><span class="rom_shoulder"><i class="fas fa-check"></i></span></td>
                                        </tr>
                                        <tr>
                                            <th>골반</th>
                                            <td>전방경사</td>
                                            <td><span class="rom_front_trunk"><i class="fas fa-check"></i></span></td>
                                            <td>후방경사</td>
                                            <td><span class="rom_back_trunk"></span></td>
                                        </tr>
                                        <tr>
                                            <th>다리</th>
                                            <td colspan="3">반장슬</td>
                                            <td><span class="rom_leg"></span></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- SVG 이미지 -->
                                <!-- <div id="errorBodySide" class="errorBody
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- <button class="good_contents" id="pose_good_contents">체형 교정 운동 컨텐츠</button> -->
                </section>

                <section class="rom">
                    <select name="ROM_DATE" id="ROM_DATE" class="DATE_SELECT">
                        <option value="">1차 2020.12.31</option>
                        <option value="">2차 2021.01.01</option>
                        <option value="">3차 2021.01.02</option>
                        <option value="">4차 2021.01.05</option>
                    </select>

                    <div class="FrSiBtn">
                        <a href="front">정면</a>
                        <a href="side">측면</a>
                        <div class="bgBox"></div>
                    </div>

                    <div class="FrSi_DATA">

                        <div class="Fr_Si">

                            <div class="Fr dataView">
                                <div class="positionBtn">
                                    <a href="neck" class="neck active">목</a>
                                    <a href="shoulder" class="shoulder">어깨</a>
                                    <a href="waist" class="waist">허리</a>
                                    <a href="leg" class="leg">다리</a>
                                </div>
                                <div class="rom positionData">
                                    <div class="neck">
                                        <a href="left" class="active">왼쪽</a>
                                        <a href="right">오른쪽</a>
                                        <article>
                                            <!-- <img src="img/ROM_jjal.jpg" alt="ROM측정 이미지"> -->

                                            <section class="char">
                                              <span class="char-style-front"></span>
                                              <div class="upBody">
                                                  <div class="head">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                  </div>
                                                  <div class="neck"></div>
                                                  <div class="arm_dot">
                                                    <div class="Larm"></div>
                                                    <div class="Rarm"></div>
                                                  </div>
                                                  <div class="body"></div>
                                              </div>
                                              <div class="downBody">
                                                <div class="hip"></div>
                                                <div class="leg">
                                                  <div class="Lleg"></div>
                                                  <div class="Rleg"></div>
                                                </div>
                                              </div>
                                            </section>

                                        </article>
                                        <div class="numberData">
                                            0˚
                                        </div>
                                    </div>

                                    <!-- <div class="shoulder" hidden>
                                        <a href="left" class="active">왼쪽</a>
                                        <a href="right">오른쪽</a>
                                        <article>
                                            <img src="img/ROM_jjal.jpg" alt="ROM측정 이미지">
                                        </article>
                                        <div class="numberData">
                                            0˚
                                        </div>
                                    </div>

                                    <div class="waist" hidden>
                                        <a href="left" class="active">왼쪽</a>
                                        <a href="right">오른쪽</a>
                                        <article>
                                            <img src="img/ROM_jjal.jpg" alt="ROM측정 이미지">
                                        </article>
                                        <div class="numberData">
                                            0˚
                                        </div>
                                    </div>

                                    <div class="leg" hidden>
                                        <a href="left" class="active">왼쪽</a>
                                        <a href="right">오른쪽</a>
                                        <article>
                                            <img src="img/ROM_jjal.jpg" alt="ROM측정 이미지">
                                        </article>
                                        <div class="numberData">
                                            0˚
                                        </div>
                                    </div> -->

                                </div>
                                <div class="front_totalResultTable table">
                                    <h3>정면 ROM 종합결과</h3>
                                    <table border="1">
                                        <thead>
                                            <tr>
                                                <th>부위</th>
                                                <th>방향</th>
                                                <th>각도</th>
                                                <th>통증</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="2">목</td>
                                                <td>오른쪽</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/good.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td>왼쪽</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/normal.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">어깨</td>
                                                <td>오른쪽</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/good.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td>왼쪽</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/normal.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">허리</td>
                                                <td>오른쪽</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/good.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td>왼쪽</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/normal.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">다리</td>
                                                <td>오른쪽</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/good.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td>왼쪽</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/normal.png" alt=""></div></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- <button class="good_contents" id="rom_good_contents">체형 교정 운동 컨텐츠</button> -->
                                </div>
                            </div>

                            <div class="Si dataView">
                                <div class="positionBtn">
                                    <a href="neck" class="neck active">목</a>
                                    <a href="shoulder" class="shoulder">어깨</a>
                                    <a href="waist" class="waist">허리</a>
                                    <a href="leg" class="leg">다리</a>
                                </div>
                                <div class="rom positionData">
                                    <div class="neck data">
                                        <a href="front" class="active">앞</a>
                                        <a href="back">뒤</a>
                                        <article>
                                            <!-- <img src="img/ROM_jjal.jpg" alt="ROM측정 이미지"> -->
                                            <section class="char side">
                                              <span class="char-style-side"></span>
                                              <div class="upBody">
                                                  <div class="head">
                                                    <span></span>
                                                    <span></span>
                                                    <!-- <span></span>
                                                    <span></span> -->
                                                  </div>
                                                  <div class="neck"></div>
                                                  <div class="arm_dot">
                                                    <div class="Larm"></div>
                                                    <div class="Rarm"></div>
                                                  </div>
                                                  <div class="body"></div>
                                              </div>
                                              <div class="downBody">
                                                <div class="hip"></div>
                                                <div class="leg">
                                                  <div class="Lleg"></div>
                                                  <div class="Rleg"></div>
                                                </div>
                                              </div>
                                            </section>

                                        </article>
                                        <div class="numberData">
                                            0˚
                                        </div>
                                    </div>

                                    <!-- <div class="shoulder data" hidden>
                                        <a href="front" class="active">앞</a>
                                        <a href="back">뒤</a>
                                        <article>
                                            <img src="img/ROM_jjal.jpg" alt="ROM측정 이미지">
                                        </article>
                                        <div class="numberData">
                                            0˚
                                        </div>
                                    </div>

                                    <div class="waist data" hidden>
                                        <a href="front" class="active">앞</a>
                                        <a href="back">뒤</a>
                                        <article>
                                            <img src="img/ROM_jjal.jpg" alt="ROM측정 이미지">
                                        </article>
                                        <div class="numberData">
                                            0˚
                                        </div>
                                    </div>

                                    <div class="leg data" hidden>
                                        <a href="front" class="active">앞</a>
                                        <a href="back">뒤</a>
                                        <article>
                                            <img src="img/ROM_jjal.jpg" alt="ROM측정 이미지">
                                        </article>
                                        <div class="numberData">
                                            0˚
                                        </div>
                                    </div> -->
                                </div>
                                <div class="front_totalResultTable table">
                                    <h3>측면 ROM 종합결과</h3>
                                    <table border="1">
                                        <thead>
                                            <tr>
                                                <th>부위</th>
                                                <th>방향</th>
                                                <th>각도</th>
                                                <th>통증</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="2">목</td>
                                                <td>앞</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/good.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td>뒤</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/normal.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2"><small>오른쪽</small><br>어깨</td>
                                                <td>앞</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/good.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td>뒤</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/normal.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2"><small>왼쪽</small><br>어깨</td>
                                                <td>앞</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/good.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td>뒤</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/normal.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">허리</td>
                                                <td>앞</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/good.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td>뒤</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/normal.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2"><small>오른쪽</small><br>다리</td>
                                                <td>앞</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/good.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td>뒤</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/normal.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2"><small>왼쪽</small><br>다리</td>
                                                <td>앞</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/good.png" alt=""></div></td>
                                            </tr>
                                            <tr>
                                                <td>뒤</td>
                                                <td>
                                                    <div class="progressbarWrap">
                                                        <div class="bar" data-angle="80"></div>
                                                    </div>
                                                </td>
                                                <td><div class="pain"><img src="img/icon/normal.png" alt=""></div></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- <button class="good_contents" id="rom_good_contents">체형 교정 운동 컨텐츠</button> -->
                                </div>
                            </div>

                        </div>

                    </div>

                </section>

            </div>
        </article>

    </section>

    <!-- 개인정보 페이지 -->
    <section id="myInformationPage" class="main">
        <i class="fas fa-chevron-left pageBack"></i>
        <div class="userFace">
            <i class="far fa-user"></i>
        </div>
        <div class="userName"><b>전상욱</b>님</div>
        <div class="myinformationMenu">
            <article>
                <div title="이용권정보" class="voucherInfoPage">이용권정보</div>
            </article>
            <article>
                <div title="출석정보" class="checkinInfo">출석정보</div>
            </article>
            <!-- <article>
                <div title="서비스약관" class="serviceUse">서비스약관</div>
            </article> -->
            <article>
                <div title="개인정보 수정" class="myInfo">개인정보 수정</div>
            </article>
        </div>
    </section>

    <!-- 이용권 정보 -->
    <section id="voucherInfoPage" class="main myInfoCommon">
        <i class="fas fa-chevron-left"></i>
        <h2>
            이용권 목록
            <button type="button" class="voucherUseListBtn">사용내역</button>
        </h2>
        <ul class="voucherList">
            <li class="activeVoucher">
                <p class="voucherName">PT 6개월 이용권 (이용중)</p>
                <div>
                    <p class="voucherDate">2021-01-01 ~ 2021-06-30 <br> <small>- 120일 남음 -</small></p>
                    <p class="voucherCount">남은세션 : 50회 / 사용세션 : 40회</p>
                </div>
                <button class="goTicketUseBtn">이용권 사용</button>
                <a href="tel:01047229330" class="stopCall">이용권 정지신청</a>
            </li>
            <li class="endVoucher">
                <p class="voucherName">PT 1개월 이용권 (만료)</p>
                <div>
                    <p class="voucherDate">2021-01-01 ~ 2021-01-31 <br> <small>- 0일 남음 -</small></p>
                    <p class="voucherCount">남은세션 : 0회 / 사용세션 : 10회</p>
                </div>
                <a href="" class="reBuy">이용권 재구매</a>
            </li>
        </ul>
    </section>

    <!-- 이용권 사용 내역 페이지 -->
    <section id="voucherUseListPage" class="main">
        <i class="fas fa-chevron-left"></i>
        <h2>
            이용권 사용 내역
            <span>
                리스트를 클릭하시면 상세정보를 보실 수 있습니다.
            </span>
        </h2>
        <table border="1">
            <thead>
                <tr>
                    <th>수업일시</th>
                    <th>이용권명</th>
                    <th>상태</th>
                </tr>
            </thead>
            <tbody>
                <tr data-sq="1">
                    <td>2021-03-22 14:00</td>
                    <td>그룹 PT 이용권 (파격 세일 상품)</td>
                    <td class="yes">출석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>개인 PT 이용권 (할인상품)</td>
                    <td class="yes">출석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>그룹 PT 이용권 (할인상품)</td>
                    <td class="yes">출석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>그룹 PT 이용권 (할인상품)</td>
                    <td class="yes">출석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>개인 PT 이용권 (할인상품)</td>
                    <td class="no">결석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>개인 PT 이용권 (할인상품)</td>
                    <td class="yes">출석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>개인 PT 이용권 (할인상품)</td>
                    <td class="yes">출석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>그룹 PT 이용권 (할인상품)</td>
                    <td class="yes">출석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>그룹 PT 이용권 (할인상품)</td>
                    <td class="no">결석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>그룹 PT 이용권 (할인상품)</td>
                    <td class="yes">출석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>개인 PT 이용권 (할인상품)</td>
                    <td class="yes">출석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>그룹 PT 이용권 (할인상품)</td>
                    <td class="yes">출석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>개인 PT 이용권 (할인상품)</td>
                    <td class="yes">출석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>그룹 PT 이용권 (할인상품)</td>
                    <td class="no">결석</td>
                </tr>
                <tr>
                    <td>2021-03-22 14:00</td>
                    <td>그룹 PT 이용권 (할인상품)</td>
                    <td class="yes">출석</td>
                </tr>
            </tbody>
        </table>
    </section>
    
    <!-- 이용권 사용 내역 자세히보기 -->
    <section id="useVoucherDetailInfoPage" class="main">
        <i class="fas fa-chevron-left"></i>
        <h2>이용권 사용 상세 정보</h2>
        <div class="detailInfo">
            <div class="state">
                <h3>상 태</h3>
                <p class="yes" style="font-weight: 700;">출 석</p>
            </div>
            <div class="teacher">
                <h3>담당강사</h3>
                <p>전상욱</p>
            </div>
            <hr class="topLine">
            <div class="time">
                <h3>수업일시</h3>
                <p>2021-03-22 14:00</p>
            </div>
            <div class="className">
                <h3>참여 수업명</h3>
                <p>근육질 몸매 만들기 프로젝트</p>
            </div>
            <hr>
            <div class="voucher">
                <h3>사용 이용권</h3>
                <p>그룹 PT 이용권 (파격 세일 상품)</p>
            </div>
            <div class="voucherInfo">
                <h3>이용권 정보</h3>
                <p>
                    잔여횟수 : <b style="color: #038313;">10회</b> / 사용횟수 : <b style="color: #777;">40회</b><br>
                    총횟수 : 50회<br>
                    만료일 : <b style="color: #444;">2021-04-09 (19일 남음)</b>
                </p>
            </div>
        </div>
    </section>

    <!-- 출석 정보 -->
    <section id="checkinInfo" class="main myInfoCommon">
        <i class="fas fa-chevron-left"></i>
        <h2>출석 정보</h2>
        <!-- <div class="checkinDate">
            <i class="fas fa-chevron-left"></i>
            <span>2021년 3월</span>
            <i class="fas fa-chevron-right"></i>
        </div> -->
        <ul class="checkinList">
            <li>
                <span>2021-03-01 13:10</span> <b>출석</b> <br>
                - 필라테스 PT 체어 + 리포머
            </li>
            <li>
                <span>2021-03-01 13:10</span> <b class="not">결석</b> <br>
                - 필라테스 PT 체어 + 리포머
            </li>
            <li>
                <span>2021-03-01 13:10</span> <b>출석</b> <br>
                - 필라테스 PT 체어 + 리포머
            </li>
        </ul>
    </section>

    <!-- 서비스 약관 -->
    <section id="termsPage1" class="main">
      <i class="fas fa-chevron-left"></i>
      <h2>이용약관</h2>
      <div class="textInfo">
          TEXT
      </div>
    </section>

    <section id="termsPage2" class="main">
      <i class="fas fa-chevron-left"></i>
      <h2>개인정보동의</h2>
      <div class="textInfo">
          TEXT
      </div>
    </section>

    <section id="termsPage3" class="main">
      <i class="fas fa-chevron-left"></i>
      <h2>개인정보수집 제3자 동의</h2>
      <div class="textInfo">
          TEXT
      </div>
    </section>



    <!-- 개인정보 -->
    <section id="myInfo" class="main myInfoCommon">
        <i class="fas fa-chevron-left"></i>
        <h2>회원 정보</h2>
        <form action="#" method="post" id="userDetailInfoFrm" autocomplete="off">
            <label class="userFace" id="myInfoImage" style="display:flex" for="myInfoImageFile">
                <i class="far fa-user" aria-hidden="true"></i>
            </label>
            <!-- <input type="file" id="myInfoImageFile" style="display:none" accept="image/*"> -->
            <p class="labelView">
                <input type="text" name="editUserName" id="editUserName">
                <label for="editUserName">이름</label>
            </p>
            <p class="gender">
                <input type="radio" name="editUserGender" id="editUserGender_male" checked>
                <label for="editUserGender_male">남자</label>
                <input type="radio" name="editUserGender" id="editUserGender_female">
                <label for="editUserGender_female">여자</label>
            </p>
            <p class="labelView">
                <input type="text" name="editUserId" id="editUserId" readonly style="color:#555">
                <label for="editUserId" style="color:#555">아이디</label>
            </p>
            <p class="labelView" style="margin-top: 10px;">
                <input type="password" name="nowUserPw" id="nowUserPw">
                <label for="nowUserPw">현재 비밀번호</label>
            </p>
            <p class="labelView" style="margin-top: 10px;">
                <input type="password" name="editUserPw" id="editUserPw" placeholder="변경할 때만 입력">
                <label for="editUserPw">새 비밀번호</label>
            </p>
            <p class="labelView" style="margin-top: 10px;">
                <input type="password" name="editUserPwChk" id="editUserPwChk" placeholder="변경할 때만 입력">
                <label for="editUserPwChk">새 비밀번호 확인</label>
            </p>
            <p class="labelView" style="margin-top: 10px;">
                <input type="text" name="editUserPhone" id="editUserPhone" placeholder="'-'(하이픈) 빼고 입력해주세요." maxlength="13">
                <label for="editUserPhone">연락처</label>
            </p>
            <p class="birth">
                <select name="editUserYear" id="editUserYear">
                    <option value="">년도</option>
                    <!-- js -->
                </select>
                <select name="editUserMonth" id="editUserMonth">
                    <option value="">월</option>
                    <!-- js -->
                </select>
                <select name="editUserDate" id="editUserDate">
                    <option value="">일</option>
                    <!-- js -->
                </select>
            </p>
            <p class="labelView">
                <input type="text" name="editUserEmail" id="editUserEmail">
                <label for="editUserEmail">이메일</label>
            </p>
            <button id="editUserInfoSubmitBtn" type="button">
                수정하기
            </button>
        </form>
    </section>

    <!-- 오늘의 운동 플랜 -->
    <section id="todayExercisePlan" class="main">
        오늘의 운동 플랜<br>
        <img src="http://ugkong.com/img/coming_soon.png" alt="COMING_SOON">
    </section>

    <!-- 고객센터 -->
    <section id="makeCompanyPage" class="main">
        <i class="fas fa-chevron-left"></i>
        <h2>고객센터</h2>
        <div class="content">
            <div>
                <h3>상호</h3>
                <p>(주)리안소프트글로벌</p>
            </div>
            <div>
                <h3>대표</h3>
                <p>이홍련</p>
            </div>
            <div>
                <h3>주소</h3>
                <p>
                    서울특별시 금천구 디지털로10길 78<br>
                    가산테라타워 809호
                </p>
            </div>
            <div>
                <h3>홈페이지</h3>
                <p><a href="http://liansoft.co.kr/">http://liansoft.co.kr/</a></p>
            </div>
            <div>
                <h3>사업자등록번호</h3>
                <p>119-87-06236</p>
            </div>
            <div class="terms">
              <button class="termsBtn1">이용약관 내용</button>
              <button class="termsBtn2">개인정보동의 내용</button>
              <button class="termsBtn3">개인정보수집 제3자 동의 내용</button>
            </div>
        </div>
    </section>


    <!-- 검은 뒷배경 -->
    <div class="dark_div"></div>
</body>
</html>
