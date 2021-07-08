from HeapsortTD import TD_Heapsort

class BU_Heapsort(TD_Heapsort):
    '''
    Wir müssen nur das Einsinken anpassen!
    '''
    def sift_in(self,a,i,ende):
        vgl = 0
        if debug: print(a,i,ende,end=' ')
        start = i
        weg = [i]
        # Virtuellen Einsinkpfad bestimmen ("Weg" in der Tabelle)
        while i*2 <= ende: # Keine Kinder mehr:
            s_l = i*2   # linker Sohn
            s_r = i*2+1 # rechter Sohn
            # Bestimme das richtige Kind
            if s_r > ende: # es gibt nur das linke Kind
                i = s_l
            else:
                vgl += 1
                i = s_l if self.test_sohn(a[s_l-1],a[s_r-1]) else s_r
            weg.append(i)
        if debug: print(weg,end=' ')
        # Einfügeposition finden (epos)
        ringtausch = []
        epos=start
        for pos in reversed(weg):
            # Look for
            if ringtausch == [] and pos != start:
                vgl += 1
                # if self.test_wurzel(a[pos-1],a[start-1]): # Würde bei Gleichstand zur
                # Wurzel weiter nach oben rücken, semantisch ok, aber nicht, was das
                # Lernsystem möchte!
                # Besser:
                # Epos gefunden, wenn s >= w für max_heap bzw. s <= w für min_heap
                # Getestet wird das mit not (w > s) und not (w < s), weil so
                # unsere Bedingungen oben gesetzt sind (für TD)
                if not self.test_wurzel(a[start-1],a[pos-1]):
                    ringtausch = [start]
                    store = a[start-1]
                    epos = pos
            if ringtausch != []:
                ringtausch.append(pos)
                a[pos-1],store = store,a[pos-1]
        if debug: print("Epos:",epos, "Ringtausch:",ringtausch, "Vgl:",vgl)
        self.vgl += vgl # zählen der Vergleiche

debug = True

a = [17, 6, 11, 15, 5, 6, 1, 8]
b = a[:] # COPY of a
c = a[:] # Another COPY of a

h1 = BU_Heapsort(tiebreak="rechts")
vgl = h1.sort(a)
print("Aufsteigend sortiert: ",a,"\nVergleiche: ",vgl,"\n")

h2 = BU_Heapsort(tiebreak="links")
vgl = h2.sort(b)
print("Aufsteigend sortiert: ",b,"\nVergleiche: ",vgl,"\n")


h3 = BU_Heapsort('absteigend')
vgl = h3.sort(c)
print("Absteigend sortiert: ",c,"\nVergleiche: ",vgl,"\n")