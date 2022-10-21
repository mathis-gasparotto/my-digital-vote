@php
$today = date_create();
foreach (\App\Models\Vote::all()->where('status', '=', 'in_progress') as $vote) {
  if ($today >= date_create($vote->final_date)) {
   $vote->update(['status' => "done"]);
  }
}
@endphp

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>MyDigitalVote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>
@auth
    <header>
        <div class="header-left">
            <a href="{{ route('index') }}" title="Aller à la page d'accueil" class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="224" height="177.031" viewBox="0 0 224 177.031">
                    <defs>
                        <clipPath id="clip-path">
                            <rect id="Rectangle_71" data-name="Rectangle 71" width="224" height="177.031" fill="none"/>
                        </clipPath>
                    </defs>
                    <g id="Groupe_16" data-name="Groupe 16" transform="translate(0 0)">
                        <path id="Tracé_75" data-name="Tracé 75" d="M52.427,58.654V84.895H72.174V56.954ZM4.985,62.69V84.895H24.732V61.01ZM30.2,60.539l8.05,10.59h.676L48.125,59Z" transform="translate(5.227 59.714)" fill="#c91c22"/>
                        <path id="Tracé_76" data-name="Tracé 76" d="M112.96,53.6l-5.1,21h-.666l-4.861-20.075-19.784,1.7,9.277,33.984h31.421l10.468-38.388Z" transform="translate(86.546 54.33)" fill="#c91c22"/>
                        <g id="Groupe_15" data-name="Groupe 15" transform="translate(0 0)">
                            <g id="Groupe_14" data-name="Groupe 14" clip-path="url(#clip-path)">
                                <path id="Tracé_77" data-name="Tracé 77" d="M120.6,50.147l-25,2.128c.049.592.072,1.231.072,1.868,0,11.187-7.78,18.211-18.211,18.211H64.69V54.924L39.785,57.052V92.032H84.177c15.634,0,36.61-13.315,36.61-37.769,0-1.395-.07-2.767-.188-4.115m0,0-25,2.128c.049.592.072,1.231.072,1.868,0,11.187-7.78,18.211-18.211,18.211H64.69V54.924L39.785,57.052V92.032H84.177c15.634,0,36.61-13.315,36.61-37.769,0-1.395-.07-2.767-.188-4.115" transform="translate(41.713 52.577)" fill="#c91c22"/>
                                <path id="Tracé_78" data-name="Tracé 78" d="M85.028,34.226H39.786V69.535l24.9-2.128V53.926h11.92c9.341,0,16.1,3.241,18.28,10.9L119.983,62.7A35.383,35.383,0,0,0,85.028,34.226" transform="translate(41.714 35.885)" fill="#005fb8"/>
                                <path id="Tracé_79" data-name="Tracé 79" d="M61.872,34.226h51.881l-13.51,6.051,9.226,2.636L85.415,46.539" transform="translate(64.869 35.885)" fill="#005fb8"/>
                                <path id="Tracé_80" data-name="Tracé 80" d="M100.426,41.709,95.868,60.493l20.853-1.8,4.64-16.982Z" transform="translate(100.513 43.73)" fill="#005fb8"/>
                                <path id="Tracé_81" data-name="Tracé 81" d="M98.185,41.709H77.23l5.889,21.57,19.886-1.721Z" transform="translate(80.972 43.73)" fill="#005fb8"/>
                                <path id="Tracé_82" data-name="Tracé 82" d="M54.181,41.744,40.928,60.487h-.676L27,41.744H6.985V75.011l19.747-1.68v-3.38h.512l2.376,3.134,23.434-2.007.86-1.127h.512v1l19.747-1.68V41.744Z" transform="translate(7.324 43.767)" fill="#005fb8"/>
                                <path id="Tracé_83" data-name="Tracé 83" d="M215.843,110.387C95.265,79.4,12.309,109.555,11.486,109.864L0,79.166c3.759-1.405,93.549-34.049,224-.522Z" transform="translate(0 66.645)" fill="#005193"/>
                                <path id="Tracé_84" data-name="Tracé 84" d="M2.994,77.036q2.99-.87,5.99-1.688,2.7,2.089,5.357,4.216l.2-.053q1.275-3.149,2.612-6.295,3.011-.75,6.033-1.452l3.89,16.752q-2.848.661-5.691,1.368-1.085-4.36-2.173-8.724l-.15.037q-1.309,2.9-2.567,5.8c-.066.016-.131.033-.2.051q-2.517-1.92-5.08-3.806l-.147.041,2.37,8.673q-2.83.774-5.648,1.592-2.4-8.256-4.8-16.515" transform="translate(3.139 75.24)" fill="#fff"/>
                                <path id="Tracé_85" data-name="Tracé 85" d="M22.968,82.392q-4.594-3.847-9.359-7.583,3.168-.725,6.348-1.4,2.261,1.92,4.486,3.865c.059-.012.119-.025.176-.035q1.248-2.646,2.54-5.281,3.174-.605,6.356-1.159-2.824,5.267-5.459,10.57L29.1,86.725q-2.51.485-5.015,1.008l-1.112-5.34" transform="translate(14.268 74.231)" fill="#fff"/>
                                <path id="Tracé_86" data-name="Tracé 86" d="M44.265,76.1A8.961,8.961,0,0,1,36.8,85.86q-5.141.728-10.263,1.6-1.447-8.477-2.9-16.953,5.466-.934,10.953-1.708A8.3,8.3,0,0,1,44.265,76.1m-5.967.727c-.365-2.751-2.329-3.634-5.084-3.23q-1.429.209-2.856.43.621,4,1.239,8.011,1.493-.23,2.991-.449a4.091,4.091,0,0,0,3.71-4.763" transform="translate(24.784 72.041)" fill="#fff"/>
                                <path id="Tracé_87" data-name="Tracé 87" d="M34.242,69.523q2.636-.3,5.277-.559l1.463,14.792q-2.535.249-5.07.537-.836-7.384-1.669-14.769" transform="translate(35.901 72.306)" fill="#fff"/>
                                <path id="Tracé_88" data-name="Tracé 88" d="M38.182,76.76a7.724,7.724,0,0,1,7.383-8.327c4.115-.295,7.534,2.044,8.272,5.719q-2.556.12-5.109.272a3.094,3.094,0,0,0-5.734,1.77,3.075,3.075,0,0,0,3.413,2.87,2.185,2.185,0,0,0,2.114-1.573c-.805.043-1.612.092-2.419.141-.041-.58-.084-1.159-.125-1.739q4.01-.28,8.026-.469c0,.27-.006.541-.01.811a7.935,7.935,0,0,1-15.81.524" transform="translate(39.995 71.723)" fill="#fff"/>
                                <path id="Tracé_89" data-name="Tracé 89" d="M46.722,68.355q2.646-.12,5.293-.2.234,7.43.465,14.857-2.547.08-5.088.193l-.67-14.847" transform="translate(48.986 71.455)" fill="#fff"/>
                                <path id="Tracé_90" data-name="Tracé 90" d="M55.338,72.075q-2.584.034-5.166.1-.052-1.988-.107-3.978,7.866-.215,15.74-.1-.031,1.988-.057,3.978-2.584-.037-5.166-.037l-.006,10.883q-2.547,0-5.092.031-.074-5.439-.145-10.881" transform="translate(52.491 71.36)" fill="#fff"/>
                                <path id="Tracé_91" data-name="Tracé 91" d="M69,81.5q-2.719-.12-5.439-.2-.273.854-.545,1.7-2.855-.08-5.711-.115,2.6-7.4,5.4-14.761,4.056.1,8.112.3,2.255,7.546,4.3,15.12-2.851-.175-5.7-.305-.209-.873-.42-1.741m-.959-4.025q-.636-2.621-1.295-5.238l-.256-.01q-.848,2.563-1.676,5.129,1.613.052,3.226.119" transform="translate(60.087 71.427)" fill="#fff"/>
                                <path id="Tracé_92" data-name="Tracé 92" d="M80.175,80.41l-.4,3.96q-6.619-.667-13.253-1.094.476-7.414.953-14.833,2.646.172,5.289.377l-.848,10.851q4.133.323,8.259.739" transform="translate(69.745 71.76)" fill="#fff"/>
                                <path id="Tracé_93" data-name="Tracé 93" d="M74,67.882q3.263.332,6.522.721.9,6.477,1.68,12.956l.2.025Q84.8,75.512,87.3,69.472q3.254.446,6.5.948-3.816,8.112-7.411,16.287-4.658-.658-9.329-1.2Q75.645,76.692,74,67.882" transform="translate(77.587 71.171)" fill="#fff"/>
                                <path id="Tracé_94" data-name="Tracé 94" d="M82.9,77.08a7.949,7.949,0,0,1,15.652,2.759A7.954,7.954,0,0,1,82.9,77.08M93.51,78.85a2.813,2.813,0,1,0-3.228,2.19,2.737,2.737,0,0,0,3.228-2.19" transform="translate(86.827 74.125)" fill="#fff"/>
                                <path id="Tracé_95" data-name="Tracé 95" d="M96.16,76.614q-2.541-.544-5.084-1.053.387-1.951.778-3.9,7.755,1.549,15.46,3.425-.473,1.933-.942,3.867-2.529-.618-5.062-1.2-1.214,5.3-2.429,10.609-2.5-.572-5-1.108l2.28-10.642" transform="translate(95.489 75.131)" fill="#fff"/>
                                <path id="Tracé_96" data-name="Tracé 96" d="M105.8,78.7l-.369,1.4q4.591,1.211,9.165,2.538-.556,1.911-1.11,3.822-4.523-1.315-9.071-2.511l-.375,1.426q4.529,1.192,9.034,2.5-.553,1.911-1.11,3.822-6.926-2.013-13.907-3.747,1.788-7.212,3.581-14.425,7.264,1.8,14.474,3.9-.556,1.911-1.11,3.822-4.591-1.334-9.2-2.548" transform="translate(102.811 77.092)" fill="#fff"/>
                                <path id="Tracé_97" data-name="Tracé 97" d="M75.642,81.637A13.005,13.005,0,0,1,62.06,76.244L46.511,53.158a12.971,12.971,0,0,1,3.5-17.957L98.267,2.7a12.969,12.969,0,0,1,17.957,3.5l15.55,23.086a12.971,12.971,0,0,1-3.5,17.957l-48.253,32.5a12.864,12.864,0,0,1-4.378,1.891M103.615,5.156a8.433,8.433,0,0,0-2.864,1.235L52.5,38.892a8.518,8.518,0,0,0-2.3,11.779l15.55,23.088a8.517,8.517,0,0,0,11.779,2.3l48.251-32.5a8.513,8.513,0,0,0,2.3-11.779L112.53,8.69a8.424,8.424,0,0,0-5.414-3.577,8.532,8.532,0,0,0-3.5.043" transform="translate(46.458 0.525)" fill="#005fb8"/>
                                <path id="Tracé_98" data-name="Tracé 98" d="M75.642,81.637A13.005,13.005,0,0,1,62.06,76.244L46.511,53.158a12.971,12.971,0,0,1,3.5-17.957L98.267,2.7a12.969,12.969,0,0,1,17.957,3.5l15.55,23.086a12.971,12.971,0,0,1-3.5,17.957l-48.253,32.5A12.864,12.864,0,0,1,75.642,81.637ZM103.615,5.156a8.433,8.433,0,0,0-2.864,1.235L52.5,38.892a8.518,8.518,0,0,0-2.3,11.779l15.55,23.088a8.517,8.517,0,0,0,11.779,2.3l48.251-32.5a8.513,8.513,0,0,0,2.3-11.779L112.53,8.69a8.424,8.424,0,0,0-5.414-3.577A8.532,8.532,0,0,0,103.615,5.156Z" transform="translate(46.458 0.525)" fill="none" stroke="#005fb8" stroke-miterlimit="10" stroke-width="1"/>
                                <path id="Tracé_99" data-name="Tracé 99" d="M88.16,43.9,50.683,38.259l.664-4.4L84.786,38.9l7.9-32.882,4.328,1.039Z" transform="translate(53.139 6.306)" fill="#005fb8"/>
                                <path id="Tracé_100" data-name="Tracé 100" d="M88.16,43.9,50.683,38.259l.664-4.4L84.786,38.9l7.9-32.882,4.328,1.039Z" transform="translate(53.139 6.306)" fill="none" stroke="#005fb8" stroke-miterlimit="10" stroke-width="1"/>
                                <rect id="Rectangle_67" data-name="Rectangle 67" width="25.233" height="4.452" transform="matrix(0.234, -0.972, 0.972, 0.234, 121.045, 70.137)" fill="#005fb8"/>
                                <rect id="Rectangle_68" data-name="Rectangle 68" width="25.233" height="4.452" transform="matrix(0.234, -0.972, 0.972, 0.234, 121.045, 70.137)" fill="none" stroke="#005fb8" stroke-miterlimit="10" stroke-width="1"/>
                                <rect id="Rectangle_69" data-name="Rectangle 69" width="4.451" height="25.232" transform="translate(141.763 39.575) rotate(-81.432)" fill="#005fb8"/>
                                <rect id="Rectangle_70" data-name="Rectangle 70" width="4.451" height="25.232" transform="translate(141.763 39.575) rotate(-81.432)" fill="none" stroke="#005fb8" stroke-miterlimit="10" stroke-width="1"/>
                            </g>
                        </g>
                    </g>
                </svg>
            </a>
        </div>
        <div class="header-right">
            @yield('link')
        </div>
    </header>
@endif

<main>
    @if (session('error'))
        <div class="alert alert-danger status">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success status">{{ session('success') }}</div>
    @endif
    @if (session('status'))
        <div class="alert alert-primary status">{{ session('status') }}</div>
    @endif

    @yield('content')
</main>
@extends('nav')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
