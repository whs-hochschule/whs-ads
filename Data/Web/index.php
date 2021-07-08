<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <br>
    <br>
    <h1 align="center">Heapsort</h1>
</head>
<body>
<div class="container">
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-6">

<!--            <table class="table" id="heapsorttable">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th scope="col">1</th>-->
<!--                    <th scope="col">2</th>-->
<!--                    <th scope="col">3</th>-->
<!--                    <th scope="col">4</th>-->
<!--                    <th scope="col">5</th>-->
<!--                    <th scope="col">6</th>-->
<!--                    <th scope="col">Sohn</th>-->
<!--                    <th scope="col">🔼🔽</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                <tr>-->
<!--                    <td><input type="text" name="r1c1" value=""/></td>-->
<!--                    <td><input type="text" name="r1c2" value=""/></td>-->
<!--                    <td><input type="text" name="r1c3" value=""/></td>-->
<!--                    <td><input type="text" name="r1c4" value=""/></td>-->
<!--                    <td><input type="text" name="r1c5" value=""/></td>-->
<!--                    <td><input type="text" name="r1c6" value=""/></td>-->
<!--                    <td class="select">-->
<!--                        <select id="son">-->
<!--                            <option value="left">-->
<!--                                linker Sohn-->
<!--                            </option>-->
<!--                            <option value="right">-->
<!--                                rechter Sohn-->
<!--                            </option>-->
<!--                        </select>-->
<!--                    </td>-->
<!--                    <td class="select">-->
<!--                        <select id="sort">-->
<!--                            <option value="Aufsteigend">-->
<!--                                Aufsteigend-->
<!--                            </option>-->
<!--                            <option value="Absteigend">-->
<!--                                Absteigend-->
<!--                            </option>-->
<!--                        </select>-->
<!--                    </td>-->
<!--                </tr>-->
<!--                </tbody>-->
<!--            </table>-->
        </div>
    </div>
    <div class="row">
        <input id="inputfield" type="text" name="r1c1" value=""/>
        <button id="rechnen" type="button" class="btn-secondary m-2">Errechnen</button>
    </div>
    <br>
    <div class="row">
        <h2>Output</h2>
    </div>
    <div class="row" id="output"></div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

<script type="application/javascript">
    const submitButton = document.querySelector('#rechnen');
    const table = document.querySelector('#heapsorttable');
    let data

    // var sohn = document.getElementById('son');
    // var currentSohn = sohn.options[select.selectedIndex];
    // var sort = document.getElementById('sort');
    // var currentSort = sort.options[select.selectedIndex];

    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        const input = document.getElementById('inputfield')
        data = input.value;
        // let rowLength = table.rows.length;
        // for (let i = 1; i < rowLength; i++) {
        //     let objCells = table.rows.item(i).cells
        //     data[i] = {};
        //     for (let j = 0; j < objCells.length; j++) {
        //         if (objCells.item(j).querySelector('input').value)
        //             data[i][j] = objCells.item(j).querySelector('input').value;
        //     }
        // }
        calculate();
    })
    function calculate () {
        const xhrForCalculate = new XMLHttpRequest();
        xhrForCalculate.open('POST', 'Heapsort.php', true);
        xhrForCalculate.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

        xhrForCalculate.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                document.querySelector('#output').innerText = this.response;
            }
        }
        xhrForCalculate.send(JSON.stringify({data: data}));
    }

</script>

</html>