<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADS - Heapsort Top-Down</title>
    <link rel="stylesheet" href="./Resources/Main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
<body class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="/" class="btn btn-warning mb-5">Zurück zur Übersicht</a>
                <h1>Heapsort Top-Down (Min/Max)</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <label for="inputField" class="form-label">Zu sortierende Zahlen (Kommasepariert):</label>
                <input type="text" name="r1c1" class="form-control" id="inputField" placeholder="5,2,7,3..." required />
            </div>
            <div class="col-6 col-md-3">
                <label for="sortierenSeite" class="form-label">Tiebreaking</label>
                <select id="sortierenSeite" class="custom-select">
                    <option value="rechts" selected>Rechter Sohn</option>
                    <option value="links">Linker Sohn</option>
                </select>
            </div>
            <div class="col-6 col-md-3">
                <label for="sortierreihenfolge" class="form-label">Auf-/Absteigend</label>
                <select id="sortierreihenfolge" class="custom-select">
                    <option value="aufsteigend" selected>Aufsteigend (max)</option>
                    <option value="absteigend">Absteigend (min)</option>
                </select>
            </div>
            <div class="col-12">
                <button id="rechnen" type="button" class="btn btn-lg btn-secondary my-2">Errechnen</button>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-12">
                <h2>Output</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="output">
            </div>
        </div>
    </div>
    <script src="./Resources/Main.js"></script>
</body>

<script type="application/javascript">
    const submitButton = document.querySelector('#rechnen');
    let data;
    let reihenfolge;
    let seite;

    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        const input = document.getElementById('inputField')
        const sortierreihenfolgeInput = document.querySelector('#sortierreihenfolge');
        const sortierenSeiteInput = document.querySelector('#sortierenSeite');

        data = input.value;
        reihenfolge = sortierreihenfolgeInput.value;
        seite = sortierenSeiteInput.value;
        calculate();
    })

    /**
     * Berechne Tabelle
     */
    function calculate () {
        const xhrForCalculate = new XMLHttpRequest();
        xhrForCalculate.open('POST', './api/HeapsortTD.php', true);
        xhrForCalculate.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

        xhrForCalculate.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                document.querySelector('#output').innerText = this.response;
            }
        }
        xhrForCalculate.send(JSON.stringify({
            data: data,
            reihenfolge: reihenfolge,
            seite: seite
        }));
    }

</script>

</html>