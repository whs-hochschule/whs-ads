<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADS - Sortieren (Quick, Select, Insert, Merge)</title>
    <link rel="stylesheet" href="./Resources/Main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
<body class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="/" class="btn btn-warning mb-5">Zurück zur Übersicht</a>
                <h1>Sortieren (Quick, Select, Insert, Merge)</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 mb-3">
                <label for="inputField" class="form-label">Zu sortierende Zahlen (Kommasepariert):</label>
                <input type="text" name="r1c1" class="form-control" id="inputField" placeholder="5,2,7,3..." required />
            </div>
            <div class="col-12 col-md-4">
                <label for="sortiermethode" class="form-label">Sortiermethode</label>
                <select id="sortiermethode" class="custom-select">
                    <option value="insertionSort" selected>Insertion-Sort</option>
                    <option value="selectionSort">Selection-Sort</option>
                    <option value="quickSortFrame">Quick-Sort</option>
                    <option value="mergeSortFrame">Merge-Sort</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" id="submitButton" name="submitButton" class="btn btn-secondary btn-lg">Sortieren</button>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-12">
                <h2>Output</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-5" id="output" style="white-space: pre">
            </div>
        </div>
        <hr />
    </div>
    <script src="./Resources/Main.js"></script>
</body>

<script type="application/javascript">
    const submitButton = document.querySelector('#submitButton');
    let data;
    let methode;

    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        const input = document.getElementById('inputField')
        const sortiermethode = document.querySelector('#sortiermethode');

        data = input.value;
        methode = sortiermethode.value;
        calculate();
    })

    /**
     * Berechne Tabelle
     */
    function calculate () {
        const xhrForCalculate = new XMLHttpRequest();
        xhrForCalculate.open('POST', './api/Sort.php', true);
        xhrForCalculate.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

        xhrForCalculate.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                document.querySelector('#output').innerText = this.response;
            }
        }
        xhrForCalculate.send(JSON.stringify({
            data: data,
            methode: methode
        }));
    }
</script>

</html>