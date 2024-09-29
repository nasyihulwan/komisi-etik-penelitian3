<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? $title : 'Komisi Etik Penelitian | Universitas Pendidikan Indonesia'; ?></title>
    <link href="assets/img/favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style type="text/css">
        body {
          font-family: "Open Sans", sans-serif;
          color: #444444;
        }
        #auth{
            /* background-color: #eeeeee; */
            /* background: rgba(221, 0, 0, 0.15); */
            width: 100%;
            background: url("../assets/img/isola.jpg");
            position: relative;
            padding: 100px 0 0 0;
            background-repeat: no-repeat;
            background-size: cover;
        }
        #auth:before {
          content: "";
          background: rgba(221, 0, 0, 0.85);
          background-size: cover;
          position: absolute;
          bottom: 0;
          top: 0;
          left: 0;
          right: 0;
        }
        @keyframes up-down {
          0% {
            transform: translateY(10px);
          }

          100% {
            transform: translateY(-10px);
          }
        }

        .hero-waves {
          display: block;
          margin-top: 60px;
          width: 100%;
          height: 60px;
          z-index: 5;
          position: relative;
        }

        .wave1 use {
          animation: move-forever1 10s linear infinite;
          animation-delay: -2s;
        }

        .wave2 use {
          animation: move-forever2 8s linear infinite;
          animation-delay: -2s;
        }

        .wave3 use {
          animation: move-forever3 6s linear infinite;
          animation-delay: -2s;
        }

        @keyframes move-forever1 {
          0% {
            transform: translate(85px, 0%);
          }

          100% {
            transform: translate(-90px, 0%);
          }
        }

        @keyframes move-forever2 {
          0% {
            transform: translate(-90px, 0%);
          }

          100% {
            transform: translate(85px, 0%);
          }
        }

        @keyframes move-forever3 {
          0% {
            transform: translate(-90px, 0%);
          }

          100% {
            transform: translate(85px, 0%);
          }
        }
    </style>
  </head>
  <body>