from math import inf
from argparse import ArgumentParser


# Helper funtion to print out a matrix more easily
# Show matrix in a formatted way (useful, if absolute weight of edges
# is smaller than 10):
def matrix(m, start=4):
    prefix = " " * start
    out = ""
    for i in range(0, len(m)):  # x-Dimension
        out += "\n" + prefix
        for j in m[i]:
            if j == '-':
                out += '-  '
            elif j == inf:
                out += u"\u221E" + '  '
            else:
                out += str(j)
                if j < 0:
                    out += ' '
                else:
                    out += '  '
            out += ' '
    return out


# Wir gehen im Algo davon aus, dass der Graph bereits als nxn-Matrix gegeben ist.
# Ignore the parameter special for now
def floyd_warshall(g, debug=False):
    shortest = []
    pred = []

    n = len(g)

    # Initialisierung of shortest
    shortest.append(g)  # We have a list of a matrix (which is logically a 3-dimensional matrix)
    # print(shortest[0][0][0]) # see how we can access it!

    # Initialisierung of pred
    pred_init = []
    for u in range(0, n):
        pred_row = []
        for v in range(0, n):
            pred_row.append(u + 1 if g[u][v] != inf else '-')
        pred_init.append(pred_row)
    pred.append(pred_init)
    # (This can be done somewhat nicer with numpy)

    if debug:
        print("shortest[u,v,0] = ", matrix(shortest[0]), "\n")
        print("pred[u,v,0] = ", matrix(pred[0]), "\n")

    # Note, to keep this somewhat simple locigally, the third index in our Scan is the first index here!
    for x in range(0, n):
        shortest_new = []
        pred_new = []
#         print(shortest[])
        for u in range(0, n):
            shortest_row = []
            pred_row = []
            for v in range(0, n):
                print(u + 1, v + 1, x, ": test", shortest[x][u][v], "against", shortest[x][u][x] + shortest[x][x][v])
                if shortest[x][u][v] > shortest[x][u][x] + shortest[x][x][v]:
                    shortest_row.append(shortest[x][u][x] + shortest[x][x][v])
                    pred_row.append(pred[x][x][v])
                else:
                    shortest_row.append(shortest[x][u][v])
                    pred_row.append(pred[x][u][v])
            shortest_new.append(shortest_row)
            pred_new.append(pred_row)
        shortest.append(shortest_new)
        pred.append(pred_new)
        if debug:
            print("\nshortest[u,v," + str(x + 1) + "] = ", matrix(shortest_new), "\n")
            print("pred[u,v," + str(x + 1) + "] = ", matrix(pred_new), "\n")

    return shortest[-1], pred[-1]


# Define the graph you want to try out. inf represents INFINITY, of course, meaning: there is no edge
# Avoid negative cycles or your results will not be correct
# graph = [
#     [0, 1, 3, 2],
#     [inf, 0, 2, 2],
#     [-6, inf, 0, -8],
#     [0, inf, 2, 0]
# ]


def convertToIntOrString(list1):
    list2 = []

    for i in range(len(list1)):
        if i != 0:
            if list1[i] == 'inf':
                list2.append(float(list1[i]))
            else:
                list2.append(int(list1[i]))
    return list2

parser = ArgumentParser()
parser.add_argument('-a1', '--zeile1', dest="zeile1")
parser.add_argument('-a2', '--zeile2', dest="zeile2")
parser.add_argument('-a3', '--zeile3', dest="zeile3")
parser.add_argument('-a4', '--zeile4', dest="zeile4")
args = parser.parse_args()

array1 = args.zeile1.split(',')
array1 = convertToIntOrString(array1)
array2 = args.zeile2.split(',')
array2 = convertToIntOrString(array2)
array3 = args.zeile3.split(',')
array3 = convertToIntOrString(array3)
array4 = args.zeile4.split(',')
array4 = convertToIntOrString(array4)
graph = [
    array1,
    array2,
    array3,
    array4
]

print("Graph: ", matrix(graph), "\n")

shortest, pred = floyd_warshall(graph, debug=True)

print("\nKosten der kürzesten Wege:\n", matrix(shortest))
print("\nVorgängerknoten auf den kürzesten Wegen:\n", matrix(pred))