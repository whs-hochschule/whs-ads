# Lösen wir das mit einem Algorithmus

# Zunächst brauchen wir eine Repräsentation des Graphen, eine einfache Möglichkeit ergibt sich
# über Adjazenzlisten, die in einem Dictionary (z.B. HashMap in JAVA) zusammengefasst werden
# Damit sind auch gleichzeitig die Knoten im Graph bestimmt

graph = {
    'Abschluss': [],
    'EPR': ['Projekt','ADS'],
    'Projekt': ['PXS', 'Abschluss'],
    'ADS': ['PXS'],
    'PXS': ['Abschluss'],
    'LDS': ['Projekt', 'PXS']
}

# Jetzt suchen wir eine lineare Ordnung zu einem gegebenen DAG, dies nennt sich:
# Topologisches Sortieren

# Wir wollen das wie oben angegeben machen.

# Hilfsfunktion - geht eleganter in Python und ist so zudem schrecklich ineffizient,
# dafür aber leicht zu verstehen
def hat_eingehende_kante(g,k):  # g ist ein Graph, k eine Kante
    knoten = g.keys()
    for kn in knoten:
        if k in g[kn]:
            return True
    return False

def topological_sort(g):

    if len(g) == 0: # Graph ist leer
        return []

    # Finde Knoten mit Eingangsgrad 0:
    #  Alle Knoten, die nicht in den Adjazenzlisten auftauchen!
    knoten = g.keys() # Knoten, die noch im Graph sind
    # Suche alle heraus, die keine eingehende Kante haben
    eingangsgrad_0 = [k for k in knoten if not hat_eingehende_kante(g,k)]
    print("Nodes to remove next: ", eingangsgrad_0) # Ausgabe zur Kontrolle

    # Entferne diese Knoten und Kanten aus dem Graph
    for k in eingangsgrad_0:
        del g[k]

    return eingangsgrad_0 + topological_sort(g) # das + vereinigt zwei Listen


print("\nLinear order: ", topological_sort(graph))