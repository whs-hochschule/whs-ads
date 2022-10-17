<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADS - Floyd-Warshall</title>
    <link rel="stylesheet" href="./Resources/Main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
<body class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="/" class="btn btn-warning mb-5">Zurück zur Übersicht</a>
                <h1>Floyd-Warshall</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <form id="table">
                    <div class="table-responsive">
                        <table id="floydTable" class="table table-striped table-hover">
                            <tr>
                                <td><input type="text" name="r1c1" value="" /></td>
                                <td><input type="text" name="r1c2" value="" /></td>
                                <td><input type="text" name="r1c3" value="" /></td>
                                <td><input type="text" name="r1c4" value="" /></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="r2c1" value="" /></td>
                                <td><input type="text" name="r2c2" value="" /></td>
                                <td><input type="text" name="r2c3" value="" /></td>
                                <td><input type="text" name="r2c4" value="" /></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="r3c1" value="" /></td>
                                <td><input type="text" name="r3c2" value="" /></td>
                                <td><input type="text" name="r3c3" value="" /></td>
                                <td><input type="text" name="r3c4" value="" /></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="r4c1" value="" /></td>
                                <td><input type="text" name="r4c2" value="" /></td>
                                <td><input type="text" name="r4c3" value="" /></td>
                                <td><input type="text" name="r4c4" value="" /></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
            <div class="col-12">
                <input type="submit" id="submitButton" name="submitButton" class="btn btn-secondary btn-lg">
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
    const submitButton = getButtonElementById('submitButton');
    const table = getButtonElementById('floydTable');
    let data = {};

    submitButton.addEventListener('click',function (e) {
        e.preventDefault();
        let rowLength = table.rows.length;
        for (let i = 0; i < rowLength; i++) {
            let objCells = table.rows.item(i).cells
            data[i] = {};
            for (let j = 0; j < objCells.length; j++) {
                data[i][j] = objCells.item(j).querySelector('input').value;
            }
        }
        calculate();
    });
    function calculate() {
        const xhrForCalculate = new XMLHttpRequest();
        xhrForCalculate.open('POST', './api/FloydWarshall.php', true);
        xhrForCalculate.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
        xhrForCalculate.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                document.querySelector('#output').innerText = this.response;
            }
        }
        xhrForCalculate.send(JSON.stringify({data: data}));
    }
    /**
     * Suche und gebe ein Button-Element nach Id aus
     *
     * @param id
     * @returns {HTMLButtonElement}
     */
    function getButtonElementById(id) {
        return document.querySelector('#' + id);
    }
    /**
     * Suche und gebe ein Tabellen-Element nach Id aus
     *
     * @param id
     * @returns {HTMLTableElement}
     */
    function getTableElementById(id) {
        return document.querySelector('#' + id);
    }
</script>

</html>