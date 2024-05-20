<?php
// URL на который будет отправлен POST-запрос
$url = 'https://hurasev01.amocrm.ru/api/v4/leads/complex';
$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjY4NDg0N2RlMWMyMmFhZDc0NDQ4ZWMzYjdlYjFjNjZjN2UyNDE2MzEyZDZkMjZmNDNjMWYzZDMxNGRiMjBjMWIwNWJhZDFiYjA2YzdhMWM3In0.eyJhdWQiOiJhYmYxOTMyNi03ZmVhLTRjMzctYmQwNS00ZWEwMjBjZjQyMWQiLCJqdGkiOiI2ODQ4NDdkZTFjMjJhYWQ3NDQ0OGVjM2I3ZWIxYzY2YzdlMjQxNjMxMmQ2ZDI2ZjQzYzFmM2QzMTRkYjIwYzFiMDViYWQxYmIwNmM3YTFjNyIsImlhdCI6MTcxNjE1MTUwMywibmJmIjoxNzE2MTUxNTAzLCJleHAiOjE3NDU3MTIwMDAsInN1YiI6IjExMDU1MTg2IiwiZ3JhbnRfdHlwZSI6IiIsImFjY291bnRfaWQiOjMxNzUzNDMwLCJiYXNlX2RvbWFpbiI6ImFtb2NybS5ydSIsInZlcnNpb24iOjIsInNjb3BlcyI6WyJjcm0iLCJmaWxlcyIsImZpbGVzX2RlbGV0ZSIsIm5vdGlmaWNhdGlvbnMiLCJwdXNoX25vdGlmaWNhdGlvbnMiXSwiaGFzaF91dWlkIjoiNmM5MGZlN2QtNmRlYS00NmJhLWJlOTEtYzlhOWExNjEwYWU2In0.l-yHbXmLCMDg3jR2RJUGbnifSRBjtBXi3VCSC05IyjzA5BtC8uEynclk6_23LxlvPQ_Xy0zr-aA7ZUE18Yrv7yAtnbtvwCMzVEfedQrPbgtQqGxiG89gtPuyspLoOftnqCei5QDlafMp3nbpmk-PX-WqU2Pvr1XxF29naKY8OFml3YgtE3tvUQJkdTGmBt8lcpcESIZ3tkB2DofZR-SYqiksWCcbnfOmJmT4Apfj0d_f3xAY8i2e4FuyOxTUs8v_uaUzigHfWzxzX6oegkGDPNMCxMocN68a_TnXfo-ZopLlv-GZl6pcpAYpVbbIcFlAMdazA994luoV9Kkpl-20mg';
$headers = [
    'Authorization: Bearer ' . $accessToken,
    'Content-Type: application/json'
];

$id_spenttime = [
  '771607'
];

// Данные, которые будут отправлены в POST-запросе
$data = [
  'add' => [
          "name" => "Тестовая сделка",
          "custom_fields_values" => [
              [
                  "field_id" => 688125,
                  "values" => [
                      [
                        "value" => $_POST['price']
                      ]
                  ]
             ]
           ],
                    "_embedded" => [
              "contacts" => [
                  [
                      "first_name" => $_POST['name'],
                      "custom_fields_values" => [
                          [
                              "field_code" => "PHONE",
                              "values" => [
                                  [
                                      "enum_code" => "WORK",
                                      "value" => $_POST['phone']
                                  ]
                              ]
                         ],
                         [
                           "field_code" => "EMAIL",
                           "values" => [
                             [
                               "enum_code" => "WORK",
                               "value" => $_POST['email']
                             ]
                           ]
                         ],
                        [
                          'field_id' => 774255,
                          'values' => [
                            [
                            'value' => $_POST['time']
                          ]
                          ]
                          ]
                        ]
              ],
            ]
          ],
        ]
  ];

// Инициализация сеанса cURL
$ch = curl_init($url);

// Установка опций для сеанса cURL
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

// Выполнение запроса и получение ответа от сервера
$response = curl_exec($ch);

// Проверка на наличие ошибок в запросе
if (curl_errno($ch)) {
    // Вывод ошибки, если таковая произошла
    echo 'Ошибка запроса тест: ' . curl_error($ch);
} else {
    // Распечатка ответа в случае успешного запроса
        echo 'Ответ сервера: ' . $response;
}

echo 'cookie:' . $_POST['spentTime'];
// Закрытие сеанса cURL
curl_close($ch);
