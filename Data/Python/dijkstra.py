from argparse import ArgumentParser

def dijkstra(knoten, kanten, start, ziel):
    # knoten ist eine Liste von Knoten
    # kanten ist eine Liste von 3-Tupeln:
    #   (knoten1, knoten2, kosten)
    # start ist der Knoten, in dem die Suche startet
    # ziel ist der Knoten, zu dem ein Weg gesucht werden soll
    # Gibt ein Tupel zurück mit dem Weg und den Kosten
    #
    knotenEigenschaften = [ [i, float('inf'), None, False] for i in knoten if i != start ]
    knotenEigenschaften += [ [start, 0, None, False] ]
    for i in range(len(knotenEigenschaften)):
    	knotenEigenschaften[i] += [ i ]

    while True:
    	unbesuchteKnotenIterator = filter(lambda x: not x[3], knotenEigenschaften)
    	unbesuchteKnoten=list(unbesuchteKnotenIterator)
    	if not unbesuchteKnoten: break

    	sortierteListe = sorted(unbesuchteKnoten, key=lambda i: i[1])
    	aktiverKnoten = sortierteListe[0]
    	knotenEigenschaften[aktiverKnoten[4]][3] = True
    	if aktiverKnoten[0] == ziel:
    		break
    	aktiveKanten = list(filter(lambda x: x[0] == aktiverKnoten[0], kanten))
    	for kante in aktiveKanten:
    		andereKnotenListe=list(filter(lambda x: x[0] == kante[1], knotenEigenschaften))
    		andererKnotenId=andereKnotenListe[0][4]
    		gewichtSumme = aktiverKnoten[1]	+ kante[2]
    		if gewichtSumme < knotenEigenschaften[andererKnotenId][1]:
    			knotenEigenschaften[andererKnotenId][1] = gewichtSumme
    			knotenEigenschaften[andererKnotenId][2] = aktiverKnoten[4]


    if aktiverKnoten[0] == ziel:
    	weg = []
    	weg += [ aktiverKnoten[0] ]

    	kosten = aktiverKnoten[1]
    	while aktiverKnoten[0] != start:
    		aktiverKnoten = knotenEigenschaften[aktiverKnoten[2]]
    		weg += [ aktiverKnoten[0] ]

    	weg.reverse()
    	return (weg, kosten)
    else:
    	raise "Kein Weg gefunden"

def convertStringToTupleArray(knotenString):
    cutKnoten = knotenString.split(';')
    tupleArray = []

    for i in range(len(cutKnoten)):
        cutSpalten = cutKnoten[i].split(',')
        tempArray = []

        for b in range(len(cutSpalten)):
            if b == 2:
                tempArray.append(int(cutSpalten[b]))
            else:
                tempArray.append(cutSpalten[b])


        newTuple = tuple(tempArray)
        tupleArray.append(newTuple)

    return tupleArray

parser= ArgumentParser()
parser.add_argument('-k', '--knoten', dest="knoten")
parser.add_argument('-w', '--wege', dest="wege")
parser.add_argument('-s', '--start', dest="start")
parser.add_argument('-z', '--ziel', dest="ziel")
args= parser.parse_args()

if __name__ == "__main__":
    knoten = args.knoten.split(';')
    wege = convertStringToTupleArray(args.wege)

    ergebnis=dijkstra(knoten, wege, args.start, args.ziel)
    print("Kürzester Weg:" + str(ergebnis[0]) + " Kosten: " + str(ergebnis[1]) )