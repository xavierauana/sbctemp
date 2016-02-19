<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Letter to customer</title>
    <style>
        body {
            background-color: grey;
        }

        .container {
            margin: 0 auto;
        }

        div.page {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            margin-bottom: 30px;
            padding: 5mm;
            background-color: white;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                page-break-after: always;
            }
            /* ... the rest of the rules ... */
        }
    </style>
</head>
<body>
<div class="container">
    @if(count($letters) > 0)
        @foreach($letters as $letter)
            <div class="page">
                {!! $letter !!}
            </div>
        @endforeach
    @endif
</div>

</body>
</html>