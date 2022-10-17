<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADS - Dijkstra</title>
    <link rel="stylesheet" href="./Resources/Main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
<body class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="/" class="btn btn-warning mb-5">Zurück zur Übersicht</a>
                <h1>Dijkstra</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 mb-3">
                <label for="inputField" class="form-label">Wege eingeben</label>
                <input type="text" name="inputField" class="form-control" id="inputField" placeholder="AB/2 AC/1 BC/4..." required />
            </div>
            <div class="col-12">
                <button type="submit" id="submitButton" name="submitButton" class="btn btn-secondary btn-lg">Ausführen</button>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <a href="https://paiza.io/projects/0HivGfTqTC27ue1JQJ4VAw?language=python" target="_blank" class="btn btn-warning">Zum Externen-Rechner</a>
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
        <h1>CODE für Externen Rechner</h1>
        <pre>
            <code>
                # coding: utf-8
                # Your code here!

                import sys

                class Vertex:
                def __init__(self, node):
                self.id = node
                self.adjacent = {}
                # Set distance to infinity for all nodes
                self.distance = sys.maxint
                # Mark all nodes unvisited
                self.visited = False
                # Predecessor
                self.previous = None

                def add_neighbor(self, neighbor, weight=0):
                self.adjacent[neighbor] = weight

                def get_connections(self):
                return self.adjacent.keys()

                def get_id(self):
                return self.id

                def get_weight(self, neighbor):
                return self.adjacent[neighbor]

                def set_distance(self, dist):
                self.distance = dist

                def get_distance(self):
                return self.distance

                def set_previous(self, prev):
                self.previous = prev

                def set_visited(self):
                self.visited = True

                def __str__(self):
                return str(self.id) + ' adjacent: ' + str([x.id for x in self.adjacent])

                class Graph:
                def __init__(self):
                self.vert_dict = {}
                self.num_vertices = 0

                def __iter__(self):
                return iter(self.vert_dict.values())

                def add_vertex(self, node):
                self.num_vertices = self.num_vertices + 1
                new_vertex = Vertex(node)
                self.vert_dict[node] = new_vertex
                return new_vertex

                def get_vertex(self, n):
                if n in self.vert_dict:
                return self.vert_dict[n]
                else:
                return None

                def add_edge(self, frm, to, cost = 0):
                if frm not in self.vert_dict:
                self.add_vertex(frm)
                if to not in self.vert_dict:
                self.add_vertex(to)

                self.vert_dict[frm].add_neighbor(self.vert_dict[to], cost)
                self.vert_dict[to].add_neighbor(self.vert_dict[frm], cost)

                def get_vertices(self):
                return self.vert_dict.keys()

                def set_previous(self, current):
                self.previous = current

                def get_previous(self, current):
                return self.previous

                def shortest(v, path):
                ''' make shortest path from v.previous'''
                if v.previous:
                path.append(v.previous.get_id())
                shortest(v.previous, path)
                return

                import heapq

                def dijkstra(aGraph, start, target):
                print '''Dijkstra's shortest path'''
                # Set the distance for the start node to zero
                start.set_distance(0)

                # Put tuple pair into the priority queue
                unvisited_queue = [(v.get_distance(),v) for v in aGraph]
                heapq.heapify(unvisited_queue)

                while len(unvisited_queue):
                # Pops a vertex with the smallest distance
                uv = heapq.heappop(unvisited_queue)
                current = uv[1]
                current.set_visited()

                #for next in v.adjacent:
                for next in current.adjacent:
                # if visited, skip
                if next.visited:
                continue
                new_dist = current.get_distance() + current.get_weight(next)

                if new_dist < next.get_distance():
                next.set_distance(new_dist)
                next.set_previous(current)
                print 'updated : current = %s next = %s new_dist = %s' \
                %(current.get_id(), next.get_id(), next.get_distance())
                else:
                print 'not updated : current = %s next = %s new_dist = %s' \
                %(current.get_id(), next.get_id(), next.get_distance())

                # Rebuild heap
                # 1. Pop every item
                while len(unvisited_queue):
                heapq.heappop(unvisited_queue)
                # 2. Put all vertices not visited into the queue
                unvisited_queue = [(v.get_distance(),v) for v in aGraph if not v.visited]
                heapq.heapify(unvisited_queue)

                if __name__ == '__main__':

                g = Graph()

                #
                # START UND ZIEL EINGEBEN!!!!
                #
                start = 'A'
                ziel = 'G'

                g.add_vertex('A')
                g.add_vertex('B')
                g.add_vertex('C')
                g.add_vertex('D')
                g.add_vertex('E')
                g.add_vertex('F')
                g.add_vertex('G')
                g.add_vertex('H')
                g.add_vertex('I')

                g.add_edge('A', 'D', 2)
                g.add_edge('B', 'F', 6)
                g.add_edge('B', 'I', 2)
                g.add_edge('C', 'E', 3)
                g.add_edge('C', 'H', 7)
                g.add_edge('D', 'F', 2)
                g.add_edge('E', 'G', 3)
                g.add_edge('G', 'I', 5)
                g.add_edge('H', 'I', 3)

                print 'Graph data:'
                for v in g:
                for w in v.get_connections():
                vid = v.get_id()
                wid = w.get_id()
                print '( %s , %s, %3d)'  % ( vid, wid, v.get_weight(w))

                dijkstra(g, g.get_vertex(start), g.get_vertex(ziel))

                target = g.get_vertex(ziel)
                path = [target.get_id()]
                shortest(target, path)
                print 'The shortest path : %s' %(path[::-1])
            </code>
        </pre>
    </div>
    <script src="./Resources/Main.js"></script>
</body>

<script type="application/javascript">
    const submitButton = document.querySelector('#submitButton');
    let wege;

    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        const wegeInput = document.getElementById('inputField')

        wege = wegeInput.value;
        calculate();
    })

    /**
     * Berechne Tabelle
     */
    function calculate () {
        const xhrForCalculate = new XMLHttpRequest();
        xhrForCalculate.open('POST', './api/Dijkstra.php', true);
        xhrForCalculate.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

        xhrForCalculate.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                document.querySelector('#output').innerText = this.response;
            }
        }
        xhrForCalculate.send(JSON.stringify({
            wege: wege
        }));
    }
</script>

</html>