<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 날짜, 시간, 인원수, 대표 성함, 연락처를 가져옵니다.
    $date = $_POST['date'];
    $time = $_POST['time'];
    $people = $_POST['people'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // 예약이 가능한지 확인합니다.
    // 한 타임에 1명부터 10명까지 예약이 가능합니다.
    // 예약은 전날부터 가능하며, 당일 취소 시에는 한 달 간 예약이 불가능합니다.
    if ($date < date('Y-m-d') || ($time == '1' && date('H') > 10) || ($time == '2' && date('H') > 14) || ($time == '4' && date('H') > 18) || $people < 1 || $people > 10) {
      echo '예약이 불가능합니다.';
      exit;
    }

    // 예약을 처리합니다.
    // CSV 파일에 저장합니다.
    $fp = fopen('reservations.csv', 'a');
    fputcsv($fp, array($date, $time, $people, $name, $phone));
    fclose($fp);

    // 예약 성공 메시지를 출력합니다.
    echo '예약이 완료되었습니다.';
  }
?>