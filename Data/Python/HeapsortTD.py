## Top-Down Heapsort
class TD_Heapsort():
    def __init__(self,a,direction='aufsteigend',tiebreak='links'):
        # Prepare the correct test
        if direction == 'absteigend':
            self.test = lambda x,y: x < y
        else: # aufsteigend
            self.test = lambda x,y: x > y
        # Tiebreaking: left or right
        self.left = True if tiebreak=='links' else False
        self.vgl = 0 # Zählen der Vergleiche
        # Now sort it
        self.phase1(a)
        self.phase2(a)
        if debug: print("\nVergleiche:",self.vgl,"\n")

    '''
    Min-Heap für absteigende Sortierung (Wurzel <= Kinder)
    Max-Heap für aufsteigende Sortierung (Wurzel >= Kinder)

    Rekursive Lösung (damit es leichter nachverfolgbar ist)
    '''
    def sift_in(self,a,i,anfang,ende,step=0):
        if debug: print(a,"|",anfang,ende,"|",i,end=' ')
        s_l = i*2   # linker Sohn
        s_r = i*2+1 # rechter Sohn
        # Keine Kinder mehr, done
        if s_l > ende:
            if debug: print('-','-','-')
            return
        # Bestimme das richtige Kind
        if s_r > ende: # es gibt nur das linke Kind
            s = s_l
            if debug: s_r_str = '-'
        elif a[s_l-1] == a[s_r-1]:
            s = s_l if self.left else s_r
            if debug: s_r_str = str(s_r)
            self.vgl += 1
        else:
            self.vgl += 1
            s = s_l if self.test(a[s_l-1],a[s_r-1]) else s_r
            if debug: s_r_str = str(s_r)
        self.vgl += 1
        if self.test(a[s-1],a[i-1]):
            a[s-1],a[i-1] = a[i-1],a[s-1]
            if debug: print(s_l,s_r_str,s)
            self.sift_in(a,s,anfang,ende,step+1)
        elif debug: print(s_l,s_r_str,"-")


    def phase1(self,a):
        ende = len(a)
        mitte = (ende // 2)
        for anfang in range(mitte,0,-1):
            self.sift_in(a,anfang,anfang,ende)

    def phase2(self,a):
        l = len(a)
        for ende in range(l,1,-1):
            a[ende-1],a[1-1] = a[1-1],a[ende-1]
            self.sift_in(a,1,1,ende-1)

debug = True # Erzeugt eine tabellarische Ausgabe, die
             # der Tabelle aus Übung und Klausur entspricht

a = [15,11,14,17,2]
b = a[:] # COPY of a
c = a[:] # Another COPY of a

# print("Sortiere: ",a,"\n")
# TD_Heapsort(a,tiebreak='rechts')
# print("Aufsteigend sortiert, Tiebreak nach rechts: ",a,"\n\n")

# print("Sortiere: ",b,"\n")
# TD_Heapsort(b)
# print("Aufsteigend sortiert, Tiebreak nach links: ",b,"\n\n")

#
# print("Sortiere: ",c,"\n")
# TD_Heapsort(c,'absteigend')
# print("Absteigend sortiert, Tiebreak nach links: ",c)

# print("Sortiere: ",c,"\n")
# TD_Heapsort(c,'absteigend',tiebreak='rechts')
# print("Absteigend sortiert, Tiebreak nach rechts: ",c)